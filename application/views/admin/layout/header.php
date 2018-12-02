<div class="divTopHeader" screenID="<?=$screenID?>">
  <?php if($screenID == "shopMng"){?>
    <table>
      <tr>
        <td class="menu <?php if(basename($_SERVER["PHP_SELF"])=="shopMng") echo "selected";?>"><a href="/admin/shopMng">대쉬보드</a></td>
        <td class="menu <?php if(basename($_SERVER["PHP_SELF"])=="bannerMng") echo "selected";?>"><a href="/admin/bannerMng">배너관리</a></td>
        <td></td>
      </tr>
    </table>
  <?php }?>
  <?php if($screenID == "userMng"){?>
    <table>
      <tr>
        <td class="menu <?php if(basename($_SERVER["PHP_SELF"])=="userMng") echo "selected";?>"><a href="/admin/userMng">대쉬보드</a></td>
        <td class="menu <?php if(basename($_SERVER["PHP_SELF"])=="inquiryUser") echo "selected";?>"><a href="/admin/inquiryUser">회원조회</a></td>
        <td class="menu <?php if(basename($_SERVER["PHP_SELF"])=="modifyUserLevel") echo "selected";?>"><a href="/admin/modifyUserLevel">회원등급관리</a></td>
        <td></td>
      </tr>
    </table>
  <?php }?>
  <?php if($screenID == "productMng"){?>
    <table>
      <tr>
        <td class="menu <?php if(basename($_SERVER["PHP_SELF"])=="productMng") echo "selected";?>"><a href="/admin/productMng">대쉬보드</a></td>
        <td class="menu <?php if(basename($_SERVER["PHP_SELF"])=="ProductList") echo "selected";?>"><a href="/admin/ProductList">상품조회</a></td>
        <td class="menu <?php if(basename($_SERVER["PHP_SELF"])=="addProduct") echo "selected";?>"><a href="/admin/addProduct">상품추가</a></td>
        <td class="menu <?php if(basename($_SERVER["PHP_SELF"])=="optionSetMng") echo "selected";?>"><a href="/admin/optionSetMng">옵션셋 관리</a></td>
        <td class="menu <?php if(basename($_SERVER["PHP_SELF"])=="optionMng") echo "selected";?>"><a href="/admin/optionMng">옵션 관리</a></td>
        <td></td>
      </tr>
    </table>
  <?php }?>
  <?php if($screenID == "codeMng"){?>
    <table>
      <tr>
        <td class="menu <?php if(basename($_SERVER["PHP_SELF"])=="codeMng") echo "selected";?>"><a href="/admin/codeMng">대쉬보드</a></td>
        <td class="menu <?php if(basename($_SERVER["PHP_SELF"])=="commonCodeMng") echo "selected";?>"><a href="/admin/commonCodeMng">공통코드 관리</a></td>
        <td></td>
      </tr>
    </table>
  <?php }?>
  <?php if($screenID == "sample"){?>
    <table>
      <tr>
        <td class="menu <?php if(basename($_SERVER["PHP_SELF"])=="sampleDashboard") echo "selected";?>"><a href="/admin/sampleDashboard">대쉬보드</a></td>
        <td class="menu <?php if(basename($_SERVER["PHP_SELF"])=="sampleGrid") echo "selected";?>"><a href="/admin/sampleGrid">그리드 샘플</a></td>
        <td></td>
      </tr>
    </table>
  <?php }?>
</div>
