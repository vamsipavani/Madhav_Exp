<html>
<body>

<?php
  $varAction1 = $_GET['action'];
  //echo $varAction1;
?>
<table width=100% border =0>
<tr>
  <td width="15%">
    <table width=100% border =0>
    <TR>
      <td nowrap align = top>
      <B>Chart Styles</B>
      </td>

  <td align=center width ="70%">
    <table>
    <tr>
    <td align=center>
      <div style="width: 25%;" id="graphArea">
        <img src="expGraphs.php?action=<?php echo $varAction1 ?>&multiMode=1">
      </div>
    </td>
    </tr>
    </table>

  <td width="15%">
  <?php include('expLegend.php');?>
  </td>
</tr>

</table>
</body>
</html>
