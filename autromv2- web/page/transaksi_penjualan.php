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
	border:1px solid #025b9b;
}
#form td{ padding:5px 0px;}
.btn{
	padding:10px 20px;
	background:#333;
	color:#FFF;
	border:0px solid #333;
	cursor:pointer;
	margin-top:10px;	
}
.btn:hover{
	background:#025b9b;
}

.text_jumlah{
	text-align:center;
	width:30px;
	padding:8px 5px 8px 5px;
	background: #FFF;
	box-shadow:none;
	border:1px solid #333;
}
.text_jumlah:focus{
	border:1px solid #0084E6;
}
.text_jumlah:hover{
	border:1px solid #0084E6;
}
.text_harga{
	width:280px;
	padding:8px 5px 8px 5px;
	background: #FFF;
	box-shadow:none;
	border:1px solid #333;
}
.text_harga:focus{
	border:1px solid #0084E6;
}
.text_harga:hover{
	border:1px solid #0084E6;
}
.text_produk{
	text-align:left;
	width:280px;
	padding:8px 5px 8px 5px;
	background: #FFF;
	box-shadow:none;
	border:1px solid #FFF;
}
#data:hover{
	background:#EBEBEB;
	cursor:pointer;	
}
#data:hover .text_produk{
	background:#EBEBEB;
	border:1px solid #EBEBEB;
}
.btn_img{
	vertical-align:middle}
.btn_img:hover{
    -ms-transform: rotate(90deg); /* IE 9 */
    -webkit-transform: rotate(90deg); /* Chrome, Safari, Opera */
    transform: rotate(90deg);
	cursor:pointer;
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

<div id="title_page">TRANSAKSI PENJUALAN</div>

<?php
session_start();
require "../config/connection.php";
require "../config/function.php";

$id_troli=$_GET['cari'];
$qry1=FALSE;
$qry2=FALSE;
if(isset($_GET['id_transaksi'])){
	
	$qry_kasir = que("SELECT * FROM tb_kasir WHERE username='".$_SESSION['un']."'");
	while($dt_kasir = fetch($qry_kasir)){$kasir=$dt_kasir[0];}
	
	$qrytransaksi = que("INSERT INTO `db_autrom`.`tb_transaksi` (`id_transaksi`, `id_kasir`, `tanggal_waktu`, `jenis_transaksi`, `total_harga`) 
							VALUES (NULL, '$kasir', CURRENT_TIMESTAMP, 'Penjualan', '$_GET[total_harga]');");
	if($qrytransaksi){$qry1=TRUE;}
	
	$qrylastidtransaksi = que("SELECT id_transaksi FROM `tb_transaksi` ORDER BY id_transaksi DESC LIMIT 1");
	$dtlastidtransaksi = fetch($qrylastidtransaksi);
	
	$qrysementara=que("SELECT * FROM tb_transaksi_sementara,tb_produk WHERE tb_transaksi_sementara.id_produk = tb_produk.id_produk AND 
		  			  id_troli = '$_GET[id_troli]'  ORDER BY nama_produk ASC");
					 
	while($datasementara=fetch($qrysementara)){ 
			$qrytransaksidetail = que("INSERT INTO `db_autrom`.`tb_transaksi_detail` (`id_transaksi_detail`, `id_transaksi`, `id_produk`, `jumlah`) 
								VALUES (NULL, '$dtlastidtransaksi[id_transaksi]', '$datasementara[id_produk]', '$datasementara[jumlah]');");
			$delsementara 	= que("DELETE FROM tb_transaksi_sementara WHERE id_troli = $_GET[id_troli]");
			$updatestok 	= que("UPDATE `db_autrom`.`tb_produk` SET `stok_barang` = '".($datasementara['stok_barang']-$datasementara['jumlah'])."' WHERE `tb_produk`.`id_produk` = $datasementara[id_produk];");
			if($qrytransaksidetail && $delsementara){$qry2=TRUE;}
	}
	
	if($qry1==TRUE && qry2==TRUE)
	{   echo "0|<div class='notif' id='orange'>Transaksi Berhasil</div>"; }
	else
	{	echo "0|<div class='notif' id='red'>Transaksi Gagal</div>"; }
}
else
{
?>

<script type="text/javascript">
$(document).ready(function(){
	$('#cetak').hide(0);
	$("#form_data").submit(function(event){
		event.preventDefault();
		$('.notif').remove();
		data = $("#form_data").serialize();
		$("#transaksi").val("Memtransaksi...");
		$("#form_data *").prop("disabled","disabled");
		$.ajax({
			url: "page/transaksi_penjualan.php?"+data,
			success: function(result,status){				
				response = result.split("|");
				if(response[0] != "1")
				{
					$("#transaksi").hide(0);
					$('#cetak').show(0);
					$("#kembali").val("Selesai");
					$("#form_data *").removeAttr("disabled");
					$("#form_data").before(response[1]);
				}
				else
				{halaman('page/transaksi_penjualan.php');}
			}
		});
	});
});
</script>
<form id="form_data" action="#" method="get">
	<input type="hidden" name="id_transaksi" value="<?php echo $data[0]; ?>">
	<input type="hidden" name="id_troli" value="<?php echo $id_troli; ?>">
        <table id="form" width="100%">
        	<tr>
                <th colspan="6" style="background:#025b9b; color:#FFF; padding:10px">
    				          DAFTAR BELANJA  
                </th>
	        </tr>	
    <?php 	$qry=que("SELECT * FROM tb_transaksi_sementara,tb_produk WHERE tb_transaksi_sementara.id_produk = tb_produk.id_produk AND 
		  			  id_troli = '$id_troli' ORDER BY nama_produk ASC");
			$qrylastidtransaksi = que("SELECT id_transaksi FROM `tb_transaksi` ORDER BY id_transaksi DESC LIMIT 1");
			$dtlastidtransaksi = fetch($qrylastidtransaksi);
			$i=1;
			$total_harga=0;
			while($data=fetch($qry)){ 
			
					$total_harga+=$data['harga']*$data['jumlah'];

					if($i%2){$bg="#FFFFFF";}
					else    {$bg="#FFFFFF";} ?>
              <tr id="data" bgcolor="<?php echo $bg; ?>">
                <td width="8%" style="padding-left:10px;">Produk <?php echo $i; ?></td>
                <td width="36%"><input type="text" value="<?php echo $data['nama_produk'];?>" class="text_produk" readonly> </td>
                <td width="8%" style="padding-left:10px;">Kuantitas</td>
                <td width="15.5%"><input type="text" id="jumlah<?php echo $i;?>"  value="<?php echo $data['jumlah'];?>" class="text_jumlah" required name='jumlah' onmouseout="update_transaksi_sementara('page/transaksi_penjualan_edit.php',<?php echo $data['id_transaksi_sementara'];?>,$('#jumlah<?php echo $i;?>').val(),<?php echo $id_troli;?>);" autocomplete="off"/>
                </td>
                <td width="30"><?php echo "Rp. ".struk($data['harga']).",00";?></td>
                <td width="2.5%" style="padding-right:10px;"><img src="style/trollydel.png" width="25" height="25" title="Hapus" class="btn_img"
                	onClick="konfirmasi('<?php echo $data['nama_produk'];?>',
                    'page/transaksi_penjualan_hapus.php?id=<?php echo $data['0'];?>&cari=<?php echo $id_troli;?>')">
                </td>
		      </tr>
		<?php $i++;} ?>
        <input type="hidden" name="total_harga" value="<?php echo $total_harga; ?>" autocomplete="off">

<tr bgcolor="#FFFFFF">
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>

<tr bgcolor="#FFFFFF">
	<td style="padding-left:10px;">Total Harga</td>
	<td><input type="text" value="<?php echo "Rp. ".struk($total_harga).",00";?>" class="text_produk" readonly></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>

<tr bgcolor="#FFFFFF">
	<td style="padding-left:10px;">Uang Bayar</td>
	<td><input type="text" required class="text_harga" placeholder="Masukkan Nilai Uang Pembayaran" id="bayar"></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
</table>
<table border="0" width="100%">
        <tr>
        <td align="center">
        <script language="javascript" type="text/javascript">
		function struk(){
			  var hartot = document.getElementById('bayar').value;			
			  url = "page/struk.aspx?id=<?php echo $dtlastidtransaksi['id_transaksi']+1;?>&bayar="+hartot;
			  var win = window.open(url, '_blank');
  			  win.focus();
		}
        </script>
          <input type='submit' id='transaksi' value='Transaksi' class="btn"/> 
          <input type="button" id="cetak" value="Cetak" onclick="struk()" class="btn"/>  
          <input type="button" id="kembali" value="Kembali" onClick="halaman('page/transaksi.php');" class="btn"/>    
        </td>
      </tr>
    </table>
</form>
<?php } ?>
</body>
'