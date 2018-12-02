$(document).ready(function() {

});

// 탑 헤더 햄버거 버튼 클릭
$('.divFixedTopHeader .divHamburgerBtn').click(function(e){
  openSlideMenu('open');
});
// 슬라이드 메뉴 배경 클릭
$('.divSlideMenuBG').click(function(e){
  openSlideMenu('close');
});
// 슬라이드 닫기 버튼 클릭
$('.divSlideMenu .closeBtn').click(function(e){
  openSlideMenu('close');
});

/**************************************
**  슬라이드 메뉴 동작 로직
**  param
**  - type : (String) 1:'open' 2:'close'
**************************************/
function openSlideMenu(type){
  if(type=='open'){
    $('.divSlideMenu').animate({'left':'0'},300,"swing");
    $('.divSlideMenuBG').fadeIn();
  }else if(type=='close'){
    $('.divSlideMenu').animate({'left':'-310px'},300,"swing");
    $('.divSlideMenuBG').fadeOut();
  }
}
