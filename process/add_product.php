<?php  
	include "../koneksi.php";
	$vendor = $_POST['vendor'];
	$name = $_POST['name']; 
	$type = $_POST['type'];
	$color = $_POST['color'];
	$price = $_POST['price'];
	$description = $_POST['description'];
	$stock = $_POST['stock'];
	$gender = $_POST['gender'];
	$category = $_POST['category'];
	$fileSize = $_FILES["image"]["size"];

	$select = mysql_query("SELECT name FROM vendor WHERE id='$vendor'");
	$data = mysql_fetch_array($select);
	$data['name'] = strtolower($data['name']);

	if((!file_exists("../image/product/".$data['name']))&&(!is_dir("../image/product/".$data['name'])))
	{
		$folder = mkdir("../image/product/".$data['name']);
	}

	$tmp_name = $_FILES["image"]["tmp_name"];
	$name_img = "../image/product/".$data['name']."/".$_FILES["image"]["name"];


	$vend = substr($data['name'], 0, 2);
	$encript = md5($data['name']);
	$alfaOnly = preg_replace("/[^A-Za-z]/", '', $encript);
	$alfa = substr($alfaOnly, 0, 3);
	$kode = strtoupper($vend.$alfa);

	$kdauto = mysql_query("SELECT max(id_product) AS last FROM product WHERE id_product LIKE '$kode%'");
	$result = mysql_fetch_array($kdauto);
	$lastNoProduct = $result['last'];
	$lastNoUrut = substr($lastNoProduct, 5, 3);
	$nextNoUrut = $lastNoUrut + 1;
	$nextNoProduct = $kode.sprintf('%03s', $nextNoUrut);

	$time = date("Y-m-d H:i:s");

	if ($fileSize > 0) {
		move_uploaded_file($tmp_name, $name_img);
		$query = "INSERT INTO product(id_product,name,type,color,price,description,stock,gender,image,category,vendor_id,status,sale,rate,created_time) 
				VALUES('$nextNoProduct','$name','$type','$color','$price','$description','$stock','$gender','$name_img','$category','$vendor','1','','','$time')";
	} else {
		$query = "INSERT INTO product(id_product,name,type,color,price,description,stock,gender,image,category,vendor_id,status,sale,rate,created_time) 
				VALUES('$nextNoProduct','$name','$type','$color','$price','$description','$stock','$gender','','$category','$vendor','1','','','$time')";
	}

	$hasil = mysql_query($query);

	if ($hasil) {
		echo "<script>window.location = '../index.php?list=8&head=admin';</script>";
	} else {
		echo "<script>window.alert('Data Gagal Disimpan');</script>";
		echo "<script>window.location = '../index.php?list=10&head=admin';</script>";
	}
?>