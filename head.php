<?php 

//判断是否登陆
include_once 'tools/conn.php';				//执行连接数据库的操作
if(!empty($_SESSION["name"]) and !empty($_SESSION["id"])){
    $sql = "select authority from lovezx.login,lovezx.userinfo where login.dlname = '".$_SESSION["name"]."' and login.login_id = '".$_SESSION["id"]."' and login.dlname=userinfo.dlname";	
    $_SESSION['authority'] = $conne->getFields($sql,'authority');//获取权限
    $conne->close_rst();				//关闭数据库
}

if(!empty( $_SESSION['authority'])){
    switch($_session['narac']){
    case "login":
        header("Location: index.php");
        break;
    }  
}



?>
<!DOCTYPE html>
<html>
<head>
<link type="text/css" rel="stylesheet" href="css/head.css" />
<meta charset="utf-8">
</head>
<body>

<ul class="sidenav">
  <li>
    <a 
    <?php 
        if($_session['narac']=="index"){
            echo "class='active'";
        }
    ?>
    href="index.php">主页</a></li>

    <?php     
        if(!empty( $_SESSION['authority'])){
        ?>
            <li><a 
                <?php 
                        if($_session['narac']=="cjcx"){
                            echo "class='active'";
                        }
                    ?>
                href="cjcx.php">成绩查询</a></li>
    <?php }else{?>
        <li><a href="login.php">成绩查询</a></li>
    <?php }?>

  <li><a 
    <?php 
            if($_session['narac']=="about"){
                echo "class='active'";
            }
        ?>
    href="about.php">关于</a></li>

    <?php 
        if(!empty($_SESSION['authority'])){
    ?>
            <div style="float:right;width:100px"  class="dropdown">
                <a  href="#" class="dropbtn">我的账户</a>
                <div class="dropdown-content">
                <a href="#">
                    <?php
                    echo $_SESSION['authority']; 
                    ?>
                </a>
                <a href="#">修改密码</a>
                <a href="tools/logout.php">登出</a>
                </div>
            </div>
            </ul>
    <?php
        }else{?>
            <li style="float:right">
                <a 
                    <?php 
                        if($_session['narac']=="login"){
                            echo "class='active'";}?>
                href="login.php">登陆</a></li>
                </ul>               
                <?php }?>


</body>
</html>