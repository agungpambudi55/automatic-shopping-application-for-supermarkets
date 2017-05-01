<?php
	session_start();
	require "config/connection.php";
	require "config/function.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Autrom Market</title>
    <link rel="stylesheet" href="style/style.css" />
    <link rel="shortcut icon" href="style/favicon.png" />
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.easing.js"></script>
    <script type="text/javascript" src="js/jquery.form.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
</head>
<body onload="waktu();">
	<div id="sidebar">
		<div id="logo"></div>
    	<div id="datetime">
            <div id="hr"><?php echo hari(date('D'));?></div>
            <div id="tgl"><?php echo date('d');?></div>
            <div id="waktu"></div>
            <div id="bln_thn"><?php echo bulan(date('m')); echo "<br>"; echo date('Y');?></div>
        </div>
        
		<?php
        if(isset($_SESSION['un']) OR isset($_COOKIE['un'])){
        ?>
		<div id="menu_box">
        	<div id="menu" class="transaksi" onclick="halaman('page/transaksi.php');">Transaksi</div>
        	<div id="menu" class="lokasi" onclick="halaman('page/lokasi_view.php');">Lokasi</div>
        	<div id="menu" class="merk" onclick="halaman('page/merk_view.php');">Merk</div>
        	<div id="menu" class="produk" onclick="halaman('page/produk_view.php');">Produk</div>
        	<div id="menu" class="chart" onclick="new_url('page/chart.aspx')">Chart</div>
        	<div id="menu" class="keluar" onclick="halaman('page/logout.php');">Keluar</div>
        </div>
		<?php
        }
        ?>       
        <div id="footer">
            © <?php echo date("Y");?> - Autrom Market <br /> 
            All Rights Reserved.
        </div>
    </div>
    <div id="loader"><img src="style/loader.gif" width="256" height="256"/></div>
    <div id="content">  
   	          
    </div>
</body>
</html>
<?php require "config/check_session.php"; ?>