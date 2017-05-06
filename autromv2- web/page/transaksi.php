<script src="js/jquery-ui.js"></script>
<style type="text/css">
#title_page{
	font-size:26px;
	text-align:left;
	color:#FFF;
	padding:5px 0px 5px 85px;
	margin-bottom:10px;
	background:url(style/data.png) 0px -26px no-repeat #025b9b;
	background-size:92px;
}
#input{
	width:280px;
	padding:8px 25px 8px 5px;
	background:url(style/icon.png) 291px -144px no-repeat #FFF;
	box-shadow:none;
}
.notification {
	background:#025b9b;
	border-radius:1px;
	color:#FFF;
	font-size:13px;
	margin-left:10px;
	margin-top:4px;
	position: absolute; 
	display: none;
	padding:5px;
}
.notification:before {
	content: "\25C0";
	color:#025b9b;
	position: absolute;
	top:3px;
	left:-9px;
}
#input:focus + .notification,#select:focus + .notification  {
	display: inline;
}
#input_readonly{
	width:280px;
	padding:8px 25px 8px 5px;
	border:1px solid #CCC;
	background:url(style/icon.png) 287px -175px no-repeat #FFF;
}
#input:required:valid{
	background:url(style/icon.png) 287px -175px no-repeat #FFF;
	border:1px solid #F90;
	transition:all ease-in 0.3s
}

#input:focus{
	border:1px solid #0084E6;
	background:url(style/icon.png) 285px -144px no-repeat #FFF;
	transition:all ease-in 0.3s
}
#input:required{	
	border:1px solid #333;
}
#input:hover, #input_readonly:hover{
	border:1px solid #0084E6;
}
#select:required{
	width:312px;
	padding:8px 25px 8px 5px;
	border:1px solid #333;
	background:url(style/icon.png) 275px -144px no-repeat #FFF;
}
#select:required:invalid{
	box-shadow:none;
}
#select:required:valid{
	box-shadow:none;
	background:url(style/icon.png) 270px -175px no-repeat #FFF;
	transition:all ease-in 0.3s;
	border:1px solid #F90;
}
#select option{padding-left:9px;}
#select:focus{
	box-shadow:none;
	background:url(style/icon.png) 270px -144px no-repeat #FFF;
	border:1px solid #0084E6;
	transition:all ease-in 0.3s}
#select:hover{ border:1px solid #0084E6; }
#radio{ box-shadow:none; }
#radio:focus{ box-shadow:none; }
.btn{
	padding:10px 20px;
	background:#333;
	color:#FFF;
	border:0px solid #333;
	cursor:pointer;
}
.btn:hover{
	background:#025b9b;
}
.notif{
	text-align:center;
	color:#FFF;
	padding:10px;
	margin-bottom:10px;
}
.ui-widget {
	list-style:none;
	margin:0;
	padding:0;
}
li{ margin:0px; padding:5px 5px;}
li:hover{ background:#025b9b;}
.ui-widget-content {
	float:right;
	border: 1px solid #666;
	background:#FFF;
	cursor:pointer;
	margin-top:-500px;
}
.ui-state-hover,
.ui-widget-content .ui-state-hover,
.ui-state-focus,
.ui-widget-content .ui-state-focus,
.ui-widget-header .ui-state-focus 
{ color:#FFF;}

.title{
	background: #025b9b;
	padding:10px;
	color:#FFF;
	font-size:16px;
}
#t_header{
	background:#025b9b; 
	height:40px;
	color:#FFF;
}
#t_data{
	height:40px;
	text-align:center;
}
#t_data:hover{
	background:#CECECE;
	cursor:pointer;	
}
th{
	text-align:center;
	color:#FFF;
}
#control_data{
	margin-bottom:10px;
	border:0px solid gray;
	height:40px;
	margin-top:15px;
}
#pg_tot{
	float:left;
	padding:8px 10px 7px 10px;
	background:#666;
	color:#FFF;
}
#next{
	float:left;
	margin:7px 7px 0px 7px;
}
#control_data select{
	float:left;
	margin:7px 0px 0px 0px;
	border:1px solid #666;
	width:45px;
	height:25px;
	cursor:pointer;
}
#control_data select:hover{
	border:1px solid #025b9b;
}
#prev{
	float:left;
	margin:7px 7px 0px 7px;
}

#pg_control{
	border:1px solid #666;
	float:left;
	height:38px;
}
td{
	padding:10px 0px;
}
.btn_img:hover{
    -ms-transform: rotate(90deg);
    -webkit-transform: rotate(90deg);
    transform: rotate(90deg);
	cursor:pointer;
}
</style>
<div id="title_page">TRANSAKSI</div>
<?php
	require "../config/connection.php";
	require "../config/function.php";

	$querytotal = que("SELECT DISTINCT (tb_transaksi.id_transaksi), tb_kasir.id_kasir, tb_kasir.nama_lengkap, jenis_transaksi, tanggal_waktu, total_harga
						  FROM tb_transaksi, tb_transaksi_detail, tb_produk, tb_kasir
						  WHERE tb_transaksi.id_transaksi = tb_transaksi_detail.id_transaksi
						  AND tb_transaksi_detail.id_produk = tb_produk.id_produk
						  AND tb_transaksi.id_kasir = tb_kasir.id_kasir
						  ORDER BY tanggal_waktu DESC");
	$perpage	= 10; 
	$pagetotal	= num($querytotal);
	$jumpage	= ceil($pagetotal/$perpage);
	if(isset($_GET['page'])) {
		$limit 	= "LIMIT ".($_GET['page']-1)*$perpage.",".$perpage; 
		$curpage= $_GET['page'];
	}else{ 
		$limit 	= "LIMIT 0,".$perpage; 
		$curpage= 1;
	}
	$qry_transaksi = que("SELECT DISTINCT (tb_transaksi.id_transaksi), tb_kasir.id_kasir, tb_kasir.nama_lengkap, jenis_transaksi, tanggal_waktu, total_harga
						  FROM tb_transaksi, tb_transaksi_detail, tb_produk, tb_kasir
						  WHERE tb_transaksi.id_transaksi = tb_transaksi_detail.id_transaksi
						  AND tb_transaksi_detail.id_produk = tb_produk.id_produk
						  AND tb_transaksi.id_kasir = tb_kasir.id_kasir
						  ORDER BY tanggal_waktu DESC ".$limit);

	$i=0;
?>
<table width="100%" border="0" cellspacing="0">
  <tr>
    <td align="center" width="42.5%" class="title">PENJUALAN</td>
    <td width="5%">&nbsp;</td>
    <td align="center" width="42.5%" class="title">PEMBELIAN</td>
  </tr>
  <tr>
    <td align="center" style="border-right:1px solid #025b9b;border-left:1px solid #025b9b; border-bottom:1px solid #025b9b;background:#FFF">
  		<select id="select" required onchange=" if($('#select').val()!=''){pencarian('page/transaksi_penjualan.php',$('#select').val());}">
        	<option value="">Pilih ID Troli</option>
        	<?php
			$qry=que("SELECT DISTINCT id_troli FROM tb_transaksi_sementara ORDER BY id_troli ASC");
			while($data=fetch($qry))
			{ echo "<option value='$data[0]'>$data[0]</option>";}
			?>
        </select>
        <input type="button" class="btn" value="Segarkan" onclick=" halaman('page/transaksi.php'); " style="margin-left:15px;">
    </td>
    <td>&nbsp;</td>
    <td rowspan="2" align="center" style="background:#FFF;border-right:1px solid #025b9b;border-left:1px solid #025b9b;border-bottom:1px solid #025b9b;">
    	<input type="button" class="btn" value="Suplai Barang" onclick="halaman('page/transaksi_pembelian.php');"></td>
  </tr>
</table>

<div id="control_data">
  <div id='pg_tot'>
  	<img src="style/list.png" width="25" height="25" style="vertical-align:middle"/>
    Jumlah Data : <b style='font-size:15px; color:#FFF;'><?php echo $pagetotal;?></b>
  </div>
  <div id="pg_control">
	<?php
	if(isset($_GET['page']) AND $_GET['page'] > 1)
	{?> <img id="prev" class="btn_img" src="style/prev.png" width="25" height="25" title="Halaman Sebelumnya" 
    				   onClick="halaman('page/transaksi.php?page=<?php echo $curpage-1; ?>')"/> <?php }
	else
	{?> <img id="prev" src="style/prevd.png" width="25" height="25" title="Halaman Sebelumnya Tidak Ada" /> <?php } ?>	
	
	<select title="Pilih Halaman" onchange="halaman('page/transaksi.php?page='+this.value)"><?php
	for($r=1; $r <= $jumpage ; $r++){	
		if($curpage == $r)
		{ echo "<option value=".$r." selected>".$r."</a>"; }
		else
		{ echo "<option value=".$r.">".$r."</a>"; }
	}?>
    </select> 	<?php
	
    if($jumpage>1 AND (!isset($_GET['page']) OR @$_GET['page'] < $jumpage))
    {?> <img id="next" class="btn_img" src="style/next.png" width="25" height="25" title="Halaman Selanjutnya" 
    				   onClick="halaman('page/transaksi.php?page=<?php echo $curpage+1; ?>')"/> <?php }	
    else
    {?> <img id="next" src="style/nextd.png" width="25" height="25" title="Halaman Selanjutnya Tidak Ada"/><?php }	?>
  </div>
</div>
  
<table width="100%" border="0" cellspacing="0" id="form_data" style="margin-top:10px; border:1px solid #025b9b;">
  <tr id="t_header">
    <th>Nama Kasir</th>
    <th>Jenis Transaksi</th>
    <th>Tanggal & Waktu</th>
    <th>Total Harga</th>
  </tr>
<?php 
	while($data_transaksi = fetch($qry_transaksi)){
		if($i%2){$bg="#EFEFEF";}
		else    {$bg="#FFFFFF";}
		
		echo "
  <tr id='t_data' bgcolor='$bg'>
    <td>$data_transaksi[nama_lengkap]</td>
    <td>$data_transaksi[jenis_transaksi]</td>
    <td>
		".substr($data_transaksi['tanggal_waktu'],8,2)." ".bulan(substr($data_transaksi['tanggal_waktu'],5,2))." "
		 .substr($data_transaksi['tanggal_waktu'],0,4)."<br>".substr($data_transaksi['tanggal_waktu'],10,9)."	
	</td>
    <td>".rupiah($data_transaksi['total_harga'])."</td>
  </tr>
		";	
		$i++;	
	}
?>  

</table>
