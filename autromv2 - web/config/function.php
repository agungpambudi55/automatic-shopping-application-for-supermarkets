<?php
	function que($a){return mysql_query($a);}
	function fetch($b){return mysql_fetch_array($b);}
	function num($c){return mysql_num_rows($c);}
	function bulan($bulan) {
			switch($bulan)
			{
				case "01";	$bulan = "Januari";		break;
				case "02";	$bulan = "Februari";	break;
				case "03";	$bulan = "Maret";		break;
				case "04";	$bulan = "April";		break;
				case "05";	$bulan = "Mei";		  	break;
				case "06";	$bulan = "Juni";		break;
				case "07";	$bulan = "Juli";		break;
				case "08";	$bulan = "Agustus";		break;
				case "09";	$bulan = "September";	break;
				case "10";	$bulan = "Oktober";		break;
				case "11";	$bulan = "November";	break;
				case "12";	$bulan = "Desember";	break;
			}
			return $bulan;
	} 
	function hari($hari) {
		switch($hari)
			{
				case "Sun";	$hari = "Minggu";	break;
				case "Mon";	$hari = "Senin";	break;
				case "Tue";	$hari = "Selasa";	break;
				case "Wed";	$hari = "Rabu";		break;
				case "Thu";	$hari = "Kamis";	break;
				case "Fri";	$hari = "Jumat";	break;
				case "Sat";	$hari = "Sabtu";	break;
			}
		return $hari;
	}
	function rupiah($nilai) {
 		$harga = "Rp ".number_format($nilai,2,',','.');
		return $harga;
	}	
	function struk($nilai) {
 		$harga = number_format($nilai,0,'','.');
		return $harga;
	}
?>