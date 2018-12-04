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

  function index(){

  }

	public function addCart()//----------------------------------------------------------------------------------------------// [오늘의꽃] 상품상세 카트 담기 AJAX
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

    $IS_CART = $this->cart_model->duplicateCheck($PRD_ID, $OPTION);

    var_dump($IS_CART);
    /*
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
    */


    echo json_encode(array('result'=>true, 'data'=>true));

	}

}
