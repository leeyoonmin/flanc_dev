<div class="divContents optionMng">

<div class="divSearch">
  <table>
    <tr class="head">
      <td class="wd125">옵션정보</td>
      <td></td>
    </tr>
    <tr class="body">

      <td class="wd220">
        <select class="selectText OPTION_INFO_DV" name="SELECT_TEXT_1">
          <option value="0000">선택</option>
          <option value="OPTION_NAME" <?php if(!empty($GET_DATA['OPTION_INFO_DV'])){if($GET_DATA['OPTION_INFO_DV']=="OPTION_NAME"){echo "selected";}}?>>옵션명</option>
          <option value="OPTION_ID" <?php if(!empty($GET_DATA['OPTION_INFO_DV'])){if($GET_DATA['OPTION_INFO_DV']=="OPTION_ID"){echo "selected";}}?>>옵션코드</option>
          <option value="OPTION_VALUE" <?php if(!empty($GET_DATA['OPTION_INFO_DV'])){if($GET_DATA['OPTION_INFO_DV']=="OPTION_VALUE"){echo "selected";}}?>>옵션값</option>
          <option value="OPTION_DESC" <?php if(!empty($GET_DATA['OPTION_INFO_DV'])){if($GET_DATA['OPTION_INFO_DV']=="OPTION_DESC"){echo "selected";}}?>>옵션설명</option>
        </select><input class="selectText OPTION_INFO" type="text" name="name" value="<?php if(!empty($GET_DATA['OPTION_INFO'])){echo $GET_DATA['OPTION_INFO'];}?>">
      </td>
      <td></td>
    </tr>
  </table>
</div>

<div class="divButton">
  <table>
    <tr>
      <td class="info">
        총 <span><?=$ROW_CNT?></span>건
      </td>
      <td></td>
      <td class="button">
        <input class="btn green addBtn" type="button" name="" value="추가">
        <input class="btn orange modifyBtn" type="button" name="" value="수정">
        <input class="btn red deleteBtn" type="button" name="" value="삭제">
        <input class="btn blue searchBtn" type="button" name="" value="조회">
      </td>
    </tr>
  </table>
</div>

<div class="divGrid is_check">
  <table>
      <tr class="head">
        <td class="checkBox">□</td><td>옵션ID</td><td>옵션명</td><td>옵션값</td><td>옵션설명</td>
      </tr>
      <?php
        foreach($GRID_DATA as $item){
          echo "
          <tr class=\"body\">
            <td class=\"checkBox\" idxkey=\"".$item->OPTION_ID."\">□</td><td>".$item->OPTION_ID."</td><td>".$item->OPTION_NAME."</td><td>".$item->OPTION_VALUE."</td><td>".$item->OPTION_DESC."</td>
          </tr>
          ";
        }
        if($ROW_CNT < 1){
          echo "
            <tr>
              <td colspan=\"7\" style=\"padding:32px\">조회결과가 없습니다.</td>
            </tr>
          ";
        }
      ?>

  </table>
</div>
<?php
  $rowCount = $ROW_CNT;
  $CURRENT_PAGE = $PAGE;
  $LAST_PAGE = ceil($rowCount/10);
  if($LAST_PAGE==0) $LAST_PAGE = 1;
  $PAGE_LIST = array();
?>
<div class="divPagination">
  <input class="currentPage" type="hidden" name="PAGE" value="<?=$PAGE?>">
  <input class="lastPage" type="hidden" name="PAGE" value="<?=$LAST_PAGE?>">
  <table>
    <tr>
      <td  class="pageBtn first">first</td>
      <?php
        $viewCnt = 0;
        for($i=1; $i<=$LAST_PAGE; $i++){
          if($viewCnt<9){
            if($CURRENT_PAGE == $i && $i <= $LAST_PAGE){
              echo "<td class=\"pageBtn selected\">".$i."</td>";
              $viewCnt++;
            }else if($CURRENT_PAGE <= 5 && $i<=$LAST_PAGE){
              echo "<td class=\"pageBtn\">".$i."</td>";
              $viewCnt++;
            }else if($CURRENT_PAGE > 5 && $i <= $LAST_PAGE && $CURRENT_PAGE-4 <=$i){
              echo "<td class=\"pageBtn\">".$i."</td>";
              $viewCnt++;
            }else if($i<=$LAST_PAGE-2 && $i>=$LAST_PAGE-8){
              echo "<td class=\"pageBtn\">".$i."</td>";
              $viewCnt++;
            }else{
              echo "<td class=\"pageBtn unvisible\">".$i."</td>";
            }
          }
        }
      ?>
      <td  class="pageBtn last">last</td>
    </tr>
  </table>
</div>
</div>

<div class="divOptionMngPopup divPopup">
  <div class="divPopupTitle">
    <p>옵션 추가</p><img class="closeBtn" src="/resource/img/icon/ic_close_white.png">
  </div>

  <form class="divPopupFrm" action="/admin/insertCommonCode" method="post">

  <table>
    <tr>
      <td>옵션명</td><td><input class="OPTION_NAME" type="text" value=""></td>
    </tr>
    <tr>
      <td>옵션그룹</td>
      <td>

        <table class="optionGroup">
          <tr class="option">
            <td>옵션값</td><td>
              <input class="OPTION_VALUE" type="text" value="">
            </td>
            <td>추가금액</td><td>
              <input class="OPTION_PRICE" type="text" value="" placeholder="추가금액 없을 시 공란">
            </td>
            <td class="deleteTD">
              <img class="deleteBtn" src="/resource/img/icon/ic_trash.png" onclick="deleteOptionGroup($(this));">
            </td>
          </tr>
        </table>

        <img class="plusBtn" src="/resource/img/icon/ic_plus_white.png" onclick="addOptionGroup();">
      </td>
    </tr>
    <tr>
      <td>옵션설명</td><td><input class="OPTION_DESC" type="text" value=""></td>
    </tr>
  </table>

  </form>
  <input class="btn green saveBtn" type="button" value="저장하기" onclick="saveOption();">
</div>
<div class="divOptionMngPopupBG divPopupBG"></div>
