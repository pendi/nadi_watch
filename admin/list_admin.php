<?php
	if(!isset($_SESSION['user'])) {
	  	echo "<script>window.alert('Anda Harus Login Dulu');</script>";
		echo "<script>window.location = 'index.php?list=5&head=admin';</script>";
	} elseif ($_SESSION['user']['level'] == "admin") {
		echo "<script>window.alert('Maaf Anda Tidak Memiliki Hak Akses');</script>";
		echo "<script>window.location = 'index.php?list=8&head=admin';</script>";
	} else {
?>

<style type="text/css">
	.search {
		margin: 7px 0px;
		width: 50%;
		height: 28px;
		border-radius: 30px;
		outline-style: none;
		padding-left: 7px;
	}
</style>

<form action="" method="get">
	<table width="90%" align="center">
		<tr>
			<td colspan="2" align="center"><h2>DAFTAR ADMIN</h2></td>
		</tr>
		<!-- <tr>
			<td align="right">
				<input style="margin-right: 41px;" type="submit" name="submit" value="Tambah Admin" class="button round" />
			</td>
		</tr> -->
		<tr>
			<td>
				<a href="index.php?list=14&head=admin" class="button round">Tambah Admin</a>
			</td>
			<td align="right">
				<input type="hidden" name="list" value="9">
				<input type="hidden" name="head" value="admin">
				<input class="search" type="search" name="search" placeholder="Cari Admin">
			</td>
		</tr>
	</table>		
	<table width="90%" align="center" border="1" class="border">
		<tr bgcolor="#00FFFF" height="35px;">
			<!-- <th>Id</th> -->
			<th>Email</th>
			<th>Nama Depan</th>
			<th>Nama Belakang</th>
			<th>Password</th>
			<th>Status</th>
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
				$que = mysql_query("SELECT * FROM admin WHERE email_admin LIKE '%$search%' OR first_name_admin LIKE '%$search%' OR last_name_admin LIKE '%$search%' LIMIT $posisi,$batas");
				$jumlah = mysql_num_rows($que);
			} else {
				$que = mysql_query("SELECT * FROM admin LIMIT $posisi,$batas");
				$jumlah = mysql_num_rows($que);
			}
		?>

		<?php if($jumlah > 0): ?>
			<?php while ($data = mysql_fetch_array($que)): ?>					
				<tr class="hover">
					<td align='center'><?php echo $data['email_admin']; ?></td>
					<td align='center'><?php echo $data['first_name_admin']; ?></td>
					<td align='center'><?php echo $data['last_name_admin']; ?></td>
					<td align='center'>*****</td>
					<td align='center'><?php echo $data['level']; ?></td>
					<td align='center'>
						<a href="index.php?id=<?php echo $data['id_admin']; ?>&list=15&head=admin"><img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/icon/delete.png' ?>" class="width"></a>
					</td>
				</tr>					 
			<?php endwhile ?>
		<?php else: ?>
			<tr class="hover not-found">
				<td colspan="6">Admin Tidak Ditemukan</td>
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
								$tampil2 = "SELECT * FROM admin WHERE email_admin LIKE '%$search%' OR first_name_admin LIKE '%$search%' OR last_name_admin LIKE '%$search%'";
							} else {
								$tampil2 = "SELECT * FROM admin";
							}
							$hasil2=mysql_query($tampil2); 
							$jmldata=mysql_num_rows($hasil2); 
							$jmlhalaman=ceil($jmldata/$batas);
						?>

						<?php if($halaman > 1): ?>
							<?php $previous = $halaman-1; ?>
							<?php if(!empty($search)): ?>
								<li><a href="<?php echo "$_SERVER[PHP_SELF]?search=$search&halaman=$previous" ?>&list=9&head=admin" aria-label="Previous"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a></li>
							<?php else: ?>
								<li><a href="<?php echo "$_SERVER[PHP_SELF]?halaman=$previous" ?>&list=9&head=admin" aria-label="Previous"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a></li>
							<?php endif ?>
						<?php else: ?>
							<li class="disabled"><a href="" aria-label="Previous"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a></li>
						<?php endif ?>

						<?php for($i=1;$i<=$jmlhalaman;$i++): ?>
							<?php if($i>=($halaman-3) && $i <= ($halaman+3)): ?>
								<?php if ($i != $halaman): ?>
									<?php if(!empty($search)): ?>
										<li><a href="<?php echo "$_SERVER[PHP_SELF]?search=$search&halaman=$i" ?>&list=9&head=admin"><?php echo $i; ?></a></li>
									<?php else: ?>
										<li><a href="<?php echo "$_SERVER[PHP_SELF]?halaman=$i" ?>&list=9&head=admin"><?php echo $i; ?></a></li>
									<?php endif ?>
								<?php else: ?>
									<li class="active"><a><?php echo $i; ?></a></li>
								<?php endif ?>
							<?php endif ?>
						<?php endfor ?>

						<?php if($halaman < $jmlhalaman): ?>
							<?php $next = $halaman+1; ?>
							<?php if(!empty($search)): ?>
								<li><a href="<?php echo "$_SERVER[PHP_SELF]?search=$search&halaman=$next" ?>&list=9&head=admin" aria-label="Next"><span aria-hidden="true">&rsaquo;&rsaquo;</span></a></li>
							<?php else: ?>
								<li><a href="<?php echo "$_SERVER[PHP_SELF]?halaman=$next" ?>&list=9&head=admin" aria-label="Next"><span aria-hidden="true">&rsaquo;&rsaquo;</span></a></li>
							<?php endif ?>
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