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
#input{
	width:280px;
	padding:8px 25px 8px 5px;
	background:url(style/icon.png) 291px -144px no-repeat #FFF;
	box-shadow:none;
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

#select:required, #select1:required, #select2:required, #select3:required, #select4:required, #select5:required{
	width:312px;
	padding:8px 25px 8px 5px;
	border:1px solid #333;
	background:url(style/icon.png) 275px -144px no-repeat #FFF;
}
#select:required:invalid,#select1:required:invalid,#select2:required:invalid,#select3:required:invalid,#select4:required:invalid,#select5:required:invalid{
	box-shadow:none;
}
#select:required:valid,#select1:required:valid,#select2:required:valid,#select3:required:valid,#select4:required:valid,#select5:required:valid{
	box-shadow:none;
	background:url(style/icon.png) 270px -175px no-repeat #FFF;
	transition:all ease-in 0.3s;
	border:1px solid #F90;
}
#select,#select1,#select2,#select3,#select5,#select4 option{padding-left:9px;}
#select:focus,#select1:focus,#select2:focus,#select3:focus,#select5:focus,#select4:focus{
	box-shadow:none;
	background:url(style/icon.png) 270px -144px no-repeat #FFF;
	border:1px solid #0084E6;
	transition:all ease-in 0.3s;
}
#select:hover,#select1:hover,#select2:hover,#select3:hover,#select4:hover,#select5:hover{ border:1px solid #0084E6; }

#select1:required{ background:url(style/icon.png) 42px -144px no-repeat #FFF;width:78px; }
#select2:required{ background:url(style/icon.png) 100px -144px no-repeat #FFF;width:135px; }
#select3:required{ background:url(style/icon.png) 56px -144px no-repeat #FFF; width:91px;}
#select4:required{ background:url(style/icon.png) 120px -144px no-repeat #FFF; width:91px;}
#select5:required{ background:url(style/icon.png) 113px -144px no-repeat #FFF; width:91px;}

#select1:required:valid{ background:url(style/icon.png) 39px -175px no-repeat #FFF;width:78px; }
#select2:required:valid{ background:url(style/icon.png) 97px -175px no-repeat #FFF;width:135px; }
#select3:required:valid{ background:url(style/icon.png) 52px -175px no-repeat #FFF; width:91px;}
#select4:required:valid{ background:url(style/icon.png) 120px -175px no-repeat #FFF; width:91px;}
#select5:required:valid{ background:url(style/icon.png) 113px -175px no-repeat #FFF; width:91px;}
		
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
<?php
if(!isset($_GET['nama_produk'])){?>
<div id="title_page">EDIT PRODUK</div>
<?php
}
require "../config/connection.php";
require "../config/function.php";

$qry=que("SELECT * FROM tb_produk, tb_merk WHERE tb_produk.id_merk=tb_merk.id_merk AND id_produk='$_GET[id]'");
$data=fetch($qry);

if(isset($_GET['nama_produk'])){
	$qryupdate = que("UPDATE `db_autrom`.`tb_produk` SET 
						`id_merk` 		= '$_GET[id_merk]',
						`nama_produk` 	= '".ucwords($_GET['nama_produk'])."',
						`harga` 		= '$_GET[harga]',
						`barcode` 		= '$_GET[barcode]',
						`exp` 			= '$_GET[thn_exp]-$_GET[bln_exp]-$_GET[tgl_exp]', 
						`stok_barang` 	= '$_GET[stok_barang]'
					  WHERE `tb_produk`.`id_produk` =  $_GET[id];");
	if($qryupdate)
	{   echo "0|<div class='notif' id='orange'>Data Berhasil Diperbarui</div>"; 
	?>
	<script type="text/javascript">
		$("#simpan").hide(0);
		$("#hapus").hide(0);
		$("#lanjut").show(0);
    </script>
	<?php
	}
	else
	{	echo "0|<div class='notif' id='red'>Data Gagal Diperbarui</div>"; }
}
else
{
?>

<script type="text/javascript">
$(document).ready(function(){
	$("#lanjut").hide(0);
	$("#formtambah").submit(function(event){
		event.preventDefault();
		$('.notif').remove();
		data = $("#formtambah").serialize();
		$("#simpan").val("Memperbarui...");
		$("#formtambah *").prop("disabled","disabled");
		$.ajax({
			url		: "page/produk_edit.php?"+data,
			type	: "GET",
			success	: function(result,status){				
				response = result.split("|");
				if(response[0] != "1")
				{
					$("#formtambah *").removeAttr("disabled");
					$("#formtambah").before(response[1]);
				}
				else
				{halaman('page/produk_edit.php');}
			}
		});
	});
});
</script>
<form id="formtambah" enctype="multipart/form-data" method="GET" action="produk_edit.php">
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
<input type="hidden" name="stok_barang" value="<?php echo $data['stok_barang'];?>"/>
    <table id="form">
      <tr>
        <td style="width:85px">Nama Produk</td>
        <td>
        	<input type="text" name='nama_produk' required id="input" value="<?php echo $data['nama_produk'];?>"/>
        	<span class="notification">Masukkan Nama Produk</span>
        </td>
      </tr>
      <tr>
        <td style="width:85px">Nama Merk</td>
        <td>
      	<select name="id_merk" required id="select">
           	<option value=""></option>
<?php 
	$qry_merk=que("SELECT * FROM tb_merk ORDER BY nama_merk ASC");
	while($data_merk=fetch($qry_merk))
	{ 
		if($data_merk['id_merk']==$data['id_merk']){
?>			<option value="<?php echo $data_merk[0]; ?>" selected><?php echo $data_merk[1]; ?></option> <?php 
		}else{
?>			<option value="<?php echo $data_merk[0]; ?>"><?php echo $data_merk[1]; ?></option> <?php 
		}
	}
?>     </select>
        </td>
      </tr>
      <tr>
        <td style="width:85px">Harga</td>
        <td>
        	<input type="text" name='harga' required id="input" value="<?php echo $data['harga'];?>"/>
        	<span class="notification">Masukkan Harga Produk Tanpa Tanda Baca</span>
        </td>
      </tr>
      <tr>
        <td style="width:85px">Tanggal Kadaluarsa</td>
        <td>
            <select name="tgl_exp" required id="select1">
            <option value=""></option>
            <?php
            for($tgl=1;$tgl<=31;$tgl++)
            { 	if($tgl<10){$tgl="0".$tgl;}; 
				if($tgl==substr($data['exp'],8,2))
				{echo "<option value='$tgl' selected>$tgl</option>";}
				else
				{echo "<option value='$tgl'>$tgl</option>";}
			}
            ?>
            </select>
            <select name="bln_exp" required id="select2">
            <option value=""></option>
            <?php
            for($bln=1;$bln<=12;$bln++)
            {
                if($bln<10)
				{$bln="0".$bln;}
				if($bln==substr($data['exp'],5,2))
				{echo "<option value='$bln' selected>".bulan($bln)."</option>";}
				else
				{echo "<option value='$bln'>".bulan($bln)."</option>";}    
			}
            ?>
            </select>
            <select name="thn_exp" required id="select3">
            <option value=""></option>
            <?php
            for($th=2010;$th<=2050;$th++)
            {if($th==substr($data['exp'],0,4)){echo "<option value='$th' selected>$th</option>";}else{echo "<option value='$th'>$th</option>";}}
            ?>
            </select>
            
        </td>
      </tr>
      <tr>
        <td style="width:85px">Barcode</td>
        <td>
        	<input type="text" name='barcode' required id="input"  value="<?php echo $data['barcode'];?>"/>
        	<span class="notification">Masukkan Barcode</span>
        </td>
      </tr>
	  <tr>
        <td style="width:85px">Lokasi</td>
        <td>
      	<select name="lokasi_block" required id="select4" style="width:158px;">
           	<option value=""></option>
				<?php 
				$qry_lokasi1=que("SELECT * FROM tb_lokasi ORDER BY lokasi_block ASC");
				while($data_lokasi1=fetch($qry_lokasi1))
				{ 
					if($data_lokasi1['lokasi_block']==$data['lokasi_block'])
					{?>	<option value="<?php echo $data_lokasi1['lokasi_block']; ?>" selected><?php echo $data_lokasi1['lokasi_block']; ?></option> <?php }
					else
					{?>	<option value="<?php echo $data_lokasi1['lokasi_block']; ?>"><?php echo $data_lokasi1['lokasi_block']; ?></option> <?php }
				 
				}
                ?>
         </select>
      	<select name="lokasi_sekat" required id="select5" style="width:150px;">
           	<option value=""></option>
            <?php
            for($lo_se=1;$lo_se<=10;$lo_se++)
            { 
				if($lo_se==$data['lokasi_sekat'])
				{echo "<option value='$lo_se' selected>$lo_se</option>";}
				else
				{echo "<option value='$lo_se'>$lo_se</option>";}
			
			}
            ?>
        </select>
        </td>
      </tr>      
       <tr>
        <td>&nbsp;</td>
        <td style="padding-top:10px;">
          <input type='submit' id='simpan' value='Perbarui dan Lanjut' class="btn"/> 
          <input type='button' id="lanjut" value="Lanjut" onClick="halaman('page/produk_upload.php?id=<?php echo $_GET['id']; ?>');" class="btn"/>      
          <input type='reset'  id="hapus" name='reset' value='Hapus' class="btn" onClick="$('.notif').remove();"/>
          <input type="button" id="kembali" value="Kembali" onClick="halaman('page/produk_view.php');" class="btn"/>  
        </td>
      </tr>
    </table>
</form>
<?php } ?>