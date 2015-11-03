<?php
	if(!isset($_SESSION['user'])) {
	  	echo "<script>window.alert('Anda Harus Login Dulu');</script>";
		echo "<script>window.location = 'index.php?list=5&head=admin';</script>";
	} else {
		if(isset($_GET['search'])) {
			$search = $_GET['search'];
		} else { 
			$search = "";
		}

		if(isset($_GET['bulan'])) { 
			$bulan = $_GET['bulan']; 
		} else { 
			$bulan = date("m");
		}

		$dateMonth = date("m");
		$dateYear = date("Y");

		$totals = 0;
?>
<style type="text/css">
	.search {
		margin: 7px 0px;
		/*width: 50%;*/
		height: 28px;
		border-radius: 30px;
		outline-style: none;
		padding-left: 7px;
	}

	span.left {
		padding-left: 5px;
	}
</style>

<form action="" method="get" onsubmit="return validasi(this)">
	<table width="95%" align="center">
		<tr>
			<td align="right">
				<input type="hidden" name="list" value="29">
				<input type="hidden" name="head" value="admin">
				<input class="search" type="search" name="search" placeholder="Cari Kode Transaksi">
			</td>
		</tr>
		<tr>
			<td>
				<h2>Transaksi Bulan <?php echo date("F", strtotime("01-".$bulan."-2015")) ?></h2>
			</td>
		</tr>
	</table>
</form>

<form action="" method="get">
	<input type="hidden" name="list" value="29">
	<input type="hidden" name="head" value="admin">
	<table width="95%" align="center">
		<tr>
			<td width="100px">
				<select name="bulan" size="0">
					<option value="<?php echo $dateMonth ?>">- Pilih Bulan -</option>
					<?php
						$bln=array(1=>"January","February","March","April","May","June","July","August","September","October","November","December");
					?>

					<?php for($month=1; $month<=12; $month++): ?>
						<?php if($month<=9): ?>
							<option value="<?php echo '0'.$month; ?>"><?php echo $bln[$month]; ?></option>
						<?php else: ?>
							<option value="<?php echo $month; ?>"><?php echo $bln[$month]; ?></option>
						<?php endif ?>
					<?php endfor ?>
				</select>
			</td>
			<td><input type="submit" class="button round" value="Cari" style="line-height:20px"></td>
			<td align="right">
				<a href="<?php echo "export.php?bulan=$bulan&head=admin" ?>" target="_BLANK" class="button round">Export</a>
			</td>
		</tr>
	</table>
</form>

<table border="1" class="border" width="95%" align="center">
	<tr bgcolor="#00FFFF" height="35px">
		<th>Kode Transaksi</th>
		<th>Invoice</th>
		<th>Tanggal Transaksi</th>
		<th>Total</th>
		<th>Status</th>
	</tr>
	<?php
		if (!empty($search)) {
			$que = mysql_query("SELECT * FROM orders WHERE id_order LIKE '%$search%' ORDER BY created_time_order DESC");
			$jumlah = mysql_num_rows($que);
		} else {
			$que = mysql_query("SELECT * FROM orders WHERE month(created_time_order)='$bulan' AND year(created_time_order)='$dateYear' ORDER BY created_time_order DESC");
			$jumlah = mysql_num_rows($que);
		}
	?>
	<?php if($jumlah > 0): ?>
		<?php while ($dataOrd = mysql_fetch_array($que)): ?>
			<?php if(!empty($dataOrd['invoice']) && $dataOrd['status_order'] <= 4): ?>					
				<tr class="hover" style="line-height:27px">
					<td><span class="left">
						<a href="<?php echo "index.php?list=38&head=admin&id_order=$dataOrd[id_order]" ?>" class="href"><?php echo $dataOrd['id_order'] ?></a>
					</span></td>
					<td><span class="left"><?php echo $dataOrd['invoice'] ?></span></td>
					<td><span class="left"><?php echo date("d F Y", strtotime($dataOrd['created_time_order'])) ?></span></td>
					<td><span class="left"><?php echo price($dataOrd['total']) ?></span></td>
					<td>
						<span class="left">
							<?php 
								if ($dataOrd['status_order'] == 1){
									echo "Baru";
								} elseif ($dataOrd['status_order'] == 2) {
									echo "Konfirmasi";
								} elseif ($dataOrd['status_order'] == 3 || $dataOrd['status_order'] == 4) {
									echo "Lunas";
									$totals +=$dataOrd['total'];
								} else {
									echo $dataOrd['status_order'];
								}
							?>

						</span>
					</td>
				</tr>
			<?php endif ?>			 
		<?php endwhile ?>
	<?php else: ?>
		<tr>
			<td colspan="8" align="center" style="font-size:20px; padding:20px">Transaksi tidak ditemukan</td>
		</tr>
	<?php endif ?>
</table>
<table width="95%" align="center" style="padding-top:15px">
	<tr>
		<td>Total pemasukan transaksi lunas Bulan <?php echo date("F", strtotime("01-".$bulan."-2015")) ?> sebesar <b>Rp. <?php echo price($totals); ?></b></td>
	</tr>
</table>
<?php } ?>