<?php
	if(!isset($_SESSION['transaksi'])){
	    $idt = date("YmdHis");
	    $_SESSION['transaksi'] = $idt;
	}
	$idt = $_SESSION['transaksi'];
	$query = mysql_query("SELECT * FROM orders_temp ot INNER JOIN product p ON ot.id_product=p.id_product WHERE id_session = '$idt'");
	$numRow = mysql_num_rows($query);
	if ($numRow == 0) {
		echo "<script>window.alert('Keranjang Belanja Anda Masih Kosong');</script>";
		echo "<script>window.location = 'index.php?list=1';</script>";
	}
?>
<!-- <form method="post" action="save_purchase.php"> -->
<form method="post" action="process/purchase.php">
	<table width="95%" align="center">
		<tr>
			<td><h2>Rincian Pembelian :</h2></td>
		</tr>
		<tr>
			<td>
				<a href="index.php?list=1"><input type="button" value="Beli Lagi" class="button round"></a>
			</td>
		</tr>
	</table>
	<table border="1" class="border" width="95%" align="center">
		<tr bgcolor="#75D1FF">
			<th width="25px">No</th>
			<th width="305px">Nama Produk</th>
			<th width="190px">Harga Satuan</th>
			<th width="95px">Jumlah</th>
			<th width="190px">Sub Total</th>
		</tr>
		<?php
			$no = 1;
			$total = 0;
			$weight = 0;
		?>
        <?php while ($data = mysql_fetch_array($query)): ?>
			<tr class="hover">

				<input type="hidden" name="id[]" value="<?php echo $data['id_product']; ?>" />
				<td align="center"><?php echo $no; ?></td>
				<td style="padding-left:5px;"><?php echo $data['name_product']; ?>&nbsp;<?php echo $data['type'].' - '.$data['color'] ?></td>
				<td>Rp. <input readonly type="text" class="input" style="width:135px;" value="<?php echo price($data['price']); ?>"></td>
				
				<?php  
					$sub_total = $data['price'] * $data['quantity'];
			        $total += $sub_total; 
			        $sub_weight = $data['weight_product'] * $data['quantity'];
			        $weight += $sub_weight;
				?>

				<td align="center">
					<?php if ($data['quantity'] > 1): ?>
						<a class="href minus" href="index.php?list=4&act=min&amp;id=<?php echo $data['id_product']; ?>&amp;qty=<?php echo $data['quantity'] ?>"></a>
					<?php else: ?>
						<a class="href minus disabled"></a>
					<?php endif ?>
					<input name="quantity[]" readonly type="text" class="input" size="1" style="text-align:center; width:38px; padding-left:0;" value="<?php echo $data['quantity']; ?>"/>
					<?php if ($data['quantity'] < $data['stock']): ?>
						<a class="href plus" href="index.php?list=4&act=plus&amp;id=<?php echo $data['id_product']; ?>&amp;qty=<?php echo $data['quantity'] ?>"></a>
					<?php else: ?>
						<a class="href plus disabled"></a>
					<?php endif ?>
				</td>
				<td>
					Rp. <input style="width:130px; text-align:right" type="text" class="input" readonly value="<?php echo price($sub_total); ?>">

					<a href="index.php?list=4&act=del&amp;id=<?php echo $data['id_product']; ?>" style="vertical-align: -8px;">
						<img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/icon/delete.png' ?>" class="width">
					</a>
				</td>
			</tr>
		<?php 
			$no++;
			endwhile
		?>
		<input name="weight" type="hidden" value="<?php echo $weight; ?>">
		<tr>
			<td align="right" colspan="4"><b style="margin-right: 3px;">Total Belanja</b></td>
			<td><b>Rp.</b> <input style="font-weight: bold; width:130px; text-align:right" name="total" type="text" class="input" readonly value="<?php echo price($total); ?>"></td>
		</tr>
		<tr>
			<td colspan="5" align="center">
				<input type="submit" value="Lanjutkan" class="button round">
				<a href="index.php?list=4&act=clear" class="button round error">Batal</a>
			</td>
		</tr>
	</table>
</form>