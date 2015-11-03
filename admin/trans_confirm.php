<?php 
	if(!isset($_SESSION['user'])) {
	  	echo "<script>window.alert('Anda Harus Login Dulu');</script>";
		echo "<script>window.location = 'index.php?list=5&head=admin';</script>";
	}

	$id_order = $_GET['id_order'];

	$queryOrd = mysql_query("SELECT * FROM orders WHERE id_order='$id_order'");
	$dataOrd = mysql_fetch_array($queryOrd);

	$queryCus = mysql_query("SELECT * FROM customer WHERE id_cus='$dataOrd[id_cus]'");
	$dataCus = mysql_fetch_array($queryCus);

	$queryConfirm = mysql_query("SELECT payment FROM confirm WHERE id_order='$id_order'");
	$dataConfirm = mysql_fetch_array($queryConfirm);

	$selectFare = mysql_query("SELECT tarif FROM tarif WHERE id_tarif='$dataOrd[id_tarif]'");
	$dataFare = mysql_fetch_array($selectFare);
?>
<style type="text/css">
	td.left { padding-left: 7px; }
	span.price { float:right; padding-right:7px; }
</style>
<table width="95%" align="center">
	<tr>
		<td>
			<h2>Konfirmasi Pesanan <?php echo $dataOrd['invoice'] ?></h2>
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
					<td><?php echo $dataCus['email_cus']; ?></td>
				</tr>
				<tr>
					<td width="118px"><b>Nama Lengkap</b></td>
					<td width="10px">:</td>
					<td><?php echo ucwords($dataCus['first_name_cus']); ?> <?php echo ucwords($dataCus['last_name_cus']); ?></td>
				</tr>
				<tr>
					<td style="vertical-align:top;"><b>Alamat</b></td>
					<td style="vertical-align:top;">:</td>
					<td><?php echo $dataCus['address_cus']; ?></td>
				</tr>
				<tr>
					<td><b>Nomor Telepon</b></td>
					<td>:</td>
					<td><?php echo $dataCus['telp_cus']; ?></td>
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
		$ongkir = ceil($dataOrd['weight_order'])*$dataFare['tarif'];
		$payment = $dataConfirm['payment'];
		$queryTrs = mysql_query("SELECT * FROM transaksi WHERE id_order='$dataOrd[id_order]'");
		while($dataTrs = mysql_fetch_array($queryTrs)){
			$queryPro = mysql_query("SELECT * FROM product WHERE id_product='$dataTrs[id_product]'");
			$dataPro = mysql_fetch_array($queryPro);
			$sub_total = $dataPro['price'] * $dataTrs['quantity_trans'];
			if (!empty($dataOrd['id_member'])) {
				$grandTotal += $sub_total;
				$grandTotals = $grandTotal + $ongkir;
				$discount = (($grandTotals*10)/100);
				$totals = $grandTotals - $discount;
			} else {
				$total += $sub_total;
				$totals = $total + $ongkir;
			}
	?>
	<tr style="height:50px;">
		<td align="center"><?php echo $no; ?></td>
		<td class="left"><?php echo $dataPro['name_product']; ?> <?php echo $dataPro['type'].' - '.$dataPro['color'] ?></td>
		<td align="center">Rp. <?php echo price($dataPro['price']); ?></td>
		<td align="center"><?php echo $dataTrs['quantity_trans']; ?></td>
		<td class="left">Rp. <span class="price"><?php echo price($sub_total); ?></span></td>
	</tr>
	<?php
		$no++;
	 	}
	?>
	<tr style="height:50px;">
		<td colspan="4" align="right"><span style="margin-right: 3px;">Ongkos Kirim</span></td>
		<td class="left">Rp. <span class="price"><?php echo price($ongkir); ?></span></td>
	</tr>
	<?php if(!empty($dataOrd['id_member'])): ?>
		<tr style="height:50px;">
			<td colspan="4" align="right"><b style="margin-right: 3px;">Sub Total</b></td>
			<td class="left"><b>Rp. <span class="price"><?php echo price($grandTotals); ?></span></b></td>
		</tr>
		<tr style="height:50px;">
			<td colspan="4" align="right"><span style="margin-right: 3px;">Diskon Member</span></td>
			<td class="left">Rp. <span class="price"><?php echo price($discount); ?></span></td>
		</tr>
	<?php endif ?>
	<tr style="height:50px;">
		<td colspan="4" align="right"><b style="margin-right: 3px;">Total Belanja</b></td>
		<td class="left"><b>Rp. <span class="price"><?php echo price($totals); ?></span></b></td>
	</tr>
	<tr style="height:50px;">
		<td colspan="4" align="right"><b style="margin-right: 3px;">Total Transfer</b></td>
		<td class="left"><b>Rp. <span class="price"><?php echo price($payment); ?></span></b></td>
	</tr>
</table>
<form action="process/trans_confirm.php" method="post">
	<input type="hidden" name="id_order" value="<?php echo $id_order ?>">
	<div style="padding:10px 0 0 23px;">
		<?php if ($totals == $payment): ?>
			<input type="submit" class="button round" value="Konfirmasi">
		<?php endif ?>
		<a href="index.php?list=29&head=admin" class="button round warning">Kembali</a>
	</div>
</form>