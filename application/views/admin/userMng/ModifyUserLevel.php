<div class="divContents modifyUserLevel">

<div class="divSearch">
  <table>
    <tr class="head">
      <td class="wd220">고객정보별</td>
      <td class="wd125">등급별</td>
      <td class="wd125">성별</td>
      <td class="wd350">가입일</td>
      <td></td>
    </tr>
    <tr class="body">

      <td class="wd220">
        <select class="selectText USER_INFO_DV" name="SELECT_TEXT_1">
          <option value="0000">선택</option>
          <option value="ID" <?php if(!empty($GET_DATA['USER_INFO_DV'])){if($GET_DATA['USER_INFO_DV']=="ID"){echo "selected";}}?>>아이디</option>
          <option value="NAME" <?php if(!empty($GET_DATA['USER_INFO_DV'])){if($GET_DATA['USER_INFO_DV']=="NAME"){echo "selected";}}?>>이름</option>
          <option value="TEL" <?php if(!empty($GET_DATA['USER_INFO_DV'])){if($GET_DATA['USER_INFO_DV']=="TEL"){echo "selected";}}?>>전화번호</option>
          <option value="ADDR" <?php if(!empty($GET_DATA['USER_INFO_DV'])){if($GET_DATA['USER_INFO_DV']=="ADDR"){echo "selected";}}?>>주소</option>
        </select><input class="selectText USER_INFO" type="text" name="name" value="<?php if(!empty($GET_DATA['USER_INFO_DV'])){echo $GET_DATA['USER_INFO'];}?>">
      </td>
      <td class="wd125">
        <select class="SELECT USER_LEVEL" name="">
          <option value="0000">전체</option>
          <?php
            foreach($COMBO_LEVEL as $item){
              echo "<option value=\"".$item->CODE."\""; if(!empty($GET_DATA['LEVEL'])){if($GET_DATA['LEVEL']==$item->CODE){echo "selected";}} echo ">".$item->CODE_NM."</option>";
            }
          ?>
        </select>
      </td>
      <td class="wd125">
        <select class="USER_SEX" name="">
          <option value="0000">전체</option>
          <option value="01" <?php if(!empty($GET_DATA['SEX'])){if($GET_DATA['SEX']=="01"){echo "selected";}}?>>남자</option>
          <option value="02" <?php if(!empty($GET_DATA['SEX'])){if($GET_DATA['SEX']=="02"){echo "selected";}}?>>여자</option>
        </select>
      </td>
      <td class="wd350 inputDate">
        <input class="INPUT_FRDT" type="text" value="<?php if(!empty($GET_DATA['FRDT'])){echo date('Y-m-d',strtotime($GET_DATA['FRDT']));}?>"><img class="FRDT_BTN" src="/resource/img/icon/ic_calendar_white.png"> ~ <input class="INPUT_TODT" type="text" name="" value="<?php if(!empty($GET_DATA['TODT'])){echo date('Y-m-d',strtotime($GET_DATA['TODT']));}?>"><img class="TODT_BTN" src="/resource/img/icon/ic_calendar_white.png">
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
        선택된 고객을 <select class="SELECT_USER_LEVEL" name="">
          <option value="0000">선택</option>
          <?php
            foreach($COMBO_LEVEL as $item){
              echo "<option value=\"".$item->CODE."\""; if(!empty($GET_DATA['LEVEL'])){if($GET_DATA['LEVEL']==$item->CODE){echo "selected";}} echo ">".$item->CODE_NM."</option>";
            }
          ?>
        </select> 로 <input class="btn green modifyBtn" type="button" name="" value="변경">
        <!--iinput class="btn orange modifyBtn" type="button" name="" value="수정">
        <input class="btn red deleteBtn" type="button" name="" value="삭제"-->
        <input class="btn blue searchBtn" type="button" name="" value="조회">
      </td>
    </tr>
  </table>
</div>

<div class="divGrid is_check">
  <table>
      <tr class="head">
        <td class="checkBox">□</td><td>아이디</td><td>이름</td><td>등급</td><td>전화번호</td><td>성별</td><td>생년월일</td><td>주소</td><td>가입일</td>
      </tr>
      <?php
        foreach($GRID_DATA as $item){
          echo "
          <tr class=\"body\">
            <td class=\"checkBox\" id=\"".$item->ID."\">□</td><td>".$item->ID."</td><td>".$item->NAME."</td><td>".$item->LEVEL_NM."</td><td>".$item->TEL."</td><td>".$item->SEX."</td><td>".$item->BIRTH."</td><td>".$item->ADDR."</td><td>".date("Y-m-d",strtotime($item->JOIN_TIME))."</td>
          </tr>
          ";
        }
        if($ROW_CNT < 1){
          echo "
            <tr>
              <td colspan=\"9\" style=\"padding:32px\">조회결과가 없습니다.</td>
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

<div class="divModifyUserLevelPopup divPopup">
  <div class="divPopupTitle">
    <p>회원추가</p><img class="closeBtn" src="/resource/img/icon/ic_close_white.png">
  </div>

  <form class="divPopupFrm" action="/admin/insertUser" method="post">

  <table>
    <tr>
      <td>아이디</td><td><input class="ID" name="ID" type="text" value=""></td>
    </tr>
    <tr>
      <td>비밀번호</td><td><input class="PASSWORD" name="PASSWORD" type="password" value=""></td>
    </tr>
    <tr>
      <td>이름</td><td><input class="NAME" name="NAME" type="text" value=""></td>
    </tr>
    <tr>
      <td>주소</td><td>
        <input id="postcode" type="text" name="POSTCODE" placeholder="우편번호" value=""><input class="btn blue" id="postcode_btn" type="button" value="검색" onclick="searchPostcode()">
        <input id="address" type="text" name="ADDR" placeholder="주소" value="">
        <input id="detail_addr" type="text" name="ADDR_DETAIL" placeholder="상세주소" value="">
      </td>
    </tr>
    <tr>
      <td>전화번호</td><td>
        <select id="sel_tel1" name="TEL1">
          <option value="010">010</option>
          <option value="011">011</option>
          <option value="016">016</option>
          <option value="017">017</option>
          <option value="018">018</option>
          <option value="019">019</option>
        </select>
        －<input class="TEL2" type="tel" id="tel2" name="TEL2" maxlength="4" value="">
        －<input class="TEL3" type="tel" id="tel3" name="TEL3" maxlength="4" value="">
      </td>
    </tr>
    <tr>
      <td>등급</td>
      <td>
        <select class="LEVEL" name="LEVEL">
          <option value="0000">전체</option>
          <?php
            foreach($COMBO_LEVEL as $item){
              echo "<option value=\"".$item->CODE."\">".$item->CODE_NM."</option>";
            }
          ?>
        </select>
      </td>
    </tr>
  </table>

  </form>
  <input class="btn green saveBtn" type="button" value="저장하기">
</div>
<div class="divModifyUserLevelPopupBG divPopupBG"></div>

<!-- iOS에서는 position:fixed 버그가 있음, 적용하는 사이트에 맞게 position:absolute 등을 이용하여 top,left값 조정 필요 -->
<div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:998;-webkit-overflow-scrolling:touch;">
<img src="//i1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:999" onclick="closeDaumPostcode()" alt="닫기 버튼">
</div>
<script src="/resource/js/daum_postcode.js"></script>
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
