<div class="divCardList title">
  <div class="divCard pad_16px">
    <p class="typo normal base center color_white">- 회원가입 완료 -</p>
  </div>
</div>
<div class="divCardList joinMsg">
  <div class="divCard pad_16px">
    <p class="typo normal small center"><?=$this->session->userdata('user_name')?> 님, 회원가입을 축하드립니다.</p>
  </div>
</div>

<div class="divCardList shortCut">
  <div class="divCard pad_16px">
    <a class="menu" href="/"><p class="typo normal base"><i class="fa fa-chevron-circle-right"></i>홈으로</p></a>
  </div>
  <div class="divCard pad_16px">
    <a class="menu" href="/daily"><p class="typo normal base"><i class="fa fa-chevron-circle-right"></i>당일배송</p></a>
  </div>
  <div class="divCard pad_16px">
    <a class="menu" href="/subscription"><p class="typo normal base"><i class="fa fa-chevron-circle-right"></i>정기구독</p></a>
  </div>
  <div class="divCard pad_16px">
    <a class="menu" href="/planner"><p class="typo normal base"><i class="fa fa-chevron-circle-right"></i>플랑 플래너</p></a>
  </div>
</div>
