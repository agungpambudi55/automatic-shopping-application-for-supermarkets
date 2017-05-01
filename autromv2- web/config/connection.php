<?php
	$connect  = mysql_connect("localhost","root","");
	$db 	  = mysql_select_db("db_autrom");
	if(!$db) { die("koneksi database gagal!");}
?>