<div class="divCardList title">
  <div class="divCard">
    <p class="typo normal base">오늘의 꽃</p>
  </div>
</div>

<div class="divCardList productList">
  <?php
    foreach($PRODUCT as $item){
  ?>

  <div class="divCard divItem">
    <a href="/daily/detail/<?=$item->PRD_ID?>"><img src="/resource/img/product/<?=$item->PRD_ID?>/<?=$item->FILE_NAME?>" alt=""></a>
    <div class="productInfo">
      <p class="typo normal small center"><?=$item->PRD_NAME?></p>
      <p class="typo normal tiny center color_gray"><?=$item->PRD_DESC?></p>
      <p class="typo normal small center"><?=number_format($item->PRD_PRICE)." 원"?></p>
    </div>
  </div>

  <?php
    }
  ?>
</div>
