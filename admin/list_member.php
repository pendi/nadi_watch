<?php
	if(!isset($_SESSION['user'])) {
	  	echo "<script>window.alert('Anda Harus Login Dulu');</script>";
		echo "<script>window.location = 'index.php?list=5&head=admin';</script>";
	} else {
?>

<style type="text/css">
	.search {
		margin: 7px 0px;
		height: 28px;
		border-radius: 30px;
		outline-style: none;
		padding-left: 7px;
	}
</style>

<form action="" method="get">
	<table width="95%" align="center">
		<tr>
			<td align="center"><h2>DAFTAR MEMBER</h2></td>
		</tr>
		<tr>
			<td align="right">
				<input type="hidden" name="list" value="37">
				<input type="hidden" name="head" value="admin">
				<input class="search" type="search" name="search" placeholder="Cari Email Member">
			</td>
		</tr>
	</table>		
	<table width="95%" align="center" border="1" class="border">
		<tr bgcolor="#00FFFF" height="35px;">
			<!-- <th>Id</th> -->
			<th>Email</th>
			<th>Nama</th>
			<th>Alamat</th>
			<th>Telpon</th>
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
				$que = mysql_query("SELECT * FROM member WHERE email_member LIKE '%$search%' ORDER BY email_member ASC LIMIT $posisi,$batas");
				$jumlah = mysql_num_rows($que);
			} else {
				$que = mysql_query("SELECT * FROM member ORDER BY email_member ASC LIMIT $posisi,$batas");
				$jumlah = mysql_num_rows($que);
			}
		?>
			
		<?php if ($jumlah > 0): ?>
			<?php while ($data = mysql_fetch_array($que)): ?>					
				<tr class="hover" style="line-height:25px;">
					<td align='center'><?php echo $data['email_member']; ?></td>
					<td align='center'><?php echo ucwords($data['first_name_member']).' '.ucwords($data['last_name_member']) ?></td>
					<td align='center'><?php echo $data['address_member']; ?></td>
					<td align='center'><?php echo $data['telp_member']; ?></td>
				</tr>				 
			<?php endwhile ?>
		<?php else: ?>
			<tr class="hover not-found">
				<td colspan="4">Member Tidak Ditemukan</td>
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
								$tampil2 = "SELECT * FROM member WHERE email_member LIKE '%$search%'";
							} else {
								$tampil2 = "SELECT * FROM member";
							}
							$hasil2=mysql_query($tampil2); 
							$jmldata=mysql_num_rows($hasil2); 
							$jmlhalaman=ceil($jmldata/$batas);
						?>

						<?php if($halaman > 1): ?>
							<?php $previous = $halaman-1; ?>
							<li><a href="<?php echo "$_SERVER[PHP_SELF]?search=$search&halaman=$previous" ?>&list=37&head=admin" aria-label="Previous"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a></li>
						<?php else: ?>
							<li class="disabled"><a href="" aria-label="Previous"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a></li>
						<?php endif ?>

						<?php for($i=1;$i<=$jmlhalaman;$i++): ?>
							<?php if($i>=($halaman-3) && $i <= ($halaman+3)): ?>
								<?php if ($i != $halaman): ?>
									<li><a href="<?php echo "$_SERVER[PHP_SELF]?search=$search&halaman=$i" ?>&list=37&head=admin"><?php echo $i; ?></a></li>
								<?php else: ?>
									<li class="active"><a><?php echo $i; ?></a></li>
								<?php endif ?>
							<?php endif ?>
						<?php endfor ?>

						<?php if($halaman < $jmlhalaman): ?>
							<?php $next = $halaman+1; ?>
							<li><a href="<?php echo "$_SERVER[PHP_SELF]?search=$search&halaman=$next" ?>&list=37&head=admin" aria-label="Next"><span aria-hidden="true">&rsaquo;&rsaquo;</span></a></li>
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