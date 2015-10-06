<?php
	if(!isset($_SESSION['user'])) {
	  	echo "<script>window.alert('Anda Harus Login Dulu');</script>";
		echo "<script>window.location = 'index.php?list=5&head=home';</script>";
	} elseif ($_SESSION['user']['level'] == "admin") {
		echo "<script>window.alert('Maaf, Anda Tidak Memiliki Hak Akses');</script>";
		echo "<script>window.location = 'index.php?list=8&head=admin';</script>";
	} else {
?>
<div class="row-isi">
	<table class="width">
		<tr>
			<td width="35%" align="center">
				<a href="index.php?list=8&head=admin"><img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/admin/documents-icon.png' ?>" width="50%"></a><br/>
				DAFTAR PRODUK
			</td>
			<td width="35%" align="center">
				<a href="index.php?list=9&head=admin"><img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/admin/user-icon.png' ?>" width="50%"></a><br/>
				ADMIN
			</td>
		</tr>
	</table>	
</div>


<?php } ?>