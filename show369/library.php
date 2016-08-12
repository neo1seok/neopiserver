<?php
require_once("../comm/library.php");  // library.php 파일 포함


function defLink(){
	
	$maparray = array(
	    "리스트"=>"list.php",
		 "이미지리스트"=> "list.php?option=image",
			"BACK"=> "javascript:history.back()",
			"로그아웃"=> "login.php?option=logout",
			
 	);
	
	MakeLink($maparray);
// 	echo "\n";
// 	echo "<ul>";
// 	echo "\n";
// 	echo "<lis class='st'><a href='list.php'>매인화면</a></lis>";
// 	echo "\n";
// 	echo "<lis class='st'><a href='list.php?option=image'>매인화면</a></lis>";
// 	echo "\n";
// 	echo "<li><a href='javascript:history.back()'>back</a></li>";
// 	echo "\n";
// 	echo "<li><a href='login.php?option=logout'>로그아웃</a></li>";
// 	echo "\n";
// 	echo "</ul>";
// 	echo "\n";

}
?>	