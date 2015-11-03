<?php
	if(!isset($_SESSION['user'])) {
	  	echo "<script>window.alert('Anda Harus Login Dulu');</script>";
		echo "<script>window.location = 'index.php?list=5&head=admin';</script>";
	} else {

		$id = $_SESSION['user']['id_admin'];
		$query = mysql_query("SELECT * FROM admin WHERE id_admin='$id'");
		$result = mysql_fetch_array($query);
?>
<form method="post" action="process/edit_admin.php" onsubmit="return validasi(this)">
	<input type="hidden" name="id" value="<?php echo $result['id_admin']; ?>">
	<table class="width">
		<tr>
			<td align="center"><h2>PROFIL</h2></td>
		</tr>
	</table>		
	<table align="center">
		<tr>
			<td width="135px"><b>Email</b></td>
			<td colspan="2">
				<input class="input" type="text" name="email" placeholder="Email" value="<?php echo $result['email_admin']; ?>">
			</td>
		</tr>
		<tr>
			<td><b>Nama Depan</b></td>
			<td colspan="2">
				<input class="input" type="text" name="first_name" placeholder="Nama Depan" value="<?php echo $result['first_name_admin']; ?>">
			</td>
		</tr>
		<tr>
			<td><b>Nama Belakang</b></td>
			<td colspan="2">
				<input class="input" type="text" name="last_name" placeholder="Nama Belakang" value="<?php echo $result['last_name_admin']; ?>">
			</td>
		</tr>
		<tr>
			<td><b>Status</b></td>
			<td colspan="2">
				<input class="input" type="text" name="level" value="<?php echo $result['level']; ?>" readonly>
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
				<!-- <a href="index.php?list=1" class="button round warning">Kembali</a> -->
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