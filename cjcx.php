<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>数据库、数据表中数据的动态输出</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<style type="text/css">

.STYLE1 {color: #FF0000}

</style>

</head>
<script language="javascript">
 function chkinput(form){
   if(form.stuno.value==""){
     alert("请输入学号!");
     form.stuno.select();
	 return(false);
   }
  return(true);
 }
 

</script>
<body>
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
                    <td width="104" height="25" align="right" size=10>学号：</td>
                    <td width="112" align="left"><input type="text" name="stuno" size="20" class="inputcss" /></td>
                    <td width="150"><input type="submit" name="submit" class="buttoncss" value="查看" /></td>
                </tr>

                </form>
                <tr>
                    <td height="30" colspan="4" align="center">
                        <span class="STYLE1">
                            <?php
                            if(isset($_POST["submit"])!=""){
                                $stuno=$_POST["stuno"];
                                include('conn/conn.php') ;//包含数据库连接类文件
                                $sql ="select stuno,exname,score,bank,extime,exmark 
                                        from lovezx.score,lovezx.examinfo 
                                        where score.stuno = ".$stuno." 
                                        and  score.exid=examinfo.exid";
                                        //+and exname in ('语文','数学')";
                                $result=mysqli_query($conn,$sql);
                                echo "共查询到&nbsp;".mysqli_num_rows($result)."&nbsp;条考试成绩!";
                            }
                            ?>
                        </span>
                    </td>
                </tr>
            </table>
            <?php
                if(@$conn){
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
                            echo "暂无该生信息!";
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
                        mysqli_close($conn);
                    ?>
            </table>
            <?php 
            }
            ?>
		</td>
	</tr>
</table>
</body>
</html>
