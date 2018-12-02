<div class="divContents addProduct">
  <div class="divGridTabMenu">
    <table>
      <tr>
        <td class="menu dailyProduct selected">당일배송</td>
        <td class="menu subscription">정기구독</td>
        <td></td>
      </tr>
    </table>
  </div>
  <div class="divGridTab dailyProduct">

    <form class="productInfoFrm" action="/admin/addProductPrc" method="post">
    <table>
      <tr class="titleTR">
        <td>상품정보</td><td></td>
      </tr>
      <tr>
        <td class="head"><span class="essentialMark">*</span>상품명</td>
        <td>
          <input class="PRODUCT_NAME" type="text" name="PRODUCT_NAME" value="">
        </td>
      </tr>
      <tr>
        <td class="head"><span class="essentialMark">*</span>요약설명</td>
        <td>
          <input class="PRODUCT_DESC" type="text" name="PRODUCT_BRIEF_DESC" value="">
        </td>
      </tr>
      <tr>
        <td class="head">상세설명</td>
        <td>
          <input class="PRODUCT_DESC" type="text" name="PRODUCT_DESC" value="">
        </td>
      </tr>
      </table>
    </form>

    <form class="productPriceFrm" action="/admin/addProductPrc" method="post">

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
                <input class="PRODUCT_SUPPLY_PRICE" type="tel" name="PRODUCT_SUPPLY_PRICE" value="">
              </td>
            </tr>
            <tr>
              <td class="head"><span class="essentialMark">*</span>판매가</td>
              <td>
                <input class="PRODUCT_SALES_PRICE" type="tel" name="PRODUCT_SALES_PRICE" value="">
              </td>
            </tr>
            <tr>
              <td class="head">적립금</td>
              <td>
                <input class="SAVINGS" type="tel" name="SAVINGS" value="">
              </td>
            </tr>
          </table>

        </td>
      </tr>
      </table>
      </form>

      <form class="productImageFrm" enctype="multipart/form-data" action="/ajax/addProductImage" method="post">

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
                echo "
                  <div class=\"divAddImg\">
                    <img id='MAIN_IMG".$i."' src='/resource/img/icon/ic_noImg.png'>
                    <input id='FILE_MAIN_IMG".$i."' type='file' name='PRD_IMG' value='' onchange='loadMain(event,".$i.")'>
                  </div>
                ";
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
                echo "
                  <div class=\"divAddImg\">
                    <img id='DETAIL_IMG".$i."' src='/resource/img/icon/ic_noImg.png'>
                    <input id='FILE_DETAIL_IMG".$i."' type=file name='PRD_IMG' value='' onchange='loadDetail(event,".$i.")'>
                  </div>
                ";
              }
            ?>
          </div>
        </td>
      </tr>
      </table>
    </form>

    <form class="productOptionFrm" action="/admin/addProductPrc" method="post">

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
                echo "<option value=\"".$item->OPTION_SET_ID."\">".$item->OPTION_SET_NAME."</option>";
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

      <table>
        <tr class="titleTR">
          <td>기타</td><td></td>
        </tr>
      <tr>
        <td rowspan="2" class="head">기타</td>
        <td class="checkbox">
          <input id="IS_NEW" type="checkbox" name="IS_NEW"><label for="IS_NEW">신상품</label>
          <input id="IS_RECOMMAND" type="checkbox" name="IS_RECOMMAND"><label for="IS_RECOMMAND">추천상품</label>
        </td>
      </tr>
      <tr>
        <td class="checkbox">
          <input id="IS_SELL" type="checkbox" name="IS_SELL"><label for="IS_SELL">판매여부</label>
          <input id="IS_DISPLAY" type="checkbox" name="IS_DISPLAY"><label for="IS_DISPLAY">진열여부</label>
          <input id="IS_SOLDOUT" type="checkbox" name="IS_SOLDOUT"><label for="IS_SOLDOUT">매진여부</label>
        </td>
      </tr>
    </table>
    </form>

    <div class="divSubmit">
      <input class="addProductSubmitBtn btn blue" type="button" value="상품등록하기">
    </div>

  </div>
  <div class="divGridTab subscription">
    서비스크립션
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
