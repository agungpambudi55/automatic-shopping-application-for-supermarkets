<?php
	session_start();
	$_SESSION['un']="";
	session_destroy();

	if(isset($_COOKIE['un']))
	{setcookie("un",$_COOKIE['un'],time()-7*24*3600);}
	$kasir = "";
	echo "<script>window.setTimeout('window.location=\"\"; ',0);</script>";
?>