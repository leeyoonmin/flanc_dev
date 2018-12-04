<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

  function __construct()
  {
      parent::__construct();
      $this->load->helper('url');
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

  public function join()//---------------------------------------------------------------------------------------------// [회원가입] 회원가입 메인 페이지 VIEW
	{
    $this->_start_layout(array('reset','layout','join'));                          //-- 레이아웃 시작
		//--------------------------------------------------------------------------------------------------------

		$this->load->view('auth/join', array());

		//--------------------------------------------------------------------------------------------------------
		$this->_end_layout(array('layout','join'));                                    //-- 레이아읏 끝
	}

  public function joinPrc(){//---------------------------------------------------------------------------------------------// [회원가입] 회원가입 프로세스 AJAX
    $postData = $this->input->post();
    $postData['PW'] = password_hash($postData['PW'], PASSWORD_BCRYPT);
    $postData['EMAIL'] = $postData['EMAIL1']."@".$postData['EMAIL2'];
    $this->auth_model->addUser($postData);
    $this->session->set_userdata('is_login', true);
    $this->session->set_userdata('user_id', $postData['ID']);
    $this->session->set_userdata('user_name', $postData['NAME']);
    $this->session->set_userdata('user_level', '01');
    echo json_encode(array('result'=>true, 'data'=>true));
  }

  public function joinResult(){
    $this->_start_layout(array('reset','layout','join'));                          //-- 레이아웃 시작
		//--------------------------------------------------------------------------------------------------------

    $userData = $this->auth_model->getUserDataById($this->session->userdata('user_id'));
		$this->load->view('auth/joinResult', array('userData'=>$userData));

		//--------------------------------------------------------------------------------------------------------
		$this->_end_layout(array('layout','join'));                                    //-- 레이아읏 끝
  }

  public function login(){
    $this->_start_layout(array('reset','layout','login'));                          //-- 레이아웃 시작
		//--------------------------------------------------------------------------------------------------------

    $PREV_URL = $this->input->get('PREV_URL');
    if(empty($PREV_URL)){
      $PREV_URL = "/";
    }
		$this->load->view('auth/login', array('PREV_URL'=>$PREV_URL));

		//--------------------------------------------------------------------------------------------------------
		$this->_end_layout(array('layout','login'));                                    //-- 레이아읏 끝
  }

  public function logout(){
    $this->session->set_userdata('is_login', false);
    $this->session->set_userdata('user_id', '');
    $this->session->set_userdata('user_name', '');
    $this->session->set_userdata('user_level', '');
    $this->load->view('module/redirect', array('url'=>'/'));
  }

  public function loginPrc(){
    $postData = $this->input->post();
    $PASSWORD = $this->auth_model->getPasswordById($postData);

    if(password_verify($postData['PW'], $PASSWORD)){
      $userData = $this->auth_model->getUserDataById($postData['ID']);
      $this->session->set_userdata('is_login', true);
      $this->session->set_userdata('user_id', $userData->ID);
      $this->session->set_userdata('user_name', $userData->NAME);
      $this->session->set_userdata('user_level', $userData->LEVEL);
      echo json_encode(array('result'=>true, 'data'=>true));
    }else{
      echo json_encode(array('result'=>true, 'data'=>false));
    }
  }
}
