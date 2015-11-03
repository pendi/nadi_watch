<?php  
	include "../koneksi.php";
	$email = $_POST['email'];
	$name = $_POST['name']; 
	$message = $_POST['message'];
	$fileSize = $_FILES["image"]["size"];


	if((!file_exists("../image/contact"))&&(!is_dir("../image/contact")))
	{
		$folder = mkdir("../image/contact");
	}

	$tmp_name = $_FILES["image"]["tmp_name"];
	$name_img = "../image/contact/".$_FILES["image"]["name"];

	if ($fileSize > 0) {
		move_uploaded_file($tmp_name, $name_img);
		$query = "INSERT INTO contact(id_contact,email_contact,name_contact,message_contact,image_contact) 
				VALUES(null,'$email','$name','$message','$name_img')";
	} else {
		$query = "INSERT INTO contact(id_contact,email_contact,name_contact,message_contact,image_contact) 
				VALUES(null,'$email','$name','$message','')";
	}
	
	$hasil = mysql_query($query);

	if ($hasil) {
		echo "<script>window.alert('Pesan anda sudah dikirim');</script>";
		echo "<script>window.location = '../index.php?list=1';</script>";
	}
?>