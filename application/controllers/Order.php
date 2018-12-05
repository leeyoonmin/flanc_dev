<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

  function __construct()
  {
      parent::__construct();
      $this->load->helper('url');
      $this->load->model('product_model');
      $this->load->model('cart_model');
      $this->load->model('auth_model');
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
    $this->_start_layout(array('reset','layout','order'));                          //-- 레이아웃 시작
		//--------------------------------------------------------------------------------------------------------

    $ORDER_LIST = $this->cart_model->getCartListById($this->session->userdata('user_id'));
    $USER_DATA = $this->auth_model->getUserDataById($this->session->userdata('user_id'));
		$this->load->view('order/writeOrder', array('ORDER_LIST'=>$ORDER_LIST, 'USER_DATA'=>$USER_DATA));

		//--------------------------------------------------------------------------------------------------------
		$this->_end_layout(array('layout','order'));                                    //-- 레이아읏 끝
	}

}
