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
<div id="title_page">EDIT MERK</div>

<?php
require "../config/connection.php";
require "../config/function.php";
$qry=que("select * from tb_merk where id_merk='$_GET[id]'");
$data=fetch($qry);

if(isset($_GET['id']) && isset($_GET['nama'])){
	$nama=ucwords($_GET['nama']);
	$qrysimpan = que("UPDATE `db_autrom`.`tb_merk` SET `nama_merk` = '$nama' WHERE `tb_merk`.`id_merk` = $_GET[id];");	
	if($qrysimpan)
	{   echo "0|<div class='notif' id='orange'>Data Berhasil Diperbarui</div>"; }
	else
	{	echo "0|<div class='notif' id='red'>Data Gagal Diperbarui</div>"; }
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
		$("#simpan").val("Memperbarui...");
		$("#formtambah *").prop("disabled","disabled");
		$.ajax({
			url: "page/merk_edit.php?"+data,
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
				{halaman('page/merk_edit.php');}
			}
		});
	});
});
</script>
<form id="formtambah" action="#" method="get">
	<input type="hidden" name="id" value="<?php echo $data[0]; ?>">
    <table id="form">
      <tr>
        <td style="width:85px">Nama</td>
        <td>
        	<input type="text" name='nama' required id="input" value="<?php echo $data[1];?>"/>
        	<span class="notification">Masukkan Nama Merk</span>
        </td>
      </tr>
        <tr>
        <td>&nbsp;</td>
        <td style="padding-top:10px;">
          <input type='submit' id='simpan' value='Perbarui' class="btn"/> 
          <input type='reset' name='reset' value='Hapus' class="btn" onClick="$('.notif').remove();"/>
          <input type="button" value="Kembali" onClick="halaman('page/merk_view.php');" class="btn"/>      
        </td>
      </tr>
    </table>
</form>
<?php } ?>
</body>