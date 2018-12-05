<!--div class="divBox divSelectDate">
  <p class="typo title small center">언제 필요하세요?</p>
  <input class="datePicker" type="text" data-lang="ko" data-large-mode="true" data-modal="true" data-format="Y년　m월　d일" data-min-year="2018" data-max-year="2019" readonly/>
  <input class="nextBtn" type="button" value="다음">
</div-->

<div class="divBox divSelectMethod">
  <p class="typo title small center">배송방법을<br>선택해주세요!</p>
  <input class="datePicker" type="text" data-lang="ko" data-large-mode="true" data-modal="true" data-format="Y년　m월　d일" data-min-year="2018" data-max-year="2019" readonly/>
  <input class="nextBtn" type="button" value="다음">
</div>

<input class="STEP" type="hidden" value="1">
<input class="TODAY" type="hidden" value="<?=date('Ymd',time())?>">

<input class="DELIVERY_DATE" type="hidden" name="DELIVERY_DATE" value="">
