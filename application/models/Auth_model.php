<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
  function __construct(){
      parent::__construct();
      $this->load->helper('custlog');
  }
  /***********************************************************************************************
      회원정보 입력 로직
  ***********************************************************************************************/
  public function addUser($param){
    $sql = "
      INSERT INTO TB_USER_BASE
      VALUES(
          '".$param['ID']."'
        , '".$param['PW']."'
        , '01'
        , '".$param['NAME']."'
        , '".$param['TEL1']."'
        , '".$param['TEL2']."'
        , '".$param['TEL3']."'
        , '".$param['EMAIL']."'
        , '".$param['SEX']."'
        , '".$param['BIRTH']."'
        , NULL
        , NULL
        , NULL
        , NOW()+0
        , NOW()+0
      )
    ";

    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $this->db->query($sql);
  }

  public function getUserDataById($USER_ID){
    $sql = "
      SELECT * FROM TB_USER_BASE
      WHERE ID = '".$USER_ID."'
    ";

    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $this->db->query($sql)->row();
  }

  public function getPasswordById($param){
    $sql = "
      SELECT
        PASSWORD
        FROM TB_USER_BASE
       WHERE ID = '".$param['ID']."'
    ";
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $this->db->query($sql)->row()->PASSWORD;
  }
}
