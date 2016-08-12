<?php




function pagego($url){

	//header("Location: /$url");
	echo "<meta http-equiv='refresh' content='0;url=$url'>";
	echo "\n";
}
function getcurpage(){
	return $_SERVER['REQUEST_URI'];
}

function appendLn($str){
	echo $str;
	echo "\n";	
}
function appendLnBr($str){
	echo $str;
	pnl();
}
function pnl(){
	echo "<br />\n";
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

function MakeLink($linkarray){
	echo "\n";
	echo "<ul>";
	echo "\n";
	foreach ($linkarray as $k => $v ){
		echo "<li class='st'><a href='$v'>$k</a></li>";
	}
	echo "\n";
	echo "</ul>";
	echo "\n";

}

?>	