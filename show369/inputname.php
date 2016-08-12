<?php
include("library.php");  // library.php 파일 포함
defMeta();
//setHome("");

checkSession();

$uid = $_REQUEST['id'];

$maplist = QueryString2Map("SELECT nck_uid,imgid,nickname,stamp FROM nickname where nck_uid = '$uid';");
$imgid = $maplist[0]['imgid'];
$nickname = $maplist[0]['nickname'];
$stamp = $maplist[0]['stamp'];


if($stamp == 'TITLE'){
	
	echo "<script>alert('$nickname아이디 는 고칠수 있는 ID 가 아닙니다.');history.back();</script>";
	exit();
}

echo "<img src='http://369am.diskn.com/$imgid' width = '300'/> <br />\n";

 ?>
 

<script type="text/javascript">

function onloadpage(){

function onInputSubmit(item) {
	console.log("onsubmit");
	//$dbcompare = $phd_uid."".$site."".$ptail."".$id."".$etc."".$title."".$hint;
	var nickname = '<?php echo $nickname; ?>'
	

	if (nickname != '') {
		alert("변경된 내용이 없습니다.");
		return false;
	}
	return true;
}

	
</script>
<form name = 'input' method='post' action='update_nickname.php'">

<input type='hidden' name='option'  readonly value='' />
<input type='hidden' name='id' tabindex='1' value='<?php echo $uid; ?>' />


<table>

<tr>
	<td>IMGID</td>
	<td><input type='text' name='imgid' readonly tabindex='1' value='<?php echo $imgid; ?>' /></td>
</tr>
<tr>
	<td>NICK NAME</td>
	<td><input type='text' name='nickname' tabindex='2' value='<?php echo $nickname; ?>' /></td>
</tr>

</table>

<input type='submit' tabindex='3' value='UPDATE' style='height:50px'/>
</form>
<?php defLink(); ?>;