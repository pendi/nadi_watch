<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="js/css/smoothness/jquery-ui-1.8.17.custom.css" />
<script language="javascript">
function validasi(form){
  if (form.nama.value == ""){
    alert("Anda belum mengisikan Nama.");
    form.nama.focus();
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
  if (form.email.value == ""){
    alert("Anda belum mengisikan Email.");
    form.email.focus();
    return (false);
  }
  if (form.kota.value == 0){
    alert("Anda belum mengisikan Kota.");
    form.kota.focus();
    return (false);
  }
  if (form.pesan.value == ""){
    alert("Anda belum mengisikan pesan.");
    form.pesan.focus();
    return (false);
  }
   if (form.subjek.value == ""){
    alert("Anda belum mengisikan subjek.");
    form.subjek.focus();
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
	/*echo "<div class='center_title_bar'>Produk Terbaru</div>";
	// Tampilkan produk terbaru
	$sql=mysql_query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT 1");
	$new=mysql_fetch_array($sql);
  	$harga     = number_format($new['harga'],0,",",".");
    $deskripsi = nl2br($new['deskripsi']); // membuat paragraf 
    $isi       = substr($deskripsi,0,200); // ambil sebanyak 80 karakter
    $isi       = substr($deskripsi,0,strrpos($isi," ")); // potong per spasi kalimat
  
	echo "<div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
            <div class='center_prod_box_big'>            
                 <div class='product_img_big'>";
  				 echo "<a href='javascript:popImage(\"foto_produk/$new[gambar]\",\"Some Title\")' 
						title='header=[Zoom] body=[&nbsp;] fade=[on]'><img src='foto_produk/small_$new[gambar]' alt='' 
						title='' border='0' /></a>"; 
                 echo "<br />Stok: <span class='blue'>$new[stok]</span><br />";
                // echo "<div class='prod_price_big'>"; 
				 if (!empty($new['h_awal'])) {
					 echo "<span class='reduce'>Rp $new[h_awal]</span>";
				 }
					 echo "<span class='price'> Rp $harga</span></div>";
						
                 //echo "</div>";//akhir thumbs
                 echo "</div>";//akhir product_img_big 
                     echo "<div class='details_big_box'>
                         <div class='product_title_big'>$new[nama_produk]</div>";
                        echo "<div class='specifications'>";
						echo "
                           	$isi .... <br />";
                         echo "</div>"; //akhir specification
                         echo "<a href='logic.php?module=keranjang&act=tambah&id=$new[id_produk]' title='header=[Beli sekarang] body=[&nbsp;] fade=[on]' class='addtocart'>Beli</a><a href=prod-detail-$new[id_produk]-$new[seo] class='prod_details' title='header=[Detail produk] body=[&nbsp;] fade=[on]'>Selengkapnya</a>";                       
                     echo "</div>";  //Akhir details_big_box                    
            echo "</div>"; //Akhir center_prod_box_big
            echo "<div class='bottom_prod_box_big'></div>";                                
        echo "</div>"; //Akhir prod_box_big*/
	//RAndom produk
	$sql2=mysql_query("SELECT * FROM produk ORDER BY rand() LIMIT 9");
	$kolom = 3;
	echo "<div class='center_title_bar'>Produk Kami</div>";
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
	echo "</tr></table><br />";
}
//detail produk
elseif ($_GET['module']=='detailproduk'){
	// Tampilkan detail produk berdasarkan produk yang dipilih
	$detail=mysql_query("SELECT * FROM produk,kategori,vendor
                      WHERE kategori.id_kategori=produk.id_kategori AND produk.id_vendor=vendor.id_vendor
                      AND id_produk='$_GET[id]'");
	$d   = mysql_fetch_array($detail);
	$tgl = tgl_indo($d['tgl_masuk']);
  	$deskripsi = nl2br($d['deskripsi']); // membuat paragraf pada isi berita
  	$harga     = number_format($d['harga'],0,",",".");
	
	echo "<div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
            <div class='center_prod_box_big'>            
                 
                 <div class='product_img_big'>
                 <a href='javascript:popImage(\"foto_produk/$d[gambar]\",\"$d[nama_produk]\")' title='header=[Zoom] body=[&nbsp;] fade=[on]'><img src='foto_produk/small_$d[gambar]' alt='' title='' border='0' /></a>
                 </div>"; //end product_img_big
                     echo "<div class='details_big_box'>
                         <div class='product_title_big'>$d[nama_produk]</div>
                         <div class='specifications'>
                            Stok: <span class='blue'>$d[stok]</span><br />

                            Dimensi: <span class='blue'>$d[dimensi]</span><br />
                            
                            Berat: <span class='blue'>$d[berat]</span><br />
                            
                         </div>
                         <div class='prod_price_big'>";
						  if (!empty($new['h_awal'])) {
					 		echo "<span class='reduce'>Rp $d[h_awal]</span>";
							}
					 		echo "<span class='price'> Rp $harga</span></div>";
						 
						 echo "</div>
                         
                          <a href='logic.php?module=keranjang&act=tambah&id=$d[id_produk]' title='header=[Beli] body=[&nbsp;] fade=[on]' class='addtocart'> Beli </a>
                     </div>                        
            </div>"; //end details_big_boxn
			?>
<div class='desc_prod_box_big'>
<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Deskripsi Produk</a></li>
		<li><a href="#tabs-2">Review</a></li>
	</ul>
	<div id="tabs-1">
		<p><strong>Click this tab again to close the content pane.</strong></p>
		<p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
	</div>
	<div id="tabs-2">
		<p><strong>Click this tab again to close the content pane.</strong></p>
		<p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
	</div>
</div> 
</div><!--end div desc_prod-->           
            <?php
           
		   echo "<div class='desc_prod_box_big'>
			 <div class='product_title_big'>Deskripsi Produk</div><br><span>Kategori: <a href=kategori-$d[id_kategori]-$d[seo].html><b>$d[nama_kategori]</b></a></span><br /><br>
			 $deskripsi<hr>";
			 echo "</div><br>"; //end desc_prod_box_big
			echo "<div class='rev_prod_box_big'>
			 <div class='product_title_big'>Review</div>";
			 $sql=mysql_query("SELECT * FROM review_produk WHERE id_produk='$d[id_produk]'");
			 $num = mysql_num_rows($sql);
			 //show review 
				while ($review = mysql_fetch_array($sql)) {
					echo "Nama : $review[nama_customer]<br>Email : $review[email]<br>$review[isi]<br><hr>";
				}
			 //}
			// else {
				//echo "No review yet for this $d[id_produk]";
			 //}?>
				<form method="post" action="katalog_beranda.php?module=simpanreview&id=<?php echo"$d[id_produk]"; ?>">
                <br/><table><TR>
                <td>Nama </td><td> : </td><td><input type="text" name="nama" size="20" /></td>
                </TR>
                <tr><td>Email </td><td> : </td><td><input type="text" name="email" size="20" /></td></tr>
               <!-- <tr><td colspan="3">-->
        <?php
         /* require_once('config/recaptchalib.php');
          $publickey = "6Lc3EMwSAAAAAGzmDaLF5tIp-vfhfuxHn0jl8BOf"; // you got this from the signup page
          echo recaptcha_get_html($publickey);*/
        ?><!--</td></tr>-->
                <tr><td valign="top"> Review </td><td> : </td><td><textarea name="review" cols="50" rows="10"></textarea></td></tr>
                <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;&nbsp;<img border="1px" id="captcha" src="config/securimage/securimage_show.php" alt="CAPTCHA Image" /></td></tr>
        <tr><td>Text</td><td> : </td><td>&nbsp;<input type="text" name="captcha_code" size="10" maxlength="6" />
<a href="#" onclick="document.getElementById('captcha').src = 'config/securimage/securimage_show.php?' + Math.random(); return false"><img src="config/securimage/images/refresh.gif" /></a></td></tr>
        <tr><td><input type="submit" /></td><td></td><td></td></tr></table>
      </form>
			 <?php
			 echo "</div>";//end rev_prod_box_big
            echo "<div class='bottom_prod_box_big'></div>                                
        </div>"; //end prod_box_big

}
elseif ($_GET['module']=='simpanreview'){
	/*require_once('config/recaptchalib.php');
  $privatekey = "6Lc3EMwSAAAAAGzmDaLF5tIp-vfhfuxHn0jl8BOf";
  $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
    die ("Kode yang anda masukkan salah. Silahkan <a href=javascript:history.go(-1)> ulangi lagi</a> " .
         "(reCAPTCHA said: " . $resp->error . ")");
  } else {*/
    // Your code here to handle a successful verification
  	$nama = $_POST['nama'];
	$email = $_POST['email'];
	$review = $_POST['review'];
	
	$sql = mysql_query("INSERT INTO review_produk
					VALUES('','$nama','$email','$review','$_GET[id]','off')");
	if ($sql){
		echo "<b>Review anda telah tersimpan</b>";
		echo  "<META HTTP-EQUIV='Refresh' CONTENT='3; URL=beranda.seto'>";
	}
	else {
		echo "error";
	}
	
  //}
		
}
//semua produk
elseif ($_GET['module']=='semuaproduk'){
	// Tampilkan semua produk
	echo "<div class='center_title_bar'><b>Produk</b></div>"; 
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
}
//produk per kategori
elseif ($_GET['module']=='detailkategori'){
	// Tampilkan nama kategori
	$sq = mysql_query("SELECT nama_kategori from kategori where id_kategori='$_GET[id]'");
	$n = mysql_fetch_array($sq);
	echo "<div class='center_title_bar'>Kategori : <b>$n[nama_kategori]</b></div>";
  
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
}
//produk per vendor
elseif ($_GET['module']=='detailvendor'){
	// Tampilkan nama Vendor
	$sq = mysql_query("SELECT nama_vendor from vendor where id_vendor='$_GET[id]'");
	$n = mysql_fetch_array($sq);
	echo "<div class='center_title_bar'>Vendor : <b>$n[nama_vendor]</b></div>";
  
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
}
// Modul searching
elseif ($_GET['module']=='search'){
	if (empty($_POST[search])){
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
	
	echo "<div class='center_title_bar'>Hasil pencarian untuk <font style='background-color:#00FFFF'><i><b>$keyword</b></i></font></div>";  
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
}
//keranjang belanja
elseif ($_GET['module']=='keranjang'){
	// Tampilkan produk-produk yang telah dimasukkan ke keranjang belanja
	echo "<div class='center_title_bar'> <b>Keranjang Belanja</b></div>"; 
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
}
//selesai belanja
elseif ($_GET['module']=='selesaibelanja'){
	// Form untuk input data pembeli
	echo "<span class=judul_head>&#187; <b>Data Pembeli</b></span><br /><br /> 
			<form name='form' action=simpan-transaksi.end method=POST onSubmit=\"return validasi(this)\">
			<table>
			<tr><td>Nama</td><td> : <input type=text name=nama size=30></td></tr>
			<tr><td>Alamat Lengkap</td><td> : <input type=text name=alamat size=70></td></tr>
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
			</table>";
}
//simpan transaksi
elseif ($_GET['module']=='simpantransaksi'){
	$kar1=strstr($_POST['email'], "@");
	$kar2=strstr($_POST['email'], ".");
	if (empty($_POST['nama']) || empty($_POST['alamat']) || empty($_POST['telpon']) || empty($_POST['email']) || empty($_POST['kota'])){
		echo "Data yang Anda isikan belum lengkap<br />
				<a href='selesai-belanja.html'><b>Ulangi Lagi</b>";
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
		echo "<span class=judul_head>&#187; <b>Proses Transaksi Selesai</b></span><br /><br /> 
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
		$mailsent = mail($_POST['email'],$subjek,$pesan,"From: admin@nanocomputercorner.com");
		// Kirim email ke pengelola toko online
		$mailsent = mail("admin@nanocomputercorner.com",$subjek,$pesan,"From: admin@nanocomputercorner.com");
		echo "<tr><td colspan=4 align=right>Total : Rp. </td><td align=right><b>$total_rp</b></td></tr>
				<tr><td colspan=4 align=right>Ongkos Kirim : Rp. </td><td align=right><b>$ongkoskirim_rp</b></td></tr>      
				<tr><td colspan=4 align=right>Grand Total : Rp. </td><td align=right><b>$grandtotal_rp</b></td></tr>
				</table>";
		echo "<hr /><p>Data order dan nomor rekening transfer sudah terkirim ke email Anda. <br />
				Apabila Anda tidak melakukan pembayaran dalam 3 hari, maka data order Anda akan terhapus (transaksi batal)</p><br />";      
	}
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
elseif ($_GET['module']=='kontak'){
	include "include/static_content/kontak-kami.php";
}
// hubungi aksi
elseif ($_GET['module']=='kontakaksi'){
	$kar1=strstr($_POST['email'], "@");
	$kar2=strstr($_POST['email'], ".");
	if (empty($_POST['nama']) || empty($_POST['email']) || empty($_POST['subjek']) || empty($_POST['pesan'])){
		echo "Data yang Anda isikan belum lengkap<br />
				<a href='selesai-belanja.html'><b>Ulangi Lagi</b><meta http-equiv='refresh' content='3; url=javascript:history.go(-1);'>";
	}
	elseif (@!ereg("[a-z|A-Z]","$_POST[nama]")){
		echo "Nama tidak boleh diisi dengan angka atau simbol.<br />
				<a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a><meta http-equiv='refresh' content='3; url=javascript:history.go(-1);'>";
	}
	elseif (strlen($kar1)==0 OR strlen($kar2)==0){
		echo "Alamat email Anda tidak valid, mungkin kurang tanda titik (.) atau tanda @.<br />
				<a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a><meta http-equiv='refresh' content='3; url=javascript:history.go(-1);'>";
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