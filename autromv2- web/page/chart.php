<?php
	session_start();
	require "../config/connection.php";
	require "../config/function.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Autrom Market</title>
    <link rel="shortcut icon" href="../style/favicon.png" />
    <link rel="stylesheet" href="../style/style.css" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/main.js"></script>

<link rel="stylesheet" type="text/css" href="../js/chart/jquery.jqplot.min.css"  class="include" />
<script type="text/javascript" src="../js/chart/jquery.jqplot.min.js"  class="include"></script>
<script type="text/javascript" src="../js/chart/syntaxhighlighter/scripts/shCore.min.js"></script>
<script type="text/javascript" src="../js/chart/syntaxhighlighter/scripts/shBrushJScript.min.js"></script>
<script type="text/javascript" src="../js/chart/syntaxhighlighter/scripts/shBrushXml.min.js"></script>
<script class="include" language="javascript" type="text/javascript" src="../js/chart/plugins/jqplot.dateAxisRenderer.min.js"></script>
<script class="include" language="javascript" type="text/javascript" src="../js/chart/plugins/jqplot.canvasTextRenderer.min.js"></script>
<script class="include" language="javascript" type="text/javascript" src="../js/chart/plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
<script class="include" language="javascript" type="text/javascript" src="../js/chart/plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script class="include" language="javascript" type="text/javascript" src="../js/chart/plugins/jqplot.barRenderer.min.js"></script>

<script class="code" type="text/javascript">
$(document).ready(function(){
  var line1 = [
<?php
	$sql1 = que("SELECT tb_produk.nama_produk, SUM( tb_transaksi_detail.jumlah ) jumlah
				FROM tb_transaksi, tb_transaksi_detail, tb_produk, tb_kasir
				WHERE tb_transaksi.id_transaksi = tb_transaksi_detail.id_transaksi
				AND tb_transaksi_detail.id_produk = tb_produk.id_produk
				AND tb_transaksi.id_kasir = tb_kasir.id_kasir
				AND tb_transaksi.jenis_transaksi = 'Penjualan'
				GROUP BY tb_produk.nama_produk ORDER BY jumlah DESC");
	while($data1=fetch($sql1)){
		echo "['$data1[nama_produk]', $data1[jumlah]],";		
	}
?>
  ];

  var line2 = [
<?php
	$sql2 = que("SELECT DISTINCT (
				tb_transaksi.id_transaksi
				), tb_kasir.id_kasir, tb_kasir.nama_lengkap, jenis_transaksi, tanggal_waktu, SUBSTR( tanggal_waktu, 1, 10 ) tanggal, 
				SUM( total_harga ) total_harga
				FROM tb_transaksi, tb_transaksi_detail, tb_produk, tb_kasir
				WHERE tb_transaksi.id_transaksi = tb_transaksi_detail.id_transaksi
				AND tb_transaksi_detail.id_produk = tb_produk.id_produk
				AND tb_transaksi.id_kasir = tb_kasir.id_kasir
				AND tb_transaksi.jenis_transaksi = 'Penjualan'
				GROUP BY tanggal
				ORDER BY tanggal_waktu ASC");
	while($data2=fetch($sql2)){
		echo "['".substr($data2['tanggal'],8,2)." ".bulan(substr($data2['tanggal'],5,2))." ".substr($data2['tanggal'],0,4)."', $data2[total_harga]],";		
	}
?>
  ];


  var plot1 = $.jqplot('chart1', [line1], {
    title: 'CHART PRODUK TERLARIS',
    series:[{renderer:$.jqplot.BarRenderer}],
    axesDefaults: {
        tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
        tickOptions: {
          angle: -50,
          fontSize: '10pt'
        }
    },
    axes: {
      xaxis: {
        renderer: $.jqplot.CategoryAxisRenderer
      }
    }
  });

var plot2 = $.jqplot('chart2', [line2], {
    title: 'CHART PENJUALAN PER HARI DALAM SATU BULAN',
    series:[{renderer:$.jqplot.BarRenderer}],
    axesDefaults: {
        tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
        tickOptions: {
          angle: -50,
          fontSize: '10pt'
        }
    },
    axes: {
      xaxis: {
        renderer: $.jqplot.CategoryAxisRenderer
      }
    }
  });
});
</script>  
<style type="text/css">
#title_page{
	font-size:26px;
	text-align:left;
	color:#FFF;
	padding:5px 0px 5px 85px;
	margin-bottom:10px;
	background:url(../style/data.png) 0px -26px no-repeat #025b9b;
	background-size:92px;
}
</style>
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
        	<div id="menu" class="transaksi" onclick="new_url('../');">Transaksi</div>
        	<div id="menu" class="lokasi" onclick="new_url('../');">Lokasi</div>
        	<div id="menu" class="merk" onclick="new_url('../');">Merk</div>
        	<div id="menu" class="produk" onclick="new_url('../');">Produk</div>
        	<div id="menu" class="chart" onclick="">Chart</div>
        	<div id="menu" class="keluar" onclick="new_url('../');">Keluar</div>
        </div>
		<?php
        }
        ?>       
        <div id="footer">
            © <?php echo date("Y");?> - Autrom Market <br /> 
            All Rights Reserved.
        </div>
    </div>
    <div id="content">  
<div id="title_page">CHART</div> 
<div id="chart1" style="height:600px; width:100%;"></div>	          
<div id="chart2" style="height:600px; width:100%; margin-top:50px;"></div>	          
    
    </div>
</body>
</html>