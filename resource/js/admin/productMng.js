/////////////////////////////////////////////////////////////////////////////////////////////
//                                     온로드 이벤트                                        //
/////////////////////////////////////////////////////////////////////////////////////////////
$(document).ready(function() {
  var OPTION_SET_ID = $('.divGridTab .PRODUCT_OPTION_SET').val();
  var dataSet = {'OPTION_SET_ID':OPTION_SET_ID};
  viewOptions(OPTION_SET_ID);
  var ajaxResult;
  if(OPTION_SET_ID != '0000'){
    ajaxResult = doAjaxSync('ajaxGetOptionsByOptionSetID',dataSet);
    viewOptions(ajaxResult);
  }else{
    $('.divOption').remove();
  }
});

/////////////////////////////////////////////////////////////////////////////////////////////
//                                  버튼 클릭 이벤트 리스트                                  //
/////////////////////////////////////////////////////////////////////////////////////////////

//--> [상품추가] 탭 버튼 클릭이벤트
$('.addProduct .divGridTabMenu .menu').click(function(e){
  var clickClass = "";
  if($(this).hasClass('dailyProduct')){
    clickClass = 'dailyProduct';
  }else if($(this).hasClass('subscription')){
    clickClass = 'subscription';
  }
  $('.addProduct .divGridTabMenu .menu').removeClass('selected');
  $('.addProduct .divGridTabMenu .menu.'+clickClass).addClass('selected');
  $('.addProduct .divGridTab').css('display','none');
  $('.addProduct .divGridTab.'+clickClass).css('display','block');
});

//--> [상품추가] 옵션셀렉터 값 변경 클릭이벤트
$('.addProduct .divGridTab .PRODUCT_OPTION_SET, .modifyProduct .divGridTab .PRODUCT_OPTION_SET').change(function(e){
  var OPTION_SET_ID = $(this).val();
  var dataSet = {'OPTION_SET_ID':OPTION_SET_ID};
  var ajaxResult;
  if(OPTION_SET_ID != '0000'){
    ajaxResult = doAjaxSync('ajaxGetOptionsByOptionSetID',dataSet);
    viewOptions(ajaxResult);
  }else{
    $('.divOption').remove();
  }

});

//--> [상품추가] 상품등록하기버튼 클릭이벤트
$('.addProduct .addProductSubmitBtn').click(function(e){
  if($('.productInfoFrm .PRODUCT_NAME').val()==""){
    alert('상품명을 입력해주세요');
    return false;
  }else if($('.productInfoFrm .PRODUCT_BRIEF_DESC').val()==""){

    alert('상품 간단설명을 입력해주세요');
    return false;
  }else if($('.productPriceFrm .PRODUCT_SUPPLY_PRICE').val()==""){

    alert('상품 공급가를 입력해주세요');
    return false;
  }else if($('.productPriceFrm .PRODUCT_SALES_PRICE').val()==""){

    alert('상품 판매가를 입력해주세요');
    return false;
  }else if($('#MAIN_IMG1').attr('src')=="/resource/img/icon/ic_noImg.png"){

    alert('대표사진을 등록해주세요.');
    return false;
  }else if($('#DETAIL_IMG1').attr('src')=="/resource/img/icon/ic_noImg.png"){

    alert('상세페이지 사진을 등록해주세요.');
    return false;
  }else{
      var form = $('.productInfoFrm')[0];
      var productInfoFrm = new FormData(form);
      form = $('.productPriceFrm')[0];
      var productPriceFrm = new FormData(form);
      form = $('.productOptionFrm')[0];
      var productOptionFrm = new FormData(form);
      form = $('.productEtcFrm')[0];
      var productEtcFrm = new FormData(form);
      var PRD_ID = doAjaxForm('addProductInfo', productInfoFrm);

      productPriceFrm.append("PRD_ID",PRD_ID);
      doAjaxForm('updateProductPrice', productPriceFrm);
      productOptionFrm.append("PRD_ID",PRD_ID);
      doAjaxForm('updateProductOption', productOptionFrm);
      productEtcFrm.append("PRD_ID",PRD_ID);
      doAjaxForm('updateProductEtc', productEtcFrm);
      var productMainImageFrm = new FormData();
      var productDetailImageFrm = new FormData();
      for(var i=1 ; i<=5; i++){
        productMainImageFrm = new FormData();
        productMainImageFrm.append(("PRD_IMG"),$("#FILE_MAIN_IMG"+i)[0].files[0]);
        if($("#FILE_MAIN_IMG"+i)[0].files[0]!=null){
          doAjaxForm('addProductImage?TYPE=MAIN'+i+'&PRD_ID='+PRD_ID+'&MODE=ADD', productMainImageFrm);
        }
      }
      for(var i=1 ; i<=5; i++){
        productDetailImageFrm = new FormData();
        productDetailImageFrm.append(("PRD_IMG"),$("#FILE_DETAIL_IMG"+i)[0].files[0]);
        if($("#FILE_DETAIL_IMG"+i)[0].files[0]!=null){
          doAjaxForm('addProductImage?TYPE=DETAIL'+i+'&PRD_ID='+PRD_ID+'&MODE=ADD', productDetailImageFrm);
        }
      }
      location.href="";
  }
});

//--> [상품수정] 상품수정하기버튼 클릭이벤트
$('.modifyProduct .addProductSubmitBtn').click(function(e){
  var PRD_ID = $('.productImageFrm .PRD_ID').val();
  if($('.productInfoFrm .PRODUCT_NAME').val()==""){
    alert('상품명을 입력해주세요');
    return false;
  }else if($('.productInfoFrm .PRODUCT_BRIEF_DESC').val()==""){
    alert('상품 간단설명을 입력해주세요');
    return false;
  }else if($('.productPriceFrm .PRODUCT_SUPPLY_PRICE').val()==""){
    alert('상품 공급가를 입력해주세요');
    return false;
  }else if($('.productPriceFrm .PRODUCT_SALES_PRICE').val()==""){
    alert('상품 판매가를 입력해주세요');
    return false;
  }else if($('#MAIN_IMG1').attr('src')=="/resource/img/icon/ic_noImg.png"){
    alert('대표사진을 등록해주세요.');
    return false;
  }else if($('#DETAIL_IMG1').attr('src')=="/resource/img/icon/ic_noImg.png"){
    alert('상세페이지 사진을 등록해주세요.');
    return false;
  }else{
      var form = $('.productInfoFrm')[0];
      var productInfoFrm = new FormData(form);

      form = $('.productPriceFrm')[0];
      var productPriceFrm = new FormData(form);

      form = $('.productOptionFrm')[0];
      var productOptionFrm = new FormData(form);

      form = $('.productEtcFrm')[0];
      var productEtcFrm = new FormData(form);

      doAjaxForm('updateProductInfo', productInfoFrm);
      doAjaxForm('updateProductPrice', productPriceFrm);
      doAjaxForm('updateProductOption', productOptionFrm);
      doAjaxForm('updateProductEtc', productEtcFrm);

      var productMainImageFrm = new FormData();
      var productDetailImageFrm = new FormData();
      for(var i=1 ; i<=5; i++){
        productMainImageFrm = new FormData();
        if($("#FILE_MAIN_IMG"+i).val()==""){
        }else{
            console.log('MAIN'+i+' : 변경');
            productMainImageFrm.append(("PRD_IMG"),$("#FILE_MAIN_IMG"+i)[0].files[0]);
            if($("#FILE_MAIN_IMG"+i)[0].files[0]!=null){
              doAjaxForm('addProductImage?TYPE=MAIN'+i+'&PRD_ID='+PRD_ID+'&MODE=MODIFY', productMainImageFrm);
          }
        }
        if($("#FILE_MAIN_IMG"+i).prev().prev().val() == "true"){
          doAjaxForm('deleteProductImage?TYPE=MAIN'+i+'&PRD_ID='+PRD_ID, productMainImageFrm);
        }
      }

      for(var i=1 ; i<=5; i++){
        productDetailImageFrm = new FormData();
        if($("#FILE_DETAIL_IMG"+i).val()==""){
        }else{
          console.log('DETAIL'+i+' : 변경');
          productDetailImageFrm.append(("PRD_IMG"),$("#FILE_DETAIL_IMG"+i)[0].files[0]);
          if($("#FILE_DETAIL_IMG"+i)[0].files[0]!=null){
            doAjaxForm('addProductImage?TYPE=DETAIL'+i+'&PRD_ID='+PRD_ID, productDetailImageFrm);
          }
        }
        if($("#FILE_DETAIL_IMG"+i).prev().prev().val() == "true"){
          doAjaxForm('deleteProductImage?TYPE=DETAIL'+i+'&PRD_ID='+PRD_ID, productDetailImageFrm);
        }
      }
      location.href="";
  }
});

//--> [상품수정] 이미지 삭제 버튼 클릭 이벤트
$('.modifyProduct .imgDeleteBtn').click(function(e){
  $(this).prev().prev().attr('src','/resource/img/icon/ic_noImg.png');
  $(this).prev().prev().prev().val(true);
});

//--> [상품조회] 추가 버튼 클릭이벤트
$('.productList .addBtn').click(function(e){
  location.href="/admin/addProduct";
});

//--> [상품조회] 그리드에서 상품명 클릭 이벤트
$('.productList .PRD_NAME_TD').click(function(e){
  var PRD_ID = $(this).prev().prev().text();
  location.href="/admin/modifyProduct/"+PRD_ID;
});

//--> [상품조회] 삭제 버튼 클릭이벤트
$('.productList .deleteBtn').click(function(e){
  var idxkey = new Array();
  $('.productList .divGrid .body .checkBox.checked').each(function(e){
    idxkey.push($(this).attr('idxkey'));
  });

  if(idxkey.length < 1){
    alert('상품을 선택해주세요.');
    return false;
  }

  if(!confirm('정말 삭제하시겠습니까?')){
    return false;
  }

  $('.productList .divGrid .body .checkBox.checked').each(function(e){
    var dataSet = {idxkey:$(this).attr('idxkey')};
    doAjaxSync('ajaxDeleteProduct',dataSet);
  });
  location.href="";
});




/////////////////////////////////////////////////////////////////////////////////////////////
//                                  버튼 클릭 로직 리스트                                   //
/////////////////////////////////////////////////////////////////////////////////////////////

//--> [상품추가] 사진 업로드 변경 로직
var loadMain = function(event,number){
  var output = document.getElementById('MAIN_IMG'+number);
  output.src = URL.createObjectURL(event.target.files[0]);
};
var loadDetail = function(event,number){
  var output = document.getElementById('DETAIL_IMG'+number);
  output.src = URL.createObjectURL(event.target.files[0]);
};

//--> [상품추가] 옵션셋선택 시 옵션보이기
function viewOptions(option){
  var prevOptionName;
  $('.divOption').remove();
  for(var i=0; i<option.length; i++){
    if(option[i]['OPTION_NAME'] != prevOptionName){
      prevOptionName = option[i]['OPTION_NAME'];
      $('.divGridTab .OPTIONS').append('<div class="divOption"><input type="hidden" name="OPTION[]" value="'+option[i]['OPTION_ID']+'">'+option[i]['OPTION_NAME']+'<img optionValue="'+option[i]['OPTION_VALUE']+'" src="/resource/img/icon/ic_search_white.png"><div>');
    }
  }
  addViewOptionValueEvent();
}

//--> [상품추가] 옵션 마우스 오버 시 옵션값 보이기 이벤트 등록
function addViewOptionValueEvent(){
  $('.divGridTab .OPTIONS .divOption img').off();
  $('.divGridTab .OPTIONS .divOption img').mouseenter(function(e){
    var offsetT = $(this).offset().top;
    var offsetL = $(this).offset().left;
    console.log(offsetT, offsetL);
    $('.divGridTab td.OPTIONS .divOptionValue').css('top',offsetT-380).css('left',offsetL+30);
    $('.divGridTab td.OPTIONS .divOptionValue').text($(this).attr('optionValue'));
    $('.divGridTab td.OPTIONS .divOptionValue').fadeIn('fast');
  });
  $('.divGridTab .OPTIONS .divOption img').mouseleave(function(e){
    $('.divGridTab td.OPTIONS .divOptionValue').fadeOut('fast');
  });
}
