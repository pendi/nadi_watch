<?php 
	if(!isset($_SESSION['transaksi'])){
	    $idt = date("YmdHis");
	    $_SESSION['transaksi'] = $idt;
	}
	$idt = $_SESSION['transaksi'];

	$query = mysql_query("SELECT id_session FROM orders_temp WHERE id_session = '$idt'");
	$numRow = mysql_num_rows($query);
	if ($numRow == 0) {
		echo "<script>window.alert('Keranjang Belanja Anda Masih Kosong');</script>";
		echo "<script>window.location = index.php?list=1';</script>";
	}


	if(isset($_GET['id_cus'])) { 
		$id_cus = $_GET['id_cus']; 
		$selectCus = mysql_query("SELECT * FROM customer WHERE id_cus = '$id_cus'");
		$dataCus = mysql_fetch_array($selectCus);
	} else {
		$id_cus = "";
	}

	if(isset($_SESSION['member'])) { 
		$id = $_SESSION['member']['id']; 
		$selectMember = mysql_query("SELECT * FROM member WHERE id = '$id'");
		$dataMember = mysql_fetch_array($selectMember);
	}
	
?>
<style type="text/css">
	.top {
		vertical-align: top;
	}
</style>
<form action="process/data_customer.php" method="post" onsubmit="return validasi(this)">
	<input type="hidden" name="id_order" value="<?php echo $_GET['id_order']; ?>">
	<input type="hidden" name="id_cus" value="<?php if(isset($_GET['id_cus'])){ echo $dataCus['id_cus'];}elseif(isset($_SESSION['member'])){ echo $dataMember['id'];} ?>">

	<table width="70%" align="center">
		<tr>
			<td><h2>Data Pembeli :</h2></td>
		</tr>
	</table>
	<table width="70%" align="center">
		<tr>
			<td><b>Email</b></td>
			<td><input autofocus type="text" class="input" name="email" placeholder="Email" value="<?php if(isset($_GET['id_cus'])){ echo $dataCus['email'];} if(isset($_SESSION['member'])){ echo $dataMember['email'];} ?>"></td>
		</tr>
		<tr>
			<td width="20%"><b>Nama Depan</b></td>
			<td><input type="text" class="input" name="first_name" placeholder="Nama Depan" value="<?php if(isset($_GET['id_cus'])){ echo $dataCus['first_name'];}elseif(isset($_SESSION['member'])){ echo $dataMember['first_name'];} ?>"></td>
		</tr>
		<tr>
			<td><b>Nama Belakang</b></td>
			<td><input type="text" class="input" name="last_name" placeholder="Nama Belakang" value="<?php if(isset($_GET['id_cus'])){ echo $dataCus['last_name'];}elseif(isset($_SESSION['member'])){ echo $dataMember['last_name'];} ?>"></td>
		</tr>
		<tr>
			<td class="top"><b>Alamat</b></td>
			<td><textarea cols="25" rows="5" name="address" placeholder="Alamat"><?php if(isset($_GET['id_cus'])){ echo $dataCus['address'];}elseif(isset($_SESSION['member'])){ echo $dataMember['address'];} ?></textarea></td>
		</tr>
		<tr>
			<td><b>Nomor Telepon</b></td>
			<td><input type="text" class="input" name="telp" placeholder="Nomor Telepon" value="<?php if(isset($_GET['id_cus'])){ echo $dataCus['telp'];}elseif(isset($_SESSION['member'])){ echo $dataMember['telp'];} ?>"></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" value="Simpan" class="button round"> 
				<a href="index.php?list=4&act=cart" class="button round warning">Kembali</a> 
				<!-- <a href="check.php?act=clear" class="button round error">Batal</a> -->
			</td>
		</tr>
		<!-- <tr>
			<td colspan="2">
				<a href="../login/member.php" class="button round">Member</a>
			</td>
		</tr> -->
	</table>
</form>
<script>
	function validasi(form) {
		if (form.email.value == ""){
			alert("Anda belum mengisikan Alamat Email.");
			form.email.focus();
			return (false);
		}
		if (form.first_name.value == ""){
			alert("Anda belum mengisikan Nama Depan.");
			form.first_name.focus();
			return (false);
		}
		if (form.address.value == ""){
			alert("Anda belum mengisikan Alamat.");
			form.address.focus();
			return (false);
		}
		if (form.telp.value == ""){
			alert("Anda belum mengisikan Nomor Telepon.");
			form.telp.focus();
			return (false);
		}
	}
</script>