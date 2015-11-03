<?php 
	if(!isset($_SESSION['user'])) {
	  	echo "<script>window.alert('Anda Harus Login Dulu');</script>";
		echo "<script>window.location = 'index.php?list=5&head=admin';</script>";
	} else {

	$query = "SELECT * FROM vendor ORDER BY name_vendor ASC";
	$sql = mysql_query($query);
?>
<form action="process/add_product.php" method="post" enctype="multipart/form-data" onsubmit="return validasi(this)">
	<table class="width">
		<tr>
			<td colspan="3"><center><h2>TAMBAH PRODUK</h2></center></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td width="20%"></td>
			<td width="12%">Vendor</td>
			<td width="33%">
				<select name='vendor' autofocus size="0">
					<option value="0">Pilih Vendor</option>
					<?php while ($data = mysql_fetch_array($sql)): ?>
						<option value=<?php echo $data[0] ?>><?php echo ucwords($data[1]) ?></option>
					<?php endwhile ?>
				</select>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>Nama &nbsp;</td>
			<td><input type="text" class="input" name="name" placeholder="Nama"></td>
		</tr>
		<tr>
			<td></td>
			<td>Model &nbsp;</td>
			<td><input type="text" class="input" name="type" placeholder="Model"></td>
		</tr>
		<tr>
			<td></td>
			<td>Warna &nbsp;</td>
			<td><input type="text" class="input" name="color" placeholder="Warna"></td>
		</tr>
		<tr>
			<td></td>
			<td>Harga &nbsp;</td>
			<td><input type="number" class="input" name="price" placeholder="Harga"></td>
		</tr>
		<tr>
			<td></td>
			<td style="vertical-align: top;">Deskripsi &nbsp;</td>
			<td><textarea name="description" rows="5" cols="20" placeholder="Deskripsi"></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td>Stok &nbsp;</td>
			<td><input type="number" class="input" name="stock" placeholder="Stok"></td>
		</tr>
		<tr>
			<td></td>
			<td>Berat &nbsp;</td>
			<td><input type="text" class="input" name="weight" placeholder="Berat"></td>
		</tr>
		<tr>
			<td width="20%"></td>
			<td width="12%">Pemakai</td>
			<td width="33%">
				<select name='gender' size="0">
					<option value="0">Pilih Pemakai</option>
					<option value="pria">Pria</option>
					<option value="wanita">Wanita</option>
				</select>
			</td>
		</tr>
		<tr>
			<td width="20%"></td>
			<td width="12%">Kategori</td>
			<td width="33%">
				<select name='category' size="0">
					<option value="0">Pilih Kategori</option>
					<option value="casual">Casual</option>
					<option value="fashion">Fashion</option>
					<option value="sport">Sport</option>
				</select>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>Pilih Gambar &nbsp;</td>
			<td><input type="file" name="image"></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3" align="center">
				<input type="submit" name="submit" class="button round" value="Simpan"> 
				<a href="index.php?list=8&head=admin" class="button round error">Batal</a>
			</td>
		</tr>
	</table>
</form>
<?php } ?>
<script>
	function validasi(form) {
		if (form.vendor.value == 0){
			alert("Anda belum memilih Vendor Produk.");
			form.vendor.focus();
			return (false);
		}
		if (form.name.value == ""){
			alert("Anda belum mengisikan Nama Produk.");
			form.name.focus();
			return (false);
		}
		if (form.color.value == ""){
			alert("Anda belum mengisikan Warna Produk.");
			form.color.focus();
			return (false);
		}
		// if (form.type.value == ""){
		// 	alert("Anda belum mengisikan Type Produk.");
		// 	form.type.focus();
		// 	return (false);
		// }
		if (form.price.value == ""){
			alert("Anda belum mengisikan Harga Produk.");
			form.price.focus();
			return (false);
		}
		if (form.description.value == ""){
			alert("Anda belum mengisikan Deskripsi Produk.");
			form.description.focus();
			return (false);
		}
		if (form.stock.value == ""){
			alert("Anda belum mengisikan Stok Produk.");
			form.stock.focus();
			return (false);
		}
		if (form.gender.value == 0){
			alert("Pilihlah Pemakai Jam.");
			form.gender.focus();
			return (false);
		}
		if (form.category.value == 0){
			alert("Anda belum memilih Kategori.");
			form.category.focus();
			return (false);
		}
		return (true);  
	}
</script>