<?php
	if(!isset($_SESSION['user'])) {
	  	echo "<script>window.alert('Anda Harus Login Dulu');</script>";
		echo "<script>window.location = 'index.php?list=5&head=home';</script>";
	} elseif ($_SESSION['user']['level'] == "admin") {
		echo "<script>window.alert('Maaf Anda Tidak Memiliki Hak Akses');</script>";
		echo "<script>window.location = 'index.php?list=8&head=admin';</script>";
	} else {
?>
<form action="process/register_admin.php" method="post" onsubmit="return validasi(this)">
	<table width="75%" align="center" bgcolor="#E6E6E6">
		<tr>
			<td colspan="3"><center><h2>TAMBAH ADMIN</h2></center></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td width="10%"></td>
			<td width="15%">Email &nbsp;</td>
			<td width="35%">
				<input autofocus type="text" class="input" name="email" placeholder="Email">
			</td>
		</tr>
		<tr>
			<td></td>
			<td>Nama Depan &nbsp;</td>
			<td>
				<input type="text" class="input" name="first_name" placeholder="Nama Depan">
			</td>
		</tr>
		<tr>
			<td></td>
			<td>Nama Belakang &nbsp;</td>
			<td>
				<input type="text" class="input" name="last_name" placeholder="Nama Belakang">
			</td>
		</tr>
		<tr>
			<td></td>
			<td>Password &nbsp;</td>
			<td>
				<input type="password" class="input" name="password" placeholder="Password">
			</td>
		</tr>
		<tr>
			<td></td>
			<td>Konfirmasi Password &nbsp;</td>
			<td>
				<input type="password" class="input" name="conf_password" placeholder="Konfirmasi Password">
			</td>
		</tr>
		<tr>
			<td></td>
			<td>Status &nbsp;</td>
			<td>
				<select name="status" size="0">
					<option value="0">Pilih Status</option>
					<option value="super admin">Super Admin</option>
					<option value="admin">Admin</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3" align="center">
				<input type="submit" name="submit" value="Simpan" class="button round">
				<a href="index.php?list=9&head=admin" class="button round error">Batal</a>
			</td>
		</tr>
	</table>
</form>
<?php } ?>

<script>
	function validasi(form) {
		if (form.email.value == ""){
			alert("Anda belum mengisikan Email.");
			form.email.focus();
			return (false);
		}
		if (form.first_name.value == ""){
			alert("Anda belum mengisikan Nama Depan.");
			form.first_name.focus();
			return (false);
		}
		if (form.password.value == ""){
			alert("Anda belum mengisikan Password.");
			form.password.focus();
			return (false);
		}
		if (form.conf_password.value == ""){
			alert("Anda belum mengisikan Konfirmasi Password.");
			form.conf_password.focus();
			return (false);
		}
		if (form.password.value != "" || form.conf_password.value != ""){
			if (form.password.value != form.conf_password.value) {
				alert("Konfirmasi Password Anda Tidak Cocok.");
				form.conf_password.focus();
				return (false);
			}
		}
		if (form.status.value == 0){
			alert("Anda belum memilih Status.");
			form.status.focus();
			return (false);
		}
		return (true);
	}
</script>