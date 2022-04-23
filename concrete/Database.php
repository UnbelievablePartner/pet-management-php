<?php
//数据库连接类
class Database
{
	//主机地址
	static $host="127.0.0.1";
	//数据库名
	static $dbname="petmanage";
	//数据库账号
	static $user="root";
	//static $user="sql_pet_management";
	
	//数据库密码
	static $password="123456";
	//static $password="e2NfwneEmbrZCCpF";

	//数据库连接
	public $conn;
	
	//析构函数关闭数据库连接
	public function __distruct()
	{
		if($this->conn)
		{
			@$this->conn->close();
		}
	}
	
	//连接数据库的方法
	public function open()
	{
		$this->conn=@new mysqli(self::$host, self::$user, self::$password, self::$dbname);
		//判断连接是否有错误($this->conn->connect_errno)
		if(mysqli_connect_errno())
		{
			return false;
		}
		
		//设置中文字符
		$this->conn->query("SET NAMES utf8");
		
		return true;
	}
}

?>