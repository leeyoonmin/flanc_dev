$(document).ready(function() {

});

//->  이메일 선택 변경 이벤트
$('.EMAIL3').change(function(e){
  if($(this).val()=="0000"){
    $('.EMAIL2').val('');
  }else if($(this).val()=="9999"){
    $('.EMAIL2').val('');
    $('.EMAIL2').prop('readonly',false);
    $('.EMAIL2').focus();
  }else{
    $('.EMAIL2').val($(this).val());
    $('.EMAIL2').prop('readonly',true);
  }
});

//->  가입하기 버튼 클릭 이벤트
$('.submitBtn').click(function(e){
  var is_verification = joinVerification();
  console.log(is_verification);

  if(!is_verification){
    return false;
  }

  var ID = $('.ID').val();
  var PW = $('.PASSWORD1').val();
  var NAME = $('.NAME').val();
  var TEL1 = $('.TEL1').val();
  var TEL2 = $('.TEL2').val();
  var TEL3 = $('.TEL3').val();
  var EMAIL1 = $('.EMAIL1').val();
  var EMAIL2 = $('.EMAIL2').val();
  var SEX;
  $('.divRadioBtn input').each(function(){
    if($(this).prop('checked')){
      SEX = $(this).val();
    }
  });
  var BIRTH = $('.BIRTH').val();

  var dataSet = {ID:ID, PW:PW, NAME:NAME, TEL1:TEL1, TEL2:TEL2, TEL3:TEL3, EMAIL1:EMAIL1, EMAIL2:EMAIL2, SEX:SEX, BIRTH:BIRTH};
  var returnValue = doAjaxSync('/auth/joinPrc',dataSet);

  if(returnValue){
    location.href="/auth/joinResult";
  }
});

//-> 회원가입 폼 검증 로직
function joinVerification(){
  var idReg = /^[a-z]+[a-z0-9]{5,19}$/g;
  var emailReg = /^[A-Za-z0-9_\.\-]+@[A-Za-z0-9\-]+\.[A-Za-z0-9\-]+/;

  var is_radio = false;
  $('.divRadioBtn input').each(function(){
    is_radio = (is_radio || $(this).prop('checked'));
  });

  var returnValue = true;

  if($('.ID').val()==""){
    alert('아이디를 입력해주세요');
    $('.ID').focus();
    returnValue = false;
  }else if(!idReg.test($('.ID').val())){
    alert('아이디 형식에 맞지 않습니다.');
    $('.ID').focus();
    returnValue = false;
  }else if($('.PASSWORD1').val()==""){
    alert('비밀번호를 입력해주세요');
    $('.PASSWORD1').focus();
    returnValue = false;
  }else if($('.PASSWORD2').val()==""){
    alert('비밀번호를 입력해주세요');
    $('.PASSWORD2').focus();
    returnValue = false;
  }else if($('.PASSWORD1').val() != $('.PASSWORD2').val()){
    alert('비밀번호와 비밀번호 확인이 다릅니다.\n확인 부탁드립니다.');
    $('.PASSWORD2').focus();
    returnValue = false;
  }else if($('.NAME').val()==""){
    alert('이름을 입력해주세요');
    $('.NAME').focus();
    returnValue = false;
  }else if($('.TEL2').val()==""){
    alert('전화번호를 입력해주세요');
    $('.TEL2').focus();
    returnValue = false;
  }else if($('.TEL3').val()==""){
    alert('전화번호를 입력해주세요');
    $('.TEL3').focus();
    returnValue = false;
  }else if($('.TEL2').val().replace(/[^0-9]/g,'').length < 3){
    alert('전화번호 형식에 맞지 않습니다.');
    $('.TEL2').focus();
    returnValue = false;
  }else if($('.TEL3').val().replace(/[^0-9]/g,'').length < 4){
    alert('전화번호 형식에 맞지 않습니다.');
    $('.TEL3').focus();
    returnValue = false;
  }else if(!$('#SMS_AGREEMENT').prop('checked')){
    alert('SMS 수신에 관한 동의에 체크해주세요');
    $('#SMS_AGREEMENT').focus();
    returnValue = false;
  }else if(!emailReg.test($('.EMAIL1').val()+'@'+$('.EMAIL2').val())){
    console.log($('.EMAIL1').val()+'@'+$('.EMAIL2').val());
    alert('이메일 형식에 맞지 않습니다.');
    $('.EMAIL1').focus();
    returnValue = false;
  }else if(!$('#EMAIL_AGREEMENT').prop('checked')){
    alert('EMAIL 수신에 관한 동의에 체크해주세요');
    $('#EMAIL_AGREEMENT').focus();
    returnValue = false;
  }else if(!is_radio){
    alert('성별을 선택해주세요.');
    returnValue = false;
  }else if($('.BIRTH').val()==""){
    alert('생년월일을 입력해주세요');
    $('.BIRTH').focus();
    returnValue = false;
  }else if($('.BIRTH').val().replace(/[^0-9]/g,'').length != 8){
    alert('생년월일 형식에 맞지 않습니다.');
    $('.BIRTH').focus();
    returnValue = false;
  }
  return returnValue;
}
