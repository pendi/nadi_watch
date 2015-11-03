<?php
	if(!isset($_SESSION['user'])) {
	  	echo "<script>window.alert('Anda Harus Login Dulu');</script>";
		echo "<script>window.location = 'index.php?list=5&head=admin';</script>";
	} else {
?>

<style type="text/css">
	.search {
		margin: 7px 0px;
		width: 70%;
		height: 28px;
		border-radius: 30px;
		outline-style: none;
		padding-left: 7px;
	}
</style>

<form action="" method="get">
	<table width="50%" align="center">
		<tr>
			<td colspan="2" align="center"><h2>DAFTAR ONGKIR</h2></td>
		</tr>
		<tr>
			<td>
				<a href="index.php?list=26&head=admin" class="button round">Tambah Kotamadya</a>
			</td>
			<td align="right">
				<input type="hidden" name="list" value="40">
				<input type="hidden" name="head" value="admin">
				<input class="search" type="search" name="search" placeholder="Cari Kotamadya">
			</td>
		</tr>
	</table>		
	<table width="50%" align="center" border="1" class="border">
		<tr bgcolor="#00FFFF" height="35px;">
			<!-- <th>Id</th> -->
			<th>Kotamadya</th>
			<th width="80px;"></th>
		</tr>
		<?php
			$batas = 7; 

			if(isset($_GET['search'])) {
				$search = $_GET['search'];
			} else { 
				$search = "";
			}

			if(isset($_GET['halaman'])) { 
				$halaman = $_GET['halaman']; 
			} else { 
				$halaman = ""; 
			}

			if(empty($halaman)){ 
			    $posisi=0; 
			    $halaman=1; 
			} 
			else{ 
			    $posisi = ($halaman-1) * $batas; 
			}

			// $que = "SELECT * FROM user LIMIT $posisi,$batas";
			// $tampil = mysql_query($que);
			if (!empty($search)) {
				$que = mysql_query("SELECT * FROM kotamadya WHERE name LIKE '%$search%' ORDER BY name ASC LIMIT $posisi,$batas");
				$jumlah = mysql_num_rows($que);
			} else {
				$que = mysql_query("SELECT * FROM kotamadya ORDER BY name ASC LIMIT $posisi,$batas");
				$jumlah = mysql_num_rows($que);
			}
		?>
			
		<?php if ($jumlah > 0): ?>
			<?php while ($data = mysql_fetch_array($que)): ?>					
				<tr class="hover">
					<td align='center'><?php echo ucwords($data['name']); ?></td>
					<td align='center'>
						<a href="index.php?id=<?php echo $data['id']; ?>&list=41&head=admin"><img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/icon/edit.png' ?>" class="width"></a> &nbsp;
						<a href="index.php?id=<?php echo $data['id']; ?>&list=42&head=admin"><img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/icon/delete.png' ?>" class="width"></a>
					</td>
				</tr>				 
			<?php endwhile ?>
		<?php else: ?>
			<tr class="hover not-found">
				<td colspan="3">Kotamadya Tidak Ditemukan</td>
			</tr>
		<?php endif ?>
	</table>
	<table width="90%" align="center">
		<tr>
			<td align="right" colspan="7">
				<nav>
					<ul class="pagination">
						<?php
							if (!empty($search)) {
								$tampil2 = "SELECT * FROM kotamadya WHERE name LIKE '%$search%'";
							} else {
								$tampil2 = "SELECT * FROM kotamadya";
							}
							$hasil2=mysql_query($tampil2); 
							$jmldata=mysql_num_rows($hasil2); 
							$jmlhalaman=ceil($jmldata/$batas);
						?>

						<?php if($halaman > 1): ?>
							<?php $previous = $halaman-1; ?>
							<li><a href="<?php echo "$_SERVER[PHP_SELF]?search=$search&halaman=$previous&list=40&head=admin" ?>" aria-label="Previous"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a></li>
						<?php else: ?>
							<li class="disabled"><a href="" aria-label="Previous"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a></li>
						<?php endif ?>

						<?php for($i=1;$i<=$jmlhalaman;$i++): ?>
							<?php if($i>=($halaman-3) && $i <= ($halaman+3)): ?>
								<?php if ($i != $halaman): ?>
									<li><a href="<?php echo "$_SERVER[PHP_SELF]?search=$search&halaman=$i&list=40&head=admin" ?>"><?php echo $i; ?></a></li>
								<?php else: ?>
									<li class="active"><a><?php echo $i; ?></a></li>
								<?php endif ?>
							<?php endif ?>
						<?php endfor ?>

						<?php if($halaman < $jmlhalaman): ?>
							<?php $next = $halaman+1; ?>
							 <li><a href="<?php echo "$_SERVER[PHP_SELF]?search=$search&halaman=$next&list=40&head=admin" ?>" aria-label="Next"><span aria-hidden="true">&rsaquo;&rsaquo;</span></a></li>
						<?php else: ?>
							<li class="disabled"><a href="" aria-label="Next"><span aria-hidden="true">&rsaquo;&rsaquo;</span></a></li>
						<?php endif ?>
					</ul>
			   	</nav>
			</td>
		</tr>
	</table>
</form>
<?php } ?>