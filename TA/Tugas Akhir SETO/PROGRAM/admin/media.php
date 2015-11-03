<?php
session_start();

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='css/style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus ";
  echo "<a href=index.php><b>LOGIN</b></a></center><br><META HTTP-EQUIV='Refresh' CONTENT='3; URL=index.php'>";
}
else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
	<title>Administrator</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css" />
    <script type="text/javascript" src="../css/js/nicEdit.js"></script>
	<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
	</script>
	<!--[if IE 6]>
	<link rel="stylesheet" type="text/css" href="iecss.css" />
	<![endif]-->
	<script type="text/javascript" src="../css/js/boxOver.js"></script>
</head>
<body>
<div id="main_container">
	<div class="top_bar"></div>
	<div id="main_content">
    	<div class="left_content">
    		<div class="title_box">Menu</div>
   				<ul class="left_menu_admin">
        		<li class="odd"><a href="?module=home">&rArr; DASHBOARD </a></li>
        		<?php include "menu.php"; ?>
        		<li class="odd"><a href="logout.php">&rArr;; LOGOUT</a></li>
        		</ul>         
     		<div class="title_box"></div> 
   		</div><!-- end of left content -->
   		<div class="center_content">
     		<div class="prod_box_big">
   	    		<div class="top_prod_box_big"></div>
            	<div class="center_admin">            
            	<?php include "content.php"; ?>                                   
            	</div>
            	<div class="bottom_prod_box_big"></div>                                
     		</div>
      	</div><!-- end of center content -->
        <div class="right_content">
			<?php 
	echo"$hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB"; ?>
  		</div>
	</div><!-- end of main content -->
   	<div class="footer">
   		<div class="left_footer"></div>
    	<div class="center_footer">
        NANO/Computer/Corner&copy;.<br /> All Rights Reserved 2011
        </div>
	</div>                 
	</div>
<!-- end of main_container -->
</body>
</html>
<?php
}
?>