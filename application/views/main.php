  <div class="divSlideBanner divMainBanner">
    <div class="swiper-container">
      <div class="swiper-wrapper">
        <?php
          foreach($BANNER_DATA as $item){
            echo "<div class=\"swiper-slide\"><a href=\"".$item->LINK_URL."\"><img src=\"/resource/img/banner/".$item->FILE_NAME."\"></a></div>";
          }
        ?>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>

  <div class="divCard mainCardMenu subscription cursor">
    <p class="typo normal base">정기구독</p>
  </div>

  <div class="divCard mainCardMenu quickDelivery cursor">
    <p class="typo normal base">오늘의 꽃</p>
  </div>

  <div class="divCard mainCardMenu flancPlanner cursor">
    <p class="typo normal base">플랑 플레너</p>
  </div>

  <!-- Swiper JS -->
  <script src="/resource/js/swiper.js"></script>
  <!-- Initialize Swiper -->
  <script>
    var swiper1 = new Swiper('.divMainBanner .swiper-container', {
      loop: true,
      pagination: {
        el: '.swiper-pagination'
      },
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
    });
  </script>
