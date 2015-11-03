<?php
	session_start();
	if(!isset($_SESSION['user'])) {
		echo "<script>window.location = 'index.php?list=5&head=admin';</script>";
	} else {
		echo "<script>window.location = 'index.php?list=6&head=admin';</script>";
	}
?>