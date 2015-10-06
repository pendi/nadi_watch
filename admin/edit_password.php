<?php
	if(!isset($_SESSION['user'])) {
	  	echo "<script>window.alert('Anda Harus Login Dulu');</script>";
		echo "<script>window.location = 'index.php?list=5&head=home';</script>";
	} else {

	$query = mysql_query("SELECT * FROM user WHERE id='$_GET[id]'");
	$data = mysql_fetch_array($query);
?>
<form action="process/edit_admin.php" method="post" enctype="multipart/form-data" onsubmit="return validasi(this)">
<input type="hidden" name="id" value="<?php echo $data[0]; ?>" />
<input type="hidden" name="act" value="<?php echo $_GET['act']; ?>" />
<input type="hidden" name="list" value="<?php echo $_GET['list']; ?>" />
	<table class="width">
		<tr>
			<td colspan="3" align="center"><h2>GANTI PASSWORD</h2></td>
		</tr>
		<tr>
			<td width="23%"></td>
			<td width="12%">Ganti Password &nbsp;</td>
			<td width="35%"><input autofocus type="password" class="input" name="newpass" placeholder="Ganti Password"></td>
		</tr>
		<tr>
			<td></td>
			<td>Konfirmasi Password &nbsp;</td>
			<td><input type="password" class="input" name="newpass2" placeholder="Konfirmasi Password"></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td></td>
			<td>Masukan Password &nbsp;</td>
			<td><input type="password" class="input" name="password" placeholder="Masukan Password"></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3" align="center">
				<input type="submit" name="submit" value="Simpan" class="button round">
				<a href="index.php?list=16&head=admin" class="button round error">Batal</a>
			</td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
	</table>
</form>
<?php } ?>
<script>
	function validasi(form) {
		if (form.newpass.value == 0){
			alert("Password harus diisi.");
			form.newpass.focus();
			return (false);
		}
		if (form.newpass2.value == ""){
			alert("Masukan konfirmasi password anda.");
			form.newpass2.focus();
			return (false);
		}
		if (form.newpass.value != "" || form.newpass2.value != ""){
			if (form.newpass.value != form.newpass2.value) {
				alert("Konfirmasi Password Anda Tidak Cocok.");
				form.newpass2.focus();
				return (false);
			}
		}
		if (form.password.value == ""){
			alert("Masukan password lama anda untuk konfirmasi.");
			form.password.focus();
			return (false);
		}
		return (true);  
	}

</script>