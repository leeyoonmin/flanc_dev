<div class="divCardList productImage">
  <div class="divCard productMainImage">
    <img src="/resource/img/product/<?=$PRODUCT->PRD_ID?>/<?=$PRODUCT->FILE_NAME?>">
  </div>
  <?php foreach($PRODUCT_IMG as $item){
          if($item->IMG_TYPE == "MAIN"){
  ?>
    <div class="divCard productOtherImg">
      <img src="/resource/img/product/<?=$item->PRD_ID?>/<?=$item->FILE_NAME?>">
    </div>
  <?php }} ?>
</div>

<div class="divCardList productTitle">
  <div class="divCard">
    <p class="typo normal base center"><?=$PRODUCT->PRD_NAME?></p>
    <p class="typo normal small center color_gray"><?=$PRODUCT->PRD_DESC?></p>
  </div>
</div>

<div class="divCardList productPrice">
  <div class="divCard">
    <p class="typo normal base center"><?=number_format($PRODUCT->PRD_PRICE)." 원"?></p>
  </div>
</div>

<div class="divCardList productOption">
  <div class="divCard">
  <?php
    $PREV_OPTION_ID = "";
    $OPTION_CNT = 1;
    foreach($PRODUCT_OPTION as $item){
      if($item->OPTION_ID != $PREV_OPTION_ID){
        if($OPTION_CNT != 1){
          echo "
              </select>
          ";
        }
      echo "
        <span>".$item->OPTION_NAME."</span><select class=\"SELECT_OPTION\" OPTION_NAME=\"".$item->OPTION_NAME."\" OPTION_VALUE=\"\" OPTION_PRICE=\"\" OPTION_ID=\"".$item->OPTION_ID."\" OPTION_CD=\"\">
          <option value=\"0000\">선택안함</option>
      ";
      }

      echo "<option value=\"".$item->OPTION_CD."\" OPTION_VALUE=\"".$item->OPTION_VALUE."\" OPTION_PRICE=\"".$item->OPTION_PRICE."\">".$item->OPTION_VALUE."(+".number_format($item->OPTION_PRICE)."원)"."</option>";

      if($item->OPTION_ID != $PREV_OPTION_ID){
      $OPTION_CNT++;
      }
      $PREV_OPTION_ID = $item->OPTION_ID;
    }
  ?>
    </select>
  </div>
</div>

<div class="divCardList productTotal">
  <div class="divCard">
    <p class="typo normal base center">총 상품금액　<span class="TT_PRICE" ORIGIN = "<?=$PRODUCT->PRD_PRICE?>"><?=number_format($PRODUCT->PRD_PRICE)."</span> 원"?></p>
  </div>
</div>

<?php
  if($this->session->userdata('is_login')){
?>
<div class="divCardList buttonList">
  <div class="divCard addCardBtn"><p class="typo normal small center ">ADD CART</p></div>
  <div class="divCard buyNowBtn"><p class="typo normal small center color_white ">BUY NOW</p></div>
</div>
<?php
}else{
?>
<div class="divCardList requestLogin">
  <div class="divCard center">
    <p class="typo normal base center ">구매를 위해서는 로그인이 필요합니다.</p>
    <a href="/auth/login?PREV_URL=<?=$_SERVER['REQUEST_URI']?>"><div class="loginBtn">로그인하러 가기　<i class="fa fa-angle-double-right"></i></div><a>
  </div>
</div>
<?php }?>

<div class="divCardList productImgDetail">
  <div class="divCard title"><p class="typo normal small center color_white">-　DETAIL SHOT　-</p></div>
  <div class="divCard detailImg">
    <?php
      foreach($PRODUCT_IMG as $item){
        if($item->IMG_TYPE == "DETAIL"){
    ?>
      <img src="/resource/img/product/<?=$item->PRD_ID?>/<?=$item->FILE_NAME?>">
    <?php
        }
      }
    ?>
  </div>
</div>

<div class="divProductData">
  <input type="hidden" class="HD_PRD_ID" value="<?=$PRODUCT->PRD_ID?>">
</div>
