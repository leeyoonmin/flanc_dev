<div class="divCardList title">
  <div class="divCard pad_16px">
    <p class="typo normal base center color_white">장바구니</p>
  </div>
</div>

<div class="divCardList cartList">
  <div class="divCard pad_8px">
    <table>
      <?php
        $PRD_CNT = 0;
        $TT_PRICE = 0;
        foreach($CART_LIST as $item){
      ?>
      <tr>
        <td>
          <input type="checkbox">
          <input class="CART_ID" type="hidden" value="<?=$item->CART_ID?>">
        </td>
        <td class="imgTD">
          <a href="/daily/detail/<?=$item->PRD_ID?>"><img src="/resource/img/product/<?=$item->PRD_ID?>/<?=$item->IMG?>"></a>
        </td>
        <td class="nameTD">
          <p class="PRD_NAME"><?=$item->PRD_NAME?></p>
          <p class="PRD_DESC"><?=$item->PRD_BRIEF_DESC?></p>
          <p class="PRD_OPTION"><?php if(empty($item->PRD_OPTION)){echo "없음";}else{echo nl2br(str_replace('|','<br>',$item->PRD_OPTION));}?></p>
        </td>
        <td class="qtyTD">
          <input class="minusBtn" type="button" value="－">
          <span><?=number_format($item->QTY)?></span>
          <input class="plusBtn" type="button" value="＋">
        </td>
        <td class="totalTD"><?=number_format($item->TT_PRICE*$item->QTY)?>원</td>
      </tr>
      <?php
      $PRD_CNT++;
      $TT_PRICE += $item->TT_PRICE*$item->QTY;
    }if(empty($CART_LIST)){
      echo "<p class=\"typo normal base center pad_8px\">장바구니가 비었습니다.</p>";
    }
      ?>
    </table>
  </div>
</div>

<div class="divCardList cartButton">
  <div class="divCard pad_8px">
    <input class="deleteBtn" type="button" value="선택삭제">
    <input class="deleteAllBtn" type="button" value="전체삭제">
  </div>
</div>

<div class="divCardList buyTotal">
  <div class="divCard pad_16px center">
    <p class="typo normal small"><span><?=$PRD_CNT?></span> 개 상품　/　총 <span><?=number_format($TT_PRICE)?></span> 원</p>
  </div>
</div>

<div class="divCardList orderBtn">
  <a href="/order">
    <div class="divCard pad_16px center">
      <p class="typo normal base"><i class="fa fa-edit"></i>주문서 작성</p>
    </div>
  </a>
</div>
