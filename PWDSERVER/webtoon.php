<?php
include ("library.php"); // library.php 파일 포함
defMeta();
//checkSession ();

$yoil = array("일","월","화","수","목","금","토");
$curyoil = $yoil[date('w')];

echo '오늘은'. $yoil[date('w')].'요일 입니다. ';
pnl();


function viewWebtoonLink($curyoil){
	$sql = "SELECT title, id, B.date FROM neo_pwinfo.webtoon A , date_webtoon B where A.wtn_uid = B.wtn_uid and B.date = '".$curyoil."';";
	 
			
			
	$todaywebtoonMap = QueryString2Map($sql);
	
	echo "<h3>오늘의 목록</h3>";
	
	
	foreach ($todaywebtoonMap as $v){
		echo "<p>".getnaverWebtoollink($v['id'],$v['title'])."</p>";
	
	}
	
	
	
	
	
	$totalwebtoonMap = QueryString2Map("SELECT id,title FROM webtoon;");

	echo "<h3>전체 목록</h3>";
	
	foreach ($totalwebtoonMap as $v){
		echo "<p>".getnaverWebtoollink($v['id'],$v['title'])."</p>";
	
	}


}


function viewWebtoonLink_OLD($curyoil){
	$maptitle = array(
			"675554"=>"가우스전자 시즌3",
	
			"674209"=>"스퍼맨",
			"665170"=>"귀도호가록",
			"22897"=>"호랭총각",
	
			"675830"=>"MZ",
			"21815"=>"히어로메이커",
	
			"25455"=>"노블레스",
			"409629"=>"죽은 마법사의 도시",
	
			"662774"=>"고수",
			"665618"=>"웃지 않는 개그반 시즌3",
			"643123"=>"녹두전",
	
			"570506"=>"최강전설 강해효",
			"679544"=>"문유",
			"675829"=>"동네변호사 조들호 시즌2",
			"160469"=>"특수 영능력 수사반",
	
			"641253"=>"외모지상주의",
			"675393"=>"한번 더 해요",
	
			"670139"=>"부활남",
	
	);
	
	$links = array(
			"일"=>array('674209','665170','22897'),
			"월"=>array('675830','21815'),
			"화"=>array('25455','409629'),
			"수"=>array("662774","665618","643123"),
			"목"=>array("570506","679544","675829","160469"),
			"금"=>array("641253","675393"),
			"토"=>array("670139")
	
	);
	echo "<h3>오늘의 목록</h3>";
	foreach ( $links[$curyoil] as $k){
		echo "<p>".getnaverWebtoollink($k,$maptitle[$k])."</p>";

	}

	echo "<h3>전체 목록</h3>";
	foreach ($maptitle as $k => $v){
		echo "<p>".getnaverWebtoollink($k,$v)."</p>";

	}


}





viewWebtoonLink($curyoil);

echo "<li><a href='javascript:history.back()'>back</a></li>";
echo "\n";


?>

