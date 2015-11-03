<form action="process/register_member.php" method="post" onsubmit="return validasi(this)">
	<table align="center">
		<tr>
			<td colspan="3"><center><h2>DAFTAR MEMBER</h2></center></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td width="135px">Email</td>
			<td colspan="2">
				<input autofocus type="text" class="input" name="email" placeholder="Email" id="email">
			</td>
		</tr>
		<tr>
			<td>Nama Depan</td>
			<td colspan="2">
				<input type="text" class="input" name="first_name" placeholder="Nama Depan">
			</td>
		</tr>
		<tr>
			<td>Nama Belakang</td>
			<td colspan="2">
				<input type="text" class="input" name="last_name" placeholder="Nama Belakang">
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top;">Alamat</td>
			<td colspan="2">
				<textarea rows="5" cols="20" class="input" name="address" placeholder="Alamat Lengkap"></textarea>
			</td>
		</tr>
		<tr>
			<td>Telephone</td>
			<td colspan="2">
				<input type="text" class="input" name="telp" placeholder="Telephone">
			</td>
		</tr>
		<tr>
			<td>Password</td>
			<td>
				<input type="password" class="input" name="password" placeholder="Password">
			</td>
			<td>
				<input type="password" class="input" name="conf_password" placeholder="Konfirmasi Password">
			</td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3" align="center">
				<input type="submit" name="submit" value="Simpan" class="button round">
				<a href="view_admin.php" class="button round error">Batal</a>
			</td>
		</tr>
	</table>
</form>

<script>
	function validasi(form) {
		if (form.email.value == ""){
			alert("Anda belum mengisikan Email.");
			form.email.focus();
			return (false);
		} else {
			var email=document.getElementById('email').value;
			if ((email.indexOf('@',0)==-1) || (email.indexOf('.',0)==-1)) { 
				alert("Alamat Email anda tidak valid");  
				form.email.focus();
				return (false);
			}			
		}
		if (form.first_name.value == ""){
			alert("Anda belum mengisikan Nama Depan.");
			form.first_name.focus();
			return (false);
		}
		if (form.address.value == ""){
			alert("Anda belum mengisikan Alamat.");
			form.address.focus();
			return (false);
		}
		if (form.telp.value == ""){
			alert("Anda belum mengisikan Nomor Telephone.");
			form.telp.focus();
			return (false);
		}
		if (form.password.value == ""){
			alert("Anda belum mengisikan Password.");
			form.password.focus();
			return (false);
		}
		if (form.conf_password.value == ""){
			alert("Anda belum mengisikan Konfirmasi Password.");
			form.conf_password.focus();
			return (false);
		}
		if (form.password.value != "" || form.conf_password.value != ""){
			if (form.password.value != form.conf_password.value) {
				alert("Konfirmasi Password Anda Tidak Cocok.");
				form.conf_password.focus();
				return (false);
			}
		}
		
		return (true);
	}
</script>