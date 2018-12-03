<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layout_model extends CI_Model {
  function __construct(){
      parent::__construct();
      $this->load->helper('custlog');
  }

  //=> 메인베너 데이터 가져오기
  public function getMainBanner(){
    $sql = "
      SELECT
          CONCAT(IMG_NAME,'.',IMG_EXTENSION) AS FILE_NAME
        , LINK_URL
        FROM TB_BANNER_INFO
       WHERE BANNER_TYPE = '01'
      ";
    $result = $this->db->query($sql);
    custlogR('sql',__class__,__function__,$this->session->userdata('user_id'),$sql,$result->result());
    return $result->result();
  }
}
