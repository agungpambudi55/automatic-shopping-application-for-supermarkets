<?php
session_start();
require "../config/connection.php";
require "../config/function.php";
$quser = que("SELECT * FROM tb_kasir WHERE username='".$_POST['un']."'");
if(num($quser) == 1) {
	$user	 = fetch($quser);
	if(md5($_POST['pw']) == $user['password']) {
		if($_POST['pakecookie']=="iya")
		{ setcookie("un",$user['username'],time()+7*24*3600); }
		else
		{ $_SESSION['un'] = $user['username']; }
		echo "1";
	}
	else
	{ echo "0"; }
}
else
{ echo "0"; }
sleep(1);
?>