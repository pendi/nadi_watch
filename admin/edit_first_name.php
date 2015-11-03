<?php
	if(!isset($_SESSION['user'])) {
	  	echo "<script>window.alert('Anda Harus Login Dulu');</script>";
		echo "<script>window.location = 'index.php?list=5&head=admin';</script>";
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
			<td colspan="3" align="center"><h2>GANTI NAMA DEPAN</h2></td>
		</tr>
		<tr>
			<td width="23%"></td>
			<td width="12%">Ganti Nama Depan &nbsp;</td>
			<td width="35%"><input autofocus type="text" class="input" name="first_name" placeholder="Nama Depan" value="<?php echo $data['first_name']; ?>"></td>
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
		if (form.first_name.value == 0){
			alert("Nama depan harus diisi.");
			form.first_name.focus();
			return (false);
		}
		if (form.password.value == ""){
			alert("Anda belum memasukan password.");
			form.password.focus();
			return (false);
		}
		return (true);  
	}

</script>