<HTML>
<TITLE>Expense Analyzer</TITLE>
<HEAD>
  <link rel=stylesheet type="text/css" href=jtfucss.css>
  <!-- AJAX functionality -->
  <script type="text/javascript" src="ajaxRouter.js">  </script>
</HEAD>
<BODY>
<?php
include("expCommonHeader.php");

?>
 <table width="100%" border = 0>
  <tr>
    <table width="100%" border = 0>
    <tr>
      <td align = center><a href="javascript:sndReq('MER');">[By Merchant Type]</a></td>
      <td align = center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
      <td align = center><a href="javascript:sndReq('EXP');">[By Expense Type]</a></td>
    </tr>
    </table>
  </tr>
  <tr>
    <table width="100%" border = 0>
    <tr>
      <td width = 100% align=center nowrap>
        <!-- we only have one object that would be updated: someText -->
        <!-- so our ajax.php file will always output "someText|whatever...", which handleResponse will -->
        <!--  use to update this <div> object -->

        <div style="width: 25%;" id="someText">
          Click one of the above pages to select a graph type.
        </div>
      </td>
    </tr>
    </table>
  </tr>
  </table>
</BODY>
</HTML>