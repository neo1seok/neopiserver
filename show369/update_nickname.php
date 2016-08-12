<?php
include("library.php");  // library.php 파일 포함

$nck_uid = $_REQUEST['id'];
$nickname = $_REQUEST['nickname'];

$sql = "UPDATE nickname SET nickname = '$nickname' where nck_uid = '$nck_uid' ;"		;

echo $sql;
pnl();
QueryString($sql);
// echo "<meta http-equiv='refresh' content='0;url=list.php?optjion=image'>"; 
commBackHome();
?>



