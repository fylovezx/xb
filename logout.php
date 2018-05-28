<?php 
session_start();
session_destroy();
echo "<script>alert('退出登录！');window.location.href='index.php';</script>";
?>