<?php
	if(isset($_SESSION['id']) AND $_SESSION['level'] == "super admin") {
		header('location:../admin/dashboard.php'); 
	} elseif (isset($_SESSION['id']) AND $_SESSION['level'] == "admin") {
		header('location:../product/view_product.php'); 
	}
?>
<script>
	function validasi(form) {
		if (form.username.value == ""){
			alert("Anda belum mengisikan Username.");
			form.username.focus();
			return (false);
		}
		if (form.password.value == ""){
			alert("Anda belum mengisikan Password.");
			form.password.focus();
			return (false);
		}    
	}
</script>
<form action="process/login_admin.php" method="post" onsubmit="return validasi(this)">
	<table class="width">
		<tr>
			<td colspan="3" align="center"><h2>Admin</h2></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td width="27%">&nbsp;</td>
			<td width="8%">Email</td>
			<td width="35%"><input type="text" class="input" name="email" placeholder="Email" autofocus></td>	
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>Password</td>
			<td><input type="password" class="input" name="password" placeholder="Password"></td>	
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3" align="center">
				<input type="submit" class="button round" value="Masuk">
				<a href="index.php?list=1" class="button round warning">Kembali</a>
			</td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
	</table>
</form>