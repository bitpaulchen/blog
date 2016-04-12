<?php
//模型类就是为每张表建一个模型类
/*操作blog表的模型类*/
require_once './framework/Model.class.php';
class blogModel extends Model
{
	/**
	*为每一个针对该表的操作建立一个方法。
	*为每一个sql语句建立一个方法？？
	*/

	//判断合法性
	public function authority(){
		$sql = "SELECT `id` from `blog` where `userid`=".$_SESSION['userid']." and id=".$_REQUEST['id'];
		return $this->_db->fetchRow($sql);
	}



	public function listBlog()
	{
		$sql ="SELECT `id`,`title`,`content`,`time`from `blog` where userid='".$_SESSION['userid']."'";
		return $this->_db->fetchAll($sql);
	}

	public function detailBlog()
	{
		$sql = "SELECT * from  `blog` where id='".$_GET['id']."'";
		return $this->_db->fetchRow($sql);
	}

	public function addBlog()
	{
		$btitle =$_POST['title'];
		$bcontent = $_POST['content'];

		$sql="INSERT INTO blog(title,content,userid,time) VALUES ('".$btitle."','".$bcontent."','".$_SESSION['userid']."',default)";
		return $this->_db->query($sql);
	}

	public function updateBlog()
	{
		$sql="select * from blog where id=".$_POST['id'];
		$row = $this->_db->fetchRow($sql);
		$btitle = $_POST['title'];
		$bcontent = $_POST['content'];
		$sql="update blog set title='".$btitle."',content='".$bcontent."' , time=default where id=".$_POST['id'];
		return $this->_db->query($sql);

	}

	public function editBlog()
	{
			$sql="select * from blog where id=".$_GET['id'];
			return $this->_db->fetchRow($sql);	
	}	

	public function deleteBlog()
	{
		 $sql="delete from blog  where id=".$_GET['id'];
	  	 return $this->_db->query($sql);
	}


}

