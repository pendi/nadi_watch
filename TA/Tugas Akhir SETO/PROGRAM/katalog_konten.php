<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="js/css/smoothness/jquery-ui-1.8.17.custom.css" />
<script type="text/javascript" language="javascript">
	function validasi(form){
		if (form.nama.value == ""){
			alert("Anda belum mengisikan Nama.");
			form.nama.focus();
			return (false);
		}    
		if (form.email.value == ""){
			alert("Anda belum mengisikan Emailkontak.");
			form.email.focus();
			return (false);
		}
		if (form.subjek.value == ""){
			alert("Anda belum mengisikan subjek.");
			form.subjek.focus();
			return (false);
		}
		if (form.pesan.value == ""){
			alert("Anda belum mengisikan isi pesan .");
			form.pesan.focus();
			return (false);
		}
		if (form.alamat.value == ""){
			alert("Anda belum mengisikan Alamat.");
			form.alamat.focus();
			return (false);
		}
		if (form.telpon.value == ""){
			alert("Anda belum mengisikan Telpon.");
			form.telpon.focus();
			return (false);
		}
		 
		if (form.kota.value == 0){
			alert("Anda belum mengisikan Kota.");
			form.kota.focus();
			return (false);
		}
		return (true);
	}

	function harusangka(jumlah){
		var karakter = (jumlah.which) ? jumlah.which : event.keyCode
		if (karakter > 31 && (karakter < 48 || karakter > 57))
			return false;
		return true;
	}
</script>
<?php
// Halaman utama (Home)
if ($_GET['module']=='beranda'){
?>
	<div class='top_prod' style="padding:0 0 0 0;">
		<div id="accordion">
			<h3><a href="#"><div class='product_title'>Selamat berbelanja :)</div></a></h3>
				<div><hr>
					<?php
						$sql2=mysql_query("SELECT * FROM produk ORDER BY rand() LIMIT 6");
						$kolom = 3;
						echo "<table><tr>";
						$i=0;
						while ($random=mysql_fetch_array($sql2)){
							$harga     = number_format($random['harga'],0,",",".");
	
							if ($i >= $kolom){
								echo "</tr><tr>";
								$i=0;
							}
							$i++;
							echo "<td align=center><div class='prod_box'>
								<div class='top_prod_box'></div>
								<div class='center_prod_box'>            
								<div class='product_title'><a href='prod-detail-$random[id_produk]-$random[seo]'>$random[nama_produk]</a></div>
								<div class='product_img'><a href='prod-detail-$random[id_produk]-$random[seo]'><img src='foto_produk/small_$random[gambar]' alt='$random[nama_produk]' title='header=[$random[nama_produk]] body=[&nbsp;] fade=[on]' border='0' /></a></div>
								<div class='prod_price'>";
							if (!empty($random['h_awal'])) {
								$h_awal = number_format($random['h_awal'],0,",",".");
								echo "<span class='reduce'>Rp $h_awal</span>";
							}
							echo "<span class='price'> Rp $harga</span></div>                        
								</div>
								<div class='bottom_prod_box'></div>             
								<div class='prod_details_tab'>
								<a href='logic.php?module=keranjang&act=tambah&id=$random[id_produk]' title='header=[Beli sekarang] body=[&nbsp;] fade=[on]'><img src='css/images/addtocart.gif' alt='chart' title='' border='0' class='left_bt' /></a>                      
								<a href='prod-detail-$random[id_produk]-$random[seo]' class='prod_details' title='header=[Detail $random[nama_produk]] body=[&nbsp;] fade=[on]'>Selengkapnya</a> 			                    
								</div></td>";
						}
						echo "</tr></table>"; 
					?>
				</div><!--end acoordion 1-->
		</div><!--end accordion-->
	</div><!--end top_prod_box-->
<?php
}
//detail produk
elseif ($_GET['module']=='detailproduk'){
	$detail		=mysql_query("SELECT * FROM produk,kategori,vendor
                      WHERE kategori.id_kategori=produk.id_kategori AND produk.id_vendor=vendor.id_vendor
                      AND id_produk='$_GET[id]'");
	$d   		= mysql_fetch_array($detail);
	$tgl 		= tgl_indo($d['tgl_masuk']);
  	$deskripsi 	= nl2br($d['deskripsi']); // membuat paragraf pada isi berita
  	$harga     	= number_format($d['harga'],0,",",".");
	$ongkir		= number_format($d['ongkir'],0,",",".");
?>
	<div class='top_prod'>
		<div id="accordion">
			<h3><a href="#"><div class='product_title'><?php echo "$d[nama_produk]"; ?></div></a></h3>
				<div id="acor1_content">
					<table>
						<tr><td>
								<div class='prod_box'>
									<div class='top_prod_box'></div>
									<div class='center_prod_box'>          
										<div class='product_img_big'>
											<?php echo "<a href='javascript:popImage(\"foto_produk/$d[gambar]\",\"$d[nama_produk]\")' title='header=[Zoom] body=[&nbsp;] fade=[on]'><img src='foto_produk/small_$d[gambar]' alt='' title='' border='0' /></a>"; ?>
										</div>
										<div class='prod_price'> 
											<?php 
												if (!empty($d['h_awal'])) {
													$h_awal = number_format($d['h_awal'],0,",",".");
													echo "<span class='reduce'>Rp $h_awal</span>";
												}
												echo "<br/><span class='price'>Rp $harga</span>";
											?>
										</div>
									</div><!--end center_prod_box -->
									<div class='bottom_prod_box'></div>             
								</div><!-- end prod_box-->
							</td>
							<td width='160' valign='top'><b>Dimensi</b><br/>
											$d[dimensi]<br/><br/><br/>
											<b>Stok</b><br/>
											$d[stok]<br/><br/><br/>
											<a href='logic.php?module=keranjang&act=tambah&id=$d[id_produk]' title='header=[Beli sekarang] body=[&nbsp;] fade=[on]'>
														<img src='css/images/addtocart.gif' alt='chart' title='' border='0' class='left_bt' /></a>
							</td>
							<td valign='top'><b>Berat</b><br/>
											$d[berat]<br/><br/><br/>
											<b>Listing sejak</b><br/>
											$d[tgl_masuk]<br/><br/><br/>
											<b>Ongkos kirim</b><br/>
											Rp $ongkir<br/><br/>
							</td>
						</tr>
					</table>
				</div><!--acor1_content-->
			<h3><a href="#">Deskripsi</a></h3>
				<div class='desc_prod_box_big'>
					<span>Kategori: <?php echo"<a href=kategori-$d[id_kategori]-$d[seo].html><b>$d[nama_kategori]</b></a>"; ?></span><br /><br>
					<?php echo "$deskripsi"; ?><hr>
				</div><!--desc_prod_box_big-->
		</div><!--END accordion-->
	</div><!--end top_prod-->
	<div class='bottom_prod' style="position:relative; left:0; ">
		<div id="tabs">
			<ul>
				<li><a href="#tabs-1"><img src="css/images/hype_machine.png" /></a></li>
				<li><a href="#tabs-2"><img src="css/images/sharethis.png" /></a></li>
			</ul>
			<div id="tabs-2">           
				<div class='related_prod_box_big'>
					<table>
						<tr><td>
								<div class='pic_prod_box'>
									<?php
									/*	$sql=mysql_query("SELECT * FROM produk WHERE id_kategori='$d[nama_kategori]' OR id_vendor='$d[id_vendor]' ORDER BY rand() DESC LIMIT 2");
										$numrelated = mysql_num_rows($sql);//AND id_produk!='$d[id_produk]' 
										if ($numrelated<1) {
											echo "No related product";
										}
										else {
											while ($related=mysql_fetch_array($sql)){
												$deskripsi 	= nl2br($related['deskripsi']); // membuat paragraf 
												$isi       	= substr($deskripsi,0,200); // ambil sebanyak 80 karakter
												$isi       	= substr($deskripsi,0,strrpos($isi," ")); // potong per spasi kalima
												$h_awal 	= number_format($related['h_awal'],0,",",".");				 
												$harga 		= number_format($related['harga'],0,",",".");
												echo "<a href='prod-detail-$related[id_produk]-$related[seo]' title='header=[Detail $related[nama_produk]] body=[&nbsp;] fade=[on]'>
													<img src='foto_produk/small_$related[gambar]' class='oferta_img' /></a>
													<br/>";
												if (!empty($related['h_awal'])) {
													echo "<span class='reduce'>Rp $h_awal</span><br/>";
												}
												echo "<span class='price'> Rp $harga</span>";*/
									?>
								</div><!--end pic_prod_box-->
							</td>
							<td>
								<div class='desc_prod'>
									<?php
										echo "<br/><br/><a href='logic.php?module=keranjang&act=tambah&id=$related[id_produk]' title='header=[Beli sekarang] body=[&nbsp;] fade=[on]'>
													<img src='css/images/addtocart.gif' alt='chart' title='' border='0' class='left_bt' /></a>"; 
									?>		
								</div><!--end desc_prod-->
							</td>	
						</tr>		
					</table>
					<hr>
				</div><!--related_prod_box_big-->
			</div><!--end tabs-2--> 
			<div id="tabs-1">
				<div class='rev_prod_box_big'>
					<?php
						$sql=mysql_query("SELECT * FROM review_produk WHERE id_produk=$d[id_produk] AND status !='off' ORDER BY id_review DESC");				
						$num = mysql_num_rows($sql);
						if ($num > 0) {//show review 
							while ($review = mysql_fetch_array($sql)) {
								$tanggal = explode("-",$review['tanggal']);
								$tanggal = "$tanggal[2]/$tanggal[1]/$tanggal[0] jam $review[jam]";
								echo "$review[nama_customer] pada $tanggal <br><br>
									$review[isi]<br><hr>";
							}
						}
						else {
							echo "No review yet for this $d[nama_produk]";
						}
					?>
						<script type="text/javascript" language="javascript">
							function  validasiReview(form){
							  if (form.nama.value == ""){
								alert("Anda belum mengisikan Nama.");
								form.nama.focus();
								return (false);
							  }    
							  if (form.email.value == ""){
								alert("Anda belum mengisikan Email Review.");
								form.email.focus();
								return (false);
							  }
							  if (form.review.value == ""){
								alert("Anda belum mengisikan review.");
								form.review.focus();
								return (false);
							  }
							  return (true);
							}
							</script>
					<br/>
					<form method="post" name="form" action="katalog_beranda.php?module=simpanreview&id=<?php echo"$d[id_produk]"; ?>" onSubmit="return validasiReview(this)" >
					<table>
						<TR><td width="20">Nama </td>
							<td width="5"> : </td>
							<td align="left"><input type="text" name="nama" size="20" /></td>
						</TR>
						<tr><td>Email </td>
							<td> : </td>
							<td  align="left"><input type="text" name="email" size="20" />
								<?php
								if(isset($_GET['f']) AND $_GET['f']=='email') {
									echo "<br>&nbsp;&nbsp;&nbsp;<font color=red>Email Anda sepertinya tidak valid</font>";
								}		
								?>
							</td>
						</tr>
						<tr><td valign="top"> Review </td>
							<td  valign="top" align="left"> : </td>
							<td  align="left"><textarea name="review" rows="10" cols="60"></textarea></td>
						</tr>
						<tr><td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;&nbsp;<img border="1px" id="captcha" src="config/securimage/securimage_show.php" alt="CAPTCHA Image" />
								<?php
								if(isset($_GET['f']) AND $_GET['f']=='captcha') {
									echo "<br>&nbsp;&nbsp;&nbsp;<font color=red>Kode captcha salah, coba teks lain</font>";
								}		
								?>		
							</td>
						</tr>
						<tr><td>Text</td>
							<td> : </td>
							<td align="left">&nbsp;<input type="text" name="captcha_code" size="10" maxlength="6" />	
								<a href="#" onclick="document.getElementById('captcha').src = 'config/securimage/securimage_show.php?' + Math.random(); return false">
								<img src="config/securimage/images/refresh.gif" /></a>
							</td>
						</tr>
						<tr><td><input type="submit" Value="Submit" /></td>
							<td><input type="reset" value="Reset" /></td>
							<td></td>
						</tr>
					</table>
					</form>
				</div><!--end rev_prod_box_big-->          
			</div><!--end tabs-1-->      
		</div><!--end tabs--> 
	</div><!--end bottom_prod--> 	
<?php
}
elseif ($_GET['module']=='simpanreview'){
	$nama = $_POST['nama'];
	$email = $_POST['email'];
	$review = $_POST['review'];
	include_once "config/securimage/securimage.php";
	$securimage = new Securimage();
	$kar1=strstr($_POST['email'], "@");
	$kar2=strstr($_POST['email'], ".");
	if (@!ereg("[a-z|A-Z]","$_POST[nama]")){
		header("location:katalog_beranda.php?module=detailproduk&id=$_GET[id]&f=name");
	}
	elseif (strlen($kar1)==0 OR strlen($kar2)==0){
		header("location:katalog_beranda.php?module=detailproduk&id=$_GET[id]&f=email");
	}
	elseif ($securimage->check($_POST['captcha_code']) == false) {
		header("location:katalog_beranda.php?module=detailproduk&id=$_GET[id]&f=captcha");
	} 
	else{	
		$review = mysql_real_escape_string(stripslashes(strip_tags($review,ENT_QUOTES)));
		$sql = mysql_query("INSERT INTO review_produk
						VALUES('','$nama','$email','$review','$_GET[id]','off',CURDATE(),CURTIME())");
		if ($sql){
			echo "<center><b>Review anda telah tersimpan</b></center>";
			echo  "<META HTTP-EQUIV='Refresh' CONTENT='3; URL=katalog_beranda.php?module=detailproduk&id=$_GET[id]'>";
		}
		else {
			echo "Error :".mysql_error();
		}
	}		
}
//semua produk
elseif ($_GET['module']=='semuaproduk'){?>
<div class='top_prod' style="padding:0 0 0 0;">
<div id="accordion">
	<h3><a href="#"><div class='product_title'><b>All Produk</b></div></a></h3>
	<div><hr>

<?php	// Tampilkan semua produk
	$p      = new Paging2;
	$batas  = 8;
	$posisi = $p->cariPosisi($batas);
	// Tampilkan semua produk
	$sql=mysql_query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT $posisi,$batas");
	$kolom = 3;
		echo "<table><tr>";
		$i=0;
		while ($r=mysql_fetch_array($sql)){
			$harga     = number_format($r['harga'],0,",",".");
            if ($i >= $kolom){
				echo "</tr><tr>";
				$i=0;
			}
			$i++;
			echo "<td align=center><div class='prod_box'>
				<div class='top_prod_box'></div>
				<div class='center_prod_box'>            
					<div class='product_title'><a href='prod-detail-$r[id_produk]-$r[seo]'>$r[nama_produk]</a></div>
					<div class='product_img'><a href='prod-detail-$r[id_produk]-$r[seo]'><img src='foto_produk/small_$r[gambar]' alt='$r[nama_produk]' 					title='header=[$r[nama_produk]] body=[&nbsp;] fade=[on]' border='0' /></a></div>
					<div class='prod_price'>";
					if (!empty($random['h_awal'])) {
						$h_awal = number_format($random['h_awal'],0,",",".");
						echo "<span class='reduce'>Rp $h_awal</span>";
					}
					echo "<span class='price'> Rp $harga</span></div>                        
						</div>
						<div class='bottom_prod_box'></div>             
						<div class='prod_details_tab'>
						<a href='logic.php?module=keranjang&act=tambah&id=$r[id_produk]' title='header=[Beli sekarang] body=[&nbsp;] fade=[on]'><img src='css/images/addtocart.gif' alt='' title='' border='0' class='left_bt' /></a>                      
						<a href='prod-detail-$r[id_produk]-$r[seo]' class='prod_details' title='header=[Detail $r[nama_produk]] body=[&nbsp;] fade=[on]'>Selengkapnya</a>            
						</div>                     
						</div></td>";
		}
		echo "</tr></table><br />";
		$jmldata     = mysql_num_rows(mysql_query("SELECT * FROM produk"));
		$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
		$linkHalaman = $p->navHalaman($_GET['halproduk'], $jmlhalaman);

		echo "Hal: $linkHalaman<br /><br />";
?>
</div>
	</div>
	</div><!--end top_prod-->
<?php		
}
//produk per kategori
elseif ($_GET['module']=='detailkategori'){?>
<div class='top_prod' style="padding:0 0 0 0;">
<div id="accordion">
	

<?php
	// Tampilkan nama kategori
	$sq = mysql_query("SELECT nama_kategori from kategori where id_kategori='$_GET[id]'");
	$n = mysql_fetch_array($sq);
	echo "<h3><a href='#'><div class='product_title'><b>Kategori : <b>$n[nama_kategori]</b></div></a></h3>
	<div><hr>";
  
	$p      = new Paging3;
	$batas  = 9;
	$posisi = $p->cariPosisi($batas);
  
	// Tampilkan daftar produk yang sesuai dengan kategori yang dipilih
	$sql   = "SELECT * FROM produk WHERE id_kategori='$_GET[id]' 
				ORDER BY id_produk DESC LIMIT $posisi,$batas";		 
	$hasil = mysql_query($sql);
	$jumlah = mysql_num_rows($hasil);
	
	// Apabila ditemukan produk dalam kategori
	if ($jumlah > 0){
		$kolom = 3;
		echo "<table><tr>";
		$i=0;
		while ($r=mysql_fetch_array($hasil)){
			$harga     = number_format($r['harga'],0,",",".");
            if ($i >= $kolom){
				echo "</tr><tr>";
				$i=0;
			}
			$i++;
			echo "<td align=center><div class='prod_box'>
				<div class='top_prod_box'></div>
				<div class='center_prod_box'>            
					<div class='product_title'><a href='prod-detail-$r[id_produk]-$r[seo]'>$r[nama_produk]</a></div>
					<div class='product_img'><a href='prod-detail-$r[id_produk]-$r[seo]'><img src='foto_produk/small_$r[gambar]' alt='$r[nama_produk]' title='header=[$r[nama_produk]] body=[&nbsp;] fade=[on]' border='0' /></a></div>
					<div class='prod_price'>";
					if (!empty($r['h_awal'])) {
						$h_awal = number_format($r['h_awal'],0,",",".");
						echo "<span class='reduce'>Rp $h_awal</span>";
					}
					echo "<span class='price'> Rp $harga</span></div>                        
						</div>
						<div class='bottom_prod_box'></div>             
						<div class='prod_details_tab'>
						<a href='logic.php?module=keranjang&act=tambah&id=$r[id_produk]' title='header=[Beli sekarang] body=[&nbsp;] fade=[on]'><img src='css/images/addtocart.gif' alt='' title='' border='0' class='left_bt' /></a>                      
						<a href='prod-detail-$r[id_produk]-$r[seo]' class='prod_details' title='header=[Detail $r[nama_produk]] body=[&nbsp;] fade=[on]'>Selengkapnya</a>            
						</div>                     
						</div></td>";
		}
		echo "</tr></table><br />";
		$jmldata     = mysql_num_rows(mysql_query("SELECT * FROM produk WHERE id_kategori='$_GET[id]'"));
		$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
		$linkHalaman = $p->navHalaman($_GET['halkategori'], $jmlhalaman);

		echo "Hal: $linkHalaman<br /><br />";
	}
  else{
    echo "<p align=center>Belum ada produk pada kategori ini.</p>";
  }	
?>
</div>
	</div>
	</div><!--end top_prod-->
<?php	
}
//produk per vendor
elseif ($_GET['module']=='detailvendor'){?>
<div class='top_prod' style="padding:0 0 0 0;">
<div id="accordion">
	

<?php
	// Tampilkan nama Vendor
	$sq = mysql_query("SELECT nama_vendor from vendor where id_vendor='$_GET[id]'");
	$n = mysql_fetch_array($sq);
	echo "<h3><a href='#'><div class='product_title'><b>Vendor : <b>$n[nama_vendor]</b></div></a></h3>
	<div><hr>";
  
	$p      = new Paging3;
	$batas  = 9;
	$posisi = $p->cariPosisi($batas);
  
	// Tampilkan daftar produk yang sesuai dengan vendor yang dipilih
	$sql   = "SELECT * FROM produk WHERE id_vendor='$_GET[id]' 
				ORDER BY id_produk DESC LIMIT $posisi,$batas";		 
	$hasil = mysql_query($sql);
	$jumlah = mysql_num_rows($hasil);
	
	// Apabila ditemukan 
	if ($jumlah > 0){
		$kolom = 3;
		echo "<table><tr>";
		$i=0;
		while ($r=mysql_fetch_array($hasil)){
			$harga     = number_format($r['harga'],0,",",".");
            if ($i >= $kolom){
				echo "</tr><tr>";
				$i=0;
			}
			$i++;
			echo "<td align=center><div class='prod_box'>
				<div class='top_prod_box'></div>
				<div class='center_prod_box'>            
					<div class='product_title'><a href='prod-detail-$r[id_produk]-$r[seo]'>$r[nama_produk]</a></div>
					<div class='product_img'><a href='prod-detail-$r[id_produk]-$r[seo]'><img src='foto_produk/small_$r[gambar]' alt='$r[nama_produk]' title='header=[$r[nama_produk]] body=[&nbsp;] fade=[on]' border='0' /></a></div>
					<div class='prod_price'>";
					if (!empty($r['h_awal'])) {
						$h_awal = number_format($r['h_awal'],0,",",".");
						echo "<span class='reduce'>Rp $h_awal</span>";
					}
					echo "<span class='price'> Rp $harga</span></div>                        
						</div>
						<div class='bottom_prod_box'></div>             
						<div class='prod_details_tab'>
						<a href='logic.php?module=keranjang&act=tambah&id=$r[id_produk]' title='header=[Beli sekarang] body=[&nbsp;] fade=[on]'><img src='css/images/addtocart.gif' alt='' title='' border='0' class='left_bt' /></a>                      
						<a href='prod-detail-$r[id_produk]-$r[seo]' class='prod_details' title='header=[Detail $r[nama_produk]] body=[&nbsp;] fade=[on]'>Selengkapnya</a>            
						</div>                     
						</div></td>";
		}
		echo "</tr></table>";
		$jmldata     = mysql_num_rows(mysql_query("SELECT * FROM produk WHERE id_vendor='$_GET[id]'"));
		$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
		$linkHalaman = $p->navHalaman($_GET['halkategori'], $jmlhalaman);

		echo "Hal: $linkHalaman<br /><br />";
	}
	else{
		echo "<p align=center>Belum ada produk dari vendor ini.</p>";
	}
?>
</div>
	</div>
	</div><!--end top_prod-->
<?php		
}
// Modul searching
elseif ($_GET['module']=='search'){?>
<div class='top_prod' style="padding:0 0 0 0;">
<div id="accordion">
	
<?php
	if (empty($_POST['search'])){
		echo "<b><center>Masukkan kata kunci!</center></b>";
	}
	else {
	//Menghilangkan spasi di kiri dan kanan
	$keyword = trim($_POST['search']);
	
	//pisahkan kata perkalimat lalu hitung jumlah kata
	$pisah_keyword = explode(" ",$keyword);
	$jml_keywords  = (integer)count($pisah_keyword);
	$jml_keyword   = $jml_keywords-1;
	
	//paging initialize
	$p      = new Paging3;
	$batas  = 12;
	$posisi = $p->cariPosisi($batas);
	
	//Query multiple keyword
	$sql = "SELECT * FROM produk WHERE ";
	for($x=0; $x <=$jml_keyword; $x++) {
		$sql .= "nama_produk LIKE '%$pisah_keyword[$x]%'";
		if($x < $jml_keyword) {
			$sql .=" OR ";
		}
	}
	$sql .=" ORDER BY id_produk DESC LIMIT $posisi,$batas";
	
	echo "<h3><a href='#'><div class='product_title'><b>Hasil pencarian untuk <font style='background-color:#00FFFF'><i><b>$keyword</b></i></font></b></div></a></h3>
	<div><hr>";  
	// Tampilkan daftar produk yang sesuai dengan keyword pencarian
	$hasil = mysql_query($sql);
	$jumlah = mysql_num_rows($hasil);
	//echo "$sql<br>jumlah key $jml_keyword";
	// Apabila ada produk yang ditemukan
	if ($jumlah > 0){
		$kolom = 3;
		echo "<table><tr>";
		$i=0;
		while ($r=mysql_fetch_array($hasil)){
			$harga     = number_format($r['harga'],0,",",".");
            if ($i >= $kolom){
				echo "</tr><tr>";
				$i=0;
			}
			$i++;
			echo "<td align=center><div class='prod_box'>
				<div class='top_prod_box'></div>
				<div class='center_prod_box'>            
					<div class='product_title'><a href='prod-detail-$r[id_produk]-$r[seo]'>$r[nama_produk]</a></div>
					<div class='product_img'><a href='prod-detail-$r[id_produk]-$r[seo]'><img src='foto_produk/small_$r[gambar]' alt='$r[nama_produk]' title='header=[$r[nama_produk]] body=[&nbsp;] fade=[on]' border='0' /></a></div>
					<div class='prod_price'>";
					if (!empty($r['h_awal'])) {
						$h_awal = number_format($r['h_awal'],0,",",".");
						echo "<span class='reduce'>Rp $h_awal</span>";
					}
					echo "<span class='price'> Rp $harga</span></div>                        
						</div>
						<div class='bottom_prod_box'></div>             
						<div class='prod_details_tab'>
						<a href='logic.php?module=keranjang&act=tambah&id=$r[id_produk]' title='header=[Beli sekarang] body=[&nbsp;] fade=[on]'><img src='css/images/addtocart.gif' alt='' title='' border='0' class='left_bt' /></a>                      
						<a href='prod-detail-$r[id_produk]-$r[seo]' class='prod_details' title='header=[Detail $r[nama_produk]] body=[&nbsp;] fade=[on]'>Selengkapnya</a>            
						</div>                     
						</div></td>";
						
		}
		echo "</tr></table><br />";
		$jmldata     = mysql_num_rows(mysql_query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%'"));
		$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
		$linkHalaman = $p->navHalaman($_GET['halkategori'], $jmlhalaman);

		echo "Hal: $linkHalaman<br /><br />";
	}
  else{
    echo "<p align=center>Silahkan masukkan kata kunci baru.</p>";
  }	
	}
	?>
 
		</div>
	</div>
	</div><!--end top_prod-->	
	<?php
}
//keranjang belanja
elseif ($_GET['module']=='keranjang'){?>
<div class='top_prod' style="padding:0 0 0 0;">
<div id="accordion">
	<h3><a href="#"><div class='product_title'><b>Keranjang Belanja</b></div></a></h3>
	<div><hr>

<?php
	// Tampilkan produk-produk yang telah dimasukkan ke keranjang belanja
	$sid = session_id();
	$sql = mysql_query("SELECT * FROM orders_temp, produk 
								WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
	$ketemu=mysql_num_rows($sql);
	if($ketemu < 1){
		echo "<center><h3><b>Keranjang Belanjanya Masih Kosong</b></h3></center>";
		echo "<META HTTP-EQUIV='Refresh' CONTENT='3; URL=index.php'><br/>";
    }
	else{
		echo "<div class='prod_box_big'><form method=post action=logic.php?module=keranjang&act=update>
			<table border=0 cellpadding=3 align=center width=100%>
			<tr bgcolor=#D3DCE3><th>No</th><th>Produk</th><th>Nama Produk</th><th>Jumlah</th>
			<th>Harga</th><th>Sub Total</th><th>Hapus</th></tr>";  
  
		$no=1;
		while($r=mysql_fetch_array($sql)){
			$subtotal    = $r['harga'] * $r['jumlah'];
			$total       = $total + $subtotal;  
			$subtotal_rp = format_rupiah($subtotal);
			$total_rp    = format_rupiah($total);
			$harga       = format_rupiah($r['harga']);
    
			echo "<tr bgcolor=#cccccc><td>$no</td><input type=hidden name=id[$no] value=$r[id_orders_temp]>
					<td align=center><br><img src=foto_produk/small_$r[gambar]></td>
					<td>$r[nama_produk]</td>
					<td><input type=text name='jml[$no]' value=$r[jumlah] size=1 onkeypress=\"return harusangka(event)\"></td>
					<td>$harga</td>
					<td>$subtotal_rp</td>
					<td align=center><a href='logic.php?module=keranjang&act=hapus&id=$r[id_orders_temp]'>
					<img src=css/images/kali.png border=0 title='header=[Hapus] body=[&nbsp;] fade=[on]'></a></td>
					</tr>";
			$no++; 
		} //javascript:history.go(-1)
		echo "<tr><td colspan=5 align=right><br><b>Total</b>:</td><td colspan=2><br>Rp. <b>$total_rp</b></td></tr>
				<tr><td colspan=2><br /><a href=beranda.seto><img src=css/images/lanjutkan.png border=0 title='header=[Lanjut belanja] body=[&nbsp;] fade=[on]'></a><br /></td>
				<td colspan=2><br /><input type=image src='css/images/update.png' border=0 title='header=[Update keranjang belanja] body=[&nbsp;] fade=[on]'><br /></td>
				<td colspan=3 align=right><br /><a href=selesai-belanja.html title='header=[Selesai belanja] body=[&nbsp;] fade=[on]'><img src='css/images/shoppingcart.png' alt='' title='' width='48' height='48' border='0' /></a><br /></td></tr>
				</table></form><br />";
		echo "*) Apabila anda mengubah jumlah, setelah input data pada jumlah, tekan tombol <b>Update Keranjang</b>.  
			**) Total harga diatas belum termasuk ongkos kirim yang akan dihitung saat <b>Selesai Belanja</b>.<br /><br /></div>";
	}
	?>
	</div>
	</div>
	</div><!--end top_prod-->	
	<?php
}
//selesai belanja
elseif ($_GET['module']=='selesaibelanja'){?>
<div class='top_prod' style="padding:0 0 0 0;">
<div id="accordion">
	<h3><a href="#"><div class='product_title'><b>Data Anda</b></div></a></h3>
	<div><hr>

<?php
	// Form untuk input data pembeli
	echo "<form name='form' action=simpan-transaksi.end method=POST onSubmit=\"return validasi(this)\">
			<table>
			<tr><td>Nama</td><td> : <input type=text name=nama size=30></td></tr>
			<tr><td>Alamat Lengkap</td><td> : <input type=text name=alamat size=65></td></tr>
			<tr><td>Telpon/HP</td><td> : <input type=text name=telpon></td></tr>
			<tr><td>Email</td><td> : <input type=text name=email></td></tr>
			<tr><td valign=top>Kota Tujuan</td><td> :  
			<select name='kota'>
			<option value=0 selected>- Pilih Kota -</option>";
	$tampil=mysql_query("SELECT * FROM kota ORDER BY nama_kota");
    while($r=mysql_fetch_array($tampil)){
		echo "<option value=$r[id_kota]>$r[nama_kota]</option>";
    }
	echo "</select> <br /><br />*)  Apabila tidak terdapat nama kota tujuan Anda, pilih <b>Lainnya</b>
			<br />**) Ongkos kirim dihitung berdasarkan kota tujuan</td></tr>
			<tr><td colspan=2><input type=submit value=Proses></td></tr>
			</table>";?>
			</div>
	</div>
	</div><!--end top_prod-->	
			<?php
}
//simpan transaksi
elseif ($_GET['module']=='simpantransaksi'){?>
<div class='top_prod' style="padding:0 0 0 0;">
<div id="accordion">
	<h3><a href="#"><div class='product_title'><b>Terimakasih :)</b></div></a></h3>
	<div><hr>
<?php
	$kar1=strstr($_POST['email'], "@");
	$kar2=strstr($_POST['email'], ".");
	if (empty($_POST['nama']) || empty($_POST['alamat']) || empty($_POST['telpon']) || empty($_POST['email']) || empty($_POST['kota'])){
		echo "Data yang Anda isikan belum lengkap<br />
				<a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
	}
	elseif (@!ereg("[a-z|A-Z]","$_POST[nama]")){
		echo "Nama tidak boleh diisi dengan angka atau simbol.<br />
				<a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
	}
	elseif (strlen($kar1)==0 OR strlen($kar2)==0){
		echo "Alamat email Anda tidak valid, mungkin kurang tanda titik (.) atau tanda @.<br />
				<a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a><meta http-equiv='refresh' content='3; url=javascript:history.go(-1);'>";
	}
	else{
		// fungsi untuk mendapatkan isi keranjang belanja
		function isi_keranjang(){
			$isikeranjang = array();
			$sid = session_id();
			$sql = mysql_query("SELECT * FROM orders_temp WHERE id_session='$sid'");
	
			while ($r=mysql_fetch_array($sql)) {
				$isikeranjang[] = $r;
			}
			return $isikeranjang;
		}
		$tgl_skrg = date("Ymd");
		$jam_skrg = date("H:i:s");
		// simpan data pemesanan 
		mysql_query("INSERT INTO orders(nama_customer, alamat_lengkap, telpon, email, tgl_order, jam_order, id_kota) 
						VALUES('$_POST[nama]','$_POST[alamat]','$_POST[telpon]','$_POST[email]','$tgl_skrg','$jam_skrg','$_POST[kota]')");
		// mendapatkan nomor orders
		$id_orders=mysql_insert_id();
		// panggil fungsi isi_keranjang dan hitung jumlah produk yang dipesan
		$isikeranjang = isi_keranjang();
		$jml          = count($isikeranjang);
		// simpan data detail pemesanan  
		for ($i = 0; $i < $jml; $i++){
			mysql_query("INSERT INTO orders_detail(id_orders, id_produk, jumlah) 
								VALUES('$id_orders',{$isikeranjang[$i]['id_produk']}, {$isikeranjang[$i]['jumlah']})");
		}
  		// update/kurangi stok produk
		for ($i = 0; $i < $jml; $i++) {
			mysql_query("UPDATE produk SET stok = stok - {$isikeranjang[$i]['jumlah']}
						    WHERE id_produk = {$isikeranjang[$i]['id_produk']}");
		}
		// update/tambahkan produk yang dibeli (best seller)
		for ($i = 0; $i < $jml; $i++) {
			mysql_query("UPDATE produk SET dibeli = dibeli + {$isikeranjang[$i]['jumlah']}
						    WHERE id_produk = {$isikeranjang[$i]['id_produk']}");
		}
		// setelah data pemesanan tersimpan, hapus data pemesanan di tabel pemesanan sementara (orders_temp)
		for ($i = 0; $i < $jml; $i++) {
			mysql_query("DELETE FROM orders_temp
						WHERE id_orders_temp = {$isikeranjang[$i]['id_orders_temp']}");
		}
		echo "<br /> 
				Data pemesan beserta ordernya adalah sebagai berikut: <br />
				<table>
				<tr><td>Nama           </td><td> : <b>$_POST[nama]</b> </td></tr>
				<tr><td>Alamat Lengkap </td><td> : $_POST[alamat] </td></tr>
				<tr><td>Telpon         </td><td> : $_POST[telpon] </td></tr>
				<tr><td>E-mail         </td><td> : $_POST[email] </td></tr></table><hr /><br />
      
				Nomor Order: <b>$id_orders</b><br /><br />";

		$daftarproduk=mysql_query("SELECT * FROM orders_detail,produk 
									WHERE orders_detail.id_produk=produk.id_produk 
									AND id_orders='$id_orders'");
		echo "<table cellpadding=5>
				<tr bgcolor=#D3DCE3><th>No</th><th>Nama Produk</th><th>Jumlah</th><th>Harga</th><th>Sub Total</th></tr>";
		$pesan="Terimakasih telah melakukan pemesanan online di NANOComputerCorner.com <br /><br />  
				Nama: $_POST[nama] <br />
				Alamat: $_POST[alamat] <br/>
				Telpon: $_POST[telpon] <br /><hr />
				Nomor Order: $id_orders <br />
				Data order Anda adalah sebagai berikut: <br /><br />";
        $total = 0;
		$total_rp= 0;
		$no=1;
		while ($d=mysql_fetch_array($daftarproduk)){
			$subtotal    = $d['harga'] * $d['jumlah'];
			$total       = $total + $subtotal;
			$subtotal_rp = format_rupiah($subtotal);    
			$total_rp    = format_rupiah($total);    
			$harga       = format_rupiah($d['harga']);

			echo "<tr bgcolor=#cccccc><td>$no</td><td>$d[nama_produk]</td><td align=center>$d[jumlah]</td><td>Rp. $harga</td><td>Rp. $subtotal_rp</td></tr>";

			$pesan.="$d[jumlah] $d[nama_produk] -> Rp. $harga -> Subtotal: Rp. $subtotal_rp <br />";
			$no++;
		}
		$ongkos=mysql_fetch_array(mysql_query("SELECT ongkos_kirim FROM kota WHERE id_kota='$_POST[kota]'"));
		$ongkoskirim=$ongkos['ongkos_kirim'];

		$grandtotal    = $total + $ongkoskirim; 

		$ongkoskirim_rp = format_rupiah($ongkoskirim);
		$grandtotal_rp  = format_rupiah($grandtotal);    
		$pesan.="<br /><br />Total : Rp. $total_rp 
					<br />Ongkos kirim: Rp. $ongkoskirim_rp
					<br />Grand Total : Rp. $grandtotal_rp 
					<br /><br />Silahkan lakukan pembayaran ke BCA sebanyak Grand Total yang tercantum, 
					nomor rekeningnya <b>0312849389</b> a.n. Setto El Kahfi";
		$subjek="Toko Online NANO Computer Corner";
		// Kirim email ke kustomer
		@$mailsent = mail($_POST['email'],$subjek,$pesan,"From: admin@nanocomputercorner.com");
		// Kirim email ke pengelola toko online
		@$mailsent = mail("admin@nanocomputercorner.com",$subjek,$pesan,"From: admin@nanocomputercorner.com");
		echo "<tr><td colspan=4 align=right>Total : Rp. </td><td align=right><b>$total_rp</b></td></tr>
				<tr><td colspan=4 align=right>Ongkos Kirim : Rp. </td><td align=right><b>$ongkoskirim_rp</b></td></tr>      
				<tr><td colspan=4 align=right>Grand Total : Rp. </td><td align=right><b>$grandtotal_rp</b></td></tr>
				</table>";
		echo "<hr /><p>Data order dan nomor rekening transfer sudah terkirim ke email Anda. <br />
				Apabila Anda tidak melakukan pembayaran dalam 3 hari, maka data order Anda akan terhapus (transaksi batal)</p><br />";      
	}
?>

		</div>
	</div>
	</div><!--end top_prod-->
<?php
}
// Static content
// profil
elseif ($_GET['module']=='profil'){
	include "include/static_content/profil.html"; 
}
// cara pembelian
elseif ($_GET['module']=='carabeli'){
  	include "include/static_content/carapembelian.html";
}

// hubungi kami
elseif ($_GET['module']=='kontak'){ ?>
<div class='top_prod' style="padding:0 0 0 0;">
<div id="accordion">
	<h3><a href="#"><div class='product_title'><b>Hubungi Kami</b></div></a></h3>
	<div><hr>
		
   <p>Hubungi kami secara online dengan mengisi form dibawah ini:</p>
        <table width=100% style='border: 1pt dashed #0000CC;padding: 10px;'>
        <form name="form" action="kontak-aksi" method="POST" onSubmit="return validasi(this)">
        <tr><td>Nama</td><td> : <input type=text name="nama" size=40></td></tr>
        <tr><td>Email</td><td> : <input type=text name="email" size=40>
		<?php
		if(isset($_GET['f']) AND $_GET['f']=='email') {
			echo "<br><font color=red>Invalid E-mail address</font>";
		}		
		?>
		</td></tr>
        <tr><td>Subjek</td><td> : <input type=text name="subjek" size=55></td></tr>
        <tr><td valign=top>Pesan</td><td>&nbsp;&nbsp;&nbsp;<textarea name="pesan"  style='width: 315px; height: 100px;'></textarea></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;&nbsp;&nbsp;<img border="1px" id="captcha" src="config/securimage/securimage_show.php" alt="CAPTCHA Image" />
		<?php
		if(isset($_GET['f']) AND $_GET['f']=='captcha') {
			echo "<br>&nbsp;&nbsp;&nbsp;<font color=red>Kode captcha salah, coba teks lain</font>";
		}		
		?>
		</td></tr>
        <tr><td>Text</td><td>&nbsp;:&nbsp;<input type="text" name="captcha_code" size="10" maxlength="6" />
<a href="#" onclick="document.getElementById('captcha').src = 'config/securimage/securimage_show.php?' + Math.random(); return false"><img src="config/securimage/images/refresh.gif" /></a></td></tr>
        </td><td colspan=2><input type=submit name=submit value=Kirim>&nbsp;&nbsp;&nbsp;<input type="reset" value="Reset" /></td></tr>
        </form></table><br />

	</div>
	</div>
	</div><!--end top_prod-->

<?php
}
// hubungi aksi
elseif ($_GET['module']=='kontakaksi'){
	include_once "config/securimage/securimage.php";
	$securimage = new Securimage();
	$kar1=strstr($_POST['email'], "@");
	$kar2=strstr($_POST['email'], ".");
	if (@!ereg("[a-z|A-Z]","$_POST[nama]")){
		header("location:kontak-kami?f=name");
	}
	elseif (strlen($kar1)==0 OR strlen($kar2)==0){
		header("location:katalog_beranda.php?module=kontak&f=email");
	}
	elseif ($securimage->check($_POST['captcha_code']) == false) {
		header("location:katalog_beranda.php?module=kontak&f=captcha");
	} 
	else{		
		mysql_query("INSERT INTO kontak(nama,
										email,
										subjek,		
										pesan,
										tanggal) 
							VALUES('$_POST[nama]',
									'$_POST[email]',
									'$_POST[subjek]',
									'$_POST[pesan]',
									'$tgl_sekarang')");
		echo "<div class='center_title_bar'><b>Hubungi Kami</b></div>"; 
		echo "<p align=center><b>Terimakasih telah menghubungi kami. <br /> Kami akan segera meresponnya.</b></p>";
		echo  "<META HTTP-EQUIV='Refresh' CONTENT='2; URL=beranda.seto'>";
	
	}
}
?>