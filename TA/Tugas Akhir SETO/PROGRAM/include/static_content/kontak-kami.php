<div class='top_prod' style="padding:0 0 0 0;">
<div id="accordion">
	<h3><a href="#"><div class='oferta_title'>Produk Kami</div></a></h3>
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
	echo "</tr></table>"; ?>
	</div>
	</div>
	</div><!--end top_prod-->
<div class="center_title_bar"><b>Hubungi Kami</b></div>
<div class="prod_box_big">   <div class="product_title"><b>Hubungi kami secara online dengan mengisi form dibawah ini:</b></div>
        <table width=100% style='border: 1pt dashed #0000CC;padding: 10px;'>
        <form action=kontak-aksi method=POST onSubmit="return validasi(this)">
        <tr><td>Nama</td><td> : <input type=text name="nama" size=40></td></tr>
        <tr><td>Email</td><td> : <input type=text name="email" size=40></td></tr>
        <tr><td>Subjek</td><td> : <input type=text name="subjek" size=55></td></tr>
        <tr><td valign=top>Pesan</td><td>&nbsp;&nbsp;&nbsp;<textarea name="pesan"  style='width: 315px; height: 100px;'></textarea></td></tr>
        <tr><td>&nbsp;</td><td>&nbsp;&nbsp;&nbsp;<img border="1px" id="captcha" src="config/securimage/securimage_show.php" alt="CAPTCHA Image" /></td></tr>
        <tr><td>Text</td><td>&nbsp;:&nbsp;<input type="text" name="captcha_code" size="10" maxlength="6" />
<a href="#" onclick="document.getElementById('captcha').src = 'config/securimage/securimage_show.php?' + Math.random(); return false"><img src="config/securimage/images/refresh.gif" /></a></td></tr>
        </td><td colspan=2><input type=submit name=submit value=Kirim>&nbsp;&nbsp;&nbsp;<input type="reset" value="Reset" /></td></tr>
        </form></table><br />
        </div>