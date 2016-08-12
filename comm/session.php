<?php
require_once 'commlib.php';
function startSession(){
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
}
function checkSession(){


	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	}
	if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
		pagego('login.php');
		exit;
	}
	$user_id = $_SESSION['user_id'];
	$user_name = $_SESSION['user_name'];
	
	//appendLnBr($_SERVER['REQUEST_URI']);
	//appendLnBr($_SERVER['QUERY_STRING']);


	echo "<p>안녕하세요. $user_name($user_id)님</p>";

}


function setHome($url){
	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	}
	if($url==''){
		$url = $_SERVER['REQUEST_URI'];
	}
	
	$_SESSION['homeurl'] = $url;

}
function commBackHome(){
	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	}

	
	$homeurl ='main.php';
	if(isset($_SESSION['homeurl']) ) {
		$homeurl =$_SESSION['homeurl'];
		
	}
	pagego($homeurl);

}
function vewSessionState(){
	return ;
	echo ("session state:");
	appendLnBr(session_status());
	echo( "PHP_SESSION_ACTIVE:");
	appendLnBr( PHP_SESSION_ACTIVE);
	echo( "PHP_SESSION_NONE:");
	appendLnBr( PHP_SESSION_NONE);
}