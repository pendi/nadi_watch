<?php
	if(!isset($_SESSION['user'])) {
	  	echo "<script>window.alert('Anda Harus Login Dulu');</script>";
		echo "<script>window.location = 'index.php?list=5&head=home';</script>";
	} else {
?>
<form action="process/add_vendor.php" method="post" onsubmit="return validasi(this)">
	<table class="width">
		<tr>
			<td colspan="3" align="center"><h2>TAMBAH VENDOR</h2></td>
		</tr>
		<tr>
		<tr>
			<td width="20%"></td>
			<td width="5%">Nama &nbsp;</td>
			<td width="33%">
				<input type="text" class="input" name="name" placeholder="Nama">
			</td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3" align="center">
				<input type="submit" name="submit" class="button round" value="Simpan">
				<a href="index.php?list=25&head=admin" class="button round error">Batal</a>
			</td>
		</tr>
	</table>
</form>
<?php } ?>
<script>
	function validasi(form) {
		if (form.name.value == ""){
			alert("Anda belum mengisikan Nama Vendor.");
			form.name.focus();
			return (false);
		}
		return (true);  
	}
</script>