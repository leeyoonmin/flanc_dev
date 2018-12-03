<div class="divContents bannerMng">

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
          <option value="OPTION_SET_NAME" <?php if(!empty($GET_DATA['OPTION_INFO_DV'])){if($GET_DATA['OPTION_INFO_DV']=="OPTION_SET_NAME"){echo "selected";}}?>>옵션셋명</option>
          <option value="OPTION_SET_ID" <?php if(!empty($GET_DATA['OPTION_INFO_DV'])){if($GET_DATA['OPTION_INFO_DV']=="OPTION_SET_ID"){echo "selected";}}?>>옵션셋코드</option>
          <option value="OPTION_SET_DESC" <?php if(!empty($GET_DATA['OPTION_INFO_DV'])){if($GET_DATA['OPTION_INFO_DV']=="OPTION_SET_DESC"){echo "selected";}}?>>옵션셋설명</option>
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
        <input class="btn red deleteBtn" type="button" name="" value="삭제">
        <input class="btn blue searchBtn" type="button" name="" value="조회">
      </td>
    </tr>
  </table>
</div>

<div class="divGrid is_check">
  <table>
      <tr class="head">
        <td class="checkBox">□</td><td>타입</td><td>순서</td><td>사진</td><td>링크</td><td>등록일자</td>
      </tr>
      <?php
        foreach($GRID_DATA as $item){
          echo "
          <tr class=\"body\">
            <td class=\"checkBox\" idxkey=\"".$item->BANNER_ID."\" fileName=\"".$item->IMG_NAME.".".$item->IMG_EXTENSION."\">□</td>
            <td>".$item->BANNER_TYPE."</td>
            <td>".$item->BANNER_ORDER."</td>
            <td><img src=\"/resource/img/banner/".$item->IMG_NAME.".".$item->IMG_EXTENSION."\"></td>
            <td>".$item->LINK_URL."</td>
            <td>".date('Y-m-d',strtotime($item->CREATED))."</td>
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

<div class="divOptionSetMngPopup divPopup">
  <div class="divPopupTitle">
    <p>옵션 추가</p><img class="closeBtn" src="/resource/img/icon/ic_close_white.png">
  </div>

  <form class="divPopupFrm" action="/admin/insertCommonCode" method="post">

  <table>
    <tr>
      <td class="head">옵션셋명</td><td class="body"><input class="OPTION_SET_NAME" type="text" value=""></td>
    </tr>
    <tr>
      <td class="head">옵션</td>
      <td class="body optionList">
        <select class="searchDV">
          <option value="OPTION_NAME">옵션명</option>
          <option value="OPTION_ID">옵션코드</option>
          <option value="OPTION_VALUE">옵션값</option>
        </select><input class="searchKeyword" type="text" value=""><input class="searchBtn" type="button" value="옵션검색"><input class="allBtn" type="button" value="전체보기">

        <div class="divOptionList">
            <div class="divList allOption">
              <?php
                foreach($OPTION_LIST as $item){
                  echo "<div class=\"divOption\" OPTION_ID=\"".$item->OPTION_ID."\" OPTION_NAME=\"".$item->OPTION_NAME."\" OPTION_VALUE=\"".$item->OPTION_VALUE."\">[".$item->OPTION_ID."]".$item->OPTION_NAME."<img src=\"/resource/img/icon/ic_search_white.png\"></div>";
                }
              ?>
            </div>
            <div class="divButton">
              <input class="addBtn" type="button" name="" value="추가 >>"></br><input class="removeBtn" type="button" name="" value="삭제 <<">
            </div>
            <div class="divList addOption">

            </div>
        </div>
      </td>
    </tr>
    <tr>
      <td class="head">옵션셋설명</td><td class="body"><input class="OPTION_SET_DESC" type="text" value=""></td>
    </tr>
  </table>

  </form>
  <input class="btn green saveBtn" type="button" value="저장하기" onclick="saveOptionSet();">
</div>
<div class="divOptionSetMngPopupBG divPopupBG"></div>
<div class="divToolTip"></div>
