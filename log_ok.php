<?php
session_start();								//初始化SESSION变量
if($_POST['sub']){
    if($_POST['user']!="" && $_POST['pwd']!=""){	//判断用户名和密码是否为空
		if($_POST['user']=="mr" && $_POST['pwd']=="mrsoft"){		//判断管理员用户名和密码是否正确
			$_SESSION['user'] = $_POST['user'];
			$_SESSION['pwd'] = $_POST['pwd'];
            $_SESSION['check'] = $_POST['check'];
            $_SESSION['login'] = true;
            $_SESSION['authority'] = "管理员";
			echo "<script>alert('登录成功！');window.location.href='index.php'</script>";
		}else{
            $_SESSION['login'] = false;
			echo "<script>alert('用户名或者密码不正确！');window.location.href='login.php'</script>";
		}
	}else{
        $_SESSION['login'] = false;
		echo "<script>alert('登录用户名或者密码不能为空！');window.location.href='login.php'</script>";
	}
}else{
    echo "<script>alert('您尚未登陆！');window.location.href='login.php'</script>";
}
?>	