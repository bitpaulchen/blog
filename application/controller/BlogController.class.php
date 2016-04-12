<?php
/**
 * 管理员管理控制器类
 */
//
class BlogController {

	/**
	 * 登录表单的展示
	 */
	public function login() {
		//不需要数据

		//展示登录表单模板即可
		include  './application/view/login.html';
	}

	/**
	 * 验证用户信息是否正确
	 */
	public function logincheck() {
		//header('Content-Type: text/html; charset=utf-8');
		session_start();
		//收集表单数据
		$username = $_POST['username'];
		$password = $_POST['password'];
		

		//调用模型，完成数据的验证
		require './application/model/userModel.class.php';
		$model_user = new userModel;
		$row = $model_user->userCheck($username) ;
		
		if($row['username']<>'')
		{
		  if ($row['password']==$password)
		   {
		      $_SESSION['username']=$row['username'];//给session赋值
		      $_SESSION['admin']=$row['admin'];
		      $_SESSION['userid']=$row['userid'];
		      echo "<script>alert('登录成功！');window.location.href='./index.php?c=blog&a=mypage'</script>";
		    }
		  else
		    {
		        echo "<script>alert('密码错误！');window.location.href='./index.php'</script>";
		    }
		}
		else
		{
		   echo "<script>alert('用户名不存在！请注册');window.location.href='index.php'</script>";
		}
		
	}

	/* 主页面展示 */
	public function mypage() {
		//header('Content-Type: text/html; charset=utf-8');
		include_once  './framework/session.php';
		//调用模型，模型的划分：为每一个table建一个Model
		require './application/model/blogModel.class.php';
		$model_blog = new blogModel;
		$list = $model_blog->listBlog();

		include  './application/view/mypage.html';
	}

	

}