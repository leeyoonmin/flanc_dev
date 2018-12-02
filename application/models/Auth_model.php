<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
  /***********************************************************************************************
      회원정보 입력 로직
  ***********************************************************************************************/
  public function insert_user_data($user_data){
    $this->load->library('common');
    $indexkey =  $this->common->makeIndexkey('01','01');

    $insert_data = array(
      'IDXKEY'   => $indexkey ,
      'ID'       => $user_data['USER_ID'] ,
      'PASSWORD' => '' ,
      'NAME'     => $user_data['USER_NM'] ,
      'SEX'      => $user_data['SEX'] ,
      'BIRTH'    => $user_data['USER_BIRTH'],
      'LEVEL'    => '01',
      'LAST_LOGIN_DT' => date("YmdHis",time()) ,
      'JOIN_DT'  => date("YmdHis",time())
    );

    // 비밀번호 암호화
    $hash = sha1($user_data['USER_PW1']);
    $insert_data['PASSWORD'] = $hash;

    $sql = "
      INSERT INTO TB_CUST_BASE_INFO(
        INDEXKEY ,
        ID ,
        PASSWORD ,
        NAME ,
        SEX ,
        BIRTH ,
        LEVEL ,
        LAST_LOGIN_DT ,
        JOIN_DT
      )
      VALUES(?,?,?,?,LPAD(?,2,0),?,LPAD(?,2,0),?,?)";
    $query = $this->db->query($sql,$insert_data);
    return $query;
  }

  public function getRepetChkById($user_id){
    $sql = "
      SELECT
        IF(COUNT(1) = 0, 'Y', 'N') AS REPET_YN
        FROM TB_CUST_BASE_INFO
       WHERE ID = ?
      ";
    $query = $this->db->query($sql,$user_id);
    $result = $query->result();
    
    return $result[0]->REPET_YN;
  }
}
