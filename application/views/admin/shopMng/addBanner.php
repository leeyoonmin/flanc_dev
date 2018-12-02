<div class="divContents addBanner">
  <table>
    <tr>
      <td class="head">배너타입</td>
      <td>
        <select class="BANNER_TYPE" name="BANNER_TYPE">
          <option value="0000">선택하세요</option>
          <option value="01">매인배너</option>
        </select>
      </td>
    </tr>
    <tr class="previewTR">
      <td class="head">미리보기</td>
      <td>
        <img id="BANNER_IMG" src="">
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
        <input id="LINK_URL" type="text" name="LINK_URL" value="">
      </td>
    </tr>
  </table>
  <div class="divSubmit">
    <input class="addBannerBtn btn blue" type="button" value="배너등록하기">
  </div>
</div>
