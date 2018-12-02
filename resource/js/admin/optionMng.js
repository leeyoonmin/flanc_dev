/////////////////////////////////////////////////////////////////////////////////////////////
//                                     온로드 이벤트                                        //
/////////////////////////////////////////////////////////////////////////////////////////////
$(document).ready(function() {

});


/////////////////////////////////////////////////////////////////////////////////////////////
//                                  버튼 클릭 이벤트 리스트                                  //
/////////////////////////////////////////////////////////////////////////////////////////////

//--> [옵션관리] 추가버튼 클릭이벤트
$('.optionMng .divButton .addBtn').click(function(e){
  $('.optionGroup .option').remove();
  addOptionGroup();
  popup('optionMng','add');
});

//--> [옵션관리] 조회버튼 클릭이벤트
$('.optionMng .divButton .searchBtn').click(function(e){
  search('optionMng');
});

//--> [옵션관리] 엔터키 입력 이벤트
$('.optionMng .divSearch .OPTION_INFO').keydown(function(key){
  if(key.keyCode == 13){
    search('optionMng');
  }
});

//--> [옵션관리] 수정버튼 클릭이벤트
$('.optionMng .divButton .modifyBtn').click(function(e){
  var checkdRowCnt = 0;
  var idxkey = new Array();
  $('.optionMng .divGrid .checkBox.checked').each(function(e){
    idxkey.push($(this).attr('idxkey'));
    checkdRowCnt++;
  });
  if(checkdRowCnt == 0){
    alert('수정할 행을 선택해주세요.');
    return false;
  }else if(checkdRowCnt > 1){
    alert('수정은 1개 행만 선택해야 합니다.');
    return false;
  }else{
    popup('optionMng','modify', idxkey[0]);
  }
});

//--> [옵션관리] 삭제버튼 클릭이벤트
$('.optionMng .divButton .deleteBtn').click(function(e){
  var checkdRowCnt = 0;
  var idxkey = new Array();
  $('.optionMng .divGrid .checkBox.checked').each(function(e){
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
    ajaxDeleteOption(idxkey);
  }
});

//--> [옵션셋관리] 추가버튼 클릭이벤트
$('.optionSetMng .divButton .addBtn').click(function(e){
  $('.optionGroup .option').remove();
  addOptionGroup();
  popup('optionSetMng','add');
});

//--> [옵션셋관리] 조회버튼 클릭이벤트
$('.optionSetMng .divButton .searchBtn').click(function(e){
  search('optionSetMng');
});

//--> [옵션셋관리] 엔터키 입력 이벤트
$('.optionSetMng .divSearch .OPTION_INFO').keydown(function(key){
  if(key.keyCode == 13){
    search('optionSetMng');
  }
});

//--> [옵션셋관리] 수정버튼 클릭이벤트
$('.optionSetMng .divButton .modifyBtn').click(function(e){
  var checkdRowCnt = 0;
  var idxkey = new Array();
  $('.optionSetMng .divGrid .checkBox.checked').each(function(e){
    idxkey.push($(this).attr('idxkey'));
    checkdRowCnt++;
  });
  if(checkdRowCnt == 0){
    alert('수정할 행을 선택해주세요.');
    return false;
  }else if(checkdRowCnt > 1){
    alert('수정은 1개 행만 선택해야 합니다.');
    return false;
  }else{
    popup('optionSetMng','modify', idxkey[0]);
  }
});

//--> [옵션셋관리] 삭제버튼 클릭이벤트
$('.optionSetMng .divButton .deleteBtn').click(function(e){
  var checkdRowCnt = 0;
  var idxkey = new Array();
  $('.optionSetMng .divGrid .checkBox.checked').each(function(e){
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
    console.log(idxkey);
    ajaxDeleteOptionSet(idxkey);
  }
});

//--> [옵션셋관리] 옵션셋팝업 검색 버튼 클릭이벤트
$('.divOptionSetMngPopup .optionList .searchBtn').click(function(e){
  var SEARCH_DV = $('.divOptionSetMngPopup .optionList .searchDV').val();
  var SEARCH_KEYWORD = $('.divOptionSetMngPopup .optionList .searchKeyword').val();
  $('.divOptionSetMngPopup .divOptionList .allOption .divOption').css('display','none');
  $('.divOptionSetMngPopup .divOptionList .allOption .divOption').each(function(e){
    var CompStr = $(this).attr(SEARCH_DV);
    console.log(CompStr, SEARCH_KEYWORD, CompStr.match(SEARCH_KEYWORD));
    if(CompStr.match(SEARCH_KEYWORD)){
      $(this).css('display','block');
    }
  });
});

//--> [옵션셋관리] 옵션셋팝업 전체보기 버튼 클릭이벤트
$('.divOptionSetMngPopup .optionList .allBtn').click(function(e){
  $('.divOptionSetMngPopup .divOptionList .allOption .divOption').css('display','none');
  $('.divOptionSetMngPopup .divOptionList .allOption .divOption').each(function(e){
    $(this).css('display','block');
  });
});


//--> [옵션셋관리] 옵션셋팝업 옵선선택버튼 클릭이벤트
$('.divOptionSetMngPopup .divOptionList .divOption').click(function(e){
  if($(this).hasClass('selected')){
    $(this).removeClass('selected');
  }else{
    $(this).addClass('selected');
  }
});

//--> [옵션셋관리] 옵션셋팝업 옵션상세보기 버튼 마우스오버
$('.divOptionSetMngPopup .divOptionList .divOption img').mouseenter(function(e){
  var OPTION_VALUE = $(this).parents('.divOption').attr('OPTION_VALUE');
  $('.divToolTip').text(OPTION_VALUE);
  $('.divToolTip').css('top', $(this).offset().top);
  $('.divToolTip').css('left', $(this).offset().left+30);
  $('.divToolTip').css('display', 'block');
});

//--> [옵션셋관리] 옵션셋팝업 옵션상세보기 버튼 마우스아웃
$('.divOptionSetMngPopup .divOptionList .divOption img').mouseleave(function(e){
  $('.divToolTip').css('display','none');
});

//--> [옵션셋관리] 옵션셋팝업 추가>> 버튼 클릭이벤트
$('.divOptionSetMngPopup .divOptionList .addBtn').click(function(e){
  $('.divOptionSetMngPopup .divOptionList .allOption .divOption.selected').each(function(e){
    var prevID = $(this).attr('OPTION_ID');
    var prevName = $(this).attr('OPTION_NAME');
    var prevValue = $(this).attr('OPTION_VALUE');
    var IS_OPTION = false;
    $('.divOptionSetMngPopup .divOptionList .addOption .divOption').each(function(e){
      if(prevID == $(this).attr('OPTION_ID')){
        IS_OPTION = true;
      }
    });
    if(IS_OPTION == false){
      $('.divOptionSetMngPopup .divOptionList .addOption').append(`
        <div class="divOption" OPTION_ID="`+prevID+`" OPTION_NAME="`+prevName+`" OPTION_VALUE="`+prevValue+`">[`+prevID+`]`+prevName+`<img src=\"/resource/img/icon/ic_search_white.png\"></div>
        `);
      }
  });
  addOptionDetailEvent();
  $('.divOptionSetMngPopup .divOptionList .addOption .divOption').off();
  $('.divOptionSetMngPopup .divOptionList .addOption .divOption').click(function(e){
    if($(this).hasClass('selected')){
      $(this).removeClass('selected');
    }else{
      $(this).addClass('selected');
    }
  });
});

//--> [옵션셋관리] 옵션셋팝업 삭제<< 버튼 클릭이벤트
$('.divOptionSetMngPopup .divOptionList .removeBtn').click(function(e){
  $('.divOptionSetMngPopup .divOptionList .addOption .divOption.selected').each(function(e){
    $(this).remove();
  });
});



/////////////////////////////////////////////////////////////////////////////////////////////
//                                  버튼 클릭 로직 리스트                                   //
/////////////////////////////////////////////////////////////////////////////////////////////

//--> 조회 로직
function search(screenID, PAGE){
  var OPTION_INFO_DV = '0000';
  var OPTION_INFO = '';
  if(PAGE == null){
    PAGE = $('.divPagination .currentPage').val();
  }
  var PARAM = '?';
  if(screenID == 'optionMng'){
    OPTION_INFO_DV = $('.optionMng .divSearch .OPTION_INFO_DV').val();
    OPTION_INFO    = $('.optionMng .divSearch .OPTION_INFO').val();
  }else if(screenID == 'optionSetMng'){
    OPTION_INFO_DV = $('.optionSetMng .divSearch .OPTION_INFO_DV').val();
    OPTION_INFO    = $('.optionSetMng .divSearch .OPTION_INFO').val();
  }

  if(OPTION_INFO_DV != '0000' && OPTION_INFO != ''){
    PARAM = PARAM + 'OPTION_INFO_DV=' + OPTION_INFO_DV + '&';
    PARAM = PARAM + 'OPTION_INFO=' + OPTION_INFO + '&';
  }

  PARAM = PARAM + 'PAGE=' + PAGE + '&';
  location.href = location.pathname + PARAM;
}

//--> 팝업 로직
function popup(screenID, mode, IDXKEY){
  if(mode=='add' && screenID =='optionMng'){
    $('.divOptionMngPopup .divPopupTitle p').text('옵션 추가');
    $('.divOptionMngPopup .OPTION_NAME').val('');
    $('.divOptionMngPopup .OPTION_DESC').val('');
    $('.divOptionMngPopup .saveBtn').attr('onclick','saveOption("add","");');
    $('.divOptionMngPopup').fadeIn('fast');
    $('.divOptionMngPopupBG').fadeIn('fast');
  }else if(mode=='modify' && screenID =='optionMng'){
    $('.divOptionMngPopup .divPopupTitle p').text('옵션 수정');
    $('.divOptionMngPopup .saveBtn').attr('onclick','saveOption("modify","'+IDXKEY+'");');
    $.ajax({
          type:"POST",
          url:"/admin/ajaxGetOptionByID",
          data : {IDXKEY:IDXKEY},
          dataType : "json",
          success: function(res){
            $('.divOptionMngPopup .OPTION_NAME').val(res[0]['OPTION_NAME']);
            $('.divOptionMngPopup .OPTION_DESC').val(res[0]['OPTION_DESC']);
            $('.optionGroup .option').remove();
            res.forEach(function(value, index, array){
              addOptionGroupIsValue(value.OPTION_VALUE, value.OPTION_PRICE);
            });
          },
          error: function(xhr, status, error) {
            console.log(error);
          }
    });
    $('.divOptionMngPopup').fadeIn('fast');
    $('.divOptionMngPopupBG').fadeIn('fast');
  }else if(mode=='add' && screenID =='optionSetMng'){
    $('.divOptionSetMngPopup .divPopupTitle p').text('옵션셋 추가');
    $('.divOptionSetMngPopup .OPTION_SET_NAME').val('');
    $('.divOptionSetMngPopup .OPTION_SET_DESC').val('');
    $('.divOptionSetMngPopup .addOption .divOption').remove();
    $('.divOptionSetMngPopup .saveBtn').attr('onclick','saveOptionSet("add","");');
    $('.divOptionSetMngPopup').fadeIn('fast');
    $('.divOptionSetMngPopupBG').fadeIn('fast');
  }else if(mode=='modify' && screenID =='optionSetMng'){
    $('.divOptionSetMngPopup .divPopupTitle p').text('옵션셋 수정');
    $('.divOptionSetMngPopup .saveBtn').attr('onclick','saveOptionSet("modify","'+IDXKEY+'");');
    $.ajax({
          type:"POST",
          url:"/admin/ajaxGetOptionSetByID",
          data : {IDXKEY:IDXKEY},
          dataType : "json",
          success: function(res){
            $('.divOptionSetMngPopup .OPTION_SET_NAME').val(res[0]['OPTION_SET_NAME']);
            $('.divOptionSetMngPopup .OPTION_SET_DESC').val(res[0]['OPTION_SET_DESC']);
            $('.divOptionSetMngPopup .addOption .divOption').remove();
            res.forEach(function(value, index, array){
              addOptionInOptionSet(value.OPTION_ID, value.OPTION_NAME, value.OPTION_VALUE);
              addOptionSetEvent();
            });
          },
          error: function(xhr, status, error) {
            console.log(error);
          }
    });
    $('.divOptionSetMngPopup').fadeIn('fast');
    $('.divOptionSetMngPopupBG').fadeIn('fast');
  }
}

//--> [옵션관리] 추가팝업 옵션값 추가 로직
function addOptionGroup(){

  $('.optionGroup').append(`
    <tr class="option">
      <td>옵션값</td><td>
        <input class="OPTION_VALUE" type="text" value="">
      </td>
      <td>추가금액</td><td>
        <input class="OPTION_PRICE" type="text" value="" placeholder="추가금액 없을 시 공란">
      </td>
      <td class="deleteTD">
        <img class="deleteBtn" src="/resource/img/icon/ic_trash.png" onclick="deleteOptionGroup($(this));">
      </td>
    </tr>
  `);

}

//--> [옵션관리] 추가팝업 옵션값 추가 로직
function addOptionGroupIsValue(optionValue, optionPrice){

  $('.optionGroup').append(`
    <tr class="option">
      <td>옵션값</td><td>
        <input class="OPTION_VALUE" type="text" value="`+optionValue+`">
      </td>
      <td>추가금액</td><td>
        <input class="OPTION_PRICE" type="text" value="`+optionPrice+`" placeholder="추가금액 없을 시 공란">
      </td>
      <td class="deleteTD">
        <img class="deleteBtn" src="/resource/img/icon/ic_trash.png" onclick="deleteOptionGroup($(this));">
      </td>
    </tr>
  `);

}

//--> [옵션셋관리] 옵션셋팝업의 AddList에 옵션 넣는 로직
function addOptionInOptionSet(OPTION_ID, OPTION_NAME, OPTION_VALUE){
  $('.divOptionSetMngPopup .divOptionList .addOption').append(`
    <div class="divOption" OPTION_ID="`+OPTION_ID+`" OPTION_NAME="`+OPTION_NAME+`" OPTION_VALUE="`+OPTION_VALUE+`">[`+OPTION_ID+`]`+OPTION_NAME+`<img src=\"/resource/img/icon/ic_search_white.png\"></div>
  `);
}

//--> [옵션관리] 추가팝업 옵션값 삭제 로직
function deleteOptionGroup(item){
  item.parents('.deleteTD').parents('.option').remove();
}

//--> [옵션관리] 옵션저장 로직
function saveOption(mode,id){
  var is_err = false;
  var OPTION_ID = "";
  var OPTION_NAME = $('.divOptionMngPopup .OPTION_NAME').val();
  var OPTION_DESC = $('.divOptionMngPopup .OPTION_DESC').val();
  var OPTION_VALUE, OPTION_PRICE = '';
  var OPTION_ARR = new Array();
  $('.divOptionMngPopup .optionGroup .option').each(function(e){
    OPTION_VALUE = $(this).children('td').children('.OPTION_VALUE').val();
    OPTION_PRICE = $(this).children('td').children('.OPTION_PRICE').val();
    OPTION_ARR.push({OPTION_VALUE,OPTION_PRICE});
  });
  if(OPTION_NAME==""){
    alert('옵션명을 입력해주세요.');
    return false;
  }
  OPTION_ARR.forEach(function(value, index, array){
    if(value.OPTION_VALUE == ""){
      is_err = true;
      return false;
    }
  });
  if(is_err){
    alert('옵션값을 입력해주세요.');
    return false;
  }
  if(mode == 'add'){
    $.ajax({
          type:"POST",
          url:"/admin/ajaxAddOption",
          data : {OPTION_NAME:OPTION_NAME, OPTION_ARR:OPTION_ARR, OPTION_DESC:OPTION_DESC},
          dataType : "json",
          success: function(res){
            search(window.location.pathname.substring(7));
          },
          error: function(xhr, status, error) {
            console.log(error);
          }
    });
  }else if(mode == 'modify'){
    $.ajax({
          type:"POST",
          url:"/admin/ajaxModifyOption",
          data : {OPTION_ID:id, OPTION_NAME:OPTION_NAME, OPTION_ARR:OPTION_ARR, OPTION_DESC:OPTION_DESC},
          dataType : "json",
          success: function(res){
            search(window.location.pathname.substring(7));
          },
          error: function(xhr, status, error) {
            console.log(error);
          }
    });
  }

}

//--> [옵션관리] 옵션삭제 로직 (Ajax)
function ajaxDeleteOption(idxkey){
  $.ajax({
        type:"POST",
        url:"/admin/ajaxDeleteOption",
        data : {OPTION_ID_ARR:idxkey},
        dataType : "json",
        success: function(res){
          search(window.location.pathname.substring(7));
        },
        error: function(xhr, status, error) {
          console.log(error);
        }
  });
}

function addOptionDetailEvent(){
  //--> [옵션셋관리] 옵션셋팝업 옵션상세보기 버튼 마우스오버
  $('.divOptionSetMngPopup .divOptionList .divOption img').off();
  $('.divOptionSetMngPopup .divOptionList .divOption img').mouseenter(function(e){
    var OPTION_VALUE = $(this).parents('.divOption').attr('OPTION_VALUE');
    $('.divToolTip').text(OPTION_VALUE);
    $('.divToolTip').css('top', $(this).offset().top);
    $('.divToolTip').css('left', $(this).offset().left+30);
    $('.divToolTip').css('display', 'block');
  });

  //--> [옵션셋관리] 옵션셋팝업 옵션상세보기 버튼 마우스아웃
  $('.divOptionSetMngPopup .divOptionList .divOption img').mouseleave(function(e){
    $('.divToolTip').css('display','none');
  });
}

function addOptionSetEvent(){
  //--> [옵션셋관리] 옵션셋팝업 옵션상세보기 버튼 마우스오버
  $('.divOptionSetMngPopup .divOptionList .divOption img').off();
  $('.divOptionSetMngPopup .divOptionList .divOption img').mouseenter(function(e){
    var OPTION_VALUE = $(this).parents('.divOption').attr('OPTION_VALUE');
    $('.divToolTip').text(OPTION_VALUE);
    $('.divToolTip').css('top', $(this).offset().top);
    $('.divToolTip').css('left', $(this).offset().left+30);
    $('.divToolTip').css('display', 'block');
  });

  //--> [옵션셋관리] 옵션셋팝업 옵션상세보기 버튼 마우스아웃
  $('.divOptionSetMngPopup .divOptionList .divOption img').mouseleave(function(e){
    $('.divToolTip').css('display','none');
  });

  $('.divOptionSetMngPopup .divOptionList .divOption').off();
  $('.divOptionSetMngPopup .divOptionList .divOption').click(function(e){
    if($(this).hasClass('selected')){
      $(this).removeClass('selected');
    }else{
      $(this).addClass('selected');
    }
  });
}

// --> [옵션셋관리] 팝업 저장하기 로직
function saveOptionSet(mode,id){

  var OPTION_SET_ID = "";
  var OPTION_SET_NAME = $('.divOptionSetMngPopup .OPTION_SET_NAME').val();
  var OPTION_SET_DESC = $('.divOptionSetMngPopup .OPTION_SET_DESC').val();
  var OPTION_ID_ARR = new Array();
  $('.divOptionSetMngPopup .addOption .divOption').each(function(e){
    var OPTION_ID = $(this).attr('OPTION_ID');
    OPTION_ID_ARR.push(OPTION_ID);
  });

  if(OPTION_SET_NAME==""){
    alert('옵션셋명을 입력해주세요.');
    return false;
  }

  if(OPTION_ID_ARR.length < 1){
    alert('옵션을 선택해주세요.');
    return false;
  }
  if(mode == 'add'){
    $.ajax({
          type:"POST",
          url:"/admin/ajaxAddOptionSet",
          data : {OPTION_SET_NAME:OPTION_SET_NAME, OPTION_ID_ARR:OPTION_ID_ARR, OPTION_SET_DESC:OPTION_SET_DESC},
          dataType : "json",
          success: function(res){
            search(window.location.pathname.substring(7));
          },
          error: function(xhr, status, error) {
            console.log(error);
          }
    });
  }else if(mode == 'modify'){
    $.ajax({
          type:"POST",
          url:"/admin/ajaxModifyOptionSet",
          data : {OPTION_SET_ID:id, OPTION_SET_NAME:OPTION_SET_NAME, OPTION_ID_ARR:OPTION_ID_ARR, OPTION_SET_DESC:OPTION_SET_DESC},
          dataType : "json",
          success: function(res){
            search(window.location.pathname.substring(7));
          },
          error: function(xhr, status, error) {
            console.log(error);
          }
    });
  }
}

//--> [옵션셋관리] 옵션삭제 로직 (Ajax)
function ajaxDeleteOptionSet(idxkey){
  $.ajax({
        type:"POST",
        url:"/admin/ajaxDeleteOptionSet",
        data : {OPTION_SET_ID_ARR:idxkey},
        dataType : "json",
        success: function(res){
          search(window.location.pathname.substring(7));
        },
        error: function(xhr, status, error) {
          console.log(error);
        }
  });
}
