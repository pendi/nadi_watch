<style type="text/css">
	.search { width: 235px; margin-left: 0px; }
	.tgl {font-size: 13px;color: rgb(94, 94, 94); }
	.show-area{
	 	background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAWCAMAAADzapwJAAAA8FBMVEXm5ubg4ODf39/g4ODe3t7g4ODd3d3h4eHe3t7h4eHl5eXc3Nzh4eHY2NjS0tLi4uLY2NjT09Ph4eHR0dHf39/Y2NjZ2dnT09Pg4ODZ2dnf39/S0tLZ2dnh4eHf39/Y2NjU1NTS0tLi4uLb29vU1NTh4eHm5uba2trMzMzb29vm5ubn5+fW1tbX19fa2trLy8vm5ubk5OTR0dHh4eHKysrY2NgAAADt7e3p6enk5OTe3t7d3d3w8PDu7u76+vrr6+vq6ur8/Pzv7+/o6Oj29vb09PTy8vLz8/P5+fn19fX+/v739/f7+/v9/f1ERET///8/rafdAAAAN3RSTlOo5+/y8rJdre7mrlpdpghdqFVbBun2CFbt8vbpV1PzUlHrWJVUVIuJA4mWlwMDjAOKsu5WBgYAdeRyLAAAAOFJREFUeNpt0VdvwjAUhmHa0tLSPaB70sVsGUkXWR6BOLHz//9NT3SOIoN4rz49F5ZsV9yVEU+O90d/v6Oj84nND9c88BjzAv74XPLHG2cxxfjgnbgdxrOyOGwh34cysZLBTcGnlzJdSDYOgHenc8wYGtMt4JrIMGNopJvA25nGjKGRVYG/tYIMVWz9BfyjcshQxVYe8I7OMTBMbwDX/WXOhsAnYpnFIbBzF+ULRVdNYPdFKltV8oRP9SmUpWnHRe69yqg8Ien2kaHbM+FruIcvLsb2pznjyjrja8M9xyVe2T+Lx3cEOchHGgAAAABJRU5ErkJggg==) no-repeat left;
	    padding:5px 5px 5px 30px;
		cursor: pointer;
	}
	.hide-area{
		background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAWCAMAAADzapwJAAAA8FBMVEXm5ubf39/g4ODg4ODe3t7g4ODd3d3h4eHe3t7h4eHl5eXc3Nzh4eHY2NjS0tLi4uLY2NjT09Ph4eHR0dHf39/Y2NjZ2dnT09Pg4ODZ2dnf39/S0tLZ2dnh4eHf39/Y2NjU1NTS0tLi4uLb29vU1NTh4eHm5uba2trMzMzb29vm5ubn5+fW1tba2trX19fLy8vm5ubk5OTR0dHh4eHKysrY2NgAAADt7e3k5OTp6ene3t7d3d3w8PDu7u76+vrr6+vq6ur8/Pzv7+/o6Oj29vb09PTy8vLz8/P19fX+/v75+fn39/dERET7+/v9/f3///+/DEe5AAAAN3RSTlOo7+ey8vJdre7mrlpdpghdqFVbBun2CFbt8vbpV1PzUlHrWJVUVIuJA4mWlwOMAwOKsu5WBgYAh1WbJAAAANlJREFUeNpt0dlSwjAUgGFAARVEwA1wQWV1AQTa4tI1S22sSd//bThMYyfN8F+d+S4yk3MK1t4kG63T1ffXqnltqPxwgz0HIcfDj8OMFxOMQhnCs6nkZz/8yQr9Qcp9n0ZK1Lvd8XmXxrnoZQO4Zv9q2RXgKuFa8QHwERda/BD4UzDoT8YgsQH+YAn0z7uZOcDHItESZeATV2e+BG4TnckZsHkf5DXoXQFbI8pUZdFTuqp3whSNX+QG38Y0yF6IXucpQ3cXxBXwD5d01urRzHWhiHBpWTctlfW2j1R3AzQa08IAAAAASUVORK5CYII=) no-repeat left;
		padding:5px 5px 5px 30px;
		cursor: pointer;
	}
	.hide,.text-area{ display:none; }
	.listLine { line-height: 30px; }
	td.left { padding-left: 7px; }
	span.price { float:right; padding-right:7px; }
	.right { text-align:right; padding-right:7px; }
</style>

<form action="" method="get">
	<table width="95%" align="center" border="0">
		<tr>
			<td>
				<input type="hidden" name="list" value="31">
				<input class="search" type="search" name="kdTrs" placeholder="Masukan Kode Transaksi Anda">
			</td>
		</tr>
	</table>
</form>

<?php 
	if(isset($_GET['kdTrs'])) {
		$search = $_GET['kdTrs'];
	} else {
		$search = '';
	}

	if(isset($_SESSION['member'])) {
		$id_member = $_SESSION['member']['id'];
	} else {
		$id_member = '';
	}

	if (!empty($search)) {
		$selectOrd = mysql_query("SELECT * FROM orders WHERE id_order LIKE '$search' ORDER BY id_order DESC");
		$jumlah = mysql_num_rows($selectOrd);
	} else {
		$selectOrd = mysql_query("SELECT * FROM orders WHERE id_member='$id_member' ORDER BY id_order DESC");
		$jumlah = mysql_num_rows($selectOrd);
	}
?>
<?php if($jumlah > 0): ?>
<?php if(isset($_SESSION['member']) || !empty($search)): ?>
	<?php while($resultOrd = mysql_fetch_array($selectOrd)): ?>
		<?php if(!empty($resultOrd['invoice']) && $resultOrd['status'] != 3): ?>
			<table width="95%" align="center" class="border textKA" border="1" style="margin-bottom:15px;">
				<tr class="listLine">
					<td colspan="5" class="left"><?php echo $resultOrd['id_order']; ?></td>
				</tr>
				<tr>
					<td width="90px"><img src="image/icon/shopping-icon.png" width="90px"></td>
					<td colspan="3" width="500px" valign="top" style="line-height:25px;" class="left">
						<?php echo $resultOrd['invoice']; ?><br /><span class="tgl"><?php echo date("d F Y", strtotime($resultOrd['created_time'])); ?></span>
					</td>
					<td valign="bottom" align="right" class="show">
						<span class="show-area">Lihat Pesanan</span>
					</td>
					<td valign="bottom" align="right" class="hide">
						<span class="hide-area">Tutup Pesanan</span>
					</td>
				</tr>

				<tr class="listLine text-area" bgcolor="#75D1FF">
					<th></th>
					<th>Produk</th>
					<th>Harga</th>
					<th>Jml</th>
					<th>Sub Total</th>
				</tr>

				<?php 
					$no = 1;
					$total = 0;
					$grandTotal = 0;
					$discount = 0;
					$queryTrs = mysql_query("SELECT * FROM transaksi WHERE id_order='$resultOrd[id_order]'");
					while($dataTrs = mysql_fetch_array($queryTrs)){
						$queryPro = mysql_query("SELECT * FROM product WHERE id_product='$dataTrs[id_product]'");
						$dataPro = mysql_fetch_array($queryPro);
						$sub_total = $dataPro['price'] * $dataTrs['quantity'];
						if (!empty($resultOrd['id_member'])) {
							$grandTotal += $sub_total;
							$discount = (($grandTotal*10)/100);
							// var_dump($discount);
							$total = $grandTotal - $discount;
						} else {
							$total += $sub_total;
						}
				?>
				<tr class="listLine text-area">
					<td align="center"><?php echo $no; ?></td>
					<td class="left"><?php echo $dataPro['name']; ?> <?php echo $dataPro['type'] ?></td>
					<td class="left">Rp. <?php echo price($dataPro['price']); ?></td>
					<td align="center"><?php echo $dataTrs['quantity']; ?></td>
					<td class="left">Rp. <span class="price"><?php echo price($sub_total); ?></span></td>
				</tr>
				<?php
					$no++;
				 	} 
				?>
				<?php if(!empty($resultOrd['id_member'])): ?>
					<tr class="listLine text-area">
						<td colspan="4" align="right"><b style="margin-right: 3px;">Sub Total</b></td>
						<td class="left"><b>Rp. <span class="price"><?php echo price($grandTotal); ?></b></td>
					</tr>
					<tr class="listLine text-area">
						<td colspan="4" align="right"><span style="margin-right: 3px;">Diskon Member</span></td>
						<td class="left">Rp. <span class="price"><?php echo price($discount); ?></td>
					</tr>
				<?php endif ?>

				<tr class="listLine text-area">
					<td colspan="4" class="right"><b>Total Belanja</b></td>
					<td class="left"><b>Rp. <span class="price"><?php echo price($total); ?></span></b></td>
				</tr>
			</table>
		<?php endif ?>
	<?php endwhile ?>
<?php endif ?>
<?php else: ?>
	<table class="width">
		<tr>
			<td align="center">sasasas</td>
		</tr>
	</table>
<?php endif ?>

<script type="text/javascript">
	$(function() {
	    $('.show').click(function(evt){
	    	var 
	    	$parentShow = $(evt.target).parents('.textKA');

	    	$parentShow.find('.text-area').slideDown(1);
	    	$parentShow.find('.show').hide();
	    	$parentShow.find('.hide').show();
		});

	    $('.hide').click(function(evt){
	    	var 
	    	$parentHide = $(evt.target).parents('.textKA');

	    	$parentHide.find('.text-area').slideUp(1,"linear");
	    	$parentHide.find('.show').show();
	    	$parentHide.find('.hide').hide();
	    });
	});
</script>