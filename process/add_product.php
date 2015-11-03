<?php  
	include "../koneksi.php";
	$vendor = $_POST['vendor'];
	$name = $_POST['name']; 
	$type = $_POST['type'];
	$color = $_POST['color'];
	$price = $_POST['price'];
	$description = $_POST['description'];
	$stock = $_POST['stock'];
	$weight = $_POST['weight'];
	$gender = $_POST['gender'];
	$category = $_POST['category'];
	$fileSize = $_FILES["image"]["size"];

	$select = mysql_query("SELECT name_vendor FROM vendor WHERE id_vendor='$vendor'");
	$data = mysql_fetch_array($select);
	$data['name_vendor'] = strtolower($data['name_vendor']);

	if((!file_exists("../image/product/".$data['name_vendor']))&&(!is_dir("../image/product/".$data['name_vendor'])))
	{
		$folder = mkdir("../image/product/".$data['name_vendor']);
	}

	$tmp_name = $_FILES["image"]["tmp_name"];
	$name_img = "../image/product/".$data['name_vendor']."/".$_FILES["image"]["name"];


	$vend = substr($data['name_vendor'], 0, 2);
	$encript = md5($data['name_vendor']);
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
		$query = "INSERT INTO product(id_product,name_product,type,color,price,description,stock,gender,image_product,category,id_vendor,status_product,sale_product,weight_product,created_time_product) 
				VALUES('$nextNoProduct','$name','$type','$color','$price','$description','$stock','$gender','$name_img','$category','$vendor','1','','$weight','$time')";
	} else {
		$query = "INSERT INTO product(id_product,name_product,type,color,price,description,stock,gender,image_product,category,id_vendor,status_product,sale_product,weight_product,created_time_product) 
				VALUES('$nextNoProduct','$name','$type','$color','$price','$description','$stock','$gender','','$category','$vendor','1','','$weight','$time')";
	}

	// var_dump('expression');exit();
	$hasil = mysql_query($query);

	if ($hasil) {
		echo "<script>window.location = '../index.php?list=8&head=admin';</script>";
	} else {
		echo "<script>window.alert('Data Gagal Disimpan');</script>";
		echo "<script>window.location = '../index.php?list=10&head=admin';</script>";
	}
?>