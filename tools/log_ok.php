<?php
session_start();								//初始化SESSION变量
if($_POST['sub']){
    if($_POST['name']!="" && $_POST['pwd']!=""){	//判断用户名和密码是否为空
		include_once "conn.php";
		$name = addslashes($_POST['name']);			//获取用户名
		$pwd = $_POST['pwd'];						//获取密码

		
		$sql = "select * from lovezx.userinfo where dlname = '".$name."' and dlpwd = '".md5($pwd)."'";		
		$num = $conne->getRowsNum($sql);		//返回查询结果
		$conne->close_rst();				//关闭数据库
		if($num == 0 or $num == ''){			//如果不正确
			echo "<script>alert('用户名和密码不正确！'); window.location.href='../index.php';</script>";
		}else{									//如果正确，则将登录用户名数据存储到Cookie中
			$session_id=session_id();			//获取SessionID
			$_SESSION["name"]=$name;
			$_SESSION["id"]=md5($session_id);
			$sqls=" delete from lovezx.login where dlname = '".$name."';";	//向数据库中添加数据
			$nums = $conne->uidRst($sqls);		
			$sqls=" insert into lovezx.login (dlname,login_id,dltime)values('".$name."','".md5($session_id)."',Now())";	//向数据库中添加数据
			$nums = $conne->uidRst($sqls);		//返回查询结果
			//缺少一个插入的返回值
			echo "<script>alert('登录成功！'); window.location.href='../index.php';</script>";
		}
	}else{
		echo "<script>alert('登录用户名或者密码不能为空！');window.location.href='../login.php'</script>";
	}

}else{
	//没有sub肯定是非法登陆，直接跳转 forbidden
    echo "<script>alert('非法操作，请勿直接访问log_ok！');window.location.href='logout.php'</script>";
}
?>	