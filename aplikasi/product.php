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
	if(isset($_GET['search'])) {
		$search = $_GET['search'];
	} else { 
		$search = "";
	}

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

	$gender = $_GET['gen'];
	$category = $_GET['cat'];

	if(empty($halaman)){ 
	    $posisi=0; 
	    $halaman=1; 
	} 
	else{ 
	    $posisi = ($halaman-1) * $batas; 
	}

	$order = "created_time";
	$type = "type";
	$pos = "desc";
	if ($by == "az") {
		$order = "name";
		$type = "type";
		$pos = "asc";
	} elseif ($by == "za") {
		$order = "name";
		$type = "type";
		$pos = "desc";
	}

	if (!empty($search)) {
		$sql = mysql_query("SELECT * FROM product WHERE status = 2 AND name LIKE '%$search%' AND gender = '$gender' AND category = '$category' OR type LIKE '%$search%' AND status = 2 AND gender = '$gender' AND category = '$category' ORDER BY $order $pos,$type $pos LIMIT $posisi,$batas");
		$jumlah = mysql_num_rows($sql);
	} else {
		$sql = mysql_query("SELECT * FROM product WHERE status = 2 AND gender = '$gender' AND category = '$category' ORDER BY $order $pos,$type $pos LIMIT $posisi,$batas");
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
						<option value="sale" <?php if($by=="sale"){echo "selected";} ?>>Penjualan</option>
						<option value="az" <?php if($by=="az"){echo "selected";} ?>>A-Z</option>
						<option value="za" <?php if($by=="za"){echo "selected";} ?>>Z-A</option>
						<option value="lower" <?php if($by=="lower"){echo "selected";} ?>>Harga Terendah</option>
						<option value="higher" <?php if($by=="higher"){echo "selected";} ?>>Harga Tertinggi</option>
					</select>&nbsp;
					<?php if(!empty($search)): ?>
						<input type="hidden" name="search" value="<?php echo $search; ?>">
						<input type="hidden" name="list" value="30">
						<input type="hidden" name="cat" value="<?php echo $category ?>">
						<input type="hidden" name="gen" value="<?php echo $gender ?>">
					<?php else: ?>
						<input type="hidden" name="list" value="30">
						<input type="hidden" name="cat" value="<?php echo $category ?>">
						<input type="hidden" name="gen" value="<?php echo $gender ?>">
					<?php endif ?>
					<input type="submit" class="button round sort" value="Sort">
					<hr/>					
				</form>
			</td>
		</tr>
		<?php while ($r=mysql_fetch_array($sql)) {
		$price = $r["price"];
		$stock = $r['stock']; ?>
			
		<tr>
			<td class="padding-left" colspan="3">			
				<p><a href="index.php?list=24&id_product=<?php echo $r[0] ?>" class="href ref"><?php echo $r["name"]; ?>&nbsp;<?php echo $r['type']; ?></a></p>
			</td>
		</tr>
		<tr>
			<td class="padding-left" width="128px">
				<?php if (!empty($r['image'])): ?>				
					<a href="index.php?list=24&id_product=<?php echo $r[0] ?>"><img class="scale" src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/'.$r['image']; ?>" width="120px" height="120px"></a>
				<?php else : ?>
					<a href="index.php?list=24&id_product=<?php echo $r[0] ?>"><img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/product/no-image.jpg' ?>" width="120px" height="120px"></a>
				<?php endif ?>
			</td>
			<td style="vertical-align: top; font-size: 14px;" colspan="2" class="padding-right">
				<span class="category">Jam Tangan <?php echo ucfirst($gender)?> <?php echo ucfirst($category) ?></span><br /><span><?php echo $r["description"]; ?></span>
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
							if(!empty($search)) {
								$tampil2 = "SELECT * FROM product WHERE status = 2 AND name LIKE '%$search%' AND gender = '$gender' AND category = '$category' OR type LIKE '%$search%' AND status = 2 AND gender = '$gender' AND category = '$category'";
							} else {
								$tampil2 = "SELECT * FROM product WHERE status = 2 AND gender = '$gender' AND category = '$category'";
							}
							$hasil2=mysql_query($tampil2); 
							$jmldata=mysql_num_rows($hasil2); 
							$jmlhalaman=ceil($jmldata/$batas);
						?>

						<?php if($halaman > 1): ?>
							<?php $previous = $halaman-1; ?>
							<?php if(!empty($search)): ?>
								<li><a href="<?php echo "$_SERVER[PHP_SELF]?list=30&search=$search&halaman=$previous&by=$by&cat=$category&gen=$gender" ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
							<?php else: ?>
								<li><a href="<?php echo "$_SERVER[PHP_SELF]?list=30&halaman=$previous&by=$by&cat=$category&gen=$gender" ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
							<?php endif ?>
						<?php else: ?>
							<li class="disabled"><a href="" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
						<?php endif ?>

						<?php for($i=1;$i<=$jmlhalaman;$i++): ?>
							<?php if($i>=($halaman-3) && $i <= ($halaman+3)): ?>
								<?php if ($i != $halaman): ?>
									<?php if(!empty($search)): ?>
										<li><a href="<?php echo "$_SERVER[PHP_SELF]?list=30&search=$search&halaman=$i&by=$by&cat=$category&gen=$gender" ?>"><?php echo $i; ?></a></li>
									<?php else: ?>
										<li><a href="<?php echo "$_SERVER[PHP_SELF]?list=30&halaman=$i&by=$by&cat=$category&gen=$gender" ?>"><?php echo $i; ?></a></li>
									<?php endif ?>
								<?php else: ?>
									<li class="active"><a><?php echo $i; ?></a></li>
								<?php endif ?>
							<?php endif ?>
						<?php endfor ?>

						<?php if($halaman < $jmlhalaman): ?>
							<?php $next = $halaman+1; ?>
							<?php if(!empty($search)): ?>
								<li><a href="<?php echo "$_SERVER[PHP_SELF]?list=30&search=$search&halaman=$next&by=$by&cat=$category&gen=$gender" ?>" aria-label="Next"><span aria-hidden="true">»</span></a></li>
							<?php else: ?>
								<li><a href="<?php echo "$_SERVER[PHP_SELF]?list=30&halaman=$next&by=$by&cat=$category&gen=$gender" ?>" aria-label="Next"><span aria-hidden="true">»</span></a></li>
							<?php endif ?>
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
			<td class="search-error">Maaf, <span style="font-weight:bold"><?php echo $search; ?></span> tidak ditemukan.</td>
		</tr>
	</table>
<?php endif ?>