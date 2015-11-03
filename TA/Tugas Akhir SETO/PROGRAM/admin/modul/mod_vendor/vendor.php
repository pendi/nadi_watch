<script LANGUAGE="JavaScript"> 
<!-- 
function confirmSubmit(ttt) {
var msg;
msg= "Anda yakin akan menghapus vendor " + ttt + "?";
var agree=confirm(msg);
if (agree)
return true ;
else
return false ;
}
// -->
</script>
<?php
$aksi="modul/mod_vendor/aksi_vendor.php";
switch($_GET['act']){
  // Tampil vendor
  default:
    echo "<div class='top_admin_box'><h2>Vendor</h2></DIV>
          <input type=button value='Tambah Vendor' 
          onclick=\"window.location.href='?module=vendor&act=tambahvendor';\">
          <table id='list'>
          <tr><th>No</th><th>Nama Vendor</th><th>Aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM vendor ORDER BY id_vendor DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[nama_vendor]</td>
             <td><a href=?module=vendor&act=editvendor&id=$r[id_vendor]>Edit</a> | 
	               <a onclick=\"return confirmSubmit('$r[nama_vendor]')\" href=$aksi?module=vendor&act=hapus&id=$r[id_vendor]>Hapus</a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
    break;
  
  // Form Tambah vendor
  case "tambahvendor":
    echo "<div class='top_admin_box'><h2>Tambah Vendor</h2></div>
          <form method=POST action='$aksi?module=vendor&act=input'>
          <table>
          <tr><td>Nama Vendor</td><td> : <input type=text name='nama_vendor'></td></tr>
          <tr><td colspan=2><input type=submit name=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
  
  // Form Edit vendor  
  case "editvendor":
    $edit=mysql_query("SELECT * FROM vendor WHERE id_vendor='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<div class='top_admin_box'><h2>Edit Vendor</h2></div>
          <form method=POST action=$aksi?module=vendor&act=update>
          <input type=hidden name=id value='$r[id_vendor]'>
          <table>
          <tr><td>Nama Vendor</td><td> : <input type=text name='nama_vendor' value='$r[nama_vendor]'></td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
?>
