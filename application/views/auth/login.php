<div class="divCardList loginForm">
  <div class="divCard pad_8px">
    <table class="ID">
      <tr>
        <td class="inputIcon">
          <div><i class="fa fa-user"></i></div>
        </td>
        <td>
          <div>
            <input class="inputID" type="email" name="ID" value="" placeholder="아이디">
          </div>
        </td>
      </tr>
    </table>

    <table class="PW">
      <tr>
        <td class="inputIcon">
          <div><i class="fa fa-lock"></i></div>
        </td>
        <td>
          <div>
            <input class="inputPW" type="password" name="PW" value="" placeholder="비밀번호">
          </div>
        </td>
      </tr>
    </table>

  </div>
</div>

<div class="divCardList submitBtn">
  <div class="divCard pad_16px">
    <p class="typo normal base center color_white">로그인</p>
  </div>
</div>

<div class="divCardList joinBtn">
  <div class="divCard pad_16px">
    <a href="/auth/join"><p class="typo normal base center">회원가입</p></a>
  </div>
</div>

<div class="divCardList snsLogin">
  <div class="divCard pad_16px facebookLogin">
    <a href=""><p class="typo normal base center">페이스북 로그인</p></a>
  </div>
  <div class="divCard pad_16px googleLogin">
    <a href=""><p class="typo normal base center">구글 로그인</p></a>
  </div>
  <div class="divCard pad_16px kakaoLogin">
    <a href=""><p class="typo normal base center">카카오 로그인</p></a>
  </div>
  <div class="divCard pad_16px naverLogin">
    <a href=""><p class="typo normal base center">네이버 로그인</p></a>
  </div>
</div>

<div class="divCardList divButton">
  <div class="divCard pad_16px">
    <a href=""><span>아이디찾기</span></a><span class="division">/</span><a href=""><span>비밀번호찾기</span></a>
  </div>
</div>

<input class="PREV_URL" type="hidden" value="<?=$PREV_URL?>">
