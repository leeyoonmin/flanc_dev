<div class="divCardList title">
  <div class="divCard pad_16px">
    <p class="typo normal base center color_white">주문서 작성</p>
  </div>
</div>


<div class="divCardList form deliveryData">

  <div class="divCard id">

    <p class="typo normal small inputTitle">주문자명　<span class="desc"></span></p>
    <i class="fa fa-camera-retro"></i>
    <input class="NAME" type="email" name="NAME" value="<?=$USER_DATA->NAME?>">
    <div class="division"></div>

    <p class="typo normal small inputTitle">주소<span></span></p>
    <input id="postcode" class="POSTCODE" type="tel" name="POSTCODE" value=""><input class="addrSearchBtn" type="button" value="검색" onclick="searchPostcode()">
    <input id="address" class="ADDR" type="email" name="ADDR" value="">
    <input id="detail_addr" class="ADDR_D" type="email" name="ADDR_D" value="">
    <div class="division"></div>

    <p class="typo normal small inputTitle">휴대전화　<span></span></p>
    <select class="TEL1" name="TEL1">
      <option value="010" <?php if($USER_DATA->TEL_H=='010') echo "selected";?>>010</option>
      <option value="016" <?php if($USER_DATA->TEL_H=='016') echo "selected";?>>016</option>
      <option value="017" <?php if($USER_DATA->TEL_H=='017') echo "selected";?>>017</option>
      <option value="018" <?php if($USER_DATA->TEL_H=='018') echo "selected";?>>018</option>
      <option value="019" <?php if($USER_DATA->TEL_H=='019') echo "selected";?>>019</option>
    </select>
    <input class="TEL2" type="tel" name="TEL2" maxlength="4" value="<?=$USER_DATA->TEL_B?>">
    <input class="TEL3" type="tel" name="TEL3" maxlength="4" value="<?=$USER_DATA->TEL_T?>">
    <div class="division"></div>

    <?php
      $EMAIL = explode('@',$USER_DATA->EMAIL);
    ?>
    <p class="typo normal small inputTitle">이메일　<span></span></p>
    <input class="EMAIL1" type="email" name="EMAL1" value="<?=$EMAIL[0]?>">
    <input class="emailMark" type="button" value="@">
    <input class="EMAIL2" type="email" name="EMAL2" value="<?=$EMAIL[1]?>" readonly>
    <select class="EMAIL3">
      <option value="0000">- 이메일 선택 -</option>
      <option value="naver.com">naver.com</option>
      <option value="daum.net">daum.net</option>
      <option value="nate.com">nate.com</option>
      <option value="hotmail.com">hotmail.com</option>
      <option value="yahoo.com">yahoo.com</option>
      <option value="empas.com">empas.com</option>
      <option value="korea.com">korea.com</option>
      <option value="dreamwiz.com">dreamwiz.com</option>
      <option value="gmail.com">gmail.com</option>
      <option value="9999">직접입력</option>
    </select>
    <div class="division"></div>


    <p class="typo normal small inputTitle">요청메시지<span></span></p>
    <input class="RQST_MSG" type="email" name="RQST_MSG" value="" placeholder="">
    <div class="division"></div>

  <input class="submitBtn bg_black color_white" type="button" value="가입하기">

</div>

<!-- iOS에서는 position:fixed 버그가 있음, 적용하는 사이트에 맞게 position:absolute 등을 이용하여 top,left값 조정 필요 -->
<div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
<img src="//i1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:3" onclick="closeDaumPostcode()" alt="닫기 버튼">
</div>
<script src="/resource/js/daum_postcode.js"></script>
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
