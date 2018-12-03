<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

  function __construct(){
      parent::__construct();
      $this->load->helper('custlog');
  }

  //=> [오늘의 꽃] 상품리스트 가져오기
  public function getProductList(){
    $sql = "
    SELECT
            A.PRD_ID
    		  , A.PRD_NAME
    		  , A.PRD_BRIEF_DESC AS PRD_DESC
    		  , A.PRD_SALES_PRICE AS PRD_PRICE
    		  , A.IS_NEW
    		  , A.IS_RECOMMAND
    		  , A.IS_SOLDOUT
    		  , CONCAT(B.IMG_NAME, '.', B.IMG_EXTENSION) AS FILE_NAME
    		  FROM TB_PRODUCT_BASE A
    		     , TB_PRODUCT_IMG B
    		 WHERE A.IS_DISPLAY = 'Y'
    		   AND A.IS_SELL = 'Y'
    		   AND A.PRD_ID = B.PRD_ID
    		   AND B.IMG_NAME = 'MAIN1'
    ";

    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result->result();
  }

  //=> [오늘의 꽃] 상품코드로 상품가져오기
  public function getProductById($PRD_ID){
    $sql = "
    SELECT
            A.PRD_ID
    		  , A.PRD_NAME
    		  , A.PRD_BRIEF_DESC AS PRD_DESC
    		  , A.PRD_SALES_PRICE AS PRD_PRICE
    		  , A.IS_NEW
    		  , A.IS_RECOMMAND
    		  , A.IS_SOLDOUT
    		  , CONCAT(B.IMG_NAME, '.', B.IMG_EXTENSION) AS FILE_NAME
    		  FROM TB_PRODUCT_BASE A
    		     , TB_PRODUCT_IMG B
    		 WHERE A.IS_DISPLAY = 'Y'
    		   AND A.IS_SELL = 'Y'
    		   AND A.PRD_ID = B.PRD_ID
    		   AND B.IMG_NAME = 'MAIN1'
           AND A.PRD_ID = '".$PRD_ID."'
    ";

    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result->row();
  }

  //=> [오늘의 꽃] 상품코드로 이미지 가져오기
  public function getProductImgById($PRD_ID){
    $sql = "
    SELECT
        PRD_ID
      , CONCAT(IMG_NAME,'.',IMG_EXTENSION) AS FILE_NAME
      , CASE WHEN SUBSTR(IMG_NAME,1,4) = 'MAIN' THEN 'MAIN'
               ELSE 'DETAIL' END AS IMG_TYPE
      FROM TB_PRODUCT_IMG
      WHERE PRD_ID = '".$PRD_ID."'
    ";

    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result->result();
  }

  //=> [오늘의 꽃] 상품코드로 상품옵션 가져오기
  public function getProductOptionById($PRD_ID){
    $sql = "
    SELECT
        A.PRD_ID
      , B.OPTION_ID
      , B.OPTION_NAME
      , C.OPTION_CD
      , C.OPTION_VALUE
      , C.OPTION_PRICE
      FROM TB_PRODUCT_OPTION A
         , TB_OPTION_BASE B
         , TB_OPTION_DETAIL C
      WHERE A.PRD_ID = '".$PRD_ID."'
        AND A.OPTION_ID = B.OPTION_ID
    	 AND B.OPTION_ID = C.OPTION_ID
    ";

    $result = $this->db->query($sql);
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $result->result();
  }

}
