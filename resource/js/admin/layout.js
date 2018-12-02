/////////////////////////////////////////////////////////////////////////////////////////////
//                                     온로드 이벤트                                        //
/////////////////////////////////////////////////////////////////////////////////////////////
$(document).ready(function() {

});

/////////////////////////////////////////////////////////////////////////////////////////////
//                                     이벤트 리스트                                        //
/////////////////////////////////////////////////////////////////////////////////////////////

//--> 왼쪽 사이드 메뉴 마우스오버 이벤트
$('.divSideMenu .divMenuList li').mouseenter(function(e){
  var type = $(this).children('img').attr('type');
  $(this).children('img').attr('src','/resource/img/icon/ic_'+type+'_blue.png');
});
$('.divSideMenu .divMenuList li').mouseleave(function(e){
  if($(this).hasClass('selected')){return false;}
  var type = $(this).children('img').attr('type');
  $(this).children('img').attr('src','/resource/img/icon/ic_'+type+'_gray.png');
});

//--> 그리드 체크박스 클릭 이벤트
$('.divGrid.is_check .body .checkBox').click(function(e){
  var is_checked = $(this).hasClass('checked');
  if(is_checked){
    $(this).text('□');
    $(this).removeClass('checked');
    $(this).css('color','#818181');
    $(this).parents('tr').css('background','#fff');
    $('.divGrid .head .checkBox').text('□');
    $('.divGrid .head .checkBox').removeClass('checked');
    $('.divGrid .head .checkBox').css('color','#818181');
  }else{
    $(this).addClass('checked');
    $(this).text('▣');
    $(this).css('color','#38D3FF');
    $(this).parents('tr').css('background','#eaf6fa');
  }
});

//--> 그리드 체크박스 단일 클릭 이벤트
$('.divGrid.is_one_check .body .checkBox').click(function(e){
  $('.divGrid.is_check .body').text('□');
  $('.divGrid.is_check .body').removeClass('checked');
  $('.divGrid.is_check .body').css('color','#818181');
  $(this).addClass('checked');
  $(this).text('▣');
  $(this).css('color','#38D3FF');
});

//--> 그리드 헤더 체크박스 클릭 이벤트 전체 클릭!
$('.divGrid .head .checkBox').click(function(e){
  if(!$('.divGrid').hasClass('is_check')){
    return false;
  }
  var is_checked = $(this).hasClass('checked');
  if(is_checked){
    $('.divGrid.is_check .body').children('.checkBox').text('□');
    $('.divGrid.is_check .body').children('.checkBox').removeClass('checked');
    $('.divGrid.is_check .body').children('.checkBox').css('color','#818181');
    $('.divGrid.is_check .body').css('background','#fff');
    $(this).removeClass('checked');
    $(this).text('□');
    $(this).css('color','#818181');
  }else{
    $('.divGrid.is_check .body').children('.checkBox').addClass('checked');
    $('.divGrid.is_check .body').children('.checkBox').text('▣');
    $('.divGrid.is_check .body').children('.checkBox').css('color','#38D3FF');
    $('.divGrid.is_check .body').css('background','#eaf6fa');
    $(this).addClass('checked');
    $(this).text('▣');
    $(this).css('color','#38D3FF');
  }
});

//--> 페이지네이션 페이지 클릭이벤트
$('.divPagination .pageBtn').click(function(e){
  var clickPage = $(this).text();
  var currentPage = $('.divPagination .currentPage').val();
  var lastPage = $('.divPagination .lastPage').val();

  if(clickPage == currentPage){
    return false;
  }

  if(clickPage=='first'){
    clickPage = 1;
  }else if(clickPage=='last'){
    clickPage = lastPage;
  }

  search(window.location.pathname.substring(7),clickPage);
  //location.href= location.pathname + '?page='+clickPage;
});

//--> 팝업 닫기버튼 클릭 이벤트
$('.divPopup .closeBtn').click(function(e){
  $(this).parents('.divPopupTitle').parents('.divPopup').fadeOut('fast');
  $(this).parents('.divPopupTitle').parents('.divPopup').next('.divPopupBG').fadeOut('fast');
});

//--> 팝업 배경 클릭 이벤트
$('.divPopupBG').click(function(e){
  $(this).prev('.divPopup').fadeOut('fast');
  $(this).fadeOut('fast');
});

/***************************************
  달력출력
***************************************/
function setCalendar(getYear,getMonth){
  var day=1;
  var date = new Date();
  var yearNow = date.getFullYear();
  var monthNow = date.getMonth() + 1;
  var dayNow = date.getDate();
  var firstDayStrOfMonth = new Date(getYear+'-'+getMonth+'-01').getDay();
  firstDayStrOfMonth = Number(firstDayStrOfMonth);
  var lastDayOfMonth = ( new Date(getYear, getMonth, 0) ).getDate();
  $('.calendar .calendarBox table td').removeClass('today');
  $('.calendar .calendarBox table td').removeClass('able');
  $('.calendar .calendarBox table td').removeClass('unable');
  $('.dateNow').val(getYear+"."+lpad(getMonth,0,2));
  if(firstDayStrOfMonth==7){
    firstDayStrOfMonth=0;
  }
  for(var weeks=1; weeks<7; weeks++){
    for(var dayOfWeeks=0;dayOfWeeks<7;dayOfWeeks++){
      var pos = dayOfWeeks+((weeks-1)*7);
      $('.calendar .calendarBox table .pos'+(pos)).html('');
      if(pos>=firstDayStrOfMonth && day<=lastDayOfMonth){
        $('.calendar .calendarBox table .pos'+(pos)).addClass('is_day').html('<a>'+day+'</a>');
        if(day == dayNow && getMonth == monthNow){
          $('.calendar .calendarBox table .pos'+(pos)).addClass('today');
        }
        if((yearNow >= getYear && monthNow > getMonth)||(monthNow == getMonth && dayNow >=day)){
          $('.calendar .calendarBox table .pos'+(pos)).addClass('able');
        }else{
          if(dayOfWeeks == 1 || dayOfWeeks == 3 || dayOfWeeks == 5){
            $('.calendar .calendarBox table .pos'+(pos)).addClass('able');
          }else{
            $('.calendar .calendarBox table .pos'+(pos)).addClass('able');
          }
        }
        day++;
      }
    }
  }
}

/***************************************
  이전달 이동
***************************************/
$('.calendar .buttonBox .prev_month_btn').click(function(e){
  var getDate = $('.dateNow').val();
  var getDateArray = getDate.split(".");
  var getYear = getDateArray[0];
  var getMonth = getDateArray[1];
  getMonth = Number(getMonth) - 1;
  if(getMonth == 0){
    getYear = Number(getYear) - 1;
    getMonth = 12;
  }
  getMonth = lpad(String(getMonth),2,0);
  $('.dateNow').val(getYear+"."+getMonth);
  setCalendar(getYear,getMonth);
  setClickEvent();
});

/***************************************
  다음달 이동
***************************************/
$('.calendar .buttonBox .next_month_btn').click(function(e){
  var getDate = $('.dateNow').val();
  var getDateArray = getDate.split(".");
  var getYear = getDateArray[0];
  var getMonth = getDateArray[1];
  getMonth = Number(getMonth) + 1;
  if(getMonth == 13){
    getYear = Number(getYear) + 1;
    getMonth = 1;
  }
  getMonth = lpad(String(getMonth),2,0);
  $('.dateNow').val(getYear+"."+getMonth);
  setCalendar(getYear,getMonth);
  setClickEvent();
});

/***************************************
  달력이벤트 등록
***************************************/
function setClickEvent(){
  $('.divCalendar .calendarBox td').off();
  $('.able').click(function(e){
    var year = $('.divCalendar .calendar .dateNow').val().substring(0,4);
    var month = $('.divCalendar .calendar .dateNow').val().substring(5,7);
    var day = $(this).text();
    $('.divSearch .inputDate .'+fromORto).val(year+'-'+lpad(month,2,0)+'-'+lpad(day,2,0));
    $('.divCalendar').fadeOut('fast');
  });
}

//--> [회원조회] 달력버튼 클릭이벤트
var fromORto = "";
$('.divSearch .inputDate img').click(function(e){
  if($(this).hasClass('TODT_BTN')){
    fromORto = 'INPUT_TODT';
  }else if($(this).hasClass('FRDT_BTN')){
    fromORto = 'INPUT_FRDT';
  }
  var offsetTop = $(this).offset().top;
  var offsetLeft = $(this).offset().left;
  $('.divCalendar').css('top',offsetTop+37).css('left',offsetLeft-112);
  var year = "";
  var month = "";
  var date = $('.divSearch .inputDate .'+fromORto).val();
  date = date.replace(/[^0-9]/g,"");
  if(4 < date.length){
    year = date.substring(0,4);
    month = date.substring(4,6);
    if(month<1){
      month = 1;
    }else if(month>12){
      month = 12;
    }
  }else{
    var date = new Date();
    year = date.getFullYear();
    month = date.getMonth() + 1;
    if(month<1){
      month = 1;
    }else if(month>12){
      month = 12;
    }
  }
  setCalendar(year,month);
  setClickEvent();
  $('.divCalendar').fadeIn('fast');
});

/***************************************
  달력날짜 클릭 이벤트
***************************************/
$('.divCalendar .calendar .able').click(function(e){
  var year = $('.divCalendar .calendar .dateNow').val().substring(0,4);
  var month = $('.divCalendar .calendar .dateNow').val().substring(5,7);
  var day = $(this).text();
  $('.divSearch .inputDate .'+fromORto).val(year+'-'+lpad(month,2,0)+'-'+lpad(day,2,0));
  $('.divCalendar').fadeOut('fast');
});

/***************************************
  달력 닫기버튼 클릭 이벤트
***************************************/
$('.divCalendar .calendar .closeBtn').click(function(e){
  $('.divCalendar').fadeOut('fast');
});

/***************************************
  달력 인풋값 변경 시
***************************************/
$('.divSearch .inputDate input[type="text"]').keyup("change paste keyup", function(){
  var date = $(this).val();
  date = date.replace(/[^0-9]/g,"");
  if(4 < date.length && date.length < 7 ){
    date = date.substring(0,4)+'-'+date.substring(4,6);
  }else if(date.length > 6){
    date = date.substring(0,4)+'-'+date.substring(4,6)+'-'+date.substring(6,8);
  }
  date = $(this).val(date);
});


/////////////////////////////////////////////////////////////////////////////////////////////
//                                      로직 리스트                                         //
/////////////////////////////////////////////////////////////////////////////////////////////

/***************************************
  LPAD 함수
***************************************/
function lpad(s, padLength, padString){

    while(s.length < padLength)
        s = padString + s;
    return s;
}

/***************************************
  RPAD 함수
***************************************/
function rpad(s, padLength, padString){
    while(s.length < padLength)
        s += padString;
    return s;
}
function getNumber(str){
  return str.replace(/[^0-9]/g,'');
}

/***************************************
  전화번호 변경
***************************************/
$('#tel2').on("change keyup paste", function(e){
  var str = $('#tel2').val();
  str = str.replace(/[^0-9]/g,'');
  $('#tel2').val(str);
  if(str.length > 3){
    $('#tel3').focus();
  }
});

$('#tel3').on("change keyup paste", function(e){
  var str = $('#tel3').val();
  str = str.replace(/[^0-9]/g,'');
  $('#tel3').val(str);
});


/***************************************
  Ajax 호출
  PARAM
  1 ) URL 명 (string)
  2 ) 데이터 (ObjectArray)
***************************************/
function doAjaxSync(URL, dataSet){
  var returnData;
  $.ajax({
        type:"POST",
        url:"/ajax/"+URL,
        data : dataSet,
        dataType : "json",
        async: false,
        success: function(res){
          returnData = res['data'];
        },
        error: function(xhr, status, error) {
          returnData = ('ERRORS: ' + status);
        }
  });
  return returnData;
}

function doAjaxForm(URL, dataSet){
  var returnData;
  $.ajax({
    url: '/ajax/'+URL,
    contentType: 'multipart/form-data',
    type: 'POST',
    data: dataSet,
    dataType: 'json',
    mimeType: 'multipart/form-data',
    async: false,
    success: function(res){
      returnData = res['data'];
    },
    error : function (xhr, status, error) {
      returnData = ('ERRORS: ' + status);
    },
    cache: false,
    contentType: false,
    processData: false
  });
  return returnData;
}

function showLoader(msg){
  $('.divLoader').css('display','block');
  $('.divLoader h1').text(msg);
}

function hiddenLoader(msg){
  $('.divLoader').css('display','none');
}
