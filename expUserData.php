<html>
<head>
<link rel=stylesheet type="text/css" href=jtfucss.css>
<script type="text/javascript" src="ajaxRouterUsers.js">  </script>
</head>
<body>

<FORM action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name = "expUserData">
<table width=100% border =0 align="center">
<tr>
  <td width=15%>
    <?php include("expProfile.php"); ?>
  </td>

  <td width =70%>
  <div id="expUsserData">
    <?php
      /*session_start();
      if (isset($_GET['mode']))
      {
        $formMode = $_GET['mode'];
        echo $formMode;
      }*/
      include("expRenderFormData.php");
    ?>

  </div>
  <table border =0 align ="right">
  <tr>

    <td align="right"><a href="javascript:editUserData();"><IMG SRC="/images/edit.gif" name="pic1" border="0"></a></td>
    <td align="right"><a href="javascript:postUserData('ro');"><IMG SRC="/images/Save.gif" name="pic1" border="0"></a></td>
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

