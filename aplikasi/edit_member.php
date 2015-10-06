<?php
	if(!isset($_SESSION['member'])) {
	  	echo "<script>window.alert('Anda Harus Login Dulu');</script>";
		echo "<script>window.location = 'index.php?list=2&head=home';</script>";
	} else {

		$id = $_SESSION['member']['id'];
		$query = mysql_query("SELECT * FROM member WHERE id='$id'");
		$result = mysql_fetch_array($query);
?>
<form method="post" action="process/edit_member.php" onsubmit="return validasi(this)">
	<input type="hidden" name="id" value="<?php echo $result['id']; ?>">
	<table class="width">
		<tr>
			<td align="center"><h2>PROFIL</h2></td>
		</tr>
	</table>		
	<table align="center">
		<tr>
			<td width="135px"><b>Email</b></td>
			<td colspan="2">
				<input class="input" type="text" name="email" placeholder="Email" value="<?php echo $result['email']; ?>">
			</td>
		</tr>
		<tr>
			<td><b>Nama Depan</b></td>
			<td colspan="2">
				<input class="input" type="text" name="first_name" placeholder="Nama Depan" value="<?php echo $result['first_name']; ?>">
			</td>
		</tr>
		<tr>
			<td><b>Nama Belakang</b></td>
			<td colspan="2">
				<input class="input" type="text" name="last_name" placeholder="Nama Belakang" value="<?php echo $result['last_name']; ?>">
			</td>
		</tr>
		<tr>
			<td><b>Alamat</b></td>
			<td colspan="2">
				<textarea name="address" placeholder="ALamat"><?php echo $result['address']; ?></textarea>
			</td>
		</tr>
		<tr>
			<td><b>Telephone</b></td>
			<td colspan="2">
				<input class="input" type="text" name="telp" placeholder="Telephone" value="<?php echo $result['telp']; ?>">
			</td>
		</tr>
		<tr>
			<td><b>Password</b></td>
			<td><input class="input" type="password" name="password" placeholder="Password"></td>
			<td><input class="input" type="password" name="conf_password" placeholder="Konfirmasi Password"></td>
		</tr>
		<tr>
			<td colspan="3" align="center" style="padding-top:30px">
				<input type="submit" value="Simpan" class="button round"> 
				<a href="index.php?list=1" class="button round warning">Kembali</a>
			</td>
		</tr>
	</table>
</form>
<?php } ?>
<script>
	function validasi(form) {
		if (form.email.value == ""){
			alert("Email tidak boleh kosong.");
			form.email.focus();
			return (false);
		}
		if (form.first_name.value == ""){
			alert("Nama Depan tidak boleh kosong.");
			form.first_name.focus();
			return (false);
		}
		if (form.address.value == ""){
			alert("Alamat tidak boleh kosong.");
			form.address.focus();
			return (false);
		}
		if (form.telp.value == ""){
			alert("Nomor Telepon tidak boleh kosong.");
			form.telp.focus();
			return (false);
		}
		if (form.password.value == ""){
			alert("Silahkan masukan password anda.");
			form.password.focus();
			return (false);
		}
		if (form.conf_password.value == ""){
			alert("Silahkan masukan konfirmasi password anda.");
			form.conf_password.focus();
			return (false);
		}
		if (form.password.value != form.conf_password.value){
			alert("Konfirmasi password anda tidak cocok.");
			form.conf_password.focus();
			return (false);
		}
	}
</script>