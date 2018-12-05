$(document).ready(function() {

});

//=> [장바구니] 수량 버튼 클릭이벤트
$('.cartList .qtyTD input').click(function(e){
  var CART_ID = $(this).parents('td').parents('tr').children('td').children('.CART_ID').val();
  var resultValue;
  if($(this).hasClass('plusBtn')){
    resultValue = doAjaxSync('/cart/updateCartQty',{CART_ID:CART_ID,MODE:"PLUS"});
  }else{
    resultValue = doAjaxSync('/cart/updateCartQty',{CART_ID:CART_ID,MODE:"MINUS"});
  }
  if(resultValue){
    location.href="";
  }else{
    alert('오류가 발생했습니다.\n관리자에게 문의하세요.');
  }
});

//=> [장바구니] 선택상품삭제 버튼 클릭이벤트
$('.cartButton .deleteBtn').click(function(e){
  var CART_ID_ARR = new Array();

  $('.cartList input[type="checkbox"]').each(function(e){
    if($(this).prop('checked')){
      CART_ID_ARR.push($(this).next().val());
    }
  });

  if(CART_ID_ARR.length<1){
    alert('선택된 상품이 없습니다.');
    return false;
  }

  if(!confirm('선택한 상품을 삭제하시겠습니까?')){
    return false;
  }

  var resultValue = doAjaxSync('/cart/deleteCart',{CART_ID_ARR:CART_ID_ARR});

  if(resultValue){
    location.href="";
  }else{
    alert('오류가 발생했습니다.\n관리자에게 문의하세요.');
  }
});

//=> [장바구니] 전체상품삭제 버튼 클릭이벤트
$('.cartButton .deleteAllBtn').click(function(e){
  var CART_ID_ARR = new Array();

  var ROWCNT = 0;
  $('.cartList input[type="checkbox"]').each(function(e){
    ROWCNT++;
  });

  if(ROWCNT == 0){
    alert('장바구니가 이미 비어있습니다.');
    return false;
  }

  if(!confirm('전체상품을 삭제하시겠습니까?')){
    return false;
  }

  var resultValue = doAjaxSync('/cart/deleteCart',{CART_ID_ARR:"ALL"});

  if(resultValue){
    location.href="";
  }else{
    alert('오류가 발생했습니다.\n관리자에게 문의하세요.');
  }
});
