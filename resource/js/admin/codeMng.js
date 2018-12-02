/////////////////////////////////////////////////////////////////////////////////////////////
//                                     온로드 이벤트                                        //
/////////////////////////////////////////////////////////////////////////////////////////////
$(document).ready(function() {

});

/////////////////////////////////////////////////////////////////////////////////////////////
//                                  버튼 클릭 이벤트 리스트                                  //
/////////////////////////////////////////////////////////////////////////////////////////////

//--> [공통코드관리] 추가버튼 클릭이벤트
$('.commonCodeMng .divButton .addBtn').click(function(e){
  popup('add');
});

//--> [공통코드관리] 수정버튼 클릭이벤트
$('.commonCodeMng .divGrid .body').dblclick(function(e){
  var IDXKEY = $(this).children('.checkBox').attr('idxkey');
  popup('modify',IDXKEY);
});
//--> [공통코드관리] 수정버튼 클릭이벤트
$('.commonCodeMng .divButton .modifyBtn').click(function(e){
  var checkdRowCnt = 0;
  var idxkey = new Array();
  $('.commonCodeMng .divGrid .checkBox.checked').each(function(e){
    idxkey.push($(this).attr('idxkey'));
    checkdRowCnt++;
  });
  if(checkdRowCnt == 0){
    alert('수정할 행을 선택해주세요.');
    return false;
  }else if(checkdRowCnt>1){
    alert('수정은 1개의 행만 선택해야 합니다.');
    return false;
  }else{
    popup('modify');
  }
});

//--> [공통코드관리] 수정버튼 클릭이벤트
$('.commonCodeMng .divButton .deleteBtn').click(function(e){
  var checkdRowCnt = 0;
  var idxkey = new Array();
  $('.commonCodeMng .divGrid .checkBox.checked').each(function(e){
    idxkey.push($(this).attr('idxkey'));
    checkdRowCnt++;
  });
  if(checkdRowCnt == 0){
    alert('삭제할 행을 선택해주세요.');
    return false;
  }else{
    if(!confirm('정말 삭제하시겠습니까?')){
      return false;
    }
    $.ajax({
          type:"POST",
          url:"/admin/ajaxDeleteCommonCode",
          data : {IDXKEY:idxkey},
          dataType : "json",
          success: function(res){
            search(window.location.pathname.substring(7));
          },
          error: function(xhr, status, error) {
            console.log(error);
          }
    });
  }
});

//--> [공통코드관리] 조회버튼 클릭이벤트
$('.commonCodeMng .divButton .searchBtn').click(function(e){
  search('commonCodeMng');
});

//--> [공통코드관리] 엔터키 입력 이벤트
$('.commonCodeMng .divSearch .TEXT_CODE_NM').keydown(function(key){
  if(key.keyCode == 13){
    search('commonCodeMng');
  }
});

//--> [공통코드관리] 엔터키 입력 이벤트
$('.commonCodeMng .divSearch .TEXT_CODE').keydown(function(key){
  if(key.keyCode == 13){
    search('commonCodeMng');
  }
});



//--> [공통코드관리] 팝업 저장버튼 클릭이벤트
$('.divCommonCodePopup .saveBtn').click(function(e){
  var WORK_DV = $('.divCommonCodePopup .WORK_DV').val();
  var CODE_DV = $('.divCommonCodePopup .CODE_DV').val();
  var CODE_NM = $('.divCommonCodePopup .CODE_NM').val();
  var CODE = $('.divCommonCodePopup .CODE').val();

  if(WORK_DV==""){
    alert("업무구분을 입력해주세요.");
    return false;
  }else if(CODE_DV==""){
    alert("코드구분을 입력해주세요.");
    return false;
  }else if(CODE_NM==""){
    alert("코드명을 입력해주세요.");
    return false;
  }else if(CODE==""){
    alert("코드를 입력해주세요.");
    return false;
  }else{
    $('.divPopupFrm').submit();
  }

});

//--> [공통코드관리] 업무구분 곰보박스 값 변경 이벤트
$('.commonCodeMng .SELECT_WORK_DV').change(function(e){
  $.ajax({
        type:"POST",
        url:"/admin/ajaxGetCodeDVByWorkDV",
        data : {WORK_DV:$(this).val()},
        dataType : "json",
        success: function(res){
          var data = res['data'];
          data.forEach(function(item, index, array){
            $('.commonCodeMng .SELECT_CODE_DV').append(`
              <option value="`+item.CODE_DV+`">`+item.CODE_DV+`</option>
            `);
          });
        },
        error: function(xhr, status, error) {
          console.log(error);
        }
    });
});


/////////////////////////////////////////////////////////////////////////////////////////////
//                                  버튼 클릭 로직 리스트                                   //
/////////////////////////////////////////////////////////////////////////////////////////////

//--> 팝업 로직
function popup(mode, IDXKEY){
  var WORK_DV = $('.commonCodeMng .SELECT_WORK_DV').val();
  var CODE_DV = $('.commonCodeMng .SELECT_CODE_DV').val();
  if(mode=='add'){
    if(WORK_DV == '0000'){
      WORK_DV = "";
    }
    if(CODE_DV == '0000'){
      CODE_DV = "";
    }
    $('.divCommonCodePopup .divPopupTitle p').text('코드추가');

    $('.divCommonCodePopup .WORK_DV').val('');
    $('.divCommonCodePopup .CODE_DV').val('');
    $('.divCommonCodePopup .CODE_NM').val('');
    $('.divCommonCodePopup .CODE').val('');
    $('.divCommonCodePopup .IS_USE').val('Y');
    $('.divCommonCodePopup .WORK_DV').val(WORK_DV);
    $('.divCommonCodePopup .CODE_DV').val(CODE_DV);
  }else if(mode=='modify'){
    $('.divCommonCodePopup .divPopupTitle p').text('코드수정');
    if(IDXKEY == null){
      $('.commonCodeMng .divGrid .checkBox.checked').each(function(e){
        IDXKEY = $(this).attr('idxkey');
      });
    }

    $.ajax({
          type:"POST",
          url:"/admin/ajaxGetCommonCodeByIDXKEY",
          data : {IDXKEY:IDXKEY},
          dataType : "json",
          success: function(res){
            var data = res['data'];
            $('.divCommonCodePopup .WORK_DV').val(data.WORK_DV);
            $('.divCommonCodePopup .CODE_DV').val(data.CODE_DV);
            $('.divCommonCodePopup .CODE_NM').val(data.CODE_NM);
            $('.divCommonCodePopup .CODE').val(data.CODE);
            $('.divCommonCodePopup .IS_USE').val(data.IS_USE);
          },
          error: function(xhr, status, error) {
            console.log(error);
          }
    });
  }
  $('.divCommonCodePopup').fadeIn('fast');
  $('.divCommonCodePopupBG').fadeIn('fast');
}

//--> 조회 로직
function search(screenID, PAGE){
  var WORK_DV = '0000';
  var CODE_DV = '0000';
  var CODE_NM = '';
  var CODE = '';
  if(PAGE == null){
    PAGE = $('.divPagination .currentPage').val();
  }
  var PARAM = '?';
  if(screenID == 'commonCodeMng'){
    WORK_DV = $('.commonCodeMng .divSearch .SELECT_WORK_DV').val();
    CODE_DV = $('.commonCodeMng .divSearch .SELECT_CODE_DV').val();
    CODE_NM = $('.commonCodeMng .divSearch .TEXT_CODE_NM').val();
    CODE    = $('.commonCodeMng .divSearch .TEXT_CODE').val();
  }

  if(WORK_DV != '0000'){
    PARAM = PARAM + 'WORK_DV=' + WORK_DV + '&';
  }
  if(CODE_DV != '0000'){
    PARAM = PARAM + 'CODE_DV=' + CODE_DV + '&';
  }
  if(CODE_NM != ''){
    PARAM = PARAM + 'CODE_NM=' + CODE_NM + '&';
  }
  if(CODE != ''){
    PARAM = PARAM + 'CODE=' + CODE + '&';
  }
  PARAM = PARAM + 'PAGE=' + PAGE + '&';
  location.href = location.pathname + PARAM;
}
