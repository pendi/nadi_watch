<?php
	function price($price) 
	{
		$format = number_format($price,0,'','.').",-";
		return $format;
	}

	function autoDelete($table) 
	{
		$time = 3;
		$query = "DELETE FROM $table WHERE DATEDIFF(CURDATE(), created_time) > $time";
		$hasil = mysql_query($query);
		return $hasil;
	}

	function strlenProduct($description) 
	{
		$tampil = strlen($description);
		$hasil = $description;
		if ($tampil >= 90) {
			$hasil = substr($description, 0, 90).'...';
		}
		return $hasil;
	}

	function romawi($angka) 
	{
		switch ($angka) {
			case '1':
			$format = 'I';
			break;

			case '2':
			$format = 'II';
			break;
			
			case '3':
			$format = 'III';
			break;
			
			case '4':
			$format = 'IV';
			break;
			
			case '5':
			$format = 'V';
			break;
			
			case '6':
			$format = 'VI';
			break;
			
			case '7':
			$format = 'VII';
			break;
			
			case '8':
			$format = 'VIII';
			break;
			
			case '9':
			$format = 'IX';
			break;

			case '10':
			$format = 'X';
			break;

			case '11':
			$format = 'XI';
			break;

			case '12':
			$format = 'XII';
			break;
		}
		return $format;
	}

	function invoice() 
	{
		$romawi = romawi(date('n'));
		$kode = "/NHW/INV/".$romawi."/".date('Y');
		$count = "-".strlen($kode)-3;

		$kdauto = mysql_query("SELECT max(invoice) AS last FROM orders WHERE invoice LIKE '%$kode'");
		$result = mysql_fetch_array($kdauto);
		$lastNoInvoice = $result['last'];
		$lastNoUrut = substr($lastNoInvoice, $count, 3);
		$nextNoUrut = $lastNoUrut + 1;
		$nextNoInvoice = sprintf('%03s', $nextNoUrut).$kode;

		return $nextNoInvoice;
	}
	
?>