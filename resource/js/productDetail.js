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
        $(this).parents('select').attr('OPTION_CD',$(this).val());
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
  var OPTION_ARR = new Array();
  var OPTION_CNT = 0;
  var dataSet = {};
  $('.productOption select').each(function(){
    if($(this).attr('option_cd') != "" && $(this).attr('option_price') != ""){
      OPTION_ARR[OPTION_CNT] = {OPTION_ID:$(this).attr('option_id'), OPTION_CD:$(this).attr('option_cd'), OPTION_PRICE:$(this).attr('option_price')};
      OPTION_CNT++;
    }
  });
  dataSet = {PRD_ID:PRD_ID, OPTION:OPTION_ARR};
  console.log(dataSet);
  //doAjaxSync('addCard',dataSet);

});

// [오늘의꽃] 상품상세 장바구니 담기 버튼 클릭 이벤트
$('.addCardBtn').click(function(e){
  console.log('ADD CART');
});
