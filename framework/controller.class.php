<?php

/**
 * 跳转模型类
 *立即跳转使用header
 *提示跳转使用refresh
 *利用用户还是否传递了提示信息
 *功能划分：页面展示，数据处理，流程调度
 */
class controller {

	protected function($url,$info='',$wait=2){
		if ($info===''){
			header('location:'.$url);
		}else{
			echo<<<HTML
<html>
<head>
<title>跳转-$info</title>
<meta http-equiv="refresh" content="$wait;url=$url">
</head>

</html>

		}
	}
	

}