<?php
class MySQLDB
{
	private $_host;
	private $_port;
	private $_user;
	private $_pass;
	private $_charset;
	private $_dbname;

	/*单例模式的三私一公*/
	private static $_instance;
	private $_link;//初始化，不定义也行
	private function __construct($option)
	{
		$this->_host = isset($option['host']) ? $option['host']:'localhost';
		$this->_port = isset($option['port']) ? $option['port']:'3306';
		$this->_user = isset($option['user']) ? $option['user']:'';
		$this->_pass = isset($option['pass']) ? $option['pass']:'';
		$this->_charset = isset($option['charset']) ? $option['charset']:'utf8';
		$this->_dbname = isset($option['dbname']) ? $option['dbname']:'';
	
		if ($link = mysql_connect($this->_host.':'.$this->_port,$this->_user,$this->_pass))
		{
			$this->_link = $link;
		}
		else
		{
			echo 'mysql fail';
			die;
		}

		$sql = "set names $this->_charset";//当字符中含有变量时，用双引号
		$this->query($sql);

		if($this->_dbname!=='')
		{
		$sql = "use `$this->_dbname`";
		$this->query($sql);
		}	

	}

	private function __clone(){}

	public static function  getInstance($options=array())
	{
		if(! self::$_instance instanceof self)
		{
			self::$_instance = new self($options);
		}
		return self::$_instance;
		
	}//三私一公结束


	
/*
功能相似，可以集成到一个 自定义函数 内
	$sql = "set names $this->_charset";
	if(!mysql_query($sql,$this->link))
	{
		echo 'sql error';
		echo mysql_error($this->link);//括号内带$this->link;
		echo mysql_errno($this->link);
		die;
	}

	if($this->_dbname!=='')
	{
		$sql = "use `$this->_dbname`";
		if(!mysql_query($sql,$this->link))
		{
			echo 'sql error';
			echo mysql_error($this->link);//括号内带$this->link;
			echo mysql_errno($this->link);
			die;
		}
	}*/
	

	public function query($sql)
	{
		if(!$result=mysql_query($sql,$this->_link))
		{
			echo 'sql error';
			echo mysql_error($this->_link);//括号内带$this->link;
			echo mysql_errno($this->_link);
			return false;
			die;
		}
		else
		{
			return $result;
		}
	}

	public function fetchAll($sql)//返回一个二维数组，每个元素表示一条记录
	{
		if($result=$this->query($sql))
		{
			$rows = array();
			while ($row= mysql_fetch_assoc($result))//一行一行的去遍历
			{
				$rows[] = $row;
				
			}
			mysql_free_result($result);
			return $rows;
			

		}
		else
		{
			return false;
		}
	}
		
	public function fetchRow($sql)//返回一维数组（一行），每个元素表示一条记录
	{
		if($result=$this->query($sql))
		{
			$row = mysql_fetch_assoc($result);
			mysql_free_result($result);
			return $row;
			
		}
		else
		{	echo 'fail';
			return false;
		}
	}

	public function fetchColumn($sql)//返回一维数组，每个元素表示一条记录
	{
		if($result=$this->query($sql))
		{
			$rows= array();			
			while ($row = mysql_fetch_assoc($result))
			{
				$rows[] = implode($row);//!将数组型row转换成一个变量，implode函数是将数组合并成一个变量
				
			}
			mysql_free_result($result);
			return $rows;
			
		}
		else
		{
			return false;
		}
	}


}

/*
$config = array('host'=>'localhost','port'=>'3306','user'=>'root','pass'=>'root','charset'=>'utf8','dbname'=>'study');
$db = new MySQLDB($config);
$sql = 'select * from blog where id=1';
var_dump($db->fetchRow($sql));
*/


