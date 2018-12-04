<div class="divSlideMenu">
  <table class="divSlideTopHeader">
    <tr>
      <td></td>
      <td class="closeBtn cursor"><img src="/resource/img/icon/ic_close_gray.png"></td>
    </tr>
  </table>
  <table class="divSlideMenuList">
    <?php
      if(!$this->session->userdata('is_login')){
    ?>
    <tr>
      <td class="cursor"><a href="/auth/login">로그인</a></td>
    </tr>
    <tr>
      <td class="cursor"><a href="/auth/join">회원가입</a></td>
    </tr>
    <?php
      }
      else{
    ?>
      <tr>
        <td class="cursor"><a href="/auth/logout">로그아웃</a></td>
      </tr>
    <?php
      }
    ?>
    <tr>
      <td class="cursor"><a href="">정기구독</a></td>
    </tr>
    <tr>
      <td class="cursor"><a href="/daily">오늘의꽃</a></td>
    </tr>
    <tr>
      <td class="cursor"><a href="">플라워플래너</a></td>
    </tr>
  </table>

</div>
<div class="divSlideMenuBG"></div>
