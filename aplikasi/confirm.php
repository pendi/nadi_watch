<?php 
	include "../koneksi.php";
	include "../function/function.php";
	$invoice = $_GET['invoice'];
	$selectOrd = mysql_query("SELECT id_order,total FROM orders WHERE invoice='$invoice'");
	$resultOrd = mysql_fetch_array($selectOrd);
?>
<style type="text/css">
	#popup { visibility:visible; opacity: 1; background-color: rgba(255,255,255,0.7); position: fixed; top:0; left:0; right:0; bottom:0; margin:0; z-index: 9; }
	@media (min-width: 768px){
		.popup-container { width:740px; }
	}
	@media (max-width: 767px){
		.popup-container { width:100%; }
	}
	div.popup-container { position: relative; margin:2% auto; padding:30px 50px; background-color: #333; color:#fff; border-radius: 3px; }
	a.popup-close { position: absolute; top:3px; right:3px; background-color: #fff; padding:7px 10px; font-size: 20px; text-decoration: none; line-height: 1; color:#333; }

	.line { line-height: 40px; }
	.ket,.ket-pay { color: #ACACA8; }
	.ket { font-size: 16px; }
	.ket-pay { font-size: 13px; }
</style>

<div class="popup-wrapper" id="popup">
    <div class="popup-container">
        <form method="post" enctype="multipart/form-data" action="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/process/confirm.php' ?>" onsubmit="return validasi(this)">
			<input type="hidden" name="id_order" value="<?php echo $resultOrd['id_order'] ?>">
			<table width="95%" align="center" border="0">
				<tr>
					<td colspan="2"><h2>Konfirmasi Pembayaran :</h2></td>
				</tr>
				<tr>
					<td colspan="2"><b><?php echo $invoice ?></b></td>
				</tr>
				<tr class="line">
					<td width="245px">
						Rekening Tujuan
					</td>
					<td>
						<input type="text" class="input" name="rek_receiver" value="5210932064" readonly>
					</td>
				</tr>
				<tr class="line">
					<td>
						Atas Nama
					</td>
					<td>
						<input type="text" class="input" name="name_receiver" value="Pendi Setiawan" readonly>
					</td>
				</tr>
				<tr class="line">
					<td colspan="2" class="ket">***** Isilah Data Dibawah Ini *****</td>
				</tr>
				<tr class="line">
					<td>
						Rekening Pengirim
					</td>
					<td>
						<input type="text" class="input" name="rek_sender" placeholder="Rekening Pengirim">
					</td>
				</tr>
				<tr class="line">
					<td>
						Atas Nama
					</td>
					<td>
						<input type="text" class="input" name="name_sender" placeholder="Atas Nama">
					</td>
				</tr>
				<tr class="line">
					<td>
						Tanggal Pembayaran
					</td>
					<td>
						<input type="text" id="datepicker" class="input" name="date_payment" value="<?php echo date("d M Y") ?>">
					</td>
				</tr>
				<tr class="line">
					<td>
						Jumlah Pembayaran
					</td>
					<td>
						<input type="text" class="input" name="payment" placeholder="Jumlah Pembayaran">
					</td>
				</tr>
				<tr>
					<td></td>
					<td class="ket-pay">
						<b>*Jumlah yang Harus Anda Bayar Sebesar Rp. <?php echo price($resultOrd['total']) ?></b><br/>
						*Isikan Jumlah Pembayaran Anda Tanpa <b>Titik (.)</b> atau <b>Koma (,)</b>. Contoh: <?php echo $resultOrd['total'] ?>
					</td>
				</tr>
				<tr class="line">
					<td>
						Upload Bukti Pembayaran
					</td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center" style="padding-top:25px;">
						<input type="submit" value="Kirim" class="button round">
					</td>
				</tr>
			</table>
		</form>
        <a class="popup-close" href="#closed" id="closed">X</a>
    </div>
</div>

<script>
	$("#closed").click(function(){
		console.log('Hhhhh');
	    $("#popup").hide();
	});

	function validasi(form) {
		if (form.rek_sender.value == ""){
			alert("Masukan Nomor Rekening Pengirim.");
			form.rek_sender.focus();
			return (false);
		}
		if (form.name_sender.value == ""){
			alert("Masukan Atas Nama Pengirim.");
			form.name_sender.focus();
			return (false);
		}
		if (form.date_payment.value == ""){
			alert("Pilih Tanggal Pembayaran Anda.");
			form.date_payment.focus();
			return (false);
		}
		if (form.payment.value == ""){
			alert("Masukan Jumlah Yang Sudah Anda Bayar.");
			form.payment.focus();
			return (false);
		}
		return (true);  
	}
	$(function() {
	    $( "#datepicker" ).datepicker({
	    	dateFormat: "dd M yy"
	    });
	});
</script>