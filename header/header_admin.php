<!DOCTYPE html>
<html>
<head>
	<title>nadiWatch.com</title>
	<link rel="stylesheet" type="text/css" href="css/font/stylesheet.css">
	<link rel="stylesheet" type="text/css" href="css/global.css">
	<!-- <link rel="stylesheet" type="text/css" href="../css/naked.css"> -->
	<!-- <link rel="shortcut icon" href="../image/favicon/favicon.ico" type="image/x-icon" /> -->
	<link rel="shortcut icon" href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/favicon/favicon.ico' ?>" type="image/x-icon" />
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/highcharts.js"></script>
	<script>
		function validasi(form) {
			if (form.search.value == ""){
				alert("Silahkan input produk yang anda cari.");
				form.search.focus();
				return (false);
			}    
		}
	</script>
	<style type="text/css">
		.search {
			margin: 7px 10px;
			width: 23%;
			height: 28px;
			border-radius: 30px;
			outline-style: none;
			padding-left: 7px;
		}

		img.padding {
			padding-right: 4px;
		}
	</style>
</head>
<body bgcolor="#80B2FF">
	<?php
		if (!isset($_SESSION)) {
		    session_start();
		}

		include "koneksi.php";
		include "function/function.php";

		if (isset($_SESSION['user'])) {
			$id = $_SESSION['user']['id_admin'];
			$query = mysql_query("SELECT * FROM admin WHERE id_admin='$id'");
			$result = mysql_fetch_array($query);
		}
	?>
	<div class="row-header radius">
		<table class="width">
			<tr>
				<td width="9%" align="right">
					<a href="index.php?list=1&head=home"><img class="padding" src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/logo-icon.png' ?>" width="70%"></a>
				</td>
				<td width="26%">
					<a href="index.php?list=1&head=home" class="href nameTitle headerName">nadiWatch.com</a><br />
					<span class="subHeaderName">Menjual Jam Tangan Baru dan Bergaransi</span>
				</td>
				<td width="35%" align="right" style="vertical-align: top;">
					<?php if(isset($_SESSION['user'])): ?>
						<a href="index.php?list=16&head=admin" class="href">
							<font color="#fff">
								<?php echo ucwords($result['first_name_admin']); ?> <?php echo ucwords($result['last_name_admin']); ?>
							</font>
						</a> ||
						<a href="index.php?list=7&head=home" class="href">Keluar &nbsp;</a>
					<?php endif ?>
				</td>
			</tr>
		</table>
	</div>
	<?php if (isset($_SESSION['user'])): ?>
		<div class="row-menu radius">
			<table class="width">
				<tr>
					<td>
						<ul class="dropmenu">
							<li><a href="index.php?list=4&act=admin&head=admin">Dashboard</a></li>
							<li><a href="index.php?list=25&head=admin">Vendor</a></li>
							<li><a href="index.php?list=29&head=admin">Transaksi</a></li>
							<li><a href="index.php?list=37&head=admin">Member</a></li>
							<!-- <li><a href="index.php?list=40&head=admin">Ongkir</a></li> -->
							<!-- <li><a href="../admin/grafik.php">Grafik Penjualan</a></li> -->
						</ul>
					</td>
				</tr>
			</table>
		</div>		
	<?php endif ?>
	<div class="row-isi radius-top">
		<div>&nbsp;</div>
		<!-- <form action="../search/search_admin.php" method="post" onsubmit="return validasi(this)">
			<table class="width">
				<tr>
					<td align="right">
						<input class="search" type="search" name="search" placeholder="Cari Produk">
					</td>
				</tr>
			</table>
		</form> -->
	</div>
</body>
</html>