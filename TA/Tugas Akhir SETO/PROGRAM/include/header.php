<div id="logo">
            <a href="index.php"><img src="css/images/logo.jpg" alt="" title="" border="0" width="237" height="140" /></a>
	    </div>
          <div class="oferte_content">
        	<div class="top_divider"><img src="css/images/header_divider.png" alt="" title="" width="1" height="164" /></div>
        	<div class="oferta">
			<!--<script src="css/acheader.js" type="text/javascript"></script><script>headerinit_doc('css/',0);</script>-->
    
     <!-- Before the closing body tag -->
   <!-- <script src="js/nikki-liteAccordion/js/liteaccordion.jquery.js" type="text/javascript"></script>-->
     
<div id="myDiv">
    <ol>
    	    <li>
            <h2><span>Service</span></h2> 
            <div>
			<?php
			$rand=mysql_query("SELECT id_produk,seo,gambar FROM produk ORDER BY rand() LIMIT 2");
			while($data=mysql_fetch_array($rand)) {
			echo "<a href='prod-detail-$data[id_produk]-$data[seo]'><img src='foto_produk/$data[gambar]' width='150' height='110' /></a>";
			}
			?>
			</div>
        </li>
        <li>
            <h2><span>Hardware</span></h2>
			<div>
			<?php
			$hd=mysql_query("SELECT gambar,id_produk,seo FROM produk WHERE id_kategori='7' OR id_kategori='9' ORDER BY rand() LIMIT 2");
			while($data=mysql_fetch_array($hd)) {
			echo "<a href='prod-detail-$data[id_produk]-$data[seo]'><img src='foto_produk/$data[gambar]' width='150' height='110' /></a>";
			}
			?>
			</div>
        </li>
        <li>
            <h2><span>Notebook</span></h2>
            <div>
			<?php
			$nb=mysql_query("SELECT gambar,id_produk,seo FROM produk WHERE id_kategori='18' OR id_kategori='1' OR id_kategori='2' OR id_vendor='9' OR id_vendor='7' OR id_vendor='4' OR id_vendor='2' OR id_vendor='10' ORDER BY dibeli LIMIT 2");
			while($data=mysql_fetch_array($nb)) {
			echo "<a href='prod-detail-$data[id_produk]-$data[seo]'><img src='foto_produk/$data[gambar]' width='150' height='110' /></a>";
			}
			?>
			</div>
        </li>
        <li>
            <h2><span>Aksesoris</span></h2>
            <div>
			<?php
			$ak=mysql_query("SELECT gambar,id_produk,seo FROM produk WHERE id_kategori='6' OR id_kategori='8' OR id_kategori='10' OR id_kategori='2' OR id_vendor='2' OR id_vendor='6' OR id_vendor='10' ORDER BY dibeli LIMIT 2");
			while($data=mysql_fetch_array($ak)) {
			echo "<a href='prod-detail-$data[id_produk]-$data[seo]'><img src='foto_produk/$data[gambar]' width='150' height='110' /></a>";
			}
			?>			
			</div>
        </li>      
    </ol>
    <noscript>
        <p>Please enable JavaScript to get the full experience.</p>
    </noscript>
</div>
  
    <script>
 $("#myDiv").liteAccordion({
						   "theme":"light", easing: 'easeOutBounce',"containerWidth":520,"containerHeight":110,"activateOn":"mouseover","autoPlay":true,"rounded":true,"linkable":true
						   });
</script>

            </div>
            <div class="top_divider"><img src="css/images/header_divider.png" alt="" title="" width="1" height="164" /></div>
        	
        </div> <!-- end of oferte_content-->