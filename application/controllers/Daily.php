<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daily extends CI_Controller {

  function __construct()
  {
      parent::__construct();
      $this->load->helper('url');
      $this->load->model('product_model');
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

	public function index()//----------------------------------------------------------------------------------------------// [오늘의꽃] 상품리스트 VIEW
	{
    $this->_start_layout(array('reset','layout','productList'));                          //-- 레이아웃 시작
		//--------------------------------------------------------------------------------------------------------

    $PRODUCT = $this->product_model->getProductList();
		$this->load->view('daily/productList', array('PRODUCT'=>$PRODUCT));

		//--------------------------------------------------------------------------------------------------------
		$this->_end_layout(array('layout','productList'));                                    //-- 레이아읏 끝
	}

  public function detail($PRD_ID)//----------------------------------------------------------------------------------------------// [오늘의꽃] 상품 상세보기 VIEW
	{
    $this->_start_layout(array('reset','layout','productDetail'));                          //-- 레이아웃 시작
		//--------------------------------------------------------------------------------------------------------

    $PRODUCT = $this->product_model->getProductById($PRD_ID);
    $PRODUCT_IMG = $this->product_model->getProductImgById($PRD_ID);
    $PRODUCT_OPTION = $this->product_model->getProductOptionById($PRD_ID);
		$this->load->view('daily/productDetail', array('PRODUCT'=>$PRODUCT, 'PRODUCT_IMG'=>$PRODUCT_IMG, 'PRODUCT_OPTION'=>$PRODUCT_OPTION));

		//--------------------------------------------------------------------------------------------------------
		$this->_end_layout(array('layout','productDetail'));                                    //-- 레이아읏 끝
	}
}
