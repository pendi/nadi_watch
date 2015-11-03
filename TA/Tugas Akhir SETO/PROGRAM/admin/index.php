<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
	<title>::..Login First..::</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css" />
	<!--[if IE 6]>
	<link rel="stylesheet" type="text/css" href="iecss.css" />
	<![endif]-->
	<script type="text/javascript" src="../css/js/boxOver.js"></script>
	<script type="text/javascript">
	function validateForm()
	{
		var x=document.forms["form"]["username"].value;
		var y=document.forms["form"]["password"].value;
		var z=document.forms["form"]["captcha_code"].value;
		if (x=="")
		{
			alert("Anda belum mengisi Username :)");
			return false;
			
		}	
		if (y=="")
		{
			alert("Anda belum mengisi Password :)");
			return false;		
		}
		if (z=="")
		{
			alert("Anda belum mengisikan kode Captcha :)");
			return false;		
		}
	
	}
	</script>
</head>
<body>
<div id="main_container">
	<div class="top_bar"></div>
		
        <div class="login_container" align="center">
        	<div class="top_divider"><img src="images/header_divider.png" alt="" title="" width="1" height="164" /></div>
          <div class="title"><h2>Login</h2></div>  
<form name="form" method="POST" action="cek_login.php" onSubmit="return validateForm()">
<table>
<tr><td>Username</td><td> : 
  <input type="text" name="username" /></td></tr>
<tr><td>Password</td><td> : <input type="password" name="password"></td></tr>
<tr><td>&nbsp;</td><td>&nbsp;&nbsp;&nbsp;<img id="captcha" src="../config/securimage/securimage_show.php" alt="CAPTCHA Image" /></td></tr>
<tr><td>Text</td><td>: <input type="text" name="captcha_code" size="10" maxlength="6" />
<a href="#" onclick="document.getElementById('captcha').src = '../config/securimage/securimage_show.php?' + Math.random(); return false"><img src="../config/securimage/images/refresh.gif"></a></td>
<tr><td colspan="2" align="center"><input type="submit" value="Login" title="header=[Log -in] body=[&nbsp;] fade=[on]"></td></tr>
</table>
</form>
</div><!--end login container -->
	<div class="footer">
        <div class="left_footer"></div>
        <div class="center_footer">
        NANO/Computer/Corner&copy;.<br /> All Rights Reserved 2011
        </div>
        <div class="right_footer">
        </div>   
   	</div>                 
</div>
<!-- end of main_container -->
</body>
</html>