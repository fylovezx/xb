<?php 
session_start();
$_SESSION['narac']="login"; ?>

<!DOCTYPE html>
<html>
<head>
<link type="text/css" rel="stylesheet" href="css/container.css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $_SESSION['narac']?></title>
</head>
<body>

<div class="container">
  <div class="head" >
    <?php require('head.php');?>
  </div>

<div class="content">
<table id="__01" width="422" height="323" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="3">
			<img src="images/index_01.jpg" width="422" height="150" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="images/index_02.jpg" width="132" height="158" alt=""></td>
		<td width="277" height="158">
		<form action="tools/log_ok.php" method="post">
		<b>用户名：<input type="text" name="name" /><br><br>
		密&nbsp;码：<input type="password" name="pwd" /><br><br></b>
		<input type="submit"name="sub"value="确定" />&nbsp;&nbsp;
		<input type="reset"name="res"value="重置" />
	</form></td>
		<td>
			<img src="images/index_04.jpg" width="13" height="158" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="images/index_05.jpg" width="422" height="15" alt=""></td>
	</tr>
</table>
</div>

</div>
</body>
</html>