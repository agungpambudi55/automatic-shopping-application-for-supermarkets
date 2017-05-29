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
#form{
	border:0px solid gray;
	border-collapse:collapse;
}
#form td{ padding:3px 0px 3px 0px;}
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
#orange{
	background:#FF8000;
}
#red{
	background:#CA0005;
}
</style>
<body onLoad="$('.notif').delay(2500).remove();">
<?php
if(!isset($_GET['nama'])){?>
<div id="title_page">TRANSAKSI PEMBELIAN</div>
<?php
}
session_start();
require "../config/connection.php";
require "../config/function.php";

if(isset($_GET['id_produk'])){

	$qry_kasir = que("SELECT * FROM tb_kasir WHERE username='".$_SESSION['un']."'");
	while($dt_kasir = fetch($qry_kasir)){$kasir=$dt_kasir[0];}
	
 	$qry_produk=que("SELECT * FROM tb_produk WHERE id_produk = $_GET[id_produk]");
    while($dt_produk = fetch($qry_produk)){$harga=$dt_produk['harga']; $stok_barang=$dt_produk['stok_barang'];}  
	         	
	$qrysimpan = que("INSERT INTO `db_autrom`.`tb_transaksi` (`id_transaksi`, `id_kasir`, `tanggal_waktu`, `jenis_transaksi`, `total_harga`) 
					   VALUES (NULL, '$kasir', CURRENT_TIMESTAMP, 'Pembelian', '".($harga*$_GET['jumlah'])."');");	

	$qrylastidtransaksi = que("SELECT id_transaksi FROM `tb_transaksi` ORDER BY id_transaksi DESC LIMIT 1");
	$dtlastidtransaksi = fetch($qrylastidtransaksi);

	$qry_trans_det = que("INSERT INTO `db_autrom`.`tb_transaksi_detail` (`id_transaksi_detail`, `id_transaksi`, `id_produk`, `jumlah`) 
						  VALUES (NULL, '$dtlastidtransaksi[id_transaksi]', '$_GET[id_produk]', '$_GET[jumlah]');");
	
	$qry_update_stok = que("UPDATE `db_autrom`.`tb_produk` SET `stok_barang` = '".($stok_barang + $_GET['jumlah'])."' 
							WHERE `tb_produk`.`id_produk` = $_GET[id_produk];");
	
	if($qrysimpan && $qry_trans_det)
	{   echo "0|<div class='notif' id='orange'>Transaksi Berhasil</div>"; }
	else
	{	echo "0|<div class='notif' id='red'>Transaksi Gagal</div>"; }
}
else
{
?>

<script type="text/javascript">
$(document).ready(function(){
	$("#formtambah").submit(function(event){
		event.preventDefault();
		$('.notif').remove();
		data = $("#formtambah").serialize();
		$("#simpan").val("Menyimpan...");
		$("#formtambah *").prop("disabled","disabled");
		$.ajax({
			url: "page/transaksi_pembelian.php?"+data,
			success: function(result,status){				
				response = result.split("|");
				if(response[0] != "1")
				{
					$("#simpan").val("Simpan");
					$("#simpan").focus();
					$("#formtambah *").removeAttr("disabled");
					$("#formtambah").before(response[1]);
				}
				else
				{halaman('page/transaksi_pembelian.php');}
			}
		});
	});
});
</script>
<form id="formtambah" action="#" method="get">
    <table id="form">
    	<tr>
        	<td style="width:85px;">Nama Produk</td>
        	<td>
                <select name="id_produk" required id="select">
                <option value="">Pilih Nama Produk</option>
                <?php 
                $qry_produk=que("SELECT * FROM tb_produk ORDER BY nama_produk ASC");
                while($data_produk=fetch($qry_produk))
                { ?> <option value="<?php echo $data_produk["id_produk"]; ?>"><?php echo $data_produk["nama_produk"]; ?></option> <?php } ?>     
                </select>
            </td>
            
        </tr>
      <tr>
        <td style="width:85px">Kuantitas</td>
        <td>
        	<input type="text" name='jumlah' required id="input" autocomplete="off"/>
        	<span class="notification">Masukkan Nilai Kuantitas Pembelian Produk</span>
        </td>
      </tr>
        <tr>
        <td>&nbsp;</td>
        <td style="padding-top:10px;">
          <input type='submit' id='simpan' value='Simpan' class="btn"/> 
          <input type='reset' name='reset' value='Hapus' class="btn" onClick="$('.notif').remove();"/>
          <input type="button" value="Kembali" onClick="halaman('page/transaksi.php');" class="btn"/>      
        </td>
      </tr>
    </table>
</form>
<?php } ?>
</body>