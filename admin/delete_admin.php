<?php
	if(!isset($_SESSION['user'])) {
	  	echo "<script>window.alert('Anda Harus Login Dulu');</script>";
		echo "<script>window.location = 'index.php?list=5&head=admin';</script>";
	} elseif ($_SESSION['user']['level'] == "admin") {
		echo "<script>window.alert('Maaf Anda Tidak Memiliki Hak Akses');</script>";
		echo "<script>window.location = 'index.php?list=8&head=admin';</script>";
	} else {

	$que = mysql_query("SELECT * FROM admin WHERE id_admin='$_GET[id]'");
	$data = mysql_fetch_array($que);
?>
<form action="process/delete_admin.php" method="post">
	<input type="hidden" name="id" value="<?php echo $data[0]; ?>">
	<table class="width">
		<tr>
			<td colspan="3" align="center"><h2>HAPUS ADMIN</h2></td>
		</tr>
		<tr>
			<td width="27%"></td>
			<td width="10%">Email &nbsp;</td>
			<td width="35%">: <?php echo $data['email_admin']; ?></td>
		</tr>
		<tr>
			<td></td>
			<td>Nama Lengkap &nbsp;</td>
			<td>: <?php echo $data['first_name_admin']; ?> <?php echo $data['last_name_admin']; ?></td>
		</tr>
		<tr>
			<td></td>
			<td>Password &nbsp;</td>
			<td>: *****</td>
		</tr>
		<tr>
			<td></td>
			<td>Status &nbsp;</td>
			<td>: <?php echo $data['level']; ?></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3" align="center">
				<input type="submit" name="submit" class="button round" value="Hapus" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
				<a href="index.php?list=9&head=admin" class="button round error">Batal</a>
			</td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
	</table>
</form>
<?php } ?>