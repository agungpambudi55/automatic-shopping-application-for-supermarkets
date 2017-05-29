<?php
require "../../config/connection_mysqli.php";

$id_troli = $_GET['id_troli'];

$query  = " SELECT c.id_transaksi_sementara, p.nama_produk, p.harga, c.jumlah 
			FROM tb_transaksi_sementara c, tb_produk p 
			WHERE c.id_produk = p.id_produk
			AND c.id_troli = $id_troli;
		  ";

$result = mysqli_query($connect, $query);

while($row = mysqli_fetch_assoc($result)){
	$data[] = $row;
}


if (empty($data)) {
	$message = array(					
		'error' => 'true',
		'cart' => 'Keranjang belanja anda masih kosong'
	);
}
else{
	$message = array(					
		'error' => 'false',
		'product' => $data
	);

}

echo json_encode($message);

mysqli_close($connect);


?>
