<div class="divContents modifyBanner">
  <table>
    <tr>
      <td class="head">배너타입</td>
      <td>
        <select class="BANNER_TYPE" name="BANNER_TYPE">
          <option value="0000">선택하세요</option>
          <option value="01" <?php if($BANNER_DATA->BANNER_TYPE == "01") echo "selected"; ?>>매인배너</option>
        </select>
      </td>
    </tr>
    <tr class="previewTR">
      <td class="head">미리보기</td>
      <td>
        <img id="BANNER_IMG" src="/resource/img/banner/<?=$BANNER_DATA->IMG_NAME.".".$BANNER_DATA->IMG_EXTENSION?>">
      </td>
    </tr>
    <tr>
      <td class="head">파일업로드</td>
      <td>
        <input class="FILE_BANNER_IMG" type="file" name="BANNER_IMG" value="" onChange="loadImg(event)">
      </td>
    </tr>
    <tr>
      <td class="head">링크</td>
      <td>
        <input id="LINK_URL" type="text" name="LINK_URL" value="<?=$BANNER_DATA->LINK_URL?>">
      </td>
    </tr>
  </table>
  <div class="divSubmit">
    <input class="BANNER_ID" type="hidden" value="<?=$BANNER_DATA->BANNER_ID?>">
    <input class="BANNER_ORDER" type="hidden" value="<?=$BANNER_DATA->BANNER_ORDER?>">
    <input class="IMG_NAME" type="hidden" value="<?=$BANNER_DATA->IMG_NAME?>">
    <input class="IMG_EXTENSION" type="hidden" value="<?=$BANNER_DATA->IMG_EXTENSION?>">
    <input class="IMG_SIZE" type="hidden" value="<?=$BANNER_DATA->IMG_SIZE?>">
    <input class="addBannerBtn btn blue" type="button" value="배너수정하기">
  </div>
</div>
