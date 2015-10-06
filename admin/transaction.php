<?php
	if(!isset($_SESSION['user'])) {
	  	echo "<script>window.alert('Anda Harus Login Dulu');</script>";
		echo "<script>window.location = 'index.php?list=5&head=home';</script>";
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

<form action="" method="get" onsubmit="return validasi(this)">
	<div class="table-body">
		<div class="fixed">
			<table border="1" class="nowrap" width="100%" align="center">
				<thead>
					<tr>
						<th>#</th>
						<th>Table Header</th>
						<th>Table Header</th>
						<th>Table Header</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1111111111</td>
						<td>This is longer content Donec id elit non mi porta gravida at eget metus.</td>
						<td>Content Goes Here</td>
						<td>Content Goes Here</td>
						<td><a href="#">Edit</a> <a href="#">Delete</a></td>
					</tr>
					<tr>
						<td>2</td>
						<td>This is longer Content Goes Here Donec id elit non mi porta gravida at eget metus.</td>
						<td>Content Goes Here</td>
						<td>Content Goes Here</td>
						<td><a href="#">Edit</a> <a href="#">Delete</a></td>
					</tr>
					<tr>
						<td>3</td>
						<td>This is longer Content Goes Here Donec id elit non mi porta gravida at eget metus.</td>
						<td>Content Goes Here</td>
						<td>Content Goes Here</td>
						<td><a href="#">Edit</a> <a href="#">Delete</a></td>
					</tr>
					<tr>
						<td>4</td>
						<td>This is longer Content Goes Here Donec id elit non mi porta gravida at eget metus.</td>
						<td>Content Goes Here</td>
						<td>Content Goes Here</td>
						<td><a href="#">Edit</a> <a href="#">Delete</a></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<table width="100%" align="center">
		<tr>
			<td align="center" colspan="2"><h2>DAFTAR PRODUK</h2></td>
		</tr>
		<tr>
			<td>
				<a href="index.php?list=10&head=admin" class="button round">Tambah Produk</a>
			</td>
			<td align="right">
				<input type="hidden" name="list" value="8">
				<input type="hidden" name="head" value="admin">
				<input class="search" type="search" name="search" placeholder="Cari Produk">
			</td>
		</tr>
	</table>
	<table border="1" class="border scroll" width="100%">
		<tr bgcolor="#00FFFF" height="35px">
			<th width="8%">Id Produk</th>
			<th width="8%">Nama Produk</th>
			<th width="8%">Model Produk</th>
			<th width="8%">Harga Produk</th>
			<th width="3%">Stok</th>
			<th width="5%">Gambar</th>
			<th width="4%">Status</th>
			<th width="5%"></th>
		</tr>
		<?php
			$batas   = 7;
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

			if(empty($halaman)){ 
			    $posisi=0; 
			    $halaman=1; 
			} 
			else{ 
			    $posisi = ($halaman-1) * $batas; 
			}

			if (!empty($search)) {
				$que = mysql_query("SELECT id_product,name,type,price,stock,image,status FROM product WHERE name LIKE '%$search%' OR type LIKE '%$search%' LIMIT $posisi,$batas");
				$jumlah = mysql_num_rows($que);
			} else {
				$que = mysql_query("SELECT id_product,name,type,price,stock,image,status FROM product LIMIT $posisi,$batas");
				$jumlah = mysql_num_rows($que);
			}
			// $tampil = mysql_query($que);
		?>
		<?php if($jumlah > 0): ?>
			<?php while ($data = mysql_fetch_array($que)): ?>					
				<tr class="hover">
					<td align='center'>
						<a href="detail.php?id_product=<?php echo $data['id_product']; ?>" class="href"><?php echo $data['id_product']; ?></a>
					</td>
					<td align='center'><?php echo $data['name']; ?></td>
					<td align='center'><?php echo $data['type']; ?></td>
					<td align='center'>Rp. <?php echo price($data['price']); ?></td>
					<td align='center'><?php echo $data['stock']; ?></td>
					<td align='center'>
						<?php if (!empty($data['image'])): ?>				
							<img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/'.$data['image']; ?>" width="50%"><br/>
						<?php else : ?>
							<img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/product/no-image.jpg' ?>" width="50%"><br/>
						<?php endif ?>
					</td>
					<td align="center">
						<?php 
							if ($data['status'] == 1) {
								echo "Not Publish";
							} elseif ($data['status'] == 2) {
								echo "Publish";
							}
						?>
					</td>
					<td align='center'>
						<a href="index.php?id_product=<?php echo $data['id_product']; ?>&list=11&head=admin"><img title="Edit" src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/icon/edit.png' ?>" width = "15%"></a> &nbsp;
						<a href="index.php?id_product=<?php echo $data['id_product']; ?>&list=12&head=admin"><img title="Hapus" src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/icon/delete.png' ?>" width = "15%"></a> &nbsp;
						<?php if($data['status'] == 1): ?>
							<a href="index.php?id_product=<?php echo $data['id_product']; ?>&list=13&head=admin"><img title="Publish" src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/icon/publish.png' ?>" width = "17%"></a>
						<?php else: ?>
							<a href="index.php?id_product=<?php echo $data['id_product']; ?>&list=13&head=admin"><img title="Not Publish" src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/icon/publish.png' ?>" width = "17%"></a>
						<?php endif ?>
					</td>
				</tr>					 
			<?php endwhile ?>
		<?php else: ?>
			<tr>
				<td colspan="8" align="center" style="font-size:20px; padding:20px">Produk tidak ditemukan</td>
			</tr>
		<?php endif ?>
	</table>
	<table class="width">
		<tr>
			<td align="right">
				<nav>
					<ul class="pagination">
						<?php
							if(!empty($search)) {
								$tampil2 = "SELECT * FROM product WHERE name LIKE '%$search%' OR type LIKE '%$search%'";
							} else {
								$tampil2="SELECT * FROM product";
							}
							$hasil2=mysql_query($tampil2); 
							$jmldata=mysql_num_rows($hasil2); 
							$jmlhalaman=ceil($jmldata/$batas);
						?>

						<?php if($halaman > 1): ?>
							<?php $previous = $halaman-1; ?>
							<?php if(!empty($search)): ?>
								<li><a href="<?php echo "$_SERVER[PHP_SELF]?search=$search&halaman=$previous" ?>&list=8&head=admin" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
							<?php else: ?>
								<li><a href="<?php echo "$_SERVER[PHP_SELF]?halaman=$previous" ?>&list=8&head=admin" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
							<?php endif ?>
						<?php else: ?>
							<li class="disabled"><a href="" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
						<?php endif ?>

						<?php for($i=1;$i<=$jmlhalaman;$i++): ?>
							<?php if($i>=($halaman-3) && $i <= ($halaman+3)): ?>
								<?php if ($i != $halaman): ?>
									<?php if(!empty($search)): ?>
										<li><a href="<?php echo "$_SERVER[PHP_SELF]?search=$search&halaman=$i" ?>&list=8&head=admin"><?php echo $i; ?></a></li>
									<?php else: ?>
										<li><a href="<?php echo "$_SERVER[PHP_SELF]?halaman=$i" ?>&list=8&head=admin"><?php echo $i; ?></a></li>
									<?php endif ?>
								<?php else: ?>
									<li class="active"><a><?php echo $i; ?></a></li>
								<?php endif ?>
							<?php endif ?>
						<?php endfor ?>

						<?php if($halaman < $jmlhalaman): ?>
							<?php $next = $halaman+1; ?>
							<?php if(!empty($search)): ?>
								<li><a href="<?php echo "$_SERVER[PHP_SELF]?search=$search&halaman=$next" ?>&list=8&head=admin" aria-label="Next"><span aria-hidden="true">»</span></a></li>
							<?php else: ?>
								<li><a href="<?php echo "$_SERVER[PHP_SELF]?halaman=$next" ?>&list=8&head=admin" aria-label="Next"><span aria-hidden="true">»</span></a></li>
							<?php endif ?>
						<?php else: ?>
							<li class="disabled"><a href="" aria-label="Next"><span aria-hidden="true">»</span></a></li>
						<?php endif ?>
					</ul>
			   	</nav>
			</td>
		</tr>
	</table>
</form>
<?php } ?>
<script>
	function validasi(form) {
		if (form.search.value == 0){
			alert("Silahkan masukan nama produk yang anda cari.");
			form.search.focus();
			return (false);
		}
		return (true);  
	}
</script>