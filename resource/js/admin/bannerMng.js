/////////////////////////////////////////////////////////////////////////////////////////////
//                                     온로드 이벤트                                        //
/////////////////////////////////////////////////////////////////////////////////////////////
$(document).ready(function() {

});

/////////////////////////////////////////////////////////////////////////////////////////////
//                                  버튼 클릭 이벤트 리스트                                  //
/////////////////////////////////////////////////////////////////////////////////////////////

//--> [배너관리] 배너추가 버튼 클릭이벤트
$('.bannerMng .divButton .addBtn').click(function(e){
  location.href="/admin/addBanner/";
});

//--> [배너추가] 배너등록하기 버튼 클릭이벤트
$('.addBanner .divSubmit .addBannerBtn').click(function(e){
  if($('.addBanner .BANNER_TYPE').val()=="0000"){
    alert('배너타입을 선택해주세요.');
    return false;
  }else if($('.addBanner #BANNER_IMG').attr('src')==""){
    alert('이미지를 등록해주세요');
    return false;
  }
  else{
    var formData = new FormData();
    formData.append("BANNER_TYPE",$('.addBanner .BANNER_TYPE').val());
    formData.append("LINK_URL",$('.addBanner #LINK_URL').val());
    formData.append("PRD_IMG",$(".FILE_BANNER_IMG")[0].files[0]);
    formData.append("MODE",'ADD');
    doAjaxForm('addBannerInfo', formData);
    location.href="";
  }
});

//--> [배너관리] 배너삭제 버튼 클릭이벤트
$('.bannerMng .divButton .deleteBtn').click(function(e){
  var dataSet = new Array();
  var rowCnt = 0;
  $('.divGrid .body .checkBox.checked').each(function(e){
    dataSet[rowCnt] = {'BANNER_ID':$(this).attr('idxkey'), 'FILE_NAME':$(this).attr('fileName')};
    rowCnt++;
  });

  if(dataSet.length < 1){
    alert('선택된 배너가 없습니다.');
    return false;
  }

  if(!confirm('정말 삭제하시겠습니까?')){
    return false;
  }

  for(var cnt=0; cnt<dataSet.length; cnt++){
    doAjaxSync('ajaxDeleteBanner',dataSet[cnt]);
  }

  location.href = "";
});

//--> [배너관리] 그리드 이미지 클릭이벤트 [배너수정]
$('.bannerMng .divGrid img').click(function(e){
  var BANNER_ID = $(this).parents('td').parents('tr').children('.checkBox').attr('idxkey');
  location.href="/admin/modifyBanner/"+BANNER_ID;
});

//--> [배너수정] 배너수정하기 버튼 클릭이벤트
$('.modifyBanner .divSubmit .addBannerBtn').click(function(e){
  if($('.addBanner .BANNER_TYPE').val()=="0000"){
    alert('배너타입을 선택해주세요.');
    return false;
  }else if($('.addBanner #BANNER_IMG').attr('src')==""){
    alert('이미지를 등록해주세요');
    return false;
  }
  else{
    var formData = new FormData();
    formData.append("BANNER_ID",$('.modifyBanner .BANNER_ID').val());
    formData.append("BANNER_ORDER",$('.modifyBanner .BANNER_ORDER').val());
    formData.append("BANNER_TYPE",$('.modifyBanner .BANNER_TYPE').val());
    formData.append("IMG_NAME",$('.modifyBanner .IMG_NAME').val());
    formData.append("IMG_EXTENSION",$('.modifyBanner .IMG_EXTENSION').val());
    formData.append("IMG_SIZE",$('.modifyBanner .IMG_SIZE').val());
    formData.append("LINK_URL",$('.modifyBanner #LINK_URL').val());
    formData.append("PRD_IMG",$(".FILE_BANNER_IMG")[0].files[0]);
    formData.append("MODE",'MODIFY');
    doAjaxForm('ajaxModifyBannewr', formData);
    location.href="/admin/bannerMng";
  }
});

/////////////////////////////////////////////////////////////////////////////////////////////
//                                  버튼 클릭 로직 리스트                                   //
/////////////////////////////////////////////////////////////////////////////////////////////

//--> [배너관리] 사진 업로드 변경 로직
var loadImg = function(event){
  var output = document.getElementById('BANNER_IMG');
  if(event.target.value == ""){
    output.src = '';
  }else{
    output.src = URL.createObjectURL(event.target.files[0]);
  }
};
