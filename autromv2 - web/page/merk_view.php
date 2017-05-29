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
#t_header{
	background:#025b9b; 
	height:40px;
}
#t_data{
	height:40px;	
}
#t_data:hover{
	background:#CECECE;
	cursor:pointer;	
}
#control_data{
	margin-bottom:10px;
	border:0px solid gray;
	height:40px;
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
.btn:hover{
    -ms-transform: rotate(90deg);
    -webkit-transform: rotate(90deg);
    transform: rotate(90deg);
	cursor:pointer;
}
#pg_control{
	border:1px solid #666;
	float:left;
	height:38px;
}
#delall{
	float:right;
	margin:7px 0px 0px 0px;
}
#tambah{
	float:right;
	margin:-43px 30px 0px 0px;
}
#caribtn{
	float:right;
	margin:-43px 60px 0px 0px;
}
#cari{
	float:right;
	padding:5px;
	margin:-44px 90px 0px 0px;
	border:1px solid #333;
	width:207px;
}
#cari:hover{
	border:1px solid #0084E6;
}
#cari:focus{border:1px solid #0084E6;}
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
{ color:#FFF; position:absolute;}

</style>

<?php
require "../config/connection.php";
require "../config/function.php";
?>

<div id="title_page">DATA MERK</div>
<?php
if(isset($_GET['cari']))
{$querytotal	= que("SELECT * FROM tb_merk WHERE nama_merk LIKE '$_GET[cari]%'");}
else
{$querytotal	= que("SELECT * FROM tb_merk");}

$perpage	= 15; 
$pagetotal	= num($querytotal);
$jumpage	= ceil($pagetotal/$perpage);
if(isset($_GET['page'])) {
	$limit 	= "LIMIT ".($_GET['page']-1)*$perpage.",".$perpage; 
	$curpage= $_GET['page'];
}else{ 
	$limit 	= "LIMIT 0,".$perpage; 
	$curpage= 1;
}

if(isset($_GET['cari']))
{$qry = que("SELECT * FROM tb_merk WHERE nama_merk LIKE '$_GET[cari]%' ORDER BY nama_merk");}
else
{$qry = que("SELECT * FROM tb_merk ORDER BY nama_merk ".$limit);}


if(isset($_GET['notif']))
{
	if($_GET['notif']=="hy")
	{echo "<div class='notif' id='orange'>Data Berhasil Dihapus</div>";}
	elseif($_GET['notif']=="hn")
	{echo "<div class='notif' id='red'>Data Gagal Dihapus</div>";}
	elseif($_GET['notif']=="ck")
	{echo "<div class='notif' id='red'>Tidak Ada Yang Dicentang atau Dihapus</div>";}
	elseif($_GET['notif']=="ta")
	{echo "<div class='notif' id='red'>Tidak Ada Yang Dicari</div>";}
}
?>
<script type="text/javascript">
$(document).ready(function(){
	$('.notif').delay(2500).hide(0);
});
$(function() {
	var availableTags = [
	<?php
	$qry_ac=que("SELECT * FROM tb_merk ORDER BY nama_merk ASC");
	while($data_ac=fetch($qry_ac))
	{ echo "'$data_ac[1]',";}
	?>
	];
	$("#cari").autocomplete({ source: availableTags });
});
</script>

<form method="GET" action="#" id="form_data">
<div id="control_data">
  <div id='pg_tot'>
  	<img src="style/list.png" width="25" height="25" style="vertical-align:middle"/>
    Jumlah Data : <b style='font-size:15px; color:#FFF;'><?php echo $pagetotal;?></b>
  </div>
	
  <div id="pg_control">
	<?php
	if(isset($_GET['page']) AND $_GET['page'] > 1)
	{?> <img id="prev" class="btn" src="style/prev.png" width="25" height="25" title="Halaman Sebelumnya" 
    				   onClick="halaman('page/merk_view.php?page=<?php echo $curpage-1; ?>')"/> <?php }
	else
	{?> <img id="prev" src="style/prevd.png" width="25" height="25" title="Halaman Sebelumnya Tidak Ada" /> <?php } ?>	
	
	<select title="Pilih Halaman" onchange="halaman('page/merk_view.php?page='+this.value)"><?php
	for($r=1; $r <= $jumpage ; $r++){	
		if($curpage == $r)
		{ echo "<option value=".$r." selected>".$r."</a>"; }
		else
		{ echo "<option value=".$r.">".$r."</a>"; }
	}?>
    </select> 	<?php
	
    if($jumpage>1 AND (!isset($_GET['page']) OR @$_GET['page'] < $jumpage))
    {?> <img id="next" class="btn" src="style/next.png" width="25" height="25" title="Halaman Selanjutnya" 
    				   onClick="halaman('page/merk_view.php?page=<?php echo $curpage+1; ?>')"/> <?php }	
    else
    {?> <img id="next" src="style/nextd.png" width="25" height="25" title="Halaman Selanjutnya Tidak Ada"/><?php }	?>
  </div>
  
  <img id="delall" class="btn" src="style/delall.png" width="25" height="25" title="Hapus Data Yang Dicentang"
  	   onclick="tanya('page/merk_hapus.php');" /> </div>

  <img id="tambah" class="btn" src="style/add.png" width="25" height="25" title="Tambah Data"
  	   onclick="halaman('page/merk_tambah.php');" /> </div>
  
  <div class="ui-widget">	
  	<input name="cari" id="cari" placeholder="Pencarian Data Fitur Autocomplete"/>
  </div>
  <img id="caribtn" class="btn" src="style/search.png" width="25" height="25" title="Tambah Data"
  	   onClick="pencarian('page/merk_view.php',$('#cari').val())" /> 
</div>


<table width="100%" cellspacing="0"  style="border:1px solid #025b9b;">
  <tr id="t_header">
	  <th width='5%'><input type="checkbox" id="centang" onClick="centang_semua()" value="all"></th>
      <th width='90%' align="left" style="color:#FFF;">Nama Merk</th>
	  <th width='5%' align="center" style="color:#FFF;">Aksi</th>
    </tr>
<?php    

if(num($qry)==0)
{	echo "<tr id='t_data' bgcolor='#FFFFFF'><td colspan='4' align='center'>Data tidak ada</td></tr>";	}
else{
	$i=0;
	while($data= fetch($qry)) {
		if($i%2){$bg="#EFEFEF";}
		else    {$bg="#FFFFFF";}
		
		echo "
		<tr id='t_data' bgcolor='$bg'>
			<td align='center'><input type='checkbox' name='kode_cek[]' value='$data[0]'/></td>
			<td>$data[1]</td>
			<td align='center'>";?>
				<img src="style/edit.png" class="btn" width="25" height="25" title="Edit Data" 
                	 onClick="halaman('page/merk_edit.php?id=<?php echo $data['0'];?>')"/> 
  				<img src="style/delete.png" class="btn" width="25" height="25"  title="Hapus Data" 
                	 onClick="konfirmasi('<?php echo $data['1'];?>','page/merk_hapus.php?id=<?php echo $data['0'];?>')"/> <?php 	echo "
			</td>
		</tr>";
		$i++;
	}
}
?>
</table>
</form>