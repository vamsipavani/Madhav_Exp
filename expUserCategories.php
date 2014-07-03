<html>
<head>
  <link rel=stylesheet type="text/css" href=jtfucss.css>
  <script type="text/javascript" src="ajaxRouterUserCats.js">  </script>
</head>

<body>

<?php
include_once("expCommonHeader.php");

$addMoreRows = 'no';
?>
<FORM action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name = "expUserCategories">
<table width=100% border =0 align="center">
<tr>
  <td width=15%>
    <?php include("expProfile.php"); ?>
  </td>

  <td width =70%>
  <div id="expUserProfile">
    <?php
    if(isset($_GET['query']))
	{
	  $pageMode             = $_GET['query'];
    }
      include("expRenderTabData.php");
    ?>

  </div>
  <table align ="right">
  <tr>
    <td> &nbsp </td>
    <td> &nbsp </td>
    <td> &nbsp </td>
  <?php
    if($addMoreRows != 'yes')
  ?>
    <td align="right"><a href="javascript:addMoreRows('<?php echo $pageMode ?>');"><IMG SRC="/images/AddMore.gif" name="pic1" border="0"></a></td>

  <?php
    if($addMoreRows == 'yes')
  ?>
    <td align="right"><a href="javascript:postCatData('<?php echo $pageMode ?>');"><IMG SRC="/images/save.gif" name="pic1" border="0"></a></td>
  </tr>
  <INPUT TYPE=hidden NAME=postData VALUE="">
  </table>
  </td>

  <td width=15%>
  </td>
</tr>
</table>


</body>
</html>