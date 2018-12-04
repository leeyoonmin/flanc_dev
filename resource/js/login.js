$(document).ready(function() {

});

//->  로그인 버튼 클릭 이벤트
$('.submitBtn').click(function(e){
  var ID = $('.loginForm .inputID').val();
  var PW = $('.loginForm .inputPW').val();
  var resultValue = doAjaxSync('/auth/loginPrc',{ID:ID, PW:PW});
  if(resultValue){
    location.href=$('.PREV_URL').val();
  }else{
    alert('존재하지 않는 아이디이거나,\n비밀번호가 틀렸습니다.');
  }
});
