<?php
	if(!isset($_SESSION['user'])) {
	  	echo "<script>window.alert('Anda Harus Login Dulu');</script>";
		echo "<script>window.location = 'index.php?list=5&head=home';</script>";
	} else {
	
	$que = mysql_query("SELECT * FROM product WHERE id_product='$_GET[id_product]'");
	$data = mysql_fetch_array($que);

	$sql = mysql_query("SELECT name FROM vendor WHERE id='$data[vendor_id]'");
	$result = mysql_fetch_array($sql);
?>
<style type="text/css">
	.td{
		vertical-align: top;
	}
</style>
<form action="process/delete_product.php" method="post">
<input type="hidden" name="id" value="<?php echo $data['id_product']; ?>">
	<center>			
		<table width="80%">
			<tr>
				<td colspan="4" align="center"><h2>HAPUS PRODUK</h2></td>
			</tr>
			<tr>
				<td width="10%"></td>
				<td width="12%">Id Produk &nbsp;</td>
				<td width="1%">:</td>
				<td width="43%"><?php echo $data['id_product']; ?></td>
			</tr>
			<tr>
				<td></td>
				<td>Vendor &nbsp;</td>
				<td>:</td>
				<td><?php echo ucwords($result['name']); ?></td>
			</tr>
			<tr>
				<td></td>
				<td>Nama &nbsp;</td>
				<td>:</td>
				<td><?php echo $data['name']; ?></td>
			</tr>
			<tr>
				<td></td>
				<td>Model &nbsp;</td>
				<td>:</td>
				<td><?php echo $data['type']; ?></td>
			</tr>
			<tr>
				<td></td>
				<td>Warna &nbsp;</td>
				<td>:</td>
				<td><?php echo $data['color']; ?></td>
			</tr>
			<tr>
				<td></td>
				<td>Harga &nbsp;</td>
				<td>:</td>
				<td>Rp. <?php echo price($data['price']); ?></td>
			</tr>
			<tr>
				<td></td>
				<td class="td">Deskripsi &nbsp;</td>
				<td class="td">:</td>
				<td><?php echo nl2br($data['description']); ?></td>
			</tr>
			<tr>
				<td></td>
				<td>Stok &nbsp;</td>
				<td>:</td>
				<td><?php echo $data['stock']; ?></td>
			</tr>
			<tr>
				<td></td>
				<td>Pemakai &nbsp;</td>
				<td>:</td>
				<td><?php echo ucwords($data['gender']); ?></td>
			</tr>
			<tr>
				<td></td>
				<td>Kategori &nbsp;</td>
				<td>:</td>
				<td><?php echo ucwords($data['category']); ?></td>
			</tr>
			<tr>
				<td></td>
				<td>Gambar</td>
				<td></td>
				<td>
					<?php if (!empty($data['image'])): ?>				
						<img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/'.$data['image']; ?>" width="150px"><br/>
					<?php else : ?>
						<img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/product/no-image.jpg' ?>" width="150px"><br/>
					<?php endif ?>
				</td>
			</tr>
			<tr>
				<td colspan="4">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="4" align="center">
					<input type="submit" name="submit" class="button round" value="Hapus" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
					<a href="index.php?list=8&head=admin" class="button round error">Batal</a>
				</td>
			</tr>
		</table>		
	</center>
</form>
<?php } ?>