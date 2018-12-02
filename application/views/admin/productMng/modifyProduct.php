<div class="divContents modifyProduct">
  <div class="divGridTab dailyProduct">

    <form class="productInfoFrm" action="/admin/addProductPrc" method="post">
      <input class="PRD_ID" type="hidden" name="PRD_ID" value="<?=$PRD_BASE->PRD_ID?>">
    <table>
      <tr class="titleTR">
        <td>상품정보</td><td></td>
      </tr>
      <tr>
        <td class="head"><span class="essentialMark">*</span>상품명</td>
        <td>
          <input class="PRODUCT_NAME" type="text" name="PRODUCT_NAME" value="<?=$PRD_BASE->PRD_NAME?>">
        </td>
      </tr>
      <tr>
        <td class="head"><span class="essentialMark">*</span>요약설명</td>
        <td>
          <input class="PRODUCT_DESC" type="text" name="PRODUCT_BRIEF_DESC" value="<?=$PRD_BASE->PRD_BRIEF_DESC?>">
        </td>
      </tr>
      <tr>
        <td class="head">상세설명</td>
        <td>
          <input class="PRODUCT_DESC" type="text" name="PRODUCT_DESC" value="<?=$PRD_BASE->PRD_DESC?>">
        </td>
      </tr>
      </table>
    </form>

    <form class="productPriceFrm" action="/admin/addProductPrc" method="post">
      <input type="hidden" name="PRD_ID" value="<?=$PRD_BASE->PRD_ID?>">
      <table>
      <tr class="titleTR">
        <td>가격정보</td><td></td>
      </tr>
      <tr>
        <td class="head">가격</td>
        <td>
          <table>
            <tr>
              <td class="head"><span class="essentialMark">*</span>공급가</td>
              <td>
                <input class="PRODUCT_SUPPLY_PRICE" type="tel" name="PRODUCT_SUPPLY_PRICE" value="<?=$PRD_BASE->PRD_SUPPLY_PRICE?>">
              </td>
            </tr>
            <tr>
              <td class="head"><span class="essentialMark">*</span>판매가</td>
              <td>
                <input class="PRODUCT_SALES_PRICE" type="tel" name="PRODUCT_SALES_PRICE" value="<?=$PRD_BASE->PRD_SALES_PRICE?>">
              </td>
            </tr>
            <tr>
              <td class="head">적립금</td>
              <td>
                <input class="SAVINGS" type="tel" name="SAVINGS" value="<?=$PRD_BASE->PRD_SAVINGS?>">
              </td>
            </tr>
          </table>

        </td>
      </tr>
      </table>
      </form>

      <form class="productImageFrm" enctype="multipart/form-data" action="/ajax/addProductImage" method="post">
      <input class="PRD_ID" type="hidden" name="PRD_ID" value="<?=$PRD_BASE->PRD_ID?>">
      <table>
      <tr class="titleTR">
        <td>사진정보</td><td></td>
      </tr>
      <tr>
        <td class="head"><span class="essentialMark">*</span>대표사진</td>
        <td class="imgAddTD">
          <div class="imageList">
            <?php
              for($i=1; $i<=5; $i++){
                $IS_IMG = false;
                foreach($PRD_IMG as $IMG){
                  if('MAIN'.$i == $IMG->IMG_NAME){
                    echo "
                      <div class=\"divAddImg\">
                      <input type='hidden' NAME='IS_DELETE' value='false'>
                        <img id='MAIN_IMG".$i."' src='/resource/img/product/".$IMG->PRD_ID."/".$IMG->IMG_NAME.".".$IMG->IMG_EXTENSION."'>
                        <input id='FILE_MAIN_IMG".$i."' type='file' name='PRD_IMG' value='' onchange='loadMain(event,".$i.")'>
                        <input class=\"imgDeleteBtn\" type=\"button\" value=\"삭제\">
                      </div>
                    ";
                    $IS_IMG = true;
                  }
                }
                if(!$IS_IMG){
                  echo "
                    <div class=\"divAddImg\">
                    <input type='hidden' NAME='IS_DELETE' value='false'>
                      <img id='MAIN_IMG".$i."' src='/resource/img/icon/ic_noImg.png'>
                      <input id='FILE_MAIN_IMG".$i."' type='file' name='PRD_IMG' value='' onchange='loadMain(event,".$i.")'>
                    </div>
                  ";
                }
              }
            ?>
          </div>
        </td>
      </tr>
      <tr>
        <td class="head"><span class="essentialMark">*</span>상세페이지</td>
        <td class="imgAddTD">
          <div class="imageList">
            <?php
              for($i=1; $i<=5; $i++){
                $IS_IMG = false;
                foreach($PRD_IMG as $IMG){
                  if('DETAIL'.$i == $IMG->IMG_NAME){
                    echo "
                      <div class=\"divAddImg\">
                        <input type='hidden' NAME='IS_DELETE' value='false'>
                        <img id='DETAIL_IMG".$i."' src='/resource/img/product/".$IMG->PRD_ID."/".$IMG->IMG_NAME.".".$IMG->IMG_EXTENSION."'>
                        <input id='FILE_DETAIL_IMG".$i."' type='file' name='PRD_IMG' value='' onchange='loadDetail(event,".$i.")'>
                        <input class=\"imgDeleteBtn\" type=\"button\" value=\"삭제\">
                      </div>
                    ";
                    $IS_IMG = true;
                  }
                }
                if(!$IS_IMG){
                  echo "
                    <div class=\"divAddImg\">
                      <input type='hidden' NAME='IS_DELETE' value='false'>
                      <img id='DETAIL_IMG".$i."' src='/resource/img/icon/ic_noImg.png'>
                      <input id='FILE_DETAIL_IMG".$i."' type=file name='PRD_IMG' value='' onchange='loadDetail(event,".$i.")'>
                    </div>
                  ";
                }
              }
            ?>
          </div>
        </td>
      </tr>
      </table>
    </form>

    <form class="productOptionFrm" action="/admin/addProductPrc" method="post">
      <input type="hidden" name="PRD_ID" value="<?=$PRD_BASE->PRD_ID?>">
      <table>
      <tr class="titleTR">
        <td>옵션</td><td></td>
      </tr>
      <tr>
        <td class="head">옵션</td>
        <td class="OPTIONS">
          <select class="PRODUCT_OPTION_SET" name="PRODUCT_OPTION_SET">
            <option value="0000">옵션없음</option>
            <?php
              foreach($OPTION_SET as $item){
                echo "<option value=\"".$item->OPTION_SET_ID."\" ";
                if(!empty($PRD_OPTION)){
                  if($PRD_OPTION[0]->OPTION_SET_ID == $item->OPTION_SET_ID){
                    echo "selected";
                  }
                }
                echo ">".$item->OPTION_SET_NAME."</option>";
              }
            ?>
          </select>
          <div class="divOptionValue">

          </div>
        </td>
      </tr>
      </table>
    </form>

    <form class="productEtcFrm" action="/admin/addProductPrc" method="post">
      <input type="hidden" name="PRD_ID" value="<?=$PRD_BASE->PRD_ID?>">
      <table>
        <tr class="titleTR">
          <td>기타</td><td></td>
        </tr>
      <tr>
        <td rowspan="2" class="head">기타</td>
        <td class="checkbox">
          <input id="IS_NEW" type="checkbox" name="IS_NEW" <?php if($PRD_BASE->IS_NEW == "Y") echo "checked";?>><label for="IS_NEW">신상품</label>
          <input id="IS_RECOMMAND" type="checkbox" name="IS_RECOMMAND" <?php if($PRD_BASE->IS_RECOMMAND == "Y") echo "checked";?>><label for="IS_RECOMMAND">추천상품</label>
        </td>
      </tr>
      <tr>
        <td class="checkbox">
          <input id="IS_SELL" type="checkbox" name="IS_SELL" <?php if($PRD_BASE->IS_SELL == "Y") echo "checked";?>><label for="IS_SELL">판매여부</label>
          <input id="IS_DISPLAY" type="checkbox" name="IS_DISPLAY" <?php if($PRD_BASE->IS_DISPLAY == "Y") echo "checked";?>><label for="IS_DISPLAY">진열여부</label>
          <input id="IS_SOLDOUT" type="checkbox" name="IS_SOLDOUT" <?php if($PRD_BASE->IS_SOLDOUT == "Y") echo "checked";?>><label for="IS_SOLDOUT">매진여부</label>
        </td>
      </tr>
    </table>
    </form>

    <div class="divSubmit">
      <input class="addProductSubmitBtn btn blue" type="button" value="상품수정하기">
    </div>

  </div>
</div>

<div class="divLoader">
  <div class="spinner">
    <div class="dot1"></div>
    <div class="dot2"></div>
    <div class="dot3"></div>
    <div class="dot4"></div>
  </div>
  <h1></h1>
</div>
