<?php 
session_start();
$_SESSION['narac']="about"; ?>
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
  <div class="content" style="">
  <h2>关于：</h2>
  <p>成绩查询</p>
  </div>
</div>
</body>
</html>