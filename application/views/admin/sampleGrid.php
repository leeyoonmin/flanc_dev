<div class="divContents sample">

<div class="divSearch">
  <table>
    <tr class="head">
      <td class="wd150">Keyword</td>
      <td class="wd260">Date</td>
      <td class="wd125">Select1</td>
      <td class="wd125">Select2</td>
      <td class="wd220">SelectText</td>
      <td></td>
    </tr>
    <tr class="body">
      <td class="wd150">
        <input type="text" name="name" placeholder="Keyword..">
      </td>
      <td class="wd260">
        <input class="inputDate FRDT" type="text" name="" value=""><img class="inputDateBtn" src="/resource/img/icon/ic_calendar_white.png"> ~ <input class="inputDate TODT" type="text" name="" value=""><img class="inputDateBtn" src="/resource/img/icon/ic_calendar_white.png">
      </td>
      <td class="wd125">
        <select class="" name="">
          <option value="">Select</option>
          <option value="">Option1</option>
          <option value="">Option2</option>
          <option value="">Option3</option>
        </select>
      </td>
      <td class="wd125">
        <select class="" name="">
          <option value="">Select</option>
          <option value="">Option1</option>
          <option value="">Option2</option>
          <option value="">Option3</option>
        </select>
      </td>
      <td class="wd220">
        <select class="selectText" name="">
          <option value="">Option1</option>
          <option value="">Option2</option>
          <option value="">Option3</option>
        </select><input class="selectText" type="text" name="name" placeholder="Keyword..">
      </td>
      <td></td>
    </tr>
  </table>
</div>

<div class="divButton">
  <table>
    <tr>
      <td class="info">
        총 <span>24</span>건
      </td>
      <td></td>
      <td class="button">
        <input class="btn green" type="button" name="" value="추가">
        <input class="btn orange" type="button" name="" value="수정">
        <input class="btn red" type="button" name="" value="삭제">
        <input class="btn blue" type="button" name="" value="조회">
      </td>
    </tr>
  </table>
</div>

<div class="divGrid is_check">
  <table>
      <tr class="head">
        <td class="checkBox">□</td><td>indexkey</td><td>model name</td><td>ip address</td><td>phone number</td><td>purchased price</td><td>memo</td><td>date</td>
      </tr>
      <?php
        for($row=0; $row<10; $row++){
          echo "
          <tr class=\"body\">
            <td class=\"checkBox\">□</td><td>01032018051116541801</td><td>SMP-D245K</td><td>192.168.213.144</td><td>010-8424-4558</td><td>287,000</td><td>just do it!</td><td>2018-11-16</td>
          </tr>
          ";
        }
      ?>

  </table>
</div>
<?php
  $rowCount = 234;
  $CURRENT_PAGE = $page;
  $LAST_PAGE = ceil($rowCount/10);
  $PAGE_LIST = array();
?>
<div class="divPagination">
  <input class="currentPage" type="hidden" name="PAGE" value="<?=$page?>">
  <input class="lastPafe" type="hidden" name="PAGE" value="<?=$LAST_PAGE?>">
  <table>
    <tr>
      <td  class="pageBtn first">first</td>
      <?php
        $viewCnt = 0;
        for($i=1; $i<=$LAST_PAGE; $i++){
          if($viewCnt<9){
            if($CURRENT_PAGE == $i && $i <= $LAST_PAGE){
              echo "<td class=\"pageBtn selected\">".$i."</td>";
              $viewCnt++;
            }else if($CURRENT_PAGE <= 5 && $i<=$LAST_PAGE){
              echo "<td class=\"pageBtn\">".$i."</td>";
              $viewCnt++;
            }else if($CURRENT_PAGE > 5 && $i <= $LAST_PAGE && $CURRENT_PAGE-4 <=$i){
              echo "<td class=\"pageBtn\">".$i."</td>";
              $viewCnt++;
            }else if($i<=$LAST_PAGE-2 && $i>=$LAST_PAGE-8){
              echo "<td class=\"pageBtn\">".$i."</td>";
              $viewCnt++;
            }else{
              echo "<td class=\"pageBtn unvisible\">".$i."</td>";
            }
          }
        }
      ?>
      <td  class="pageBtn last">last</td>
    </tr>
  </table>
</div>
</div>
