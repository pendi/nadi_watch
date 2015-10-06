<?php 
	if(!isset($_SESSION['transaksi'])){
	    $idt = date("YmdHis");
	    $_SESSION['transaksi'] = $idt;
	}
	$idt = $_SESSION['transaksi'];

	$query = mysql_query("SELECT id_session FROM orders_temp WHERE id_session = '$idt'");
	$numRow = mysql_num_rows($query);
	if ($numRow == 0) {
		echo "<script>window.alert('Keranjang Belanja Anda Masih Kosong');</script>";
		echo "<script>window.location = index.php?list=1';</script>";
	}

	$id_cus = $_GET['id_cus'];
	$id_order = $_GET['id_order'];
	$query = mysql_query("SELECT * FROM customer WHERE id_cus='$id_cus'");
	$data = mysql_fetch_array($query);
	$queryOrd = mysql_query("SELECT * FROM orders WHERE id_order='$id_order'");
	$dataOrd = mysql_fetch_array($queryOrd);
?>
<style type="text/css">
	.info{ border: 2px dashed #999; height: 70px; padding-top: 18px; padding-left: 7px; }
</style>
<table width="95%" align="center">
	<tr>
		<td style="padding-top:70px; font-size:22px;">
			<div class="info">
				Terima kasih telah berbelanja di <font color="#0052CC" class="nameTitle">nadiWatch.com</font>. <b>Periksa kembali data dan belanjaan anda</b>. 
				Klik "Benar" jika data dan belanjaan anda sudah sesuai.
			</div>
		</td>
	</tr>
</table>
<table class="border" width="95%" align="center" border="1" style="margin-top:-40px">
	<tr>
		<td colspan="5" style="padding-bottom:25px;">
			<table>
				<tr>
					<td><b>Email</b></td>
					<td>:</td>
					<td><?php echo $data['email']; ?></td>
				</tr>
				<tr>
					<td width="118px"><b>Nama Lengkap</b></td>
					<td width="10px">:</td>
					<td><?php echo ucwords($data['first_name']); ?> <?php echo ucwords($data['last_name']); ?></td>
				</tr>
				<tr>
					<td style="vertical-align:top;"><b>Alamat</b></td>
					<td style="vertical-align:top;">:</td>
					<td><?php echo $data['address']; ?></td>
				</tr>
				<tr>
					<td><b>Nomor Telepon</b></td>
					<td>:</td>
					<td><?php echo $data['telp']; ?></td>
				</tr>
			</table>
		</td>
	</tr><br/><br/><br/>
	<tr>
		<th width="25px">No</th>
		<th width="305px">Barang</th>
		<th width="190px">Harga Satuan</th>
		<th width="95px">Jumlah</th>
		<th width="190px">Sub Total</th>
	</tr>
	<?php 
		$no = 1;
		$total = 0;
		$grandTotal = 0;
		$discount = 0;
		$queryTrs = mysql_query("SELECT * FROM transaksi WHERE id_order='$dataOrd[id_order]'");
		while($dataTrs = mysql_fetch_array($queryTrs)){
			$queryPro = mysql_query("SELECT * FROM product WHERE id_product='$dataTrs[id_product]'");
			$dataPro = mysql_fetch_array($queryPro);
			$sub_total = $dataPro['price'] * $dataTrs['quantity'];
			if (!empty($dataOrd['id_member'])) {
				$grandTotal += $sub_total;
				$discount = (($grandTotal*10)/100);
				$total = $grandTotal - $discount;
			} else {
				$total += $sub_total;
			}
	?>
	<tr style="height:50px;">
		<td align="center"><?php echo $no; ?></td>
		<td><?php echo $dataPro['name']; ?> <?php echo $dataPro['type'] ?></td>
		<td align="center">Rp. <?php echo price($dataPro['price']); ?></td>
		<td align="center"><?php echo $dataTrs['quantity']; ?></td>
		<td align="center">Rp. <?php echo price($sub_total); ?></td>
	</tr>
	<?php
		$no++;
	 	}
	?>
	<?php if(!empty($dataOrd['id_member'])): ?>
		<tr style="height:50px;">
			<td colspan="4" align="right"><b style="margin-right: 3px;">Sub Total</b></td>
			<td align="center"><b>Rp. <?php echo price($grandTotal); ?></b></td>
		</tr>
		<tr style="height:50px;">
			<td colspan="4" align="right"><span style="margin-right: 3px;">Diskon Member</span></td>
			<td align="center">Rp. <?php echo price($discount); ?></td>
		</tr>
	<?php endif ?>
	<tr style="height:50px;">
		<td colspan="4" align="right"><b style="margin-right: 3px;">Total Belanja</b></td>
		<td align="center"><b>Rp. <?php echo price($total); ?></b></td>
	</tr>
</table>
<div style="padding:10px 0 0 23px;">
	<a href="index.php?list=4&act=print&id_cus=<?php echo $id_cus; ?>&id_order=<?php echo $id_order; ?>" class="button round">Benar</a>
	<a href="index.php?list=22&id_cus=<?php echo $id_cus; ?>&id_order=<?php echo $id_order; ?>" class="button round warning">Kembali</a>
</div>