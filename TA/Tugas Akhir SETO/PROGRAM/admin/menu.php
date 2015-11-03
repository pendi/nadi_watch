<?php
include "../config/koneksi.php";

if ($_SESSION['leveluser']=='admin'){
  $sql=mysql_query("select * from modul where aktif='Y' order by urutan");
}
else{
  $sql=mysql_query("select * from modul where status='user' and aktif='Y' order by urutan"); 
} 
while ($m=mysql_fetch_array($sql)){  
  echo "<li class='odd'><a href='$m[link]'>&rArr; $m[nama_modul] </a></li>";
}
?>
