<meta charset="utf-8" />
<?php
session_start(); 
session_destroy();
echo "<script>alert('成功退出!');window.location.href='index.php';</script>";

?>

