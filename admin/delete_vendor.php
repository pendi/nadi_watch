<?php
	if(!isset($_SESSION['user'])) {
	  	echo "<script>window.alert('Anda Harus Login Dulu');</script>";
		echo "<script>window.location = 'index.php?list=5&head=admin';</script>";
	} else {

	$select = mysql_query("SELECT * FROM vendor WHERE id_vendor='$_GET[id]'");
	$data = mysql_fetch_array($select);
?>
<form action="process/delete_vendor.php" method="post">
	<input type="hidden" name="id" value="<?php echo $data['id_vendor']; ?>">
	<table class="width">
		<tr>
			<td colspan="3" align="center"><h2>HAPUS VENDOR</h2></td>
		</tr>
		<tr>
		<tr>
			<td width="20%"></td>
			<td width="5%">Nama &nbsp;</td>
			<td width="33%">
				: <?php echo ucwords($data['name_vendor']); ?>
			</td>
		</tr>
		<tr>
			<td width="20%"></td>
			<td width="5%">Terjual &nbsp;</td>
			<td width="33%">
				: <?php echo $data['sale_vendor']; ?> Unit
			</td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3" align="center">
				<input type="submit" name="submit" class="button round" value="Hapus" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
				<a href="index.php?list=25&head=admin" class="button round error">Batal</a>
			</td>
		</tr>
	</table>
</form>
<?php } ?>