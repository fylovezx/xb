<?php
class opmysql{
	private $host = '106.15.90.17';			//服务器地址
	private $name = 'cjcx';					//登录账号
	private $pwd = '1234';					//登录密码
	private $dBase = 'lovezx';		//数据库名称
	private $conn = '';						//数据库链接资源
	private $result = '';					//结果集
	private $msg = '';						//返回结果
	private $fields;						//返回字段
	private $fieldsNum = 0;					//返回字段数
	private $rowsNum = 0;					//返回结果数
	private $rowsRst = '';					//返回单条记录的字段数组
	private $filesArray = array();			//返回字段数组
	private $rowsArray = array();			//返回结果数组
	//初始化类
	function __construct($host='',$name='',$pwd='',$dBase=''){
		if($host != '')
			$this->host = $host;
		if($name != '')
			$this->name = $name;
		if($pwd != '')
			$this->pwd = $pwd;
		if($dBase != '')
			$this->dBase = $dBase;
		$this->init_conn();
	}
	//连接数据库
	function init_conn(){
        $this->conn=new mysqli($this->host,$this->name,$this->pwd);
		@mysqli_select_db($this->conn,$this->dBase);
		$this->conn->query("set names utf-8");
	}
	//查询结果
	function mysql_query_result($sql){
		if($this->conn == ''){
			$this->init_conn();
		}
		$this->result = mysqli_query($this->conn,$sql);
		return $this->result;
	}
	//取得字段数 
	function getFieldsNum($sql){
		$this->mysql_query_result($sql);
		$this->fieldsNum = @mysqli_num_rows($this->result);
	}
	//取得查询结果数
	function getRowsNum($sql){
		$this->mysql_query_result($sql);
		if(!mysqli_connect_error()){
			return @mysqli_num_rows($this->result);
		}else{
			return '';
		}	
	}
	//取得记录数组（单条记录）
	function getRowsRst($sql){
		$this->mysql_query_result($sql);
		if(!mysqli_connect_error()){
			$this->rowsRst = mysqli_fetch_array($this->result,MYSQL_ASSOC);
			return $this->rowsRst;
		}else{
			return '';
		}
	}
	//取得记录数组（多条记录）
	function getRowsArray($sql){
		$this->mysql_query_result($sql);
		if(!mysqli_connect_error()){
			while($row = mysqli_fetch_array($this->result,MYSQL_ASSOC)) {
				$this->rowsArray[] = $row;
			}
			return $this->rowsArray;
		}else{
			return '';
		}
	}
	//返回更新、删除、添加记录数
	function uidRst($sql){
		if($this->conn == ''){
			$this->init_conn();
		}
		@mysqli_query($this->conn,$sql);
		$this->rowsNum = @mysqli_affected_rows($this->conn);
		if(!mysqli_connect_error()){
			return $this->rowsNum;
		}else{
			return '';
		}
	}
	//获取对应的字段值
	function getFields($sql,$fields){
		$this->mysql_query_result($sql);
		if(!mysqli_connect_error()){
			if(mysqli_num_rows($this->result) > 0){
				$tmpfld = @mysqli_fetch_row($this->result);
				$this->fields = $tmpfld[$fields];
				
			}
			return $this->fields;
		}else{
			return '';
		}
	}
	
	//错误信息
	function msg_error(){
		if(!mysqli_connect_errno()) {
			$this->msg =mysqli_connect_errno();
		}
		return $this->msg;
	}
	//释放结果集
	function close_rst(){
		@mysqli_free_result($this->result);
		$this->msg = '';
		$this->fieldsNum = 0;
		$this->rowsNum = 0;
		$this->filesArray = '';
		$this->rowsArray = '';
	}
	//关闭数据库
	function close_conn(){
		$this->close_rst();
		mysqli_close($this->conn);
		$this->conn = '';
    }
    

    function getstuno($name)
{
    if(is_numeric($name)){
        return $name;
    }else
    {
		$s = iconv("UTF-8", "GB2312//IGNORE", $name) ;
        $sql ="select num from lovezx.namelist where name='".strtoupper(md5($s))."' or name ='".strtolower(md5($s))."'";
		$this->mysql_query_result($sql);
		
        switch (mysqli_num_rows($this->result))
        {
        case 0:
            return "未查询到对应该名字的学生！";
            break;
        case 1:
            $info=mysqli_fetch_array($this->result,MYSQLI_ASSOC);
            $num = $info["num"];
            return  $num;
            break;
        default:
            return "该名称有重名，请您输入学号进行查询";
            break;
        }
    }
}
}
$conne = new opmysql();
?>