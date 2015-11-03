<style type="text/css">
	.padding-left {
    padding-left: 135px;
	}
	.padding-right {
    padding-right: 135px;
	}

	img.scale:hover {
		-webkit-transform: scale(1.2,1.2);
		-moz-transform: scale(1.2,1.2);
		-ms-transform: scale(1.2,1.2);
		-o-transform: scale(1.2,1.2);
	}
	.search-error {
		text-align: center;
		font-size: 30px;
		color: #FF1919;
		padding: 140px;
	}
	select[size="0"] {
		width: inherit;
	}
	input[type=submit].sort {
		line-height: 15px;
	}
</style>

<?php

	$batas = 10;

	// $halaman = $_GET['halaman'];
	if(isset($_GET['halaman'])) { 
		$halaman = $_GET['halaman']; 
	} else { 
		$halaman = ""; 
	}
	// $by = $_GET['by']
	if(isset($_GET['by'])) { 
		$by = $_GET['by']; 
	} else { 
		$by = ""; 
	}

	// $gen = $_GET['gen']
	if(isset($_GET['gen'])) { 
		$gen = $_GET['gen']; 
	} else { 
		$gen = "";
	}

	$vendor = $_GET['vendor'];
	$category = $_GET['cat'];

	if(empty($halaman)){ 
	    $posisi=0; 
	    $halaman=1; 
	} 
	else{ 
	    $posisi = ($halaman-1) * $batas; 
	}

	$order = "created_time_product";
	$type = "type";
	$pos = "desc";
	if ($by == "az") {
		$order = "name_product";
		$type = "type";
		$pos = "asc";
	} elseif ($by == "za") {
		$order = "name_product";
		$type = "type";
		$pos = "desc";
	} elseif ($by == "sale") {
		$order = "sale_product";
		$pos = "desc";
	} elseif ($by == "lower") {
		$order = "price";
		$pos = "asc";
	} elseif ($by == "higher") {
		$order = "price";
		$pos = "desc";
	}

	if (!empty($gen)) {
		$sql = mysql_query("SELECT * FROM product WHERE status_product = 2 AND gender = '$gen' AND category = '$category' AND id_vendor = '$vendor' ORDER BY $order $pos,$type $pos LIMIT $posisi,$batas");
		$jumlah = mysql_num_rows($sql);
	} else {
		$sql = mysql_query("SELECT * FROM product WHERE status_product = 2 AND id_vendor = '$vendor' AND category = '$category' ORDER BY $order $pos,$type $pos LIMIT $posisi,$batas");
		$jumlah = mysql_num_rows($sql);
	}
?>

<?php if($jumlah > 0): ?>
	<table class="width">
		<tr>
			<td align="center" colspan="3">
				<form action="" method="get">
					<hr/>
					Sort By: &nbsp;&nbsp;
					<select size="0" name="by">
						<option value="">-- Pilih --</option>
						<option value="sale" <?php if($by=="sale"){echo "selected";} ?>>Penjualan</option>
						<option value="az" <?php if($by=="az"){echo "selected";} ?>>A-Z</option>
						<option value="za" <?php if($by=="za"){echo "selected";} ?>>Z-A</option>
						<option value="lower" <?php if($by=="lower"){echo "selected";} ?>>Harga Terendah</option>
						<option value="higher" <?php if($by=="higher"){echo "selected";} ?>>Harga Tertinggi</option>
					</select> &nbsp;&nbsp;&nbsp;
					Pemakai: &nbsp;&nbsp;
					<select size="0" name="gen">
						<option value="">-- Pilih --</option>
						<option value="pria" <?php if($gen=="pria"){echo "selected";} ?>>Pria</option>
						<option value="wanita" <?php if($gen=="wanita"){echo "selected";} ?>>Wanita</option>
					</select>&nbsp;
					<input type="hidden" name="list" value="30">
					<input type="hidden" name="cat" value="<?php echo $category ?>">
					<input type="hidden" name="vendor" value="<?php echo $vendor ?>">
					<input type="submit" class="button round sort" value="Pilih">
					<hr/>					
				</form>
			</td>
		</tr>
		<?php while ($r=mysql_fetch_array($sql)) {
		$price = $r["price"];
		$stock = $r['stock']; ?>
			
		<tr>
			<td class="padding-left" colspan="3">			
				<p><a href="index.php?list=24&id_product=<?php echo $r[0] ?>" class="href ref"><?php echo $r["name_product"]; ?>&nbsp;<?php echo $r['type']; ?></a></p>
			</td>
		</tr>
		<tr>
			<td class="padding-left" width="128px">
				<?php if (!empty($r['image_product'])): ?>				
					<a href="index.php?list=24&id_product=<?php echo $r[0] ?>"><img class="scale" src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/'.$r['image_product']; ?>" width="120px" height="120px"></a>
				<?php else : ?>
					<a href="index.php?list=24&id_product=<?php echo $r[0] ?>"><img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/product/no-image.jpg' ?>" width="120px" height="120px"></a>
				<?php endif ?>
			</td>
			<td style="vertical-align: top; font-size: 14px;" colspan="2" class="padding-right">
				<span class="category">Jam Tangan <?php echo ucfirst($r['gender'])?> <?php echo ucfirst($r['category']) ?></span><br /><span><?php echo $r["description"]; ?></span>
			</td>
		</tr>
		<tr>
			<td align="right" style="font-size: x-large; color: #00008B;" colspan="2">
				<?php if ($stock == 0): ?>
					<a class="stock">STOK HABIS</a>			
				<?php endif ?>
				Rp. <?php echo price($price); ?> &nbsp;
			</td>
			<td class="padding-right" width="80px">
				<?php if ($stock == 0): ?>
					<a>&nbsp;</a>
				<?php else: ?>
					<a href="index.php?list=4&act=add&amp;id=<?php echo $r[0]; ?>" class="button round">BELI</a>
				<?php endif ?>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<hr>				
			</td>
		</tr>
		<?php } ?>
		<tr>
			<td align="right" colspan="3">
				<nav>
					<ul class="pagination">
						<?php
							if(!empty($gen)) {
								$tampil2 = "SELECT * FROM product WHERE status_product = 2 AND gender = '$gen' AND category = '$category' AND id_vendor = '$vendor'";
							} else {
								$tampil2 = "SELECT * FROM product WHERE status_product = 2 AND id_vendor = '$vendor' AND category = '$category'";
							}
							$hasil2=mysql_query($tampil2); 
							$jmldata=mysql_num_rows($hasil2); 
							$jmlhalaman=ceil($jmldata/$batas);
						?>

						<?php if($halaman > 1): ?>
							<?php $previous = $halaman-1; ?>
							<li><a href="<?php echo "$_SERVER[PHP_SELF]?list=30&halaman=$previous&by=$by&cat=$category&gen=$gen&vendor=$vendor" ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
						<?php else: ?>
							<li class="disabled"><a href="" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
						<?php endif ?>

						<?php for($i=1;$i<=$jmlhalaman;$i++): ?>
							<?php if($i>=($halaman-3) && $i <= ($halaman+3)): ?>
								<?php if ($i != $halaman): ?>
									<li><a href="<?php echo "$_SERVER[PHP_SELF]?list=30&halaman=$i&by=$by&cat=$category&gen=$gen&vendor=$vendor" ?>"><?php echo $i; ?></a></li>
								<?php else: ?>
									<li class="active"><a><?php echo $i; ?></a></li>
								<?php endif ?>
							<?php endif ?>
						<?php endfor ?>

						<?php if($halaman < $jmlhalaman): ?>
							<?php $next = $halaman+1; ?>
							<li><a href="<?php echo "$_SERVER[PHP_SELF]?list=30&halaman=$next&by=$by&cat=$category&gen=$gen&vendor=$vendor" ?>" aria-label="Next"><span aria-hidden="true">»</span></a></li>
						<?php else: ?>
							<li class="disabled"><a href="" aria-label="Next"><span aria-hidden="true">»</span></a></li>
						<?php endif ?>
					</ul>
			   	</nav>
			</td>
		</tr>
	</table>
<?php else: ?>
	<table class="width">
		<tr>
			<td class="search-error">Maaf, produk tidak tersedia.</td>
		</tr>
	</table>
<?php endif ?>