﻿<?php


function connect(){
	$dbname = "neo_pwinfo";
	
	//Connect DB
	$connect = @mysql_connect("localhost:3306","neo1seok","tofhdna1pi") or die("DB접속에러");
	
	//Select DB
	@mysql_select_db($dbname,$connect) or die("DB선택에러");
	
	return $connect ;
	
}

function QueryString($strQuery){
	
// 	$dbname = "neo_pwinfo";

// 	//Connect DB
// 	$connect = @mysql_connect("localhost:3306","neo1seok","tofhdna1pi") or die("DB접속에러");

// 	//Select DB
// 	@mysql_select_db($dbname,$connect) or die("DB선택에러");
	
	$connect = connect();

	//Print Query Result
	$result = @mysql_query($strQuery) or die("SQL error=>" .$strQuery);
	
	$data=@mysql_fetch_row($result);
	
	mysql_close($connect);
	
	return $data;

} 


function QueryString2Map($strQuery){

	//$dbname = "neo_pwinfo";


// 	//Connect DB
// 	$connect = @mysql_connect("localhost:3306","neo1seok","tofhdna1pi") or die("DB접속에러");

// 	//Select DB
// 	@mysql_select_db($dbname,$connect) or die("DB선택에러");
	
	//echo $strQuery;
	
	$connect = connect();

	//Print Query Result
	$result = @mysql_query($strQuery) or die("SQL error=>".$strQuery);

	$stack = array();
	$return = array();
	
	


	while($field=@mysql_fetch_field ($result)){
		array_push($stack, $field->name);
	}
	
	// 데이터 출력
	while($data=@mysql_fetch_row($result)){
		$mapret = array();
		$uid = $data[0];
		for($i=0;$i<(count($data));$i++){
		
			$mapret[$stack[$i]] = $data[$i];
		}
		array_push($return,$mapret);
		
	}
	
	//echo json_encode($return);
	mysql_close($connect);
	return $return;

}

function getMapFromResultDB($keyname,$valuename,$maplist){
	//echo 'getMapFromResultDB';
	//pnl();
	$mapresult = array();
	
	foreach($maplist as $v){
	
		$key = $v[$keyname];
		$value = $v[$valuename];
		$mapresult[$key] = $value;
		//echo $key; 
		//pnl();
	}
	return $mapresult; 
}
function getNextSeq($tablename){
	$maplist =  QueryString2Map("select COALESCE(max(seq),0)+1 as nextseq from $tablename");
	
	$nextseq = $maplist[0]['nextseq'];
	
	return $nextseq;
}
function getIdsInputForm($uidarray){

	$imgids ='';
	$i =0;
	foreach ($uidarray as $v){
		if($i>0) $imgids .= ',';
		$imgids .= "'".$v."'";
		$i++;
	}
	return $imgids;

}
function viewQueryResult($mapvalue){

	
	// 테이블 시작
	echo "\n";
	echo "<table border>";
	echo "\n";
	// 머릿글 출력
	echo "<tr>";
	echo "\n";
	
	
	
	if(count($mapvalue) == 0){
		echo "<th>";
		echo "NO RESULT";
		echo "</th>";

		echo "</tr>";
		echo "\n";
		echo "</table>";
		echo "\n";
	
		return ;
	}
	
	$title = array(
		'site'=>'사이트',
		'title'=>'헤더이름',
		'ptail'=>'태일이름',
				
	);
	$ignoretitle = array(
			'pwd_uid',
			'phd_uid',
	
	);



	foreach ($mapvalue[0] as $k => $v) {
		if (in_array($k, $ignoretitle)) {
			continue;
		}
		
		echo "<th>";
		echo $title[$k];
		echo "</th>";
		

	}
	//echo "<td>수정</td>";
	echo "</tr>";
	echo "\n";

	foreach ($mapvalue as $value) {
		echo "<tr>";
		$uid = $value['pwd_uid'];
		$phd_uid = $value['phd_uid'];
		$site = $value['site'];
		foreach ($value as $k => $v) {
			if (in_array($k, $ignoretitle)) {
				continue;
			}
			
			
			if($k=='site'){
				echo "<td><a href='update.php?uid=$uid'>$v</a></td>";
				continue;
				
				
			}
			if($k=='title'){
				echo "<td><a href='viewheader.php?uid=$phd_uid'>$v</a></td>";
				continue;
			
			
			}
			echo "<td>";
			echo $v;
			echo "</td>";
				

		}
		echo "</tr>";
		echo "\n";
	}



	// 테이블 끝
	echo "</table>";
	echo "\n";



}


function viewQueryResult_OLD($dbname,$strQuery){

	//Connect DB
	$connect = @mysql_connect("localhost:3306","neo1seok","tofhdna1pi") or die("DB접속에러");

	//Select DB
	@mysql_select_db($dbname,$connect) or die("DB선택에러");

	//Print Query Result
	$result = @mysql_query($strQuery) or die("SQL error");

	$stack = array();

	// 테이블 시작
	echo "<table border>";




	// 머릿글 출력
	echo "<tr>";
	while($field=@mysql_fetch_field ($result)){
		echo "<th>";
		//print_r($field);
		array_push($stack, $field->name);
		echo $field->name;
		echo "</th>";
	}
	//echo "<td>수정</td>";
	echo "</tr>";




	// 데이터 출력
	while($data=@mysql_fetch_row($result)){

		echo "<tr>";
		$uid = $data[0];
		for($i=0;$i<(count($data));$i++){

			if($i==0){
				echo "<td><a href='update.php?uid=$uid'>$uid</a></td>";
			}
			else{
				echo "<td>";
				echo $data[$i];
				echo "</td>";
			}


		}

		//echo "<td><a href='update.php?uid=$uid'>수정</a></td>";

		echo "</tr>";
	}

	// 테이블 끝
	echo "</table>";

	print_r($stack);


}
function pagego($url){
	echo "<meta http-equiv='refresh' content='0;url=$url'>";
}
function checkSession(){
	
	
	session_start();
	if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
		echo "<meta http-equiv='refresh' content='0;url=login.php'>";
		exit;
	}
	$user_id = $_SESSION['user_id'];
	$user_name = $_SESSION['user_name'];
	
	
	echo "<p>안녕하세요. $user_name($user_id)님</p>";
	
}
function processNoresult($title){
	echo "No Result";
	echo "<br />\n";
	
	echo '<a href="javascript:history.back()">back</a>';
	
	exit;

}

function pnl(){
	echo "<br />\n";
}
function defLink(){
	echo "\n";
	echo "<ul>";
	echo "\n";
	echo "<lis class='st'><a href='main.php'>매인화면</a></lis>";
	echo "\n";
	echo "<li><a href='javascript:history.back()'>back</a></li>";
	echo "\n";
	echo "<li><a href='logout.php'>로그아웃</a></li>";
	echo "\n";
	echo "</ul>";
	echo "\n";
	
}
function defMeta(){
	echo '<!DOCTYPE html>';
	echo "\n";
	echo '<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">';
	echo "\n";
	echo '<meta charset="utf-8" />';
	echo "\n";
	echo '<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width, height=device-height">';
	echo "\n";
	
	echo '<head>';
	echo "\n";
	echo '<link rel="stylesheet" type="text/css" href="css/style.css">';
	echo "\n";
	echo '</head>';
	echo "\n";
	
}

function getnaverWebtoollink($id,$title){
	return "<a href='http://comic.naver.com/webtoon/list.nhn?titleId=$id'>$title</a>";
}

?>	