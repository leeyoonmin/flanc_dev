<div class="divSideMenu">
  <div class="divLogo">
    <p>FLANC</p>
    <p>Admin Page</p>
  </div>
  <ul class="divMenuList">
    <a href="/admin/shopMng"><li class="<?php if($screenID=="shopMng") echo "selected";?>">
      <img type="home" src="/resource/img/icon/ic_home_<?php if($screenID=="shopMng"){echo "blue";}else{echo "gray";}?>.png">상점관리
    </li></a>
    <a href="/admin/userMng"><li class="<?php if($screenID=="userMng") echo "selected";?>">
      <img type="member" src="/resource/img/icon/ic_member_<?php if($screenID=="userMng"){echo "blue";}else{echo "gray";}?>.png">회원관리
    </li></a>
    <a href="/admin/productMng"><li class="<?php if($screenID=="productMng") echo "selected";?>">
      <img type="flower" src="/resource/img/icon/ic_flower_<?php if($screenID=="productMng"){echo "blue";}else{echo "gray";}?>.png">상품관리
    </li></a>
    <a href="#"><li class="<?php if($screenID=="a") echo "selected";?>">
      <img type="box" src="/resource/img/icon/ic_box_<?php if($screenID=="a"){echo "blue";}else{echo "gray";}?>.png">주문관리
    </li></a>
    <a href="#"><li class="<?php if($screenID=="a") echo "selected";?>">
      <img type="list" src="/resource/img/icon/ic_list_<?php if($screenID=="a"){echo "blue";}else{echo "gray";}?>.png">게시판관리
    </li></a>
    <a href="/admin/codeMng"><li class="<?php if($screenID=="codeMng") echo "selected";?>">
      <img type="code" src="/resource/img/icon/ic_code_<?php if($screenID=="codeMng"){echo "blue";}else{echo "gray";}?>.png">
      코드관리</li></a>
    <a href="/admin/sampleDashboard"><li class="<?php if($screenID=="sample") echo "selected";?>">
      <img type="code" src="/resource/img/icon/ic_code_<?php if($screenID=="sample"){echo "blue";}else{echo "gray";}?>.png">샘플페이지
    </li></a>
  </ul>
</div>
