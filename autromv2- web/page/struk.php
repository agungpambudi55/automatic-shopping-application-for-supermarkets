<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->
<title>Autrom Market</title>
<link rel="shortcut icon" href="../style/favicon.png" />
<style type="text/css">
*{
	line-height:20px;
	padding:0px;
	margin:0px;
	font-size:13px;
	text-transform:uppercase;
}
#header{
	margin:10px 0px;
	border-bottom:2px dashed #000;
	padding-top:10px;
	padding-bottom:10px; 
}
#data_1{
	padding:10px 0px;	
	margin:10px 0px;
	border-top:2px dashed #000; 
}
</style>
</head>
<body>
<?php
	require "../config/connection.php";
	require "../config/function.php";
		
	$id_transaksi = $_GET['id'];
	$bayar = $_GET['bayar'];
	$qry1 = que("SELECT * FROM tb_transaksi, tb_transaksi_detail, tb_produk, tb_kasir
				WHERE tb_transaksi.id_transaksi = tb_transaksi_detail.id_transaksi
				AND tb_transaksi_detail.id_produk = tb_produk.id_produk
				AND tb_transaksi.id_kasir = tb_kasir.id_kasir
				AND tb_transaksi.id_transaksi = $id_transaksi
				ORDER BY tanggal_waktu DESC");	
	$qry2 = que("SELECT * FROM tb_transaksi, tb_transaksi_detail, tb_produk, tb_kasir
				WHERE tb_transaksi.id_transaksi = tb_transaksi_detail.id_transaksi
				AND tb_transaksi_detail.id_produk = tb_produk.id_produk
				AND tb_transaksi.id_kasir = tb_kasir.id_kasir
				AND tb_transaksi.id_transaksi = $id_transaksi
				ORDER BY tanggal_waktu DESC");
	$data2 = fetch($qry2);
?>
<div style="text-align:center">
    AUTROM MARKET<br />
    JL. RAYA ITS<br />
    SUKOLILO, SURABAYA, 64111
</div>

<table width="100%" border="0" cellspacing="0" id="header">
  <tr>
    <td width="33.33%" align="left">TANGGAL</td>
    <td width="33.33%" align="center">WAKTU</td>
    <td width="33.33%" align="right">KASIR</td>
  </tr>
<tr>
    <td align="left"><?php echo substr($data2['tanggal_waktu'],8,2)." ".bulan(substr($data2['tanggal_waktu'],5,2))." ".substr($data2['tanggal_waktu'],0,4);?></td>
    <td align="center"><?php echo substr($data2['tanggal_waktu'],11,8);?></td>
    <td align="right">AGUNG PAMBUDI</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0">
	<?php
    
        $tohar=0;
        $item=0;
        while($data1 = fetch($qry1))
        {
            $tot = $data1['jumlah'] *  $data1['harga'];
            echo "<tr>
                    <td width='75%'>$data1[nama_produk]</td>
                    <td width='5%' align='center'>$data1[jumlah]</td>
                    <td width='10%' align='right'>".struk($data1['harga'])."</td>
                    <td width='10%' align='right'>".struk($tot)."</td>
                  </tr>";	
                  $tohar+=$tot;
                  $item+=$data1['jumlah'];
        }
    ?>
</table>

<table width="100%" border="0" cellspacing="0" id="data_1">
<?php
	echo "<tr>
			<td width='75%' align='left'>TOTAL</td>
			<td width='5%' align='center'>$item ITEM</td>
			<td width='10%'align='right'>&nbsp;</td>
			<td width='10%'align='right' style='text-transform:capitalize'>Rp. ".struk($tohar)."</td>
		  </tr>";
	echo "<tr>
			<td width='75%' align='left'>BAYAR</td>
			<td width='5%' align='center'>&nbsp;</td>
			<td width='10%'align='right'>&nbsp;</td>
			<td width='10%'align='right' style='text-transform:capitalize'>Rp. ".struk($bayar)."</td>
		  </tr>";
	echo "<tr>
			<td width='75%' align='left'>KEMBALI</td>
			<td width='5%' align='center'>&nbsp;</td>
			<td width='10%'align='right'>&nbsp;</td>
			<td width='10%'align='right' style='text-transform:capitalize'>Rp. ".struk($bayar-$tohar)."</td>
		  </tr>";
?>
</table>
<p align="center">BARANG YANG SUDAH DIBELI TIDAK DAPAT DIKEMBALIKAN KECUALI ADA PERJANJIAN</p>
</body>
</html>