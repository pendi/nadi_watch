<?php  
include "../koneksi.php";
$id = $_POST['id'];
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

// var_dump($name_img);exit();
if ($fileSize > 0) {
	move_uploaded_file($tmp_name, $name_img);
	
	$query = "UPDATE product SET name='$name',type='$type',color='$color',price='$price',description='$description',stock='$stock',gender='$gender',image='$name_img',category='$category',vendor_id='$vendor' WHERE id_product='$id'";
} else {
	$query = "UPDATE product SET name='$name',type='$type',color='$color',price='$price',description='$description',stock='$stock',gender='$gender',category='$category',vendor_id='$vendor' WHERE id_product='$id'";
}

$hasil = mysql_query($query);
if ($hasil) {
	// echo "<script>window.alert('Berhasil');</script>";
	echo "<script>window.location = '../index.php?list=8&head=admin';</script>";
} else {
	echo "<script>window.alert('Data Gagal Disimpan');</script>";
	echo "<script>window.location = 'view_product.php';</script>";
}

?>