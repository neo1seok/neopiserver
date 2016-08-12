<?php
include("library.php");  // library.php 파일 포함
defMeta();

setHome("");

checkSession();

vewSessionState();
echo "
<SCRIPT language='JavaScript'>
setTimeout('history.go(0);', 20000);
</SCRIPT>

		
		";

$option = $_REQUEST['option'];

$maplist = QueryString2Map("SELECT updt_date FROM history order by seq desc limit 1;");

$date = $maplist[0]['updt_date'];



$sql = "";

if($option != 'image') {
	echo "<h1>LIST</h1>";
	$sql = "SELECT imgid, nickname,nck_uid,stamp FROM nickname where todayin = 'TRUE' order by comment";
}
else {
	echo "<h1>IMAGE LIST</h1>";
	$sql = "SELECT imgid, nickname,nck_uid,stamp FROM nickname where stamp != 'TITLE'";
	
}
$maplist =  QueryString2Map($sql);
echo "\n";

echo "<h2>$date</h2>";
echo "\n";


foreach ($maplist as $v){
	echo "\n";
	$imgid = $v['imgid'];
	$nickname = $v['nickname'];
	$nck_uid= $v['nck_uid'];
	$stamp = $v['stamp'];
		
	$input = "inputname.php?id=$nck_uid";
	$imglink = "http://369am.diskn.com/$imgid";
	$classname = 'normal';
	if($option != 'image') {	
		$msg = '';
		if($stamp == 'TITLE') {
			$msg = "##########";
			echo "<p>=========$nickname=========</p>";
			continue;
		}
		if($stamp == 'TRUE') {
			$msg = "##########"; 
			$classname = 'stamp';
			
			
			//continue;
		}
		echo "<p><a class='$classname' href='$input'>$imgid:$nickname $msg</a></p>";

		//echo "<p><a href='$input'>$imgid:$nickname $msg</a></p>";
		
	}
	else {
		
		echo "<p>NICK:$nickname</p>";
		echo "<p><a href='$input'><img src='$imglink' width = '300'/></a></p>";
		//echo "<img src='http://369am.diskn.com/$imgid' width = '300'/> <br />\n";
		
	}
	
	
}
echo "\n";

if($option != 'image') {
	echo "<p><a><a href='list.php?date=$date&option=image'>전체리스트보기</a></p>";

}

defLink();

vewSessionState();
