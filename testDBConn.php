
<html>
<head>
<link rel=stylesheet type="text/css" href=jtfucss.css>
<script type="text/javascript" src="ajaxRouterExpListing.js">  </script>
</head>
<body>

<?php
  $dbhandle = mysql_connect("localhost", "data_admin", "data_admin") or die(mysql_error());
  mysql_select_db("analysis") or die(mysql_error());
print("Hello world");
?>

</body>
</html>
