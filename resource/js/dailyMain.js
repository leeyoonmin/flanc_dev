$(document).ready(function() {
  $('.datePicker').dateDropper();
  $('.divSelectDate').fadeIn('fast');
});

$('.nextBtn').click(function(e){
  // 현재 스탭
  var STEP = $('.STEP').val();
  // 스탭 = 1 일 떄,
  if(STEP == 1){
    // 선택된 날짜
    var SELECT_DATE = $('.datePicker').val().replace(/[^0-9]/g,"");
    // 선택된 날짜가 이전 날짜일 때,
    if(SELECT_DATE < $('.TODAY').val()){
      alert("과거일을 선택하셨습니다.\n다른 날짜로 선택해주세요.");
    }else{
      var currentDate = new Date();
      var currentTime = String(currentDate.getHours())+String(currentDate.getMinutes());
      if(currentTime > 1730 && SELECT_DATE == $('.TODAY').val()){
        alert("오후 5시 30분 이후에는 당일 배송이 불가능합니다.\n다른 날짜로 선택해주세요.");
      }else{
        // 현재 보이는 박스 숨기기
        $('.divBox').fadeOut('fast');
        // 선택된 날짜 저장
        $('.DELIVERY_DATE').val(SELECT_DATE);
        // 스텝(+1) 변경
        $('.STEP').val(Number(STEP)+1);
        fadeInNextBox();
      }
    }
  }
})


function fadeInNextBox(){

}
