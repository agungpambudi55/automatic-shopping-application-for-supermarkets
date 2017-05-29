<?php
	session_start();
	if(isset($_SESSION['un']) OR isset($_COOKIE['un'])){
		if(isset($_SESSION['un']))
		{ $un = $_SESSION['un']; }
		else
		{ $un = $_COOKIE['un']; }			
		
		$cekuser = que("SELECT * FROM tb_kasir WHERE username='".$un."'");
		if(num($cekuser) != 1)
		{ echo "<script>halaman('page/login.php');</script>"; }
		else
		{ 
		  $user = fetch($cekuser);        
		  echo "<script>halaman('page/transaksi.php');</script>";
		}
	}
	else
	{ echo "<script>halaman('page/login.php');</script>"; }

?>