<?php
require "../../config/connection_mysqli.php";

$id_cart = $_POST['id_transaksi_sementara'];

$query = "DELETE  FROM tb_transaksi_sementara WHERE id_transaksi_sementara=$id_cart";

$result = mysqli_query($connect, $query);

if ($result) {
	$message = array(					
		'error' => 'false',
		'message' => 'data berhasil dihapus'
	);
	die(json_encode($message));
} else{ 
	$message = array(					
		'error' => 'true',
		'message' => 'error'
	);
	die(json_encode($message)); 
}	
mysqli_close($connect);


?>

