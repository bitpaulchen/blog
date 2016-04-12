<?php
/**
 * 管理员管理控制器类
 */
//
class OperateController {

	/*博客编辑页面*/
	public function edit(){
		include_once  './framework/session.php';
		//调用模型
		require './application/model/blogModel.class.php';
		$model_blog = new blogModel;
		$result = $model_blog->authority();
		if($result){
			$row = $model_blog->editBlog();
			include  './application/view/edit.html';
			}else{
			echo '你没有权限！';
		}

	}

	/*更新博客至数据库*/
	public function update(){
		include_once  './framework/session.php';
		require './application/model/blogModel.class.php';
		$model_blog = new blogModel;
		$result = $model_blog->authority();
		if($result){
			$model_blog->updateBlog();
			echo "<script>alert('更新博客成功，返回主页');window.location.href='./index.php?c=blog&a=mypage'</script>"; 
		}else{
			echo "<script>alert('你没有权限');window.location.href='./index.php?c=blog&a=mypage'</script>"; 
			}
		
	}

	/*博客详情页面*/
	public function detail(){
		include_once  './framework/session.php';
		//调用模型
		
		if(isset($_GET['id']))
		{
			require './application/model/blogModel.class.php';
			$model_blog = new blogModel;
			$row = $model_blog->detailBlog();
			if($row['userid']==$_SESSION['userid']){
			echo "标题：".$row['title']."<br>";
			echo "内容：".$row['content']."<br>";
			echo "时间：".$row['time']."<br>";
			}else{
			echo "你没有权限！";
			}
		}else{
			echo "<script>alert('发生了错误，没有取到id！');window.location.href='./index.php?c=blog&a=mypage'</script>";
		}
	}


	/*创建博客页面*/
	public function create(){
		include_once  './framework/session.php';
		include  './application/view/create.html';
	}

	/*添加博客*/
	public function add(){
		include_once  './framework/session.php';
		require './application/model/blogModel.class.php';

		

		
		$model_blog = new blogModel;
		$model_blog->addBlog();
		echo "<script>alert('新建博客成功，返回主页');window.location.href='./index.php?c=blog&a=mypage'</script>"; 
		
	}

	/*删除博客*/
	public function delete(){
		include_once  './framework/session.php';
		if(isset($_GET['id']))
		{
			require './application/model/blogModel.class.php';
			$model_blog = new blogModel;
			$result = $model_blog->authority();
			if($result){
			$model_blog->deleteBlog();
			echo "<script>alert('删除博客成功，返回主页');window.location.href='./index.php?c=blog&a=mypage'</script>"; 
			}else{
			echo "<script>alert('你没有权限');window.location.href='mypage.php'</script>";
			}
		}else{
  			echo "<script>alert('发生了错误，没有取到需删除的博客id');window.location.href='./index.php?c=blog&a=mypage'</script>";
		}

		
		
	}


}