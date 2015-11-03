<script LANGUAGE="JavaScript"> 
<!-- 
function confirmSubmit() {
var msg;
msg= "Anda yakin akan menghapus?";
var agree=confirm(msg);
if (agree)
return true ;
else
return false ;
}
// -->
</script>
<?php
$aksi="modul/mod_review/aksi_review.php";
switch($_GET['act']){
  // Tampil Review
  default:
    echo "<div class='top_admin_box'><h2>Review</h2></div>
          <table id='list'>
          <tr><th>No.</th><th>Nama Konsumen</th><th>Email</th><th>Tgl</th><th>Jam</th><th>Status</th><th>Aksi</th></tr>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM review_produk ORDER BY id_review DESC LIMIT $posisi,$batas");
	$no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r['tanggal']);
      echo "<tr><td align=center>$no</td>
                <td>$r[nama_customer]</td>
                <td><a href=?module=balasreview&act=detailreview&id=$r[id_review]>$r[email]</a></td>
                <td>$tanggal</td>
                <td>$r[jam]</td>
                <td>$r[status]</td>
		            <td><a href=?module=review&act=detailreview&id=$r[id_review]>Detail</a>  <a onclick=\"return confirmSubmit()\" href=$aksi?module=review&act=hapus&id=$r[id_review]>Hapus</a></td></tr>";
      $no++;
    }
    echo "</table>";

    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM review_produk"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);

    echo "<div id=paging>Hal: $linkHalaman</div><br>";
    break;
  
    
  case "detailreview":
    $edit = mysql_query("SELECT * FROM review_produk WHERE id_review='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
    $pilihan_status = array('on', 'off');
    $pilihan_order = '';
    foreach ($pilihan_status as $status) {
	   $pilihan_order .= "<option value=$status";
	   if ($status == $r['status']) {
		    $pilihan_order .= " selected";
	   }
	   $pilihan_order .= ">$status</option>\r\n";
    }//`id_review` ,  `` ,  `email` ,  `isi` ,  `id_produk` ,  `status` ,  `tanggal` ,  `jam` 
    echo "<div class='top_admin_box'><h2>Detail Review</h2></div>
          <form method=POST action=$aksi?module=review&act=update>
          <input type=hidden name=id_review value=$r[id_review]>
          <table>
          <tr><td>Nama Pelanggan</td>     <td> : <input type=text name='nama_customer' size=30 value='$r[nama_customer]'></td></tr>
          <tr><td>Status Review</td><td>: <select name=status>$pilihan_order</select></td></tr>          
		  <tr><td valign='top'>Isi Review</td>   <td> <textarea name='isi' style='width: 450px; height: 250px;'>$r[isi]</textarea></td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
         </table></form>";

    break;  
}
?>