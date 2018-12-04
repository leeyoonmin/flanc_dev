<div class="divCardList title">
  <div class="divCard pad_8px">
    <p class="typo normal base center color_white">- 회원가입 -</p>
  </div>
</div>

<div class="divCardList form">

  <div class="divCard id">

    <p class="typo normal small inputTitle">아이디　<span class="desc">* 영문소문자/숫자 6~20자</span></p>
    <i class="fa fa-camera-retro"></i>
    <input class="ID" type="email" name="ID" value="" placeholder="">
    <div class="division"></div>

    <p class="typo normal small inputTitle">비밀번호　<span></span></p>
    <input class="PASSWORD1" type="password" name="PW" value="" placeholder="">
    <p class="typo normal small inputTitle">비밀번호 확인　<span></span></p>
    <input class="PASSWORD2" type="password" name="PW" value="" placeholder="">
    <div class="division"></div>

    <p class="typo normal small inputTitle">이름<span></span></p>
    <input class="NAME" type="email" name="NAME" value="" placeholder="" maxlength="20">
    <div class="division"></div>

    <p class="typo normal small inputTitle">휴대전화　<span></span></p>
    <select class="TEL1" name="TEL1">
      <option value="010">010</option>
      <option value="016">016</option>
      <option value="017">017</option>
      <option value="018">018</option>
      <option value="019">019</option>
    </select>
    <input class="TEL2" type="tel" name="TEL2" maxlength="4">
    <input class="TEL3" type="tel" name="TEL3" maxlength="4">
    <div class="division"></div>

    <p class="typo normal small inputTitle">SMS 수신동의</p>
    <div class="divCheckBox">
      <input type="checkbox" id="SMS_AGREEMENT" name="SMS_AGREEMENT"><label for="SMS_AGREEMENT">동의함</label></span>
    </div>
    <div class="division"></div>

    <p class="typo normal small inputTitle">이메일　<span></span></p>
    <input class="EMAIL1" type="email" name="EMAL1">
    <input class="emailMark" type="button" value="@">
    <input class="EMAIL2" type="email" name="EMAL2" readonly>
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

    <p class="typo normal small inputTitle">EMAIL 수신동의</p>
    <div class="divCheckBox">
      <input type="checkbox" id="EMAIL_AGREEMENT" name="EMAIL_AGREEMENT"><label for="EMAIL_AGREEMENT">동의함</label></span>
    </div>
    <div class="division"></div>

    <p class="typo normal small inputTitle">성별<span></span></p>
    <div class="divRadioBtn">
      <input type="radio" name="SEX" id="male" value="1"><label for="male">남성</label>
      <input type="radio" name="SEX" id="female" value="2"><label for="female">여성</label>
    </div>
    <div class="division"></div>


    <p class="typo normal small inputTitle">생년월일<span></span></p>
    <input class="BIRTH" style="width:100%;" type="tel" name="BIRTH" value="" placeholder="생년월일 8자리 - 예) 19890820" maxlength="8">
    <div class="division"></div>

  </div>

  <input class="submitBtn bg_black color_white" type="button" value="가입하기">
  
</div>
