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

  <div class="divCardList">


      <div class="divCard mainCardMenu subscription cursor">
        <a href="/">
          <p class="typo normal base">정기구독</p>
        </a>
      </div>


    <div class="divCard mainCardMenu quickDelivery cursor">
      <a href="/daily">
        <p class="typo normal base">오늘의 꽃</p>
      </a>
    </div>

    <div class="divCard mainCardMenu flancPlanner cursor">
      <a href="/">
        <p class="typo normal base">플랑 플레너</p>
      </a>
    </div>

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
