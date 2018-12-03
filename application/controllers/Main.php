<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

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
		$js_list = array('layout');															//-- JS파일 리스트 배열
		$this->load->view('layout/js',array('js_list'=>$js_list));	 			  //-- JS파일 로드 (배열로 파일명을 던짐)
		//--------------------------------------------------------------------------------------------------------
	}

	public function stylesheet()
	{
		$this->_start_layout(array('reset','layout'));                          //-- 레이아웃 시작
		//--------------------------------------------------------------------------------------------------------

		$this->load->view('layout/sample');

		//--------------------------------------------------------------------------------------------------------
		$this->_end_layout(array('layout'));                                    //-- 레이아읏 끝
	}

	public function index(){
		$this->_start_layout(array('reset','layout','main','swiper'));                          //-- 레이아웃 시작
		//--------------------------------------------------------------------------------------------------------

		$this->load->model('layout_model');
		$BANNER_DATA = $this->layout_model->getMainBanner();
		$this->load->view('main', array('BANNER_DATA'=>$BANNER_DATA));

		//--------------------------------------------------------------------------------------------------------
		$this->_end_layout(array('layout','swiper'));                                    //-- 레이아읏 끝
	}
}
