<!DOCTYPE html>
<html>
<head>
	<title>nadiWatch.com</title>
	<link rel="stylesheet" type="text/css" href="css/global.css">
	<link rel="stylesheet" type="text/css" href="css/font/stylesheet.css">
	<link rel="stylesheet" type="text/css" href="js/datepicker/jquery-ui.css">
	<!-- <link rel="stylesheet" type="text/css" href="../css/naked.css"> -->
	<!-- <link rel="shortcut icon" href="../image/favicon/favicon.ico" type="image/x-icon" /> -->
	<link rel="shortcut icon" href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/favicon/favicon.ico' ?>" type="image/x-icon" />
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/datepicker/jquery-ui.js"></script>
	<script>
		function validasi(form) {
			if (form.search.value == ""){
				alert("Silahkan masukan kata kunci yang anda cari.");
				form.search.focus();
				return (false);
			}    
		}
	</script>

	<style type="text/css">
		.search { margin: 7px 10px; width: 23%; height: 28px; border-radius: 30px; outline-style: none; padding-left: 7px; }
		img.padding { padding-right: 4px; }
	</style>
</head>
<body bgcolor="#80B2FF">
	<?php 
		if (!isset($_SESSION)) {
		    session_start();
		}

		include "koneksi.php";
		include "function/function.php";
		if(isset($_SESSION['id_admin'])) { 
			$id = $_SESSION['id_admin']; 
		} else { 
			$id = ""; 
		}

		if(!isset($_SESSION['transaksi'])){
		    $idt = date("YmdHis");
		    $_SESSION['transaksi'] = $idt;
		}
		$idt = $_SESSION['transaksi'];

		$sqlCart = mysql_query("SELECT id_session FROM orders_temp WHERE id_session = '$idt'");
		$numCart = mysql_num_rows($sqlCart);
		if ($numCart > 0) {
			$totalCart = $numCart;
		} else {
			$totalCart = 0;
		}

		// if (isset($_SESSION['user'])) {
		// 	$idUser = $_SESSION['user']['id'];
		// 	$queryUser = mysql_query("SELECT * FROM user WHERE id='$idUser'");
		// 	$resultUser = mysql_fetch_array($queryUser);
		// } else
		if (isset($_SESSION['member'])) {
			$idMember = $_SESSION['member']['id_member'];
			$queryMember = mysql_query("SELECT * FROM member WHERE id_member='$idMember'");
			$resultMember = mysql_fetch_array($queryMember);
		}

		if (isset($_GET['id_order'])) {
			$id_order = $_GET['id_order'];
		} else {
			$id_order = "";
		}

		$dataVendor = mysql_query("SELECT * FROM vendor ORDER BY name_vendor ASC");
		$dataVendor2 = mysql_query("SELECT * FROM vendor ORDER BY name_vendor ASC");
		$dataVendor3 = mysql_query("SELECT * FROM vendor ORDER BY name_vendor ASC");

		// autoDelete("customer");
		// autoDelete("orders");
		// autoDelete("orders_temp");
		// autoDelete("transaksi");
	?>
	<div class="row-header radius">
		<table class="width">
			<tr>
				<td width="9%" align="right">
					<a href="index.php?list=1&head=home" class="href"><img class="padding" src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/logo-icon.png' ?>" width="70%"></a>
				</td>
				<td width="26%">
					<a href="index.php?list=1&head=home" class="href nameTitle headerName">nadiWatch.com</a><br />
					<span class="subHeaderName">Menjual Jam Tangan Baru dan Bergaransi</span>
				</td>
				<td width="35%" align="right" style="vertical-align: top;">
					<?php if (isset($_SESSION['member'])): ?>
						<?php if (isset($_SESSION['member'])): ?>
							<a href="index.php?list=32" class="href">
								<font color="#fff">
									<?php echo ucfirst($resultMember['first_name_member']); ?> <?php echo ucfirst($resultMember['last_name_member']); ?>
								</font>
							</a>
						<?php endif ?>
						|| <a href='index.php?list=7&head=home' class='href'>Keluar &nbsp;</a>
					<?php else: ?>
						<a href='index.php?list=2&head=home&id_order=<?php echo $id_order?>' class='href'>Masuk</a> || <a href="index.php?list=3&head=home" class="href">Daftar&nbsp;</a>				
					<?php endif ?>		
				</td>
			</tr>
		</table>
	</div>
	<div class="row-menu radius">
		<table class="width">
			<tr>
				<td width="93%">
					<ul class="dropmenu">
						<li><a href="index.php?list=1&head=home">Beranda</a></li>
						<li>
							<a href="#">Fashion</a>
							<ul class="dropdown">
								<?php while($resultVendor=mysql_fetch_array($dataVendor)): ?>
									<li>
										<a href="<?php echo "index.php?list=30&cat=fashion&vendor=$resultVendor[id_vendor]" ?>" class="droplist"><?php echo ucwords($resultVendor['name_vendor']); ?></a>
									</li>
								<?php endwhile ?>
							</ul>
						</li>
						<li>
							<a href="#">Casual</a>
							<ul class="dropdown">
								<?php while($resultVendor=mysql_fetch_array($dataVendor2)): ?>
									<li>
										<a href="<?php echo "index.php?list=30&cat=casual&vendor=$resultVendor[id_vendor]" ?>" class="droplist"><?php echo ucwords($resultVendor['name_vendor']); ?></a>
									</li>
								<?php endwhile ?>
							</ul>
						</li>
						<li>
							<a href="#">Sport</a>
							<ul class="dropdown">
								<?php while($resultVendor=mysql_fetch_array($dataVendor3)): ?>
									<li>
										<a href="<?php echo "index.php?list=30&cat=sport&vendor=$resultVendor[id_vendor]" ?>" class="droplist"><?php echo ucwords($resultVendor['name_vendor']); ?></a>
									</li>
								<?php endwhile ?>
							</ul>
						</li>
						<li>
							<a href="index.php?list=31">Pemesanan</a>
						</li>
						<li>
							<a href="index.php?list=34">Cara Order</a>
						</li>
						<li>
							<a href="index.php?list=35">Kontak Kami</a>
						</li>
					</ul>
				</td>
				<td width="7%">
					<a href="index.php?list=4&act=cart" class="href">
						<img class="padding" src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/icon/cart.png' ?>" width="50%"> 
						<span style="vertical-align:4px;font-size:23px;color:#FFF;"><?php echo $totalCart; ?></span>
					</a>
				</td>
			</tr>
		</table>
	</div>
	<form action="" method="get" onsubmit="return validasi(this)">
		<div class="row-isi radius-top">
			<table class="width">
				<tr>
					<td align="right">
						<input type="hidden" name="list" value="1">
						<input class="search" type="search" name="search" placeholder="Cari Produk">
					</td>
				</tr>
			</table>
		</div>
	</form>
</body>
</html>