<?php
$act = $_GET['act'];

include "koneksi.php";
require_once "Mail/Mail/Mail.php";
require_once "Mail/Mail/mime.php";

$invoice = invoice();

if(!isset($_SESSION['transaksi'])){
    $idt = date("YmdHis");
    $_SESSION['transaksi'] = $idt;
}
$idt = $_SESSION['transaksi'];

if(isset($_GET['id'])) { 
	$id = $_GET['id']; 
} else { 
	$id = ""; 
}

if ($act == "footer") {
	if (isset($_SESSION['user'])) {
		echo "<script>window.location = 'index.php?list=4&act=admin';</script>";
	} else {
		echo "<script>window.location = 'index.php?list=5&head=admin';</script>";
	}
} elseif ($act == "admin") {
	if(!isset($_SESSION['user'])) {
	  	echo "<script>window.alert('Anda Harus Login Dulu');</script>";
		echo "<script>window.location = 'index.php?list=5&head=admin';</script>";
	} else {
		if ($_SESSION['user']['level'] == "super admin") {
			echo "<script>window.location = 'index.php?list=6&head=admin';</script>";
		} elseif ($_SESSION['user']['level'] == "admin") {
			echo "<script>window.location = 'index.php?list=8&head=admin';</script>";
		}
	}
} elseif ($act == 'add') {
	$encript = md5($id);
	$regex = preg_replace("/[^A-Za-z]/", '', $encript);
	$alfa = substr($regex, 0, 5);
	$kode = strtoupper($alfa);

	$kdauto = mysql_query("SELECT max(id_order_temp) AS last FROM orders_temp WHERE id_order_temp LIKE '$kode%'");
	$result = mysql_fetch_array($kdauto);
	$lastNoTransaksi = $result['last'];
	$lastNoUrut = substr($lastNoTransaksi, 5, 4);
	$nextNoUrut = $lastNoUrut + 1;
	$nextNoTransaksi = $kode.sprintf('%04s', $nextNoUrut);

	$time = date("Y-m-d");
	$selectAdd = mysql_query("SELECT * FROM orders_temp WHERE id_product='$id' AND id_session='$idt'");
	$numRowAdd = mysql_num_rows($selectAdd);
	if ($numRowAdd == 0) {
		$insert = mysql_query("INSERT INTO orders_temp(id_order_temp,id_product,id_session,quantity,created_time_temp) 
	            VALUES('$nextNoTransaksi','$id','$idt','1','$time')");
	} else {
		$selectPro = mysql_query("SELECT stock FROM product WHERE id_product = '$id'");
		$dataPro = mysql_fetch_array($selectPro);
		$dataAdd = mysql_fetch_array($selectAdd);
		if ($dataAdd['quantity'] == $dataPro['stock']) {
			echo "<script>window.alert('Maaf, Stok yang Tersedia Hanya $dataPro[stock] Unit');</script>";
			echo "<script>window.location = 'index.php?list=1';</script>";
		} else {
			$insert = mysql_query("UPDATE orders_temp SET quantity = quantity+1 WHERE id_product='$id' AND id_session='$idt'");
		}
	}
	if ($insert) {
		echo "<script>window.location = 'index.php?id=$id&list=21';</script>";
	}
} elseif ($act == 'plus') {
	$qty = $_GET['qty'];
	$update = mysql_query("UPDATE orders_temp SET quantity = $qty + 1 WHERE id_product='$id' AND id_session='$idt'");
	if ($update) {
		echo "<script>window.location = 'index.php?list=21&id=$id';</script>";
	}
} elseif ($act == 'min') {
	$qty = $_GET['qty'];
	$update = mysql_query("UPDATE orders_temp SET quantity = $qty - 1 WHERE id_product='$id' AND id_session='$idt'");
	if ($update) {
		echo "<script>window.location = 'index.php?list=21&id=$id';</script>";
	}
} elseif ($act == 'del') {
	$delete = mysql_query("DELETE FROM orders_temp WHERE id_product='$id' AND id_session='$idt'");
	if ($delete) {
		$select = mysql_query("SELECT * FROM orders_temp WHERE id_session='$idt'");
		$numRow = mysql_num_rows($select);
		if ($numRow == 0) {
			echo "<script>window.location = 'index.php?list=1';</script>";
		} else {
			echo "<script>window.location = 'index.php?list=21&id=$id';</script>";
		}
	}
} elseif ($act == 'clear') {
	$delete = mysql_query("DELETE FROM orders_temp WHERE id_session='$idt'");
	if ($delete) {
		echo "<script>window.location = 'index.php?list=1';</script>";
	}
} elseif ($act == 'cart') {
	$select = mysql_query("SELECT id_session FROM orders_temp WHERE id_session = '$idt'");
	$num = mysql_num_rows($select);
	if ($num > 0) {
		echo "<script>window.location = 'index.php?list=21';</script>";
	} else {
		echo "<script>window.alert('Keranjang Belanja Anda Masih Kosong');</script>";
		echo "<script>window.location = 'index.php?list=1';</script>";
	}
} elseif ($act == 'print') { 
	$id_cus = $_GET['id_cus'];
	$id_order = $_GET['id_order'];
	$total = $_GET['total'];
	

	$updateInv = mysql_query("UPDATE orders SET invoice='$invoice', status_order='1', total='$total' WHERE id_cus='$id_cus'");
	$queryOrd = mysql_query("SELECT * FROM orders WHERE id_cus='$id_cus'");
	$dataOrd = mysql_fetch_array($queryOrd);
	$queryTrs = mysql_query("SELECT * FROM transaksi WHERE id_order='$dataOrd[id_order]'");
	while($dataTrs = mysql_fetch_array($queryTrs)){
		$queryPro = mysql_query("SELECT * FROM product WHERE id_product='$dataTrs[id_product]'");
		$dataPro = mysql_fetch_array($queryPro);
		$updateStok = mysql_query("UPDATE product SET stock='$dataPro[stock]'-'$dataTrs[quantity_trans]', sale_product='$dataPro[sale_product]'+'$dataTrs[quantity_trans]' WHERE id_product='$dataTrs[id_product]'");
		$selectSale = mysql_query("SELECT * FROM vendor WHERE id_vendor='$dataPro[id_vendor]'");
		$dataSale = mysql_fetch_array($selectSale);
		$updateSale = mysql_query("UPDATE vendor SET sale_vendor='$dataSale[sale_vendor]'+'$dataTrs[quantity_trans]' WHERE id_vendor='$dataPro[id_vendor]'");

		// $messageProduct = "- ".$dataPro['name_product']." ".$dataPro['type']."<br/>";
	}

	
	if ($updateStok) {
		$deleteOt = mysql_query("DELETE FROM orders_temp WHERE id_session='$idt'");

		$selectCus = mysql_query("SELECT email_cus FROM customer WHERE id_cus='$id_cus'");
		$dataCus = mysql_fetch_array($selectCus);

		$from = '<nadiwatch@gmail.com>';
		$to = '<'.$dataCus['email_cus'].'>';
		// $cc = '<nadiwatch@gmail.com>';
		// $recipients = $to.", ".$cc;

		$subject = 'Pesanan Anda';
		$html = 
			"Anda sudah berhasil melakukan pemesanan di <span class='nameTitle'>nadiwatch.com</span><br>
			Segera lakukan <a href='http://localhost/nadi_watch/index.php?list=31' class='href'>konfirmasi pembayaran</a> agar pesanan anda bisa segera diproses";
		
		$headers['From']    = $from;
		$headers['To']      = $to;
		$headers['Subject'] = $subject;
		// $headers['Cc']      = $cc;

		$crlf = "\n";

		$mime = new Mail_mime($crlf);

		$mime->setHTMLBody($html);

		$body = $mime->get();
		$headers = $mime->headers($headers);

		$smtp = Mail::factory('smtp', array(
		        'host' => 'ssl://smtp.gmail.com',
		        'port' => '465',
		        'auth' => true,
		        'username' => 'nadiwatch@gmail.com',
		        'password' => 'nadiwatchpassword'
		    ));

		$mail = $smtp->send($to, $headers, $body);
		// $mail = $smtp->send($recipients, $headers, $body);

		if (PEAR::isError($mail)) {
		    echo('<p>' . $mail->getMessage() . '</p>');
			echo "<script>window.location = 'aplikasi/print.php?id_cus=$id_cus&id_order=$id_order';</script>";
		} else {
			echo "<script>window.location = 'aplikasi/print.php?id_cus=$id_cus&id_order=$id_order';</script>";
		}
	}

}
?>