<?php
require "../../config/connection_mysqli.php";

$nama = $_POST['nama_produk'];


$query  = " SELECT lokasi_block, lokasi_sekat FROM tb_produk 
	    WHERE nama_produk LIKE '%$nama%' ";
$result = mysqli_query($connect, $query);

while($row = mysqli_fetch_assoc($result)){
	$data = $row;
}

if (empty($data)) {
	$message = array(					
		'error' => 'true',
		'product' => 'produk tidak ada'
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
