<?php 
    session_start();
    $_SESSION['narac']="cjcx"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link type="text/css" rel="stylesheet" href="css/container.css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $_SESSION['narac']?></title>
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
<div class="container">
  <div class="head" >
    <?php require('head.php');?>
  </div>

<div class="content">

<table id="__01" width="700" border="0" cellpadding="0" cellspacing="0">
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
                                include_once 'tools/conn.php' ;//包含数据库连接类文件  
                                $stuno = $conne->getstuno($_POST["stuno"]);
                                if(is_numeric($stuno)){ 
                                    if($_SESSION['authority']=='管理员'){
                                        //查分
                                        $chafen = true;
                                    }elseif($_SESSION['authority']=='粉丝'){
                                        echo "对不起，您为粉丝，权限不够查分,请待管理员下班后会帮您修改权限!";
                                    }elseif($_SESSION['authority']<100){
                                        if($_SESSION['authority']==floor($stuno%100)){
                                            //查分
                                            $chafen = true;
                                        }else{
                                            echo $stuno."不是您班上的学生";
                                        }
                                    }else{
                                        if($_SESSION['authority']==$stuno){
                                            //查分
                                            $chafen = true;
                                        }else{
                                            echo "您不是".$stuno."的家长，无法查询该生分数";
                                        }
                                    }
                                    if(!empty($chafen)){
                                        $sql ="select stuno,exname,score,bank,extime,exmark 
                                        from lovezx.score,lovezx.examinfo 
                                        where score.stuno = ".$stuno." 
                                        and  score.exid=examinfo.exid";
                                        //+and exname in ('语文','数学')";
                                        $result= $conne->mysql_query_result($sql,true);                                
                                        if(mysqli_num_rows($result)<=0){
                                            echo "未查询到对应该姓名/学号的学生！";
                                        }else{
                                            echo "共查询到&nbsp;".mysqli_num_rows($result)."&nbsp;条考试成绩!";
                                        }
                                    }
                                }else{
                                    echo $stuno;        
                                }
                            }
                            ?>
                        </span>
                    </td>
                </tr>
            </table>
            <?php
                if(@mysqli_num_rows($result)>0){
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
                    ?>
            </table>
            <?php 
            }
            include_once 'tools/conn.php' ;//包含数据库连接类文件
            $conne->close_conn();
            ?>
		</td>
	</tr>
</table>
</div>
</div>
</body>
</html>
