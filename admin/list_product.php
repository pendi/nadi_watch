<?php
	if(!isset($_SESSION['user'])) {
	  	echo "<script>window.alert('Anda Harus Login Dulu');</script>";
		echo "<script>window.location = 'index.php?list=5&head=home';</script>";
	} else {
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
			$que = mysql_query("SELECT id_product,name,type,price,stock,image,status,gender,category,description,color FROM product WHERE name LIKE '%$search%' OR type LIKE '%$search%' LIMIT $posisi,$batas");
			$jumlah = mysql_num_rows($que);
		} else {
			$que = mysql_query("SELECT id_product,name,type,price,stock,image,status,gender,category,description,color FROM product LIMIT $posisi,$batas");
			$jumlah = mysql_num_rows($que);
		}
?>

<style type="text/css">
	.search { margin:7px 10px; width:50%; height:28px; border-radius:30px; outline-style:none; padding-left:7px; }
	.descrip { font-size:13px; color:rgb(131, 0, 0); }
	.more { padding-top:25px; color:#0066FF; font-size:16px; }
</style>

<form action="" method="get">
	<table width="95%" align="center">
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
	<?php if($jumlah > 0): ?>
		<?php while ($data = mysql_fetch_array($que)): ?>
			<table width="95%" align="center" class="listPro" style="border-bottom: 1px solid rgb(165, 165, 165);">
				<tr>
					<td width="85px">
						<?php if(!empty($data['image'])): ?>
							<img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/'.$data['image']; ?>" width="80px">
						<?php else: ?>
							<img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/product/no-image.jpg' ?>" width="80px">
						<?php endif ?>
					</td>
					<td width="540px" style="line-height:26px" valign="top">
						<?php echo $data['name'] ?> <?php echo $data['type']; ?> (<?php echo ucwords($data['gender']); ?>-<?php echo ucwords($data['category']) ?>)<br />
						<span class="descrip"><?php echo strlenProduct($data['description']); ?></span><br />
						<span style="color:#0066FF">
							<?php 
								if($data['status'] == 1) {
									echo $data['stock']." Unit - Not Publish";
								} elseif($data['status'] == 2) {
									echo $data['stock']." Unit - Publish";
								}
							?>
						</span>
					</td>
					<td valign="top" align="right">
						<a class="href" href="index.php?id_product=<?php echo $data['id_product'].'&list=11&head=admin' ?>">
							<img class="widthPro" src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/icon/edit.png' ?>">
						</a>
						<a class="href" href="index.php?id_product=<?php echo $data['id_product'].'&list=13&head=admin' ?>">
							<img class="widthPro" src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/icon/globe.png' ?>">
						</a>
						<a class="href" href="index.php?id_product=<?php echo $data['id_product'].'&list=12&head=admin' ?>">
							<img class="widthPro" src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/icon/delete.png' ?>">
						</a><br />
						<div class="more"><?php echo $data['color'].' - Rp. '.price($data['price']) ?></div>
					</td>
				</tr>
			</table>
		<?php endwhile ?>
	<?php else: ?>
		<table width="95%" align="center" class="listPro" style="border-bottom: 1px solid rgb(165, 165, 165);">
			<tr class="not-found">
				<td>Produk Tidak Ditemukan</td>
			</tr>
		</table>
	<?php endif ?>

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
	// $(function() {
	//     $('.show').click(function(evt){
	//     	var 
	//     	$parentShow = $(evt.target).parents('.textKA');

	//     	$parentShow.find('.text-area').slideDown(1);
	//     	$parentShow.find('.showArea').hide();
	//     	$parentShow.find('.hideArea').show();
	// 	});

	//     $('.hide').click(function(evt){
	//     	var 
	//     	$parentHide = $(evt.target).parents('.textKA');

	//     	$parentHide.find('.text-area').slideUp(1,"linear");
	//     	$parentHide.find('.showArea').show();
	//     	$parentHide.find('.hideArea').hide();
	//     });
	// });

	// function validasi(form) {
	// 	if (form.search.value == 0){
	// 		alert("Silahkan masukan nama produk yang anda cari.");
	// 		form.search.focus();
	// 		return (false);
	// 	}
	// 	return (true);  
	// }
</script>