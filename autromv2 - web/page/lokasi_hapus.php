<?php
require "../config/connection.php";
require "../config/function.php";

if(isset($_GET['id'])){
	$hapus = que("DELETE FROM tb_lokasi WHERE id_lokasi='".$_GET['id']."';");
	if($hapus)
	{?><script>halaman('page/lokasi_view.php?notif=hy');</script><?php }
	else
	{?><script>halaman('page/lokasi_view.php?notif=hn');</script><?php }
}elseif(isset($_GET['kode_cek'])){
	foreach($_GET['kode_cek'] as $n => $v)
	{ $hapus = que("DELETE FROM tb_lokasi WHERE id_lokasi='".$v."';"); }	

	if($hapus)
	{?><script>halaman('page/lokasi_view.php?notif=hy');</script><?php }
	else
	{?><script>halaman('page/lokasi_view.php?notif=hn');</script><?php }
}
else
{ ?><script>halaman('page/lokasi_view.php?notif=ck');</script><?php }
?>