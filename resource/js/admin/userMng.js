//                                     온로드 이벤트                                        //
/////////////////////////////////////////////////////////////////////////////////////////////
$(document).ready(function() {

});

/////////////////////////////////////////////////////////////////////////////////////////////
//                                  버튼 클릭 이벤트 리스트                                  //
/////////////////////////////////////////////////////////////////////////////////////////////

//--> [회원조회] 추가버튼 클릭이벤트
$('.inquiryUser .divButton .addBtn').click(function(e){
  popup('add');
});

//--> [회원조회] 조회버튼 클릭이벤트
$('.inquiryUser .divButton .searchBtn').click(function(e){
  search('inquiryUser');
});

//--> [회원조회] 엔터키 입력 이벤트
$('.inquiryUser .divSearch .USER_INFO').keydown(function(key){
  if(key.keyCode == 13){
    search('inquiryUser');
  }
});

//--> [회원등급관리] 조회버튼 클릭이벤트
$('.modifyUserLevel .divButton .searchBtn').click(function(e){
  search('modifyUserLevel');
});

//--> [회원등급관리] 엔터키 입력 이벤트
$('.modifyUserLevel .divSearch .USER_INFO').keydown(function(key){
  if(key.keyCode == 13){
    search('modifyUserLevel');
  }
});

//--> [회원등급관리] 수정버튼 클릭이벤트
$('.modifyUserLevel .divButton .modifyBtn').click(function(e){
  var USER_LEVEL = $('.modifyUserLevel .divButton .SELECT_USER_LEVEL').val();
  userLevelModify(USER_LEVEL);
});

//--> [회원조회] 팝업 저장버튼 클릭이벤트
$('.divInquiryUserPopup .saveBtn').click(function(e){
  var ID = $('.divInquiryUserPopup .ID').val();
  var PASSWORD = $('.divInquiryUserPopup .PASSWORD').val();
  var NAME = $('.divInquiryUserPopup .NAME').val();
  var POSTCODE = $('.divInquiryUserPopup #postcode').val();
  var ADDR = $('.divInquiryUserPopup #address').val();
  var ADDR_DETAIL = $('.divInquiryUserPopup #detail_addr').val();
  var TEL1 = $('.divInquiryUserPopup .TEL1').val();
  var TEL2 = $('.divInquiryUserPopup .TEL2').val();
  var TEL3 = $('.divInquiryUserPopup .TEL3').val();
  var LEVEL = $('.divInquiryUserPopup .LEVEL').val();
  if(ID==""){
    alert('아이디를 입력해주세요.');
    return false;
  }else if(PASSWORD==""){
    alert('비밀번호를 입력해주세요.');
    return false;
  }else if(NAME==""){
    alert('이름을 입력해주세요.');
    return false;
  }else if(POSTCODE==""){
    alert('우편번호를 입력해주세요.');
    return false;
  }else if(ADDR==""){
    alert('주소를 입력해주세요.');
    return false;
  }else if(ADDR_DETAIL==""){
    alert('상세주소를 입력해주세요.');
    return false;
  }else if(TEL2==""||TEL3==""){
    alert('전화번호를 입력해주세요.');
    return false;
  }else if(LEVEL=="0000"){
    alert('등급을 선택해주세요.');
    return false;
  }else{
    $('.divPopupFrm').submit();
  }
});


/////////////////////////////////////////////////////////////////////////////////////////////
//                                  버튼 클릭 로직 리스트                                   //
/////////////////////////////////////////////////////////////////////////////////////////////

//--> 팝업 로직
function popup(mode, IDXKEY){
  if(mode=='add'){
    $('.divInquiryUserPopup').fadeIn('fast');
    $('.divInquiryUserPopupBG').fadeIn('fast');
  }
}

//--> 조회 로직
function search(screenID, PAGE){
  var USER_INFO_DV = '0000';
  var USER_INFO = '';
  var USER_LEVEL = '';
  var USER_SEX = '';
  var FRDT = '';
  var TODT = '';
  if(PAGE == null){
    PAGE = $('.divPagination .currentPage').val();
  }
  var PARAM = '?';
  if(screenID == 'inquiryUser'){
    USER_INFO_DV = $('.inquiryUser .divSearch .USER_INFO_DV').val();
    USER_INFO    = $('.inquiryUser .divSearch .USER_INFO').val();
    USER_LEVEL   = $('.inquiryUser .divSearch .USER_LEVEL').val();
    USER_SEX     = $('.inquiryUser .divSearch .USER_SEX').val();
    FRDT         = $('.inquiryUser .divSearch .INPUT_FRDT').val();
    TODT         = $('.inquiryUser .divSearch .INPUT_TODT').val();
  }else if(screenID == 'modifyUserLevel'){
    USER_INFO_DV = $('.modifyUserLevel .divSearch .USER_INFO_DV').val();
    USER_INFO    = $('.modifyUserLevel .divSearch .USER_INFO').val();
    USER_LEVEL   = $('.modifyUserLevel .divSearch .USER_LEVEL').val();
    USER_SEX     = $('.modifyUserLevel .divSearch .USER_SEX').val();
    FRDT         = $('.modifyUserLevel .divSearch .INPUT_FRDT').val();
    TODT         = $('.modifyUserLevel .divSearch .INPUT_TODT').val();
  }

  if(USER_INFO_DV != '0000' && USER_INFO != ''){
    PARAM = PARAM + 'USER_INFO_DV=' + USER_INFO_DV + '&';
    PARAM = PARAM + 'USER_INFO=' + USER_INFO + '&';
  }
  if(USER_LEVEL != '0000'){
    PARAM = PARAM + 'LEVEL=' + USER_LEVEL + '&';
  }
  if(USER_SEX != '0000'){
    PARAM = PARAM + 'SEX=' + USER_SEX + '&';
  }
  if(FRDT != ''){
    PARAM = PARAM + 'FRDT=' + FRDT.replace(/[^0-9]/g,'') + '&';
  }
  if(TODT != ''){
    PARAM = PARAM + 'TODT=' + TODT.replace(/[^0-9]/g,'') + '&';
  }

  PARAM = PARAM + 'PAGE=' + PAGE + '&';
  location.href = location.pathname + PARAM;
}

function userLevelModify(USER_LEVEL){
  var checkdRowCnt = 0;
  var ID = new Array();
  $('.modifyUserLevel .divGrid .checkBox.checked').each(function(e){
    ID.push($(this).attr('id'));
    checkdRowCnt++;
  });

  if(USER_LEVEL ==  '0000'){
    alert('변경할 등급을 선택해주세요.');
    return false;
  }

  if(checkdRowCnt < 1){
    alert('선택된 건이 없습니다.');
    return false;
  }

  $.ajax({
        type:"POST",
        url:"/admin/ajaxModifyUserLevel",
        data : {ID:ID, USER_LEVEL:USER_LEVEL},
        dataType : "json",
        success: function(res){
          search(window.location.pathname.substring(7));
        },
        error: function(xhr, status, error) {
          console.log(error);
        }
  });
}
