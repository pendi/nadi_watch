<?php
  session_start();
  session_destroy();
  echo "<center>Anda telah sukses keluar sistem <b>[LOGOUT]<b>";
	echo "<META HTTP-EQUIV='Refresh' CONTENT='4; URL=index.php'>";
?>
