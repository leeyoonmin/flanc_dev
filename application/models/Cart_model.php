<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends CI_Model {
  public function makeCartId(){
    $sql="
      SELECT
        CASE WHEN MAX(CART_ID) IS NULL
             THEN 'C0001'
             ELSE CONCAT('C',LPAD(MAX(SUBSTR(CART_ID,2,4))+1,4,0))
        END AS CART_ID
      FROM TB_CART_BASE
    ";

    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $this->db->query($sql)->row()->CART_ID;
  }

  public function addCart($param){
    $sql = "
      INSERT INTO TB_CART_BASE
      VALUES(
         '".$param['CART_ID']."'
       , '".$param['USER_ID']."'
       , '".$param['PRD_ID']."'
       ,  ".$param['PRD_PRICE']."
       ,  ".$param['QTY']."
       ,  ".$param['TT_PRICE']."
       , NOW()+0
      )
    ";

    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $this->db->query($sql);
  }

  public function duplicateCheck($PRD_ID, $OPTION){
    $sql = "
    SELECT
          GROUP_CONCAT(C.OPTION_ID,C.OPTION_CD) AS PRD_OPTION
        , CART_ID
      FROM (
            SELECT
              OPTION_ID, OPTION_CD, A.CART_ID
               FROM TB_CART_BASE A
                  , TB_CART_OPTION B
              WHERE A.USER_ID = '".$this->session->userdata('user_id')."'
                AND A.PRD_ID = '".$PRD_ID."'
                AND A.CART_ID = B.CART_ID
                ORDER BY OPTION_ID, OPTION_CD
       ) C
    ";
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    $DB_OPTION = $this->db->query($sql)->row()->PRD_OPTION;
    if(!empty($OPTION)){
      $GET_OPTION = "";
      $ROW_CNT = 1;
      foreach($OPTION as $item){
        if($ROW_CNT==1){
          $GET_OPTION = $GET_OPTION.$item['OPTION_ID'].$item['OPTION_CD'];
        }else{
          $GET_OPTION = $GET_OPTION.','.$item['OPTION_ID'].$item['OPTION_CD'];
        }
        $ROW_CNT++;
      }

      if($DB_OPTION == $GET_OPTION){
        return $this->db->query($sql)->row()->CART_ID;
      }else{
        return "N";
      }
    }else{
      if(empty($DB_OPTION)){
        return "N";
      }else{
        return $this->db->query($sql)->row()->CART_ID;
      }
    }
  }

  public function updateCartQty($CART_ID){
    $sql = "
      SELECT QTY+1 AS CNT FROM TB_CART_BASE WHERE CART_ID = '".$CART_ID."'
    ";
    $CNT = $this->db->query($sql)->row()->CNT;

    $sql = "
      UPDATE TB_CART_BASE
         SET QTY = ".$CNT."
       WHERE CART_ID = '".$CART_ID."'
    ";
    return $this->db->query($sql);
  }

  public function addCartOption($param){
    $sql = "
      INSERT INTO TB_CART_OPTION
      VALUES(
         '".$param['CART_ID']."'
       , '".$param['OPTION_ID']."'
       , '".$param['OPTION_CD']."'
       , '".$param['OPTION_VALUE']."'
       ,  ".$param['OPTION_PRICE']."
      )
    ";

    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $this->db->query($sql);
  }


}
