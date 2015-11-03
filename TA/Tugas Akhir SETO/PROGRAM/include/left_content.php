<div class="title_box">Produk by</div>
<div id="accordionMenu">
	<h3><a href="#"><div class='product_title'  title='header=[Produk by Kategori]] body=[&nbsp;] fade=[on]'>Kategori</div></a></h3>
	<div>
<?php

echo "<ul class='left_menu'>";
$sql=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
while ($data=mysql_fetch_array($sql)) {      
	echo "<li class='odd'><a href=kategori-$data[id_kategori]-$data[seo].html >$data[nama_kategori]</a></li>";
}
  ?>     
        </ul> 
        </div>
	
    <h3><a href="#"><div class='product_title'  title='header=[Produk by vendor]] body=[&nbsp;] fade=[on]'>Vendor</div></a></h3>    
	<div> 
    <?php 
    	echo "<ul class='left_menu'>";
        $q=mysql_query("SELECT * FROM vendor ORDER BY id_vendor");
		while ($vendor=mysql_fetch_array($q)) {
			echo "<li class='odd'><a href='vendor-$vendor[id_vendor]-$vendor[seo].html' >$vendor[nama_vendor]</a></li>";
		}
    ?>  
        </ul>   
    </div> 
    <h3><a href="#"><div class='product_title'  title='header=[Produk by vendor]] body=[&nbsp;] fade=[on]'>Best Seller</div></a></h3>    
	<div style="text-align:center;"> 
     <?php
     	//echo "<div class='border_box'>";
         
		 $query2 = mysql_query("SELECT * FROM produk ORDER BY dibeli DESC LIMIT 3");
         while ($hot=@mysql_fetch_array($query2)) {
			 $harga     = number_format($hot['harga'],0,",",".");
			 
			 echo "<div class='product_title'>$hot[nama_produk]</div>";
			 echo "<div class='product_img'><a href='$_SERVER[PHP_SELF]?module=detailproduk&id=$hot[id_produk]'><img src='foto_produk/small_$hot[gambar]' alt='' title='' border='0' /></a></div>";
			 echo "<div class='prod_price'>";
			 if (!empty($hot['h_awal'])) {
				 	$h_awal	= number_format($hot['h_awal'],0,",",".");
					 echo "<span class='reduce'>Rp $h_awal</span><br>";
				 }
			echo "<span class='price'> Rp $harga</span><br/></div>";
		 }
		// echo "</div>";  
		?>
       </div>
       
       <h3><a href="#"><div class='product_title'  title='header=[Produk by vendor]] body=[&nbsp;] fade=[on]'>Segera</div></a></h3>    
	<div style="text-align:center;">
      <?php 
        $query2 = mysql_query("SELECT * FROM produk WHERE soon='on' LIMIT 3");
         while ($soon=@mysql_fetch_array($query2)) {
			 $harga     = number_format($soon['harga'],0,",",".");
			 
			 echo "<div class='product_title'>$soon[nama_produk]</div>";
			 echo "<div class='product_img'><a href='$_SERVER[PHP_SELF]?module=detailproduk&id=$soon[id_produk]'><img src='foto_produk/small_$soon[gambar]' alt='' title='' border='0' /></a></div>";
			 echo "<div class='prod_price'>";
			 if (!empty($soon['h_awal'])) {
				 	$h_awal	= number_format($soon['h_awal'],0,",",".");
					 echo "<span class='reduce'>Rp $h_awal</span><br>";
				 }
			echo "<span class='price'> Rp $harga</span><br/></div>";
		 }
		 ?>    
     </div>
 </div><!--end accordion--> 
 <div class="title_box">Advertize</div>
 <div class="banner_adds">
     
     <a href="#"><img src="css/images/bann2.jpg" alt="" title="" border="0" /></a>
     </div> 