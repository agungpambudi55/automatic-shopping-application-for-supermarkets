<?php
require "../../config/connection_mysqli.php";

$id_troli 	= $_POST['id_troli'];
$id_produk 	= $_POST['id_produk'];
$jumlah		= $_POST['jumlah'];


if (empty($id_troli) || empty($id_produk) || empty($jumlah)) { 
	$message = array(					
		'error' => 'true',
		'message' => 'data tidak boleh kosong'
	);
	die(json_encode($message));
} else {
	$query = "INSERT INTO `tb_transaksi_sementara`(`id_troli`, `id_produk`, `jumlah`) 
			  VALUES ($id_troli,$id_produk,$jumlah)";
	$result = mysqli_query($connect, $query);
	
	if ($result) {
		$message = array(					
			'error' => 'false',
			'message' => 'data berhasil ditambahkan'
		);
		die(json_encode($message));
	} else{ 
		$message = array(					
			'error' => 'true',
			'message' => 'data gagal ditambahkan'
		);
		die(json_encode($message)); 
	}	
}

mysqli_close($connect);


?>