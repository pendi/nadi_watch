<?php 
// session_start();
// if(isset($_SESSION['id']) AND $_SESSION['level'] == "super admin") {
// 	header('location:../admin/dashboard.php'); 
// } elseif (isset($_SESSION['id']) AND $_SESSION['level'] == "admin") {
// 	header('location:../product/view_product.php'); 
// }
// include "../header/header.php";
// var_dump($_GET);
	if (isset($_GET['id_order'])) {
		$id_order = $_GET['id_order'];
	} else {
		$id_order = "";
	}
?>
<style type="text/css">
	.register {
		padding-top: 20px;
		font-size: 14px;
	}
</style>

<form action="process/login_member.php" method="post" onsubmit="return validasi(this)">
	<input type="hidden" name="id_order" value="<?php echo $id_order ?>">
	<table class="width">
		<tr>
			<td colspan="3" align="center"><h2>Member</h2></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td width="27%">&nbsp;</td>
			<td width="8%">Email</td>
			<td width="35%"><input type="text" class="input" name="email" placeholder="email" autofocus></td>	
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>Password</td>
			<td><input type="password" class="input" name="password" placeholder="password"></td>	
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
			<td colspan="3" align="center" class="register">
				Tidak memiliki akun? Daftar <a href="index.php?list=3&head=home" class="href">sekarang</a>
			</td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
	</table>
</form>

<script>
	function validasi(form) {
		if (form.username.value == ""){
			alert("Anda belum mengisikan Email.");
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