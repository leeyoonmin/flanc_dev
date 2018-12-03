<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
  function __construct(){
      parent::__construct();
      $this->load->helper('custlog');
  }
  public function makeIDXKEY($WORK_CD){
    if($WORK_CD == '01'){
      $IDXKEY = $WORK_CD."01".date('Ymdhis',time()).'01';
      $sql = "
        SELECT
          CASE WHEN COUNT(1) = 0
               THEN '".$IDXKEY."'
               ELSE CONCAT('".substr($IDXKEY,1,18)."',(
                                  SELECT LPAD(MAX(SUBSTR(IDXKEY,-2)+1),2,0)
                                    FROM TB_COMMON_CODE
                                   WHERE SUBSTR(IDXKEY,1,18) = '".substr($IDXKEY,1,18)."'
                                  )
                           ) END AS IDXKEY
          FROM TB_COMMON_CODE
         WHERE IDXKEY = '".$IDXKEY."'
      ";
    }
    return  $this->db->query($sql)->row()->IDXKEY;
  }
  public function getCommonCodeDataGrid($param,$mode){
    $sql = "
      SELECT
          IDXKEY
        , WORK_DV
        , CODE_DV
        , CODE_NM
        , CODE
        , IS_USE
        , CREATED
        FROM TB_COMMON_CODE
        WHERE 1=1
    ";
    if(!empty($param['WORK_DV'])){
      $sql = $sql."
        AND WORK_DV = '".$param['WORK_DV']."'
      ";
    }
    if(!empty($param['CODE_DV'])){
      $sql = $sql."
        AND CODE_DV = '".$param['CODE_DV']."'
      ";
    }
    if(!empty($param['CODE_NM'])){
      $sql = $sql."
        AND CODE_NM LIKE '%".$param['CODE_NM']."%'
      ";
    }
    if(!empty($param['CODE'])){
      $sql = $sql."
        AND CODE LIKE '%".$param['CODE']."%'
      ";
    }
    $sql = $sql."
      ORDER BY WORK_DV, CODE_DV, CODE
    ";
    if(empty($param['PAGE']) && $mode=="IQY"){
      if($param['VIEW_CNT']=='false'){
        $sql = $sql."
        limit 0,10
        ";
      }else{
        $sql = $sql."
        limit 0,100
        ";
      }
    }else if(!empty($param['PAGE']) && $mode=="IQY"){
      if($param['VIEW_CNT']=='false'){
        $sql = $sql."
        limit ".(($param['PAGE']*10)-10).",10
        ";
      }else{
        $sql = $sql."
        limit ".(($param['PAGE']*100)-100).",100
        ";
      }
    }
    $result = $this->db->query($sql);
    custlogR('sql',__class__,__function__,$this->session->userdata('user_id'),$sql,$result->result());
    return $result;
  }

  function insertCommonCode($param){
    $sql = "
      INSERT INTO TB_COMMON_CODE(IDXKEY, WORK_DV, CODE_DV, CODE_NM, CODE, IS_USE, CREATED)
      VALUE(
           '".$param['IDXKEY']."'
         , '".$param['WORK_DV']."'
         , '".$param['CODE_DV']."'
         , '".$param['CODE_NM']."'
         , '".$param['CODE']."'
         , '".$param['IS_USE']."'
         , NOW()+0
      )
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  function getCommonCode($WORK_DV,$CODE_DV){
    $sql = "
      SELECT WORK_DV, CODE_DV, CODE_NM, CODE
        FROM TB_COMMON_CODE
        WHERE WORK_DV = '".$WORK_DV."'
          AND CODE_DV = '".$CODE_DV."'
       ORDER BY CODE
    ";
    $result = $this->db->query($sql);
    custlogR('sql',__class__,__function__,$this->session->userdata('user_id'),$sql,$result->result());
    return $result->result();
  }

  function getCommonCodeAllWorkDV(){
    $sql = "
      SELECT WORK_DV
        FROM TB_COMMON_CODE
       GROUP BY WORK_DV
       ORDER BY WORK_DV
    ";
    $result = $this->db->query($sql);
    custlogR('sql',__class__,__function__,$this->session->userdata('user_id'),$sql,$result->result());
    return $result->result();
  }

  function getCommonCodeAllCodeDV($WORK_DV){
    $sql = "
      SELECT CODE_DV
        FROM TB_COMMON_CODE
       WHERE WORK_DV = '".$WORK_DV."'
       GROUP BY CODE_DV
       ORDER BY CODE_DV
    ";
    $result = $this->db->query($sql);
    custlogR('sql',__class__,__function__,$this->session->userdata('user_id'),$sql,$result->result());
    return $result->result();
  }

  function deleteCommonCodeByIDXKEY($IDXKEY){
    $sql = "
      DELETE FROM TB_COMMON_CODE
      WHERE IDXKEY = '".$IDXKEY."'
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  function getCommonCodeByIDXKEY($IDXKEY){
    $sql = "
      SELECT * FROM TB_COMMON_CODE
      WHERE IDXKEY = '".$IDXKEY."'
    ";
    $result = $this->db->query($sql);
    custlogR('sql',__class__,__function__,$this->session->userdata('user_id'),$sql,$result->result());
    return $result->row();
  }

  public function getBannerGridData($param,$mode){
    $sql = "
      SELECT
          BANNER_ID
        , BANNER_TYPE
        , BANNER_ORDER
        , IMG_NAME
        , IMG_EXTENSION
        , LINK_URL
        , CREATED
        FROM TB_BANNER_INFO A
        WHERE 1=1
    ";
    if(!empty($param['USER_INFO_DV'])){
      $sql = $sql."
        AND ".$param['USER_INFO_DV']." LIKE '%".$param['USER_INFO']."%'
      ";
    }
    if(!empty($param['LEVEL'])){
      $sql = $sql."
        AND LEVEL = '".$param['LEVEL']."'
      ";
    }
    if(!empty($param['SEX'])){
      $sql = $sql."
        AND SEX = '".$param['SEX']."'
      ";
    }
    if(!empty($param['FRDT'])){
      $sql = $sql."
        AND CREATED BETWEEN '".$param['FRDT']."000000' AND 99999999999999
      ";
    }
    if(!empty($param['TODT'])){
      $sql = $sql."
          AND CREATED BETWEEN '00000000000000' AND '".$param['TODT']."999999'
      ";
    }

    $sql = $sql."
      ORDER BY CREATED DESC
    ";
    if(empty($param['PAGE']) && $mode=="IQY"){
      if($param['VIEW_CNT']=='false'){
        $sql = $sql."
        limit 0,10
        ";
      }else{
        $sql = $sql."
        limit 0,100
        ";
      }
    }else if(!empty($param['PAGE']) && $mode=="IQY"){
      if($param['VIEW_CNT']=='false'){
        $sql = $sql."
        limit ".(($param['PAGE']*10)-10).",10
        ";
      }else{
        $sql = $sql."
        limit ".(($param['PAGE']*100)-100).",100
        ";
      }
    }
    $result = $this->db->query($sql);
    custlogR('sql',__class__,__function__,$this->session->userdata('user_id'),$sql,$result->result());
    return $result;
  }

  public function makeBannerId(){
    $sql = "
    SELECT
    	CASE WHEN MAX(BANNER_ID) IS NULL
    	     THEN 'B0001'
    	     ELSE CONCAT('B',LPAD(MAX(SUBSTR(BANNER_ID,2,4))+1,4,0))
    	END AS BANNER_ID
		FROM TB_BANNER_INFO
    ";
    $result = $this->db->query($sql);
    custlogR('sql',__class__,__function__,$this->session->userdata('user_id'),$sql,$result->result());
    return $result->row()->BANNER_ID;
  }

  public function getBannerOrderByType($BANNER_TYPE){
    $sql = "
    SELECT
    	CASE WHEN MAX(BANNER_ORDER) IS NULL
    	     THEN '01'
    	     ELSE LPAD(MAX(BANNER_ORDER)+1,2,0)
    	END AS BANNER_ORDER
      FROM TB_BANNER_INFO
     WHERE BANNER_TYPE = '".$BANNER_TYPE."'
    ";
    $result = $this->db->query($sql);
    custlogR('sql',__class__,__function__,$this->session->userdata('user_id'),$sql,$result->result());
    return $result->row()->BANNER_ORDER;
  }

  public function addBannerInfo($param){
    $sql = "
    INSERT INTO TB_BANNER_INFO(BANNER_ID, BANNER_TYPE, BANNER_ORDER, IMG_NAME, IMG_EXTENSION, IMG_SIZE, LINK_URL, CREATED)
    VALUE(
        '".$param['BANNER_ID']."'
      , '".$param['BANNER_TYPE']."'
      , '".$param['BANNER_ORDER']."'
      , '".$param['IMG_NAME']."'
      , '".$param['IMG_EXTENSION']."'
      , '".$param['IMG_SIZE']."'
      , '".$param['LINK_URL']."'
      , NOW()+0
    )
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  public function deleteBannerById($BANNER_ID){
    $sql = "
      DELETE FROM TB_BANNER_INFO
      WHERE BANNER_ID = '".$BANNER_ID."'
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  public function getBannerById($BANNER_ID){
    $sql = "
      SELECT
          BANNER_ID
        , BANNER_TYPE
        , BANNER_ORDER
        , IMG_NAME
        , IMG_EXTENSION
        , IMG_SIZE
        , LINK_URL
        , CREATED
        FROM TB_BANNER_INFO A
        WHERE BANNER_ID = '".$BANNER_ID."'
    ";
    $result = $this->db->query($sql);
    custlogR('sql',__class__,__function__,$this->session->userdata('user_id'),$sql,$result->result());
    return $result->row();
  }

  public function updateBanner($param){
    $sql = "
      UPDATE TB_BANNER_INFO
      SET BANNER_TYPE   = '".$param['BANNER_TYPE']."'
        , BANNER_ORDER  = '".$param['BANNER_ORDER']."'
        , IMG_NAME      = '".$param['IMG_NAME']."'
        , IMG_EXTENSION = '".$param['IMG_EXTENSION']."'
        , IMG_SIZE      = '".$param['IMG_SIZE']."'
        , LINK_URL      = '".$param['LINK_URL']."'

      WHERE BANNER_ID = '".$param['BANNER_ID']."'
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  public function getUserDataGrid($param,$mode){
    $sql = "
      SELECT
          ID
        , LEVEL
        , (SELECT CODE_NM FROM TB_COMMON_CODE WHERE WORK_DV='회원정보' AND CODE_DV='회원등급코드' AND CODE = A.LEVEL) AS LEVEL_NM
        , NAME
        , CONCAT(TEL_H, '-', TEL_B, '-', TEL_T) AS TEL
        , EMAIL
        , BIRTH
        , SEX
        , CONCAT('(', POSTCODE, ')', ADDR, ADDR_DETAIL) AS ADDR
        , LAST_LOGIN_TIME
        , JOIN_TIME
        FROM TB_USER_BASE A
        WHERE 1=1
    ";
    if(!empty($param['USER_INFO_DV'])){
      $sql = $sql."
        AND ".$param['USER_INFO_DV']." LIKE '%".$param['USER_INFO']."%'
      ";
    }
    if(!empty($param['LEVEL'])){
      $sql = $sql."
        AND LEVEL = '".$param['LEVEL']."'
      ";
    }
    if(!empty($param['SEX'])){
      $sql = $sql."
        AND SEX = '".$param['SEX']."'
      ";
    }
    if(!empty($param['FRDT'])){
      $sql = $sql."
        AND JOIN_TIME BETWEEN '".$param['FRDT']."000000' AND 99999999999999
      ";
    }
    if(!empty($param['TODT'])){
      $sql = $sql."
          AND JOIN_TIME BETWEEN '00000000000000' AND '".$param['TODT']."999999'
      ";
    }

    $sql = $sql."
      ORDER BY JOIN_TIME DESC
    ";
    if(empty($param['PAGE']) && $mode=="IQY"){
      if($param['VIEW_CNT']=='false'){
        $sql = $sql."
        limit 0,10
        ";
      }else{
        $sql = $sql."
        limit 0,100
        ";
      }
    }else if(!empty($param['PAGE']) && $mode=="IQY"){
      if($param['VIEW_CNT']=='false'){
        $sql = $sql."
        limit ".(($param['PAGE']*10)-10).",10
        ";
      }else{
        $sql = $sql."
        limit ".(($param['PAGE']*100)-100).",100
        ";
      }
    }
    $result = $this->db->query($sql);
    custlogR('sql',__class__,__function__,$this->session->userdata('user_id'),$sql,$result->result());
    return $result;
  }

  public function insertUser($param){
    $sql = "
      INSERT INTO TB_USER_BASE(ID, PASSWORD, LEVEL, NAME, TEL_H, TEL_B, TEL_T, POSTCODE, ADDR, ADDR_DETAIL, LAST_LOGIN_TIME, JOIN_TIME)
      VALUES(
          '".$param['ID']."'
        , '".$param['PASSWORD']."'
        , '".$param['LEVEL']."'
        , '".$param['NAME']."'
        , '".$param['TEL1']."'
        , '".$param['TEL2']."'
        , '".$param['TEL3']."'
        , '".$param['POSTCODE']."'
        , '".$param['ADDR']."'
        , '".$param['ADDR_DETAIL']."'
        , NOW()+0
        , NOW()+0
      )
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  public function updateUserLevel($ID,$LEVEL){
    $sql = "
      UPDATE TB_USER_BASE
         SET LEVEL = '".$LEVEL."'
       WHERE ID = '".$ID."'
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  public function makeProductID(){
    $sql = "
    SELECT
      CASE WHEN MAX(PRD_ID) IS NULL
           THEN '00000001'
          ELSE LPAD(MAX(PRD_ID)+1,8,0)
      END AS PRODUCT_ID
      FROM TB_PRODUCT_BASE
    ";

    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result->row()->PRODUCT_ID;
  }

  public function createProductBase($param){
    $sql = "
    INSERT INTO TB_PRODUCT_BASE(PRD_ID, PRD_TYPE, PRD_NAME, PRD_BRIEF_DESC ,PRD_DESC, CREATED)
    VALUES(
        '".$param['PRD_ID']."'
      , '".$param['PRD_TYPE']."'
      , '".$param['PRD_NAME']."'
      , '".$param['PRD_BRIEF_DESC']."'
      , '".$param['PRD_DESC']."'
      , NOW()+0
    )
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  public function updateProductPrice($param){
    $sql = "
    UPDATE TB_PRODUCT_BASE
    SET PRD_SUPPLY_PRICE = '".$param['PRD_SUPPLY_PRICE']."'
      , PRD_SALES_PRICE = '".$param['PRD_SALES_PRICE']."'
      , PRD_SAVINGS = '".$param['PRD_SAVINGS']."'
    WHERE PRD_ID = '".$param['PRD_ID']."'
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  public function deleteProductImage($param){
    $sql = "
      DELETE FROM TB_PRODUCT_IMG
      WHERE PRD_ID = '".$param['PRD_ID']."'
        AND IMG_NAME = '".$param['IMG_NAME']."'
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  public function findProductExtensionByIdName($param){
    $sql = "
    SELECT IMG_EXTENSION
      FROM TB_PRODUCT_IMG
     WHERE PRD_ID = '".$param['PRD_ID']."'
       AND IMG_NAME = '".$param['IMG_NAME']."'
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result->row()->IMG_EXTENSION;
  }

  public function findProductImgByIdName($param){
    $sql = "
      SELECT CASE WHEN COUNT(1)>0 THEN 'Y'
             ELSE 'N' END AS IS_IMG
        FROM TB_PRODUCT_IMG
       WHERE PRD_ID = '".$param['PRD_ID']."'
         AND IMG_NAME = '".$param['IMG_NAME']."'
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result->row()->IS_IMG;
  }

  public function addProductImage($param){
  $sql = "
    INSERT INTO TB_PRODUCT_IMG(PRD_ID, IMG_NAME, IMG_EXTENSION, IMG_SIZE, CREATED)
    VALUES(
        '".$param['PRD_ID']."'
      , '".$param['IMG_NAME']."'
      , '".$param['IMG_EXTENSION']."'
      , '".$param['IMG_SIZE']."'
      , NOW()+0
    )
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  public function updateProductImage($param){
  $sql = "
    UPDATE TB_PRODUCT_IMG
       SET IMG_EXTENSION = '".$param['IMG_EXTENSION']."'
         , IMG_SIZE      = '".$param['IMG_SIZE']."'
     WHERE PRD_ID = '".$param['PRD_ID']."'
       AND IMG_NAME = '".$param['IMG_NAME']."'
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  public function updateProductEtc($param){
    $sql = "
    UPDATE TB_PRODUCT_BASE
    SET IS_NEW = '".$param['IS_NEW']."'
      , IS_DISPLAY = '".$param['IS_DISPLAY']."'
      , IS_SELL = '".$param['IS_SELL']."'
      , IS_SOLDOUT = '".$param['IS_SOLDOUT']."'
      , IS_RECOMMAND = '".$param['IS_RECOMMAND']."'
    WHERE PRD_ID = '".$param['PRD_ID']."'
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  public function addProductOption($param){
    $sql = "
    INSERT INTO TB_PRODUCT_OPTION(PRD_ID, OPTION_SET_ID, OPTION_ID)
    VALUES(
        '".$param['PRD_ID']."'
      , '".$param['OPTION_SET_ID']."'
      , '".$param['OPTION_ID']."'
    )
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  public function deleteProductOptionByID($PRD_ID){
    $sql = "
      DELETE FROM TB_PRODUCT_OPTION
      WHERE PRD_ID = '".$PRD_ID."'
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  public function updateProductBase($param){
    $sql = "
    UPDATE TB_PRODUCT_BASE
    SET PRD_NAME = '".$param['PRD_NAME']."'
      , PRD_BRIEF_DESC = '".$param['PRD_BRIEF_DESC']."'
      , PRD_DESC = '".$param['PRD_DESC']."'
    WHERE PRD_ID = '".$param['PRD_ID']."'
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  public function getProductBaseByID($PRD_ID){
    $sql = "
      SELECT * FROM TB_PRODUCT_BASE
      WHERE PRD_ID = '".$PRD_ID."'
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result->row();
  }

  public function getProductImgByID($PRD_ID){
    $sql = "
      SELECT PRD_ID, IMG_NAME, IMG_EXTENSION FROM TB_PRODUCT_IMG
      WHERE PRD_ID = '".$PRD_ID."'
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result->result();
  }

  public function getProductOptionByID($PRD_ID){
    $sql = "
      SELECT PRD_ID, OPTION_SET_ID, OPTION_ID FROM TB_PRODUCT_OPTION
      WHERE PRD_ID = '".$PRD_ID."'
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result->result();
  }

  public function getProductList($param,$mode){
    $sql = "
    SELECT
      PRD_ID
      , PRD_NAME
      , (SELECT IMG_NAME FROM TB_PRODUCT_IMG WHERE PRD_ID = A.PRD_ID AND IMG_NAME LIKE '%MAIN1%') AS IMG_NAME
      , (SELECT IMG_EXTENSION FROM TB_PRODUCT_IMG WHERE PRD_ID = A.PRD_ID AND IMG_NAME LIKE '%MAIN1%') AS IMG_EXTENSION
      , PRD_SALES_PRICE
      , IS_DISPLAY
      , IS_SELL
      , IS_SOLDOUT
      , CREATED
      FROM TB_PRODUCT_BASE A
      WHERE 1=1
    ";

    if(!empty($param['OPTION_INFO_DV'])){
      $sql = $sql."
          AND ".$param['OPTION_INFO_DV']." LIKE '%".$param['OPTION_INFO']."%'
      ";
    }
    $sql = $sql."
    ORDER BY CREATED DESC
    ";
    $sql = $sql."";

    if(empty($param['PAGE']) && $mode=="IQY"){
      if($param['VIEW_CNT']=='false'){
        $sql = $sql."
        limit 0,10
        ";
      }else{
        $sql = $sql."
        limit 0,100
        ";
      }
    }else if(!empty($param['PAGE']) && $mode=="IQY"){
      if($param['VIEW_CNT']=='false'){
        $sql = $sql."
        limit ".(($param['PAGE']*10)-10).",10
        ";
      }else{
        $sql = $sql."
        limit ".(($param['PAGE']*100)-100).",100
        ";
      }
    }
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  public function getProductOptionList($param,$mode){
    $sql = "
    SELECT * FROM (
    SELECT
        A.OPTION_ID
      , A.OPTION_NAME
      , GROUP_CONCAT(B.OPTION_VALUE) AS OPTION_VALUE
      , A.OPTION_DESC
      FROM TB_OPTION_BASE A
         , TB_OPTION_DETAIL B
      WHERE A.OPTION_ID = B.OPTION_ID
      GROUP BY OPTION_ID
      ORDER BY OPTION_ID DESC ) Z
    WHERE 1=1
    ";

    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  public function getOptionID(){
    $sql = "
    SELECT
      CASE WHEN SUBSTR(MAX(OPTION_ID),2,4) IS NULL
           THEN '0001'
           ELSE LPAD(SUBSTR(MAX(OPTION_ID),2,4)+1,4,0) END AS SEQ
      FROM TB_OPTION_BASE
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return "O".$result->row()->SEQ;
  }

  public function addOptionBase($OPTION_ID, $OPTION_NAME, $OPTION_DESC){
    $sql = "
      INSERT INTO TB_OPTION_BASE(OPTION_ID, OPTION_NAME, OPTION_DESC)
      VALUES(
        '".$OPTION_ID."', '".$OPTION_NAME."', '".$OPTION_DESC."'
      )
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  public function updateOptionBase($OPTION_ID, $OPTION_NAME, $OPTION_DESC){
    $sql = "
      UPDATE TB_OPTION_BASE
      SET OPTION_NAME = '".$OPTION_NAME."'
        , OPTION_DESC = '".$OPTION_DESC."'
      WHERE OPTION_ID = '".$OPTION_ID."'
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  public function addOptionDetail($OPTION_ID, $OPTION_CD, $OPTION_VALUE, $OPTION_PRICE){
    $sql = "
      INSERT INTO TB_OPTION_DETAIL(OPTION_ID, OPTION_CD, OPTION_VALUE, OPTION_PRICE)
      VALUES(
        '".$OPTION_ID."', '".$OPTION_CD."', '".$OPTION_VALUE."', '".$OPTION_PRICE."'
      )
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  public function deleteOptionBaseByID($OPTION_ID){
    $sql = "
      DELETE FROM TB_OPTION_BASE
      WHERE OPTION_ID = '".$OPTION_ID."'
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  public function deleteOptionDetailByID($OPTION_ID){
    $sql = "
      DELETE FROM TB_OPTION_DETAIL
      WHERE OPTION_ID = '".$OPTION_ID."'
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  public function deleteProductData($PRD_ID){
    $sql = "
      DELETE FROM TB_PRODUCT_BASE
      WHERE PRD_ID = '".$PRD_ID."'
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    $sql = "
      DELETE FROM TB_PRODUCT_OPTION
      WHERE PRD_ID = '".$PRD_ID."'
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    $sql = "
      DELETE FROM TB_PRODUCT_IMG
      WHERE PRD_ID = '".$PRD_ID."'
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  public function getOptionByID($OPTION_ID){
    $sql = "
    SELECT
    	  A.OPTION_ID
    	, A.OPTION_NAME
    	, A.OPTION_DESC
    	, B.OPTION_VALUE
    	, B.OPTION_PRICE
      FROM TB_OPTION_BASE A
         , TB_OPTION_DETAIL B
     WHERE A.OPTION_ID = B.OPTION_ID
       AND A.OPTION_ID = '".$OPTION_ID."'
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result->result();
  }

  public function getProductOptionSetList($param,$mode){
    $sql = "
    SELECT
        A.OPTION_SET_ID
      , A.OPTION_SET_NAME
      , A.OPTION_SET_DESC
      FROM TB_OPTION_SET_BASE A
      WHERE 1=1
    ";

    if(!empty($param['OPTION_INFO_DV'])){
      $sql = $sql."
          AND ".$param['OPTION_INFO_DV']." LIKE '%".$param['OPTION_INFO']."%'
      ";
    }

    $sql = $sql."";

    if(empty($param['PAGE']) && $mode=="IQY"){
      if($param['VIEW_CNT']=='false'){
        $sql = $sql."
        limit 0,10
        ";
      }else{
        $sql = $sql."
        limit 0,100
        ";
      }
    }else if(!empty($param['PAGE']) && $mode=="IQY"){
      if($param['VIEW_CNT']=='false'){
        $sql = $sql."
        limit ".(($param['PAGE']*10)-10).",10
        ";
      }else{
        $sql = $sql."
        limit ".(($param['PAGE']*100)-100).",100
        ";
      }
    }
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  function getOptionSetID(){
    $sql = "
    SELECT
      CASE WHEN SUBSTR(MAX(OPTION_SET_ID),2,4) IS NULL
           THEN '0001'
           ELSE LPAD(SUBSTR(MAX(OPTION_SET_ID),2,4)+1,4,0) END AS SEQ
      FROM TB_OPTION_SET_BASE
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return "S".$result->row()->SEQ;
  }

  public function addOptionSetBase($OPTION_SET_ID, $OPTION_SET_NAME, $OPTION_SET_DESC){
    $sql = "
      INSERT INTO TB_OPTION_SET_BASE(OPTION_SET_ID, OPTION_SET_NAME, OPTION_SET_DESC)
      VALUES(
        '".$OPTION_SET_ID."', '".$OPTION_SET_NAME."', '".$OPTION_SET_DESC."'
      )
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  public function addOptionSetDetail($OPTION_SET_ID, $OPTION_ID){
    $sql = "
      INSERT INTO TB_OPTION_SET_DETAIL(OPTION_SET_ID, OPTION_ID)
      VALUES(
        '".$OPTION_SET_ID."', '".$OPTION_ID."'
      )
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  public function deleteOptionSetBaseByID($OPTION_SET_ID){
    $sql = "
      DELETE FROM TB_OPTION_SET_BASE
      WHERE OPTION_SET_ID = '".$OPTION_SET_ID."'
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  public function deleteOptionSetDetailByID($OPTION_SET_ID){
    $sql = "
      DELETE FROM TB_OPTION_SET_DETAIL
      WHERE OPTION_SET_ID = '".$OPTION_SET_ID."'
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  public function updateOptionSetBase($OPTION_SET_ID, $OPTION_SET_NAME, $OPTION_SET_DESC){
    $sql = "
      UPDATE TB_OPTION_SET_BASE
      SET OPTION_SET_NAME = '".$OPTION_SET_NAME."'
        , OPTION_SET_DESC = '".$OPTION_SET_DESC."'
      WHERE OPTION_SET_ID = '".$OPTION_SET_ID."'
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result;
  }

  public function getOptionSetByID($OPTION_SET_ID){
    $sql = "
    SELECT
    	A.OPTION_SET_ID
    	, A.OPTION_SET_NAME
    	, A.OPTION_SET_DESC
    	, B.OPTION_ID
    	, C.OPTION_NAME
    	, C.OPTION_DESC
    	, GROUP_CONCAT(D.OPTION_VALUE) AS OPTION_VALUE
    	FROM TB_OPTION_SET_BASE A
    	   , TB_OPTION_SET_DETAIL B
    	   , TB_OPTION_BASE C
    	   , TB_OPTION_DETAIL D

    	WHERE A.OPTION_SET_ID = B.OPTION_SET_ID
    	  AND B.OPTION_ID = C.OPTION_ID
    	  AND C.OPTION_ID = D.OPTION_ID
    	  AND A.OPTION_SET_ID = '".$OPTION_SET_ID."'

    	GROUP BY B.OPTION_ID
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result->result();
  }

  public function getOptionSetAll(){
    $sql = "
      SELECT * FROM TB_OPTION_SET_BASE
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result->result();
  }

  public function getOptionsByOptionSetID($OPTION_SET_ID){
    $sql = "
    SELECT
    	  A.OPTION_SET_ID
    	, A.OPTION_SET_NAME
    	, A.OPTION_SET_DESC
    	, B.OPTION_ID
    	, C.OPTION_NAME
    	, C.OPTION_DESC
    	, GROUP_CONCAT(D.OPTION_VALUE) AS OPTION_VALUE
      FROM TB_OPTION_SET_BASE A
         , TB_OPTION_SET_DETAIL B
         , TB_OPTION_BASE C
         , TB_OPTION_DETAIL D
      WHERE A.OPTION_SET_ID = B.OPTION_SET_ID
        AND B.OPTION_ID = C.OPTION_ID
        AND C.OPTION_ID = D.OPTION_ID
        AND A.OPTION_SET_ID = '".$OPTION_SET_ID."'
        GROUP BY OPTION_ID
    ";
    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result->result();
  }
}
