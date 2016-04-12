<?php

/**
 * 基础模型类
 */
class Model {
	protected $_db;//所实例化MySQLDB对象

	public function __construct() {
		$this->_initDB();
	}
	/**
	 * 初始化MySQDB类对象
	 */
	protected function _initDB () {
		require_once './framework/MySQLDB.class.php';
		$config = array('host'=>'127.0.0.1', 'user'=>'root', 'pass'=>'root', 'dbname'=>'study');
		$this->_db = MySQLDB::getInstance($config);
	}

}