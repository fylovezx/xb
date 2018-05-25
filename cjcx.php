<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link type="text/css" rel="stylesheet" href="css/head.css" />
<title>成绩查询</title>
<style type="text/css">
.STYLE1 {color: #FF0000}
</style>

</head>
<script language="javascript">
 function chkinput(form){
   if(form.stuno.value==""){
     alert("请输入学号/姓名!");
     form.stuno.select();
	 return(false);
   }
  return(true);
 }
</script>
<body>
<ul class="sidenav">
  <li><a href="index.php">主页</a></li>
  <li><a class="active" href="cjcx.php">成绩查询</a></li>
  <li><a href="connect.php">联系</a></li>
  <li><a href="about.php">关于</a></li>
</ul>
<div class="content">

<table id="__01" width="900" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
            <table width="567" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td colspan="4">&nbsp;</td>
                </tr>
                <!-- 提交学号表单 -->
                <form name="form1" method="post" action="cjcx.php" onsubmit="return chkinput(this)">
                <tr>
                    <td width="104" height="25" align="right" size=10>学号/姓名：</td>
                    <td width="112" align="left"><input type="text" name="stuno" size="20" class="inputcss" /></td>
                    <td width="150"><input type="submit" name="submit" class="buttoncss" value="查看" /></td>
                </tr>

                </form>
                <tr>
                    <td height="30" colspan="4" align="center">
                        <span class="STYLE1">
                            <?php
                            if(isset($_POST["submit"])!=""){
                                include('conn/conn.php') ;//包含数据库连接类文件  
                                include('tools/md5.php');
                                $stuno = getstuno($_POST["stuno"],$conn);
                                if(is_numeric($stuno)){       
                                    $sql ="select stuno,exname,score,bank,extime,exmark 
                                            from lovezx.score,lovezx.examinfo 
                                            where score.stuno = ".$stuno." 
                                            and  score.exid=examinfo.exid";
                                            //+and exname in ('语文','数学')";
                                    $result=mysqli_query($conn,$sql);                                    
                                    if(mysqli_num_rows($result)<=0){
                                        $stuexist = false;
                                        echo "未查询到对应该姓名/学号的学生！";
                                    }else{
                                        $stuexist = true;
                                        echo "共查询到&nbsp;".mysqli_num_rows($result)."&nbsp;条考试成绩!";
                                    }
                                }else{
                                    $stuexist = false;
                                    echo $stuno;        
                                }
                            }
                            ?>
                        </span>
                    </td>
                </tr>
            </table>
            <?php
                if(@$stuexist){
            ?> 
            <table width="550" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#FFCC33">
                <tr>
                        <?php 
                            for($i=0; $i<mysqli_num_fields($result);$i++){
                                $obj=mysqli_fetch_field($result);
                        ?>
                    <td height="25" bgcolor="#FFFFFF" ><div align="center"><?php echo $obj->name;?></div></td>
                        <?php 
                            }
                        ?> 
                </tr>
                    <?php
                        $info=mysqli_fetch_array($result,MYSQLI_NUM);
                        if($info==NULL){
                            //这个在上面已经处理过了
                        }else{
                            do{
                    ?>
                <tr>
                            <?php 
                                for($i=0; $i<mysqli_num_fields($result);$i++){		  
                            ?>
                    <td height="25" bgcolor="#FFFFFF"><div align="center"><?php echo $info[$i];?></div></td>
                            <?php 
                                }
                            ?>
                </tr>
                    <?php
                            }while($info=mysqli_fetch_array($result,MYSQLI_NUM));
                        }
                       
                    ?>
            </table>
            <?php 
            }
            @mysqli_close($conn);
            ?>
		</td>
	</tr>
</table>
</div>
</body>
</html>
