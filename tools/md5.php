
<?php
    
function getstuno($name,$conn)
{
    if(is_numeric($name)){
        return $name;
    }else
    {
        $s = iconv("UTF-8", "GB2312//IGNORE", $name) ;
        $str = strtoupper(md5($s));
        $sql ="select num from lovezx.namelist where name='".$str."'";
        
        $result=mysqli_query($conn,$sql);//switch (0)
        switch (mysqli_num_rows($result))
        {
        case 0:
            return "未查询到对应该名字的学生！";
            break;
        case 1:
            $info=mysqli_fetch_array($result,MYSQLI_ASSOC);
            $num = $info["num"];
            return  $num;
            break;
        default:
            return "该名称有重名，请您输入学号进行查询";
            break;
        }
    }
}

?>