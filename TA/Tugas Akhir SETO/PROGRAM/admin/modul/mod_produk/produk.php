<script LANGUAGE="JavaScript"> 
<!-- 
function confirmSubmit(ttt,id) {
var msg;
msg= "Anda yakin akan menghapus produk " + ttt + " - ID = "+ id +"?";
var agree=confirm(msg);
if (agree)
return true ;
else
return false ;
}
// -->
</script>

<?php
$aksi="modul/mod_produk/aksi_produk.php";
switch($_GET['act']){
  // Tampil Produk
  default:
    echo "<div class='top_admin_box'><h2>Produk</h2></div>
          <input type=button value='Tambah Produk' onclick=\"window.location.href='?module=produk&act=tambahproduk';\">
         <table id='list'>
          <tr><th>No</th><th>Nama Produk</th><th>Harga</th><th>Harga Awal</th><th>Stok</th><th>Tgl. masuk</th><th>Promo</th><th>Soon</th><th>Aksi</th></tr>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT $posisi,$batas");
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r['tgl_masuk']);
      $harga=format_rupiah($r['harga']);
	 $h_awal=format_rupiah($r['h_awal']);
      echo "<tr><td>$no</td>
                <td>$r[nama_produk]</td>
                <td>$harga</td>
				<td>$h_awal</td>
                <td align=center>$r[stok]</td>
                <td>$tanggal</td>
				<td>$r[promo]</td>
				<td>$r[soon]</td>
		            <td><a href=?module=produk&act=editproduk&id=$r[id_produk]>Edit</a> | 
		                <a onclick=\"return confirmSubmit('$r[nama_produk]','$r[id_produk]')\"  href=$aksi?module=produk&act=hapus&id=$r[id_produk]>Hapus</a></td>
		        </tr>";
      $no++;
    }
    echo "</table>";

    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM produk"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);

    echo "<div id=paging>Hal: $linkHalaman</div><br>";
 
    break;
  
  case "tambahproduk":
  ?>
  <script type="text/javascript" language="javascript">
function validasiProduk()
	{
		var x=document.forms["form"]["nama_produk"].value;
		var y=document.forms["form"]["harga"].value;
		var z=document.forms["form"]["deskripsi"].value;
		var b=document.forms["form"]["agen"].value;
		var a=document.forms["form"]["file"].value;
		var ext = a.substring(a.lastIndexOf(".") + 1);
		if (x=="" || y=="" || z=="" || a=="" || b=="-")
		{
			alert("Data Anda kurang lengkap :)");
			return false;
			
		}
		else if (ext =="dbf" || ext =="DBF")
		{
			return true;
		}
		else if (ext !="dbf" || ext !="DBF")
		{
			alert("Data harus dalam format .DBF :)");
			return false;
		}
		
	}
</script>
  
  <?php
    echo "<div class='top_admin_box'><h2>Tambah Produk</h2></div>
          <form onSubmit=\"return validasiProduk()\" name=\"form\" method='POST' action='$aksi?module=produk&act=input' enctype='multipart/form-data'>
          <table>
          <tr><td width=70>Nama Produk</td>     <td> : <input type=text name=\"nama_produk\" size=60>";
			if (isset($_GET['f']) AND $_GET['f']=='nama') {
				echo "<br><font color=red>Namaproduk sebaiknya diisi</font>";
			}
			echo "</td></tr>";
    echo "<tr><td>Kategori</td>  <td> : 
          <select name='kategori'>";
            $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_kategori]>$r[nama_kategori]</option>";
            }
    echo "</select> Pilih Kategori</td></tr>
			  <tr><td>Vendor</td>  <td> : 
          <select name='vendor'>";
            $data=mysql_query("SELECT * FROM vendor ORDER BY nama_vendor");
            while($r2=mysql_fetch_array($data)){
              echo "<option value=$r2[id_vendor]>$r2[nama_vendor]</option>";//`id_produk` ,  `id_kategori` ,  `id_merk` ,  `nama_produk` ,  `seo` ,  `deskripsi` ,  `dimensi` ,  `berat` ,  `h_awal` ,  `harga` ,  `stok` ,  `tgl_masuk` ,  `gambar` ,  `dibeli` ,  `promo` ,  `soon` 
            }
    		echo "</select> Pilih Vendor</td></tr>
          <tr><td>Harga</td>     <td> : <input type=text name='harga' size=10>&nbsp;&nbsp;Harga Awal : <input type=text name='h_awal' size=10>&nbsp;&nbsp;Ongkir : <input type=text name='ongkir' size=10>";
			if (isset($_GET['f']) AND $_GET['f']=='harga') {
				echo "<br><font color=red>Harga Produk harus diisi</font>";
			}
			echo "</td></tr>
		  <tr><td>Dimensi(PxLxT)</td><td> : <input type=text name='dimensi' size=10>&nbsp;&nbsp;Berat :  <input type=text name='berat' size=4>*dalam Kg</td></tr>
          <tr><td>Stok</td>     <td> : <input type=text name='stok' size=3>&nbsp;&nbsp;Promo : <select name='promo'>
		  																					<option value='off' selected> Off </option>
																							<option value='on' selected> On </option>
																							</select>
									&nbsp;&nbsp;Segera Hadir : <select name='soon'>
		  																					<option value='off' selected> Off </option>
																							<option value='on' selected> On </option>
																							</select>";
									if (isset($_GET['f']) AND $_GET['f']=='stok') {
							echo "<br><font color=red>Stok harus diisi</font>";
									}
				echo "</td></tr>";
          echo "<tr><td valign='top'>Deskripsi</td>  <td> <textarea name='deskripsi' style='width: 450px; height: 250px;'></textarea></td></tr>
          <tr><td>Gambar</td>      <td> : <input type=file name='gambar' size=40> 
                                          <br>Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px</td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
    
  case "editproduk":
    $edit = mysql_query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<div class='top_admin_box'><h2>Edit Produk</h2></div>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=produk&act=update>
          <input type=hidden name=id value=$r[id_produk]>
          <table>
          <tr><td width=70>Nama Produk</td>     <td> : <input type=text name='nama_produk' size=60 value='$r[nama_produk]'></td></tr>
          <tr><td>Kategori</td>  <td> : <select name='kategori'>";
 
          $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
          while($w=mysql_fetch_array($tampil)){
            if ($r[id_kategori]==$w[id_kategori]){
              echo "<option value=$w[id_kategori] selected>$w[nama_kategori]</option>";
            }
            else{
              echo "<option value=$w[id_kategori]>$w[nama_kategori]</option>";
            }
          }
    echo "</select></td></tr>
		 <tr><td>Vendor</td>  <td> : <select name='vendor'>";
 
          $tampil2=mysql_query("SELECT * FROM vendor ORDER BY nama_vendor");
			
          while($w2=mysql_fetch_array($tampil2)){
            if ($r[id_vendor]==$w[id_vendor]){
              echo "<option value=$w2[id_vendor] selected>$w2[nama_vendor]</option>";
            }
            else{
              echo "<option value=$w2[id_vendor]>$w2[nama_vendor]</option>";
            }
          }
    echo "</select></td></tr>		
          <tr><td>Harga</td>     <td> : <input type=text name='harga' value=$r[harga] size=10>Harga Awal: <input type=text name='h_awal' value=$r[h_awal] size=10>Ongkir: <input type=text name='ongkir' value=$r[ongkir] size=8></td></tr>
		   <tr><td>Dimensi(PxLxT)</td><td> : <input type=text name='dimensi' value=$r[dimensi] size=10>&nbsp;&nbsp;Berat :  <input type=text name='berat' value=$r[berat] size=4>*dalam Kg</td></tr>
          <tr><td>Stok</td>     <td> : <input type=text name='stok' value=$r[stok] size=3>&nbsp;&nbsp;Promo : <select name='promo'>
		  																					<option value='off' selected> Off </option>
																							<option value='on' selected> On </option>
																							</select>
									&nbsp;&nbsp;Segera Hadir : <select name='soon'>
		  																					<option value='off' selected> Off </option>
																							<option value='on' selected> On </option>
																							</select></td></tr>
          <tr><td valign='top'>Deskripsi</td>   <td> <textarea name='deskripsi' style='width: 450px; height: 250px;'>$r[deskripsi]</textarea></td></tr>
          <tr><td>Gambar</td>       <td> :  
          <img src='../foto_produk/small_$r[gambar]'></td></tr>
          <tr><td>Ganti Gbr</td>    <td> : <input type=file name='gambar' size=30> *)</td></tr>
          <tr><td colspan=2>*) Apabila gambar tidak diubah, dikosongkan saja.</td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
    break;  
}
?>
