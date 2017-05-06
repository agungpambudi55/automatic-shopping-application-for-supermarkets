<?php
require "../config/connection.php";
require "../config/function.php";

if(isset($_GET['id'])){
	$hapus = que("DELETE FROM tb_transaksi_sementara WHERE id_transaksi_sementara='".$_GET['id']."';");
	if($hapus)
	{?><script>halaman('page/transaksi_penjualan.php?cari=<?php echo $_GET['cari'];?>');</script><?php }
	else
	{?><script>halaman('page/transaksi_penjualan.php?cari=<?php echo $_GET['cari'];?>');</script><?php }
}
?>