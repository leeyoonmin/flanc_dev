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
