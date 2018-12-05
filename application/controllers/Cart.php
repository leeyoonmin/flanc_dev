<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

  function __construct()
  {
      parent::__construct();
      $this->load->helper('url');
      $this->load->model('product_model');
      $this->load->model('cart_model');
  }

  public function _start_layout($css_list){
		$this->load->view('layout/metadata'); 															//-- 메타데이터 로드
		$this->load->view('layout/css',array('css_list'=>$css_list)); 			//-- CSS파일 로드 (배열로 파일명을 던짐)
		$this->load->view('layout/wrap_start');                             //-- wrap 태그시작
		$this->load->view('layout/header');                                 //-- 헤더 추가
		$this->load->view('layout/slideMenu');                                 //-- 슬라이드 메뉴 추가
		$this->load->view('layout/contents_start');                         //-- 메인 콘텐츠 시작
	}

	public function _end_layout($js_list){
		//--------------------------------------------------------------------------------------------------------
		$this->load->view('layout/contents_end');                           //-- 메인 콘텐츠 끝
		$this->load->view('layout/wrap_end');                               //-- wrap 태그끝
		//--------------------------------------------------------------------------------------------------------
		$this->load->view('layout/js',array('js_list'=>$js_list));	 			  //-- JS파일 로드 (배열로 파일명을 던짐)
		//--------------------------------------------------------------------------------------------------------
	}

  public function index()//----------------------------------------------------------------------------------------------// [카트] 장바구니 VIEW
	{
    $this->_start_layout(array('reset','layout','cart'));                          //-- 레이아웃 시작
		//--------------------------------------------------------------------------------------------------------

    $CART_LIST = $this->cart_model->getCartListById($this->session->userdata('user_id'));
		$this->load->view('cart/cart', array('CART_LIST'=>$CART_LIST));

		//--------------------------------------------------------------------------------------------------------
		$this->_end_layout(array('layout','cart'));                                    //-- 레이아읏 끝
	}

	public function addCart()//----------------------------------------------------------------------------------------------// [카트 ] 상품상세 카트 담기 AJAX
	{
    $PRD_ID = $this->input->post('PRD_ID');
    $OPTION = $this->input->post('OPTION');
    $TT_PRICE = $this->input->post('TT_PRICE');
    $PRD_PRICE = $this->input->post('PRD_PRICE');

    $CART_ID = $this->cart_model->makeCartId();

    $param = array(
      'CART_ID'   => $CART_ID,
      'USER_ID'   => $this->session->userdata('user_id'),
      'PRD_ID'    => $PRD_ID,
      'PRD_PRICE' => $PRD_PRICE,
      'QTY'       => 1,
      'TT_PRICE'  => $TT_PRICE
    );

    $dupleCheck = $this->cart_model->duplicateCheck($PRD_ID, $OPTION);

    if(empty($dupleCheck)){
      $this->cart_model->addCart($param);
      if(!empty($OPTION)){
        foreach($OPTION as $item){
          $param = array(
            'CART_ID' => $CART_ID,
            'OPTION_ID' => $item['OPTION_ID'],
            'OPTION_CD' => $item['OPTION_CD'],
            'OPTION_VALUE' => $item['OPTION_VALUE'],
            'OPTION_PRICE' => $item['OPTION_PRICE'],
          );
          $this->cart_model->addCartOption($param);
        }
      }
    }else{
      $this->cart_model->updateCartQty($dupleCheck);
    }

    echo json_encode(array('result'=>true, 'data'=>true));
	}

  function deleteCart(){
    $CART_ID_ARR = $this->input->post('CART_ID_ARR');
    if($CART_ID_ARR=='ALL'){
      $CART_ID_ARR_GET_DB = $this->cart_model->getCartIdByUser($this->session->userdata('user_id'));
      foreach($CART_ID_ARR_GET_DB as $CART_ID){
        $this->cart_model->deleteCartById($CART_ID->CART_ID);
      }
      echo json_encode(array('result'=>true, 'data'=>true));
    }else{
      foreach($CART_ID_ARR as $CART_ID){
        $this->cart_model->deleteCartById($CART_ID);
      }
      echo json_encode(array('result'=>true, 'data'=>true));
    }
  }

  function updateCartQty(){
    $CART_ID = $this->input->post('CART_ID');
    $MODE = $this->input->post('MODE');
    $QTY = $this->cart_model->getCartQtyById($CART_ID);
    if($MODE == "PLUS"){
      $QTY = $QTY + 1;
    }else{
      $QTY = $QTY - 1;
    }
    $this->cart_model->updateCartQtyByQty($CART_ID,$QTY);
    if($QTY == 0){
      $this->cart_model->deleteCartById($CART_ID);
    }
    echo json_encode(array('result'=>true, 'data'=>true));
  }

}
