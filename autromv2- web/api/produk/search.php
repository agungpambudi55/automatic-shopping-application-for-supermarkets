<?php
require "../../config/connection_mysqli.php";

$barcode = $_GET['barcode'];

$query  = " SELECT * FROM tb_produk 
			WHERE barcode = $barcode;
		  ";
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
