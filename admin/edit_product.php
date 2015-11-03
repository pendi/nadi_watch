<?php
	if(!isset($_SESSION['user'])) {
	  	echo "<script>window.alert('Anda Harus Login Dulu');</script>";
		echo "<script>window.location = 'index.php?list=5&head=admin';</script>";
	} else {

	$query = mysql_query("SELECT * FROM product WHERE id_product = '$_GET[id_product]'");
	$data = mysql_fetch_array($query);

	$sql = mysql_query("SELECT * FROM vendor ORDER BY name_vendor ASC");
?>
<form action="process/edit_product.php" method="post" enctype="multipart/form-data" onsubmit="return validasi(this)">
	<input type="hidden" name="id" value="<?php echo $data['id_product']; ?>" />
	<table class="width">
		<tr>
			<td colspan="3" align="center"><h2>EDIT PRODUK</h2></td>
		</tr>
		<tr>
			<td width="20%"></td>
			<td width="12%">Id Produk &nbsp;</td>
			<td width="33%"><input type="text" class="input" value="<?php echo $data['id_product']; ?>" disabled></td>
		</tr>		
		<tr>
			<td></td>
			<td>Vendor &nbsp;</td>
			<td>
				<select name="vendor" size="0">
					<option value="0">Pilih Vendor</option>
					<?php while($r = mysql_fetch_array($sql)): ?>
						<option value="<?php echo $r['id_vendor']; ?>" <?php if($data['id_vendor'] == $r['id_vendor']){ echo "selected"; } ?>><?php echo ucwords($r['name_vendor']); ?></option>
					<?php endwhile ?>
				</select>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>Nama &nbsp;</td>
			<td><input type="text" class="input" name="name" placeholder="Nama" value="<?php echo $data['name_product']; ?>"></td>
		</tr>
		<tr>
			<td></td>
			<td>Model &nbsp;</td>
			<td><input type="text" class="input" name="type" placeholder="Jenis" value="<?php echo $data['type']; ?>"></td>
		</tr>
		<tr>
			<td></td>
			<td>Warna &nbsp;</td>
			<td><input type="text" class="input" name="color" placeholder="Warna" value="<?php echo $data['color'] ?>"></td>
		</tr>
		<tr>
			<td></td>
			<td>Harga &nbsp;</td>
			<td><input type="number" class="input" name="price" placeholder="Harga" value="<?php echo $data['price']; ?>"></td>
		</tr>
		<tr>
			<td></td>
			<td style="vertical-align: top;">Deskripsi &nbsp;</td>
			<td><textarea name="description" rows="5" cols="20" placeholder="Deskripsi"><?php echo $data['description']; ?></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td>Stok &nbsp;</td>
			<td><input type="number" class="input" name="stock" placeholder="Stok" value="<?php echo $data['stock']; ?>"></td>
		</tr>
		<tr>
			<td></td>
			<td>Berat &nbsp;</td>
			<td><input type="text" class="input" name="weight" placeholder="Berat" value="<?php echo $data['weight_product']; ?>"></td>
		</tr>
		<tr>
			<td width="20%"></td>
			<td width="12%">Pemakai</td>
			<td width="33%">
				<select name='gender' size="0">
					<option value="0">Pilih Pemakai</option>
					<option value="pria" <?php if($data['gender'] == 'pria'){ echo "selected"; } ?>>Pria</option>
					<option value="wanita" <?php if($data['gender'] == 'wanita'){ echo "selected"; } ?>>Wanita</option>
				</select>
			</td>
		</tr>
		<tr>
			<td width="20%"></td>
			<td width="12%">Kategori</td>
			<td width="33%">
				<select name='category' size="0">
					<option value="0">Pilih Kategori</option>
					<option value="casual" <?php if($data['category'] == 'casual'){ echo "selected"; } ?>>Casual</option>
					<option value="fashion" <?php if($data['category'] == 'fashion'){ echo "selected"; } ?>>Fashion</option>
					<option value="sport" <?php if($data['category'] == 'sport'){ echo "selected"; } ?>>Sport</option>
				</select>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>Gambar</td>
			<td>
				<?php if (!empty($data['image_product'])): ?>				
					<img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/'.$data['image_product']; ?>" width="150px"><br/>
				<?php else : ?>
					<img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/product/no-image.jpg' ?>" width="150px"><br/>
				<?php endif ?>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>Ganti Gambar</td>
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
		if (form.category.value == 0){
			alert("Anda belum memilih Vendor Produk.");
			form.category.focus();
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
		return (true);  
	}
</script>