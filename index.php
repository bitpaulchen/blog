<?php
header('Content-Type: text/html; charset=utf-8');


$c = isset($_GET['c']) ? $_GET['c'] : 'blog';//$c代表所调用的控制器类，本demo里只建了一个控制器类->blogcontroller.class
$c = ucfirst($c);
$a = isset($_GET['a']) ? $_GET['a'] : 'login';

$c_file = './application/controller/'.$c.'Controller.class.php';
require $c_file;
$c_name = $c.'Controller';
$controller = new $c_name;
$controller->$a();

?>