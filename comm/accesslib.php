<?php
require_once 'commlib.php';
function loginform(){
	echo "
<form method='post' action='login.php'>
<input type='hidden' name='option' value='confirm'/>
<table>
<tr>
	<td>아이디</td>
	<td><input type='text' name='user_id' tabindex='1'/></td>
	<td rowspan='2'><input type='submit' tabindex='3' value='로그인' style='height:50px'/></td>
</tr>
<tr>
	<td>비밀번호</td>
	<td><input type='password' name='user_pw' tabindex='2'/></td>
</tr>
</table>
</form>
			";
}

function logout(){
	$homeurl ='main.php';
	startSession();
	
	vewSessionState();
	
	if(isset($_SESSION['homeurl']) ) {
		$homeurl =$_SESSION['homeurl'];

	}


	session_start();
	session_destroy();
	//echo $homeurl;
	pagego($homeurl);
}
function confirm(){
	if(!isset($_POST['user_id']) || !isset($_POST['user_pw'])) exit;


	$id = $_POST['user_id'];
	$pwd = $_POST['user_pw'];


	$sql = sprintf("SELECT rn,pwd,name FROM user where id='%s';",$id);


	echo $sql;
	echo "2 <br />\n";


	$res = QueryString($sql);

	if(!isset($res)){
		echo "<script>alert('아이디 가 잘못되었습니다.');history.back();</script>";
		exit;

	}

	$cmppwdhash = strtoupper(hash('sha256', $pwd . $res[0]));

	if( $cmppwdhash != $res[1]){
		echo "<script>alert('아이디 또는 패스워드가 잘못되었습니다.');history.back();</script>";
		exit;

	}

	startSession();
	appendLn("로그인 성공");
	$_SESSION['user_id'] = $id;
	$_SESSION['user_name'] = $res[2];

	commBackHome();
}
