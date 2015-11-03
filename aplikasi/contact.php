<?php 
	if (isset($_SESSION['member'])) {
		$id = $_SESSION['member']['id_member'];
		$select_member = mysql_query("SELECT * FROM member WHERE id_member ='$id'");
		$data_member = mysql_fetch_array($select_member);
	}
?>
<form action="process/contact.php" method="post" onsubmit="return validasi(this)" enctype="multipart/form-data">
	<table align="center">
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2">Anda bisa mengirimkan kritik, saran atau komplain dengan mengisi form dibawh ini:</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td width="135px">Email</td>
			<td>
				<input autofocus type="text" class="input" name="email" placeholder="Email" id="email" value="<?php if(isset($_SESSION['member'])){ echo $data_member['email_member']; } else {"";} ?>">
			</td>
		</tr>
		<tr>
			<td>Nama Lengkap</td>
			<td>
				<input type="text" class="input" name="name" placeholder="Nama Lengkap" value="<?php if(isset($_SESSION['member'])){ echo ucwords($data_member['first_name_member']).' '.ucwords($data_member['last_name_member']); } else {"";} ?>">
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top;">Pesan</td>
			<td>
				<textarea rows="5" cols="20" class="input" name="message" placeholder="Kirimkan Pesan Anda"></textarea>
			</td>
		</tr>
		<tr>
			<td>Foto</td>
			<td><input type="file" name="image"></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" name="submit" value="Kirim" class="button round">
				<a href="index.php?list=1" class="button round error">Batal</a>
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
		if (form.name.value == ""){
			alert("Anda belum mengisikan Nama.");
			form.name.focus();
			return (false);
		}
		if (form.message.value == ""){
			alert("Anda belum mengisikan Pesan.");
			form.message.focus();
			return (false);
		}
		return (true);
	}
</script>