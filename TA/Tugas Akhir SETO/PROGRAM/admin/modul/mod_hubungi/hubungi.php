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
$aksi="modul/mod_hubungi/aksi_hubungi.php";
switch($_GET['act']){
  // Tampil Hubungi Kami
  default:
    echo "<div class='top_admin_box'><h2>Hubungi Kami</h2></div>
          <table id='list'>
          <tr><th>no</th><th>nama</th><th>email</th><th>subjek</th><th>tanggal</th><th>aksi</th></tr>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

    $tampil=mysql_query("SELECT * FROM kontak ORDER BY id_kontak DESC LIMIT $posisi, $batas");

    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      $tgl=tgl_indo($r['tanggal']);
      echo "<tr><td>$no</td>
                <td>$r[nama]</td>
                <td><a href=?module=hubungi&act=balasemail&id=$r[id_kontak]>$r[email]</a></td>
                <td>$r[subjek]</td>
                <td>$tgl</a></td>
                <td><a onclick=\"return confirmSubmit()\" href=$aksi?module=hubungi&act=hapus&id=$r[id_kontak]>Hapus</a>
                </td></tr>";
    $no++;
    }
    echo "</table>";
    $jmldata=@mysql_num_rows(mysql_query("SELECT * FROM kontak"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);

    echo "<div id=paging>Hal: $linkHalaman</div><br>";
    break;

  case "balasemail":
    $tampil = mysql_query("SELECT * FROM kontak WHERE id_kontak='$_GET[id]'");
    $r      = mysql_fetch_array($tampil);

    echo "<div class='top_admin_box'><h2>Reply Email</h2></div>
          <form method=POST action='?module=hubungi&act=kirimemail'>
          <table>
          <tr><td>Kepada</td><td> : <input type=text name='email' size=30 value='$r[email]'></td></tr>
          <tr><td>Subjek</td><td> : <input type=text name='subjek' size=50 value='Re: $r[subjek]'></td></tr>
          <tr><td>Pesan</td><td> <textarea name='pesan' style='width: 400px; height: 150px;'><br><br><br><br>     
  -------------------------------------------------------------------------------------------------------
  $r[pesan]</textarea></td></tr>
          <tr><td colspan=2><input type=submit value=Kirim>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
    
  case "kirimemail":
    mail($_POST[email],$_POST[subjek],$_POST[pesan],"From: admin@nanocomputercorner.com");
    echo "<h2>Status Email</h2>
          <p>Email telah sukses terkirim ke tujuan</p>
          <p>[ <a href=javascript:history.go(-2)>Kembali</a> ]</p>";	 		  
    break;  
}
?>
