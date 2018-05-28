
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
        if(@$_SESSION['login']){
        ?>
            <li><a 
                <?php 
                        if($_session['narac']=="cjcx"){
                            echo "class='active'";
                        }
                    ?>
                href="cjcx.php">成绩查询</a></li>
    <?php }else{?>
        <li><a href="log_ok.php">成绩查询</a></li>
    <?php }?>

  <li><a 
    <?php 
            if($_session['narac']=="about"){
                echo "class='active'";
            }
        ?>
    href="about.php">关于</a></li>

    <?php 
        if(@$_SESSION['login']){
    ?>
            <div style="float:right;width:100px"  class="dropdown">
                <a  href="#" class="dropbtn">账户</a>
                <div class="dropdown-content">
                <a href="#">
                    <?php
                    echo $_SESSION['authority']; 
                    ?>

                </a>
                
                <a href="#">修改密码</a>
                <a href="logout.php">登出</a>
                </div>
            </div>
            </ul>

    <?php
        }else{?>
            <li style="float:right">
                <a 
                    <?php 
                        if($_session['narac']=="login"){
                            echo "class='active'";
                        }
                    ?>
                href="login.php">登陆</a></li>
                </ul>               
                <?php }?>


</body>
</html>