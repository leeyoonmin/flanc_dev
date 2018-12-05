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
    $rowCnt = 0;
    $OPTION_STR1 = NULL;
    if(!empty($OPTION)){
      foreach($OPTION as $item){
        if($rowCnt == 0){
          $OPTION_STR1 = $item['OPTION_ID'].$item['OPTION_CD'];
        }else{
          $OPTION_STR1 = $OPTION_STR1.",".$item['OPTION_ID'].$item['OPTION_CD'];
        }
        $rowCnt++;
      }
    }
    $sql = "
    SELECT Z.CART_ID FROM (
      SELECT
            A.CART_ID , GROUP_CONCAT(B.OPTION_ID , B.OPTION_CD) AS OPTION_STR
      	FROM TB_CART_BASE A
              LEFT JOIN TB_CART_OPTION B
              ON A.CART_ID = B.CART_ID
        WHERE A.PRD_ID = '".$PRD_ID."'
          AND A.USER_ID = '".$this->session->userdata('user_id')."'
          GROUP BY A.CART_ID
          ) Z";

     if(!empty($OPTION)){
       $sql = $sql."
       WHERE Z.OPTION_STR = '".$OPTION_STR1."'
       ";
     }else{
       $sql = $sql."
       WHERE Z.OPTION_STR IS NULL
       ";
     }
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    $CART_ID =  $this->db->query($sql)->row();

    if($CART_ID == NULL){
      $CART_ID = NULL;
    }else{
      $CART_ID = $CART_ID->CART_ID;
    }

    return $CART_ID;

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

  public function updateCartQtyByQty($CART_ID,$QTY){
    $sql = "
      UPDATE TB_CART_BASE
         SET QTY = ".$QTY."
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

  public function getCartListById($USER_ID){
    $sql = "
    SELECT
       A.CART_ID
     , A.PRD_ID
     , (SELECT CONCAT('MAIN1.',IMG_EXTENSION) FROM TB_PRODUCT_IMG WHERE PRD_ID = A.PRD_ID AND IMG_NAME = 'MAIN1') AS IMG
     , C.PRD_NAME
     , C.PRD_BRIEF_DESC
     , A.PRD_PRICE
     , A.QTY
     , A.TT_PRICE
      , GROUP_CONCAT(OPTION_VALUE,'(+',FORMAT(OPTION_PRICE,0),')' SEPARATOR '|') AS PRD_OPTION
      FROM TB_CART_BASE A LEFT JOIN TB_CART_OPTION B
        ON A.CART_ID = B.CART_ID
        , TB_PRODUCT_BASE C
     WHERE A.PRD_ID = C.PRD_ID
       AND A.USER_ID = '".$USER_ID."'
    GROUP BY A.CART_ID
    ";
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $this->db->query($sql)->result();
  }

  public function deleteCartById($CART_ID){
    $sql = "
      DELETE FROM TB_CART_BASE
      WHERE CART_ID = '".$CART_ID."'
    ";
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    $this->db->query($sql);
    $sql = "
      DELETE FROM TB_CART_OPTION
      WHERE CART_ID = '".$CART_ID."'
    ";
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $this->db->query($sql);
  }

  public function getCartIdByUser($USER_ID){
    $sql = "
      SELECT CART_ID FROM TB_CART_BASE
      WHERE USER_ID = '".$USER_ID."'
    ";
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $this->db->query($sql)->result();
  }

  public function getCartQtyById($CART_ID){
    $sql = "
      SELECT QTY FROM TB_CART_BASE
      WHERE CART_ID = '".$CART_ID."'
    ";
    custlog('sql',__class__,__function__,$this->session->userdata('user_id'),$sql);
    return $this->db->query($sql)->row()->QTY;
  }


}
