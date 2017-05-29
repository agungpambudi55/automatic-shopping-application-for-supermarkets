<?php
require "../config/connection.php";
require "../config/function.php";

if(isset($_GET['id'])){
	$update = que("UPDATE `db_autrom`.`tb_transaksi_sementara` SET `jumlah` = '".$_GET['data']."' 
						  WHERE `tb_transaksi_sementara`.`id_transaksi_sementara` ='".$_GET['id']."';");
	if($update)
	{?><script>pg('page/transaksi_penjualan.php?cari=<?php echo $_GET['cari'];?>');</script><?php }
	else
	{?><script>pg('page/transaksi_penjualan.php?cari=<?php echo $_GET['cari'];?>');</script><?php }
}
?>