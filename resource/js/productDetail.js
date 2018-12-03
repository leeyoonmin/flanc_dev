$(document).ready(function() {

});

// [오늘의꽃] 상품상세 옵션 값 변경 이벤트
$('.productOption select').change(function(e){
  $(this).children().each(function(e){
    var OPTION_PRICE = 0;
    var TT_PRICE = 0;
    if($(this).prop('selected')){
      if($(this).val()=='0000'){
        $(this).parents('select').attr('OPTION_PRICE',0);
      }else{
        $(this).parents('select').attr('OPTION_PRICE',Number($(this).attr('OPTION_PRICE')));
        $(this).parents('select').attr('OPTION_VALUE',$(this).attr('OPTION_VALUE'));
      }
    }
    $('.productOption select').each(function(e){
      OPTION_PRICE += Number($(this).attr('OPTION_PRICE'));
    });
    TT_PRICE = OPTION_PRICE + Number($('.TT_PRICE').attr('ORIGIN'));
    $('.TT_PRICE').text(commas(TT_PRICE));
  });
});

// [오늘의꽃] 상품상세 구매하기 버튼 클릭 이벤트
$('.buyNowBtn').click(function(e){

  var PRD_ID = $('.divProductData .HD_PRD_ID').val();
  var PRD_PRICE = $('.TT_PRICE').attr('ORIGIN');
  var TT_PRICE = $('.TT_PRICE').text().replace(',','');
  var OPTION_ARR = new Array();
  var OPTION_CNT = 0;
  var dataSet = {};
  $('.productOption select').each(function(){
    if($(this).attr('OPTION_NAME') != "" && $(this).attr('OPTION_PRICE') != "" && $(this).attr('OPTION_VALUE') != ""){
      OPTION_ARR[OPTION_CNT] = {OPTION_ID:$(this).attr('OPTION_ID'), OPTION_NAME:$(this).attr('OPTION_NAME'), OPTION_PRICE:$(this).attr('OPTION_PRICE'), OPTION_VALUE:$(this).attr('OPTION_VALUE')};
      OPTION_CNT++;
    }
  });
  dataSet = {PRD_ID:PRD_ID, OPTION:OPTION_ARR, TT_PRICE:TT_PRICE, PRD_PRICE:PRD_PRICE};
  doAjaxSync('/cart/addCart',dataSet);
  //location.href="/cart";
});

// [오늘의꽃] 상품상세 장바구니 담기 버튼 클릭 이벤트
$('.addCardBtn').click(function(e){
  console.log('ADD CART');
});
