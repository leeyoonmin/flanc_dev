<div class="divContents commonCodeMng">

<div class="divSearch">
  <table>
    <tr class="head">
      <td class="wd125">업무구분</td>
      <td class="wd125">코드구분</td>
      <td class="wd150">코드명</td>
      <td class="wd150">코드</td>
      <td></td>
    </tr>
    <tr class="body">

      <td class="wd125">
        <select class="SELECT_WORK_DV" name="">
          <option value="0000">전체</option>
          <?php
            foreach($COMBO_1 as $item){
              echo "<option value=\"".$item->WORK_DV."\""; if(!empty($GET_DATA['WORK_DV'])){if($GET_DATA['WORK_DV']==$item->WORK_DV){echo "selected";}} echo ">".$item->WORK_DV."</option>";
            }
          ?>
        </select>
      </td>
      <td class="wd125">
        <select class="SELECT_CODE_DV" name="">
          <option value="0000">전체</option>
          <?php
            foreach($COMBO_2 as $item){
                echo "<option value=\"".$item->CODE_DV."\""; if(!empty($GET_DATA['CODE_DV'])){if($GET_DATA['CODE_DV']==$item->CODE_DV){echo "selected";}} echo ">".$item->CODE_DV."</option>";
            }
          ?>
        </select>
      </td>
      <td class="wd150">
        <input class="TEXT_CODE_NM" type="text" name="name" placeholder="코드명.." value="<?php if(!empty($GET_DATA['CODE_NM'])){echo $GET_DATA['CODE_NM'];} ?>">
      </td>
      <td class="wd150">
        <input class="TEXT_CODE" type="text" name="name" placeholder="코드.." value="<?php if(!empty($GET_DATA['CODE'])){echo $GET_DATA['CODE'];} ?>">
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
        <td class="checkBox">□</td><td>업무구분</td><td>코드구분</td><td>코드명</td><td>코드</td><td>사용여부</td><td>생성일시</td>
      </tr>
      <?php
        foreach($GRID_DATA as $item){
          echo "
          <tr class=\"body\">
            <td class=\"checkBox\" idxkey=\"".$item->IDXKEY."\">□</td><td>".$item->WORK_DV."</td><td>".$item->CODE_DV."</td><td>".$item->CODE_NM."</td><td>".$item->CODE."</td><td>".$item->IS_USE."</td><td>".date("Y-m-d H:i:s",strtotime($item->CREATED))."</td>
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

<div class="divCommonCodePopup divPopup">
  <div class="divPopupTitle">
    <p>코드추가</p><img class="closeBtn" src="/resource/img/icon/ic_close_white.png">
  </div>

  <form class="divPopupFrm" action="/admin/insertCommonCode" method="post">

  <table>
    <tr>
      <td>업무구분</td><td><input class="WORK_DV" name="WORK_DV" type="text" value=""></td>
    </tr>
    <tr>
      <td>코드구분</td><td><input class="CODE_DV" name="CODE_DV" type="text" value=""></td>
    </tr>
    <tr>
      <td>코드명</td><td><input class="CODE_NM" name="CODE_NM" type="text" value=""></td>
    </tr>
    <tr>
      <td>코드</td><td><input class="CODE" name="CODE" type="text" value=""></td>
    </tr>
    <tr>
      <td>사용여부</td><td><select class="IS_USE" name="IS_USE"><option value="Y">Y</option><option value="N">N</option></select></td>
    </tr>
  </table>

  </form>
  <input class="btn green saveBtn" type="button" value="저장하기">
</div>
<div class="divCommonCodePopupBG divPopupBG"></div>
