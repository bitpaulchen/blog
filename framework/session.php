<?php
session_start();


if(!$_SESSION || $_SESSION['username']==""){
	echo "<script>alert('session超时，请重新登陆！');window.location.href='./index.php'</script>";
	die();
}

?>