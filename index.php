<?php 
 session_start();
$_SESSION['narac']="index"; ?>
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
  <div class="content" >
  <h2>醉爱昕昕宝</h2>
  <p>做给老婆大人用于查询成绩，</p>
  <p>希望老婆能够喜欢！</p>
  </div>
</div>

</body>
</html>