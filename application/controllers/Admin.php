<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
  function __construct()
  {
      parent::__construct();
      $this->load->helper('url','custlog');
      $this->load->model('admin_model');
  }

  public function _start_layout($css_list,$screenID){
		$this->load->view('admin/layout/metadata'); 															//-- 메타데이터 로드
		$this->load->view('admin/layout/css',array('css_list'=>$css_list)); 			//-- CSS파일 로드 (배열로 파일명을 던짐)
    $this->load->view('admin/layout/sideMenu', array('screenID'=>$screenID));
		$this->load->view('admin/layout/wrap_start');                             //-- wrap 태그시작
    $this->load->view('admin/layout/header', array('screenID'=>$screenID));                             //-- 탑 헤더
	}

	public function _end_layout($js_list){
		//--------------------------------------------------------------------------------------------------------
		$this->load->view('admin/layout/wrap_end');                               //-- wrap 태그끝
		//--------------------------------------------------------------------------------------------------------
		$this->load->view('admin/layout/js',array('js_list'=>$js_list));	 			  //-- JS파일 로드 (배열로 파일명을 던짐)aa
		//--------------------------------------------------------------------------------------------------------
	}

	public function index()
	{
    $this->_start_layout(array('reset','layout'),'main');



    $this->_end_layout(array('layout'));
	}

  //////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //                    상점관리 컨트롤러                                                                      //
  //////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function shopMng()//---------------------------------------------------> 대쉬보드 VIEW
	{
    $this->_start_layout(array('reset','layout'),'shopMng');

    $this->load->view('admin/sampleDashboard');

    $this->_end_layout(array('layout','shopMng'));
	}

  public function bannerMng()//---------------------------------------------------> 배너관리 VIEW
	{
    $this->_start_layout(array('reset','layout','bannerMng'),'shopMng');

    $getData = $this->input->get();
    if(empty($getData['PAGE'])){
      $getData['PAGE'] = 1;
    }
    if(empty($getData['VIEW_CNT'])){
      $getData['VIEW_CNT'] = false;
    }

    $gridData = $this->admin_model->getBannerGridData($getData,'IQY');
    $rowCnt = $this->admin_model->getBannerGridData($getData,'CNT');

    $this->load->view('admin/shopMng/bannerMng', array('PAGE'=>$getData['PAGE'], 'GRID_DATA'=>$gridData->result(),'ROW_CNT'=>$rowCnt->num_rows(), 'GET_DATA'=>$getData));

    $this->_end_layout(array('layout','bannerMng'));
	}

  public function addBanner()//---------------------------------------------------> 배너추가 VIEW
	{
    $this->_start_layout(array('reset','layout','bannerMng'),'shopMng');

    $this->load->view('admin/shopMng/addBanner');

    $this->_end_layout(array('layout','bannerMng'));
	}



  //////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //                    회원관리 컨트롤러                                                                      //
  //////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function userMng()//---------------------------------------------------> 대쉬보드 VIEW
	{
    $this->_start_layout(array('reset','layout'),'userMng');

    $this->load->view('admin/sampleDashboard');

    $this->_end_layout(array('layout','userMng'));
	}

  public function inquiryUser()//---------------------------------------------> 회원정보 조회 VIEW
	{
    $getData = $this->input->get();
    if(empty($getData['PAGE'])){
      $getData['PAGE'] = 1;
    }
    if(empty($getData['VIEW_CNT'])){
      $getData['VIEW_CNT'] = false;
    }
    if(empty($getData['WORK_DV'])){
      $getData['WORK_DV'] = NULL;
    }
    $gridData = $this->admin_model->getUserDataGrid($getData,'IQY');
    $rowCnt = $this->admin_model->getUserDataGrid($getData,'CNT');
    $comboLevel = $this->admin_model->getCommonCode('회원정보','회원등급코드');
    $combo2 = $this->admin_model->getCommonCodeAllCodeDV($getData['WORK_DV']);
    $this->_start_layout(array('reset','layout','userMng'),'userMng');

    $this->load->view('admin/userMng/inquiryUser', array('PAGE'=>$getData['PAGE'], 'GRID_DATA'=>$gridData->result(),'ROW_CNT'=>$rowCnt->num_rows(), 'COMBO_LEVEL'=>$comboLevel, 'GET_DATA'=>$getData));
    $this->load->view('admin/layout/importCalendar');

    $this->_end_layout(array('layout','userMng'));
	}

  public function modifyUserLevel()//---------------------------------------------> 회원등급관리 VIEW
	{
    $getData = $this->input->get();
    if(empty($getData['PAGE'])){
      $getData['PAGE'] = 1;
    }
    if(empty($getData['VIEW_CNT'])){
      $getData['VIEW_CNT'] = false;
    }
    if(empty($getData['WORK_DV'])){
      $getData['WORK_DV'] = NULL;
    }
    $gridData = $this->admin_model->getUserDataGrid($getData,'IQY');
    $rowCnt = $this->admin_model->getUserDataGrid($getData,'CNT');
    $comboLevel = $this->admin_model->getCommonCode('회원정보','회원등급코드');
    $combo2 = $this->admin_model->getCommonCodeAllCodeDV($getData['WORK_DV']);
    $this->_start_layout(array('reset','layout','userMng'),'userMng');

    $this->load->view('admin/userMng/modifyUserLevel', array('PAGE'=>$getData['PAGE'], 'GRID_DATA'=>$gridData->result(),'ROW_CNT'=>$rowCnt->num_rows(), 'COMBO_LEVEL'=>$comboLevel, 'GET_DATA'=>$getData));
    $this->load->view('admin/layout/importCalendar');

    $this->_end_layout(array('layout','userMng'));
	}

  public function insertUser() //---------------------------------------------> 공통코드관리 추가 SERVICE
  {
    $postData = $this->input->post();
    $postData['PASSWORD'] = password_hash($postData['PASSWORD'], PASSWORD_BCRYPT);
    $this->admin_model->insertUser($postData);
    $this->load->view('module/redirect',  array('url'=>'/admin/inquiryUser'));
  }

  public function ajaxModifyUserLevel(){
    $ID = $this->input->post('ID');
    $LEVEL = $this->input->post('USER_LEVEL');
    foreach($ID as $item){
      $this->admin_model->updateUserLevel($item,$LEVEL);
    }
    echo json_encode(array('result'=>true));
  }

  //////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //                    상품관리 컨트롤러                                                                      //
  //////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function productMng()//---------------------------------------------------> 대쉬보드 VIEW
	{
    $this->_start_layout(array('reset','layout'),'productMng');

    $this->load->view('admin/sampleDashboard');

    $this->_end_layout(array('layout','productMng'));
	}

  public function ProductList(){
    $getData = $this->input->get();
    if(empty($getData['PAGE'])){
      $getData['PAGE'] = 1;
    }
    if(empty($getData['VIEW_CNT'])){
      $getData['VIEW_CNT'] = false;
    }
    $gridData = $this->admin_model->getProductList($getData,'IQY');
    $rowCnt = $this->admin_model->getProductList($getData,'CNT');
    $this->_start_layout(array('reset','layout','productMng'),'productMng');

    $this->load->view('admin/productMng/ProductList', array('PAGE'=>$getData['PAGE'], 'GRID_DATA'=>$gridData->result(), 'ROW_CNT'=>$rowCnt->num_rows(), 'GET_DATA'=>$getData));
    $this->load->view('admin/layout/importCalendar');

    $this->_end_layout(array('layout','productMng'));
  }

  public function addProduct()//---------------------------------------------> 상품추가 VIEW
	{
    $this->_start_layout(array('reset','layout','productMng'),'productMng');

    $OPTION_SET = $this->admin_model->getOptionSetAll();
    $this->load->view('admin/productMng/addProduct', array('OPTION_SET'=>$OPTION_SET));

    $this->_end_layout(array('layout','productMng'));
	}

  public function modifyPRoduct($PRD_ID)//---------------------------------------------> 상품수정 VIEW
	{
    $this->_start_layout(array('reset','layout','productMng'),'productMng');

    $OPTION_SET = $this->admin_model->getOptionSetAll();
    $PRD_BASE = $this->admin_model->getProductBaseByID($PRD_ID);
    $PRD_IMG = $this->admin_model->getProductImgByID($PRD_ID);
    $PRD_OPTION = $this->admin_model->getProductOptionByID($PRD_ID);
    $this->load->view('admin/productMng/modifyProduct', array('OPTION_SET'=>$OPTION_SET, 'PRD_BASE'=>$PRD_BASE, 'PRD_IMG'=>$PRD_IMG, 'PRD_OPTION'=>$PRD_OPTION));

    $this->_end_layout(array('layout','productMng'));
	}

  public function optionMng()//---------------------------------------------> 상품옵션관리 VIEW
	{
    $getData = $this->input->get();
    if(empty($getData['PAGE'])){
      $getData['PAGE'] = 1;
    }
    if(empty($getData['VIEW_CNT'])){
      $getData['VIEW_CNT'] = false;
    }
    $gridData = $this->admin_model->getProductOptionList($getData,'IQY');
    $rowCnt = $this->admin_model->getProductOptionList($getData,'CNT');
    $this->_start_layout(array('reset','layout','optionMng'),'productMng');

    $this->load->view('admin/productMng/optionMng', array('PAGE'=>$getData['PAGE'], 'GRID_DATA'=>$gridData->result(), 'ROW_CNT'=>$rowCnt->num_rows(), 'GET_DATA'=>$getData));
    $this->load->view('admin/layout/importCalendar');

    $this->_end_layout(array('layout','optionMng'));
	}

  public function ajaxAddOption(){// ---------------------------------------------옵션 추가 AJAX
    $OPTION_ID = $this->admin_model->getOptionID();
    $OPTION_NAME = $this->input->post('OPTION_NAME');
    $OPTION_ARR = $this->input->post('OPTION_ARR');
    $OPTION_DESC = $this->input->post('OPTION_DESC');
    $this->admin_model->addOptionBase($OPTION_ID, $OPTION_NAME, $OPTION_DESC);
    $ROW_CNT = 0;
    foreach($OPTION_ARR as $item){
      $ROW_CNT++;
      $OPTION_CD = STR_PAD($ROW_CNT,2,0,STR_PAD_LEFT);
      $this->admin_model->addOptionDetail($OPTION_ID, $OPTION_CD, $item['OPTION_VALUE'], $item['OPTION_PRICE']);
    }
    echo json_encode(array('result'=>true));
  }

  public function ajaxDeleteOption(){// ---------------------------------------------옵션 삭제 AJAX
    $OPTION_ID_ARR = $this->input->post('OPTION_ID_ARR');
    foreach($OPTION_ID_ARR as $item){
      $this->admin_model->deleteOptionBaseByID($item);
      $this->admin_model->deleteOptionDetailByID($item);
    }
    echo json_encode(array('result'=>true));
  }

  public function ajaxGetOptionByID(){// ---------------------------------------------옵션 조회 By ID AJAX
    $OPTION_ID = $this->input->post('IDXKEY');
    $OPTION_DATA = $this->admin_model->getOptionByID($OPTION_ID);
    echo json_encode($OPTION_DATA);
  }

  public function ajaxModifyOption(){ // ---------------------------------------------옵션 수정 AJAX
    $OPTION_ID = $this->input->post('OPTION_ID');
    $OPTION_NAME = $this->input->post('OPTION_NAME');
    $OPTION_ARR = $this->input->post('OPTION_ARR');
    $OPTION_DESC = $this->input->post('OPTION_DESC');
    $this->admin_model->updateOptionBase($OPTION_ID, $OPTION_NAME, $OPTION_DESC);
    $this->admin_model->deleteOptionDetailByID($OPTION_ID);
    $ROW_CNT = 0;
    foreach($OPTION_ARR as $item){
      $ROW_CNT++;
      $OPTION_CD = STR_PAD($ROW_CNT,2,0,STR_PAD_LEFT);
      $this->admin_model->addOptionDetail($OPTION_ID, $OPTION_CD, $item['OPTION_VALUE'], $item['OPTION_PRICE']);
    }
    echo json_encode(array('result'=>true));
  }

  public function optionSetMng()//---------------------------------------------> 상품옵션셋관리 VIEW
	{
    $getData = $this->input->get();
    if(empty($getData['PAGE'])){
      $getData['PAGE'] = 1;
    }
    if(empty($getData['VIEW_CNT'])){
      $getData['VIEW_CNT'] = false;
    }
    $gridData = $this->admin_model->getProductOptionSetList($getData,'IQY');
    $rowCnt = $this->admin_model->getProductOptionSetList($getData,'CNT');
    $OPTION_LIST = $this->admin_model->getProductOptionList($getData,'CNT')->result();
    $this->_start_layout(array('reset','layout','optionMng'),'productMng');

    $this->load->view('admin/productMng/optionSetMng', array('PAGE'=>$getData['PAGE'], 'GRID_DATA'=>$gridData->result(), 'ROW_CNT'=>$rowCnt->num_rows(), 'GET_DATA'=>$getData, 'OPTION_LIST'=>$OPTION_LIST));
    $this->load->view('admin/layout/importCalendar');

    $this->_end_layout(array('layout','optionMng'));
	}

  public function ajaxAddOptionSet(){ // ---------------------------------------------옵션셋 추가 AJAX
    $OPTION_SET_ID = $this->admin_model->getOptionSetID();
    $OPTION_SET_NAME = $this->input->post('OPTION_SET_NAME');
    $OPTION_ID_ARR = $this->input->post('OPTION_ID_ARR');
    $OPTION_SET_DESC = $this->input->post('OPTION_SET_DESC');
    $this->admin_model->addOptionSetBase($OPTION_SET_ID, $OPTION_SET_NAME, $OPTION_SET_DESC);
    $ROW_CNT = 0;
    foreach($OPTION_ID_ARR as $item){
      $this->admin_model->addOptionSetDetail($OPTION_SET_ID, $item);
    }
    echo json_encode(array('result'=>true));
  }

  public function ajaxDeleteOptionSet(){// ---------------------------------------------옵션셋 삭제 AJAX
    $OPTION_SET_ID_ARR = $this->input->post('OPTION_SET_ID_ARR');
    foreach($OPTION_SET_ID_ARR as $item){
      $this->admin_model->deleteOptionSetBaseByID($item);
      $this->admin_model->deleteOptionSetDetailByID($item);
    }
    echo json_encode(array('result'=>true));
  }

  public function ajaxGetOptionSetByID(){// ---------------------------------------------옵션셋 조회 By ID AJAX
    $OPTION_SET_ID = $this->input->post('IDXKEY');
    $OPTION_SET_DATA = $this->admin_model->getOptionSetByID($OPTION_SET_ID);
    echo json_encode($OPTION_SET_DATA);
  }

  public function ajaxModifyOptionSet(){ // ---------------------------------------------옵션셋 수정 AJAX
    $OPTION_SET_ID = $this->input->post('OPTION_SET_ID');
    $OPTION_SET_NAME = $this->input->post('OPTION_SET_NAME');
    $OPTION_ID_ARR = $this->input->post('OPTION_ID_ARR');
    $OPTION_SET_DESC = $this->input->post('OPTION_SET_DESC');
    $this->admin_model->updateOptionSetBase($OPTION_SET_ID, $OPTION_SET_NAME, $OPTION_SET_DESC);
    $this->admin_model->deleteOptionSetDetailByID($OPTION_SET_ID);
    foreach($OPTION_ID_ARR as $item){
      $this->admin_model->addOptionSetDetail($OPTION_SET_ID, $item);
    }
    echo json_encode(array('result'=>true));
  }


  //////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //                    샘플 컨트롤러                                                                          //
  //////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function sampleDashboard()
  {
    $this->_start_layout(array('reset','layout'),'sample');

    $this->load->view('admin/sampleDashboard');

    $this->_end_layout(array('layout'));
  }

  public function sampleGrid()
  {
    $getData = $this->input->get();
    if(empty($getData['page'])){
      $getData['page'] = 1;
    }
    $this->_start_layout(array('reset','layout','circle'),'sample');

    $this->load->view('admin/sampleGrid', array('page'=>$getData['page']));

    $this->_end_layout(array('layout'));
  }




  //////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //                    코드관리 컨트롤러                                                                      //
  //////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function codeMng()//---------------------------------------------------> 대쉬보드 VIEW
  {
    $this->_start_layout(array('reset','layout'),'codeMng');

    $this->load->view('admin/sampleDashboard');

    $this->_end_layout(array('layout','codeMng'));
  }

  public function commonCodeMng()//---------------------------------------------> 공통코드관리 VIEW
  {
    $getData = $this->input->get();
    if(empty($getData['PAGE'])){
      $getData['PAGE'] = 1;
    }
    if(empty($getData['VIEW_CNT'])){
      $getData['VIEW_CNT'] = false;
    }
    if(empty($getData['WORK_DV'])){
      $getData['WORK_DV'] = NULL;
    }
    $gridData = $this->admin_model->getCommonCodeDataGrid($getData,'IQY');
    $rowCnt = $this->admin_model->getCommonCodeDataGrid($getData,'CNT');
    $combo1 = $this->admin_model->getCommonCodeAllWorkDV();
    $combo2 = $this->admin_model->getCommonCodeAllCodeDV($getData['WORK_DV']);
    $this->_start_layout(array('reset','layout','codeMng'),'codeMng');

    $this->load->view('admin/codeMng/commonCodeMng', array('PAGE'=>$getData['PAGE'], 'GRID_DATA'=>$gridData->result(),'ROW_CNT'=>$rowCnt->num_rows(),'COMBO_1'=>$combo1, 'COMBO_2'=>$combo2, 'GET_DATA'=>$getData));

    $this->_end_layout(array('layout','codeMng'));
  }

  public function insertCommonCode() //---------------------------------------------> 공통코드관리 추가 SERVICE
  {
    $postData = $this->input->post();
    $IDXKEY = $this->admin_model->makeIDXKEY('01');
    $postData['IDXKEY'] = $IDXKEY;
    $this->admin_model->insertCommonCode($postData);
    $this->load->view('module/redirect',  array('url'=>'/admin/commonCodeMng?WORK_DV='.$postData['WORK_DV'].'&CODE_DV='.$postData['CODE_DV']));
  }

  public function ajaxGetCodeDVByWorkDV(){ //---------------------------------------------> 공통코드->업무구분코드 조회 AJAX
    $WORK_DV = $this->input->post('WORK_DV');
    $ajaxData = $this->admin_model->getCommonCodeAllCodeDV($WORK_DV);
    echo json_encode(array('result'=>true, 'data'=>$ajaxData));
  }

  public function ajaxDeleteCommonCode(){ //---------------------------------------------> 공통코드 삭제 AJAX
    $IDXKEY = $this->input->post('IDXKEY');
    foreach($IDXKEY as $item){
      $this->admin_model->deleteCommonCodeByIDXKEY($item);
    }
    echo json_encode(array('result'=>true));
  }
  public function ajaxGetCommonCodeByIDXKEY(){ //---------------------------------------------> 공통코드를 인덱스키로 조회 AJAX
    $IDXKEY = $this->input->post('IDXKEY');
    $ajaxData = $this->admin_model->getCommonCodeByIDXKEY($IDXKEY);
    echo json_encode(array('result'=>true, 'data'=>$ajaxData));
  }
}
