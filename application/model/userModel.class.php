<?php
//模型类就是为每张表建一个模型类
/*操作user表的模型类*/
require_once './framework/Model.class.php';
class userModel extends Model
{
	/**
	*为每一个针对该表的操作建立一个方法。
	*为每一个sql语句建立一个方法？？
	*/
	public function userCheck($user_name)
	{
		$sql="SELECT `userid`, `username`,`admin`,`password` FROM `user` WHERE `username`='".$user_name."'";
		return $this->_db->fetchRow($sql);
	}
}
