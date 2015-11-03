<?php 
	if(!isset($_SESSION['transaksi'])){
	    $idt = date("YmdHis");
	    $_SESSION['transaksi'] = $idt;
	}
	$idt = $_SESSION['transaksi'];

	$query = mysql_query("SELECT id_session FROM orders_temp WHERE id_session = '$idt'");
	$numRow = mysql_num_rows($query);
	if ($numRow == 0) {
		echo "<script>window.alert('Keranjang Belanja Anda Masih Kosong');</script>";
		echo "<script>window.location = index.php?list=1';</script>";
	}

	$selectKota = "SELECT * FROM kotamadya ORDER BY name_city ASC";
    $resultKota = mysql_query($selectKota);

    if (isset($_GET['id_order'])) {
		$id_order = $_GET['id_order'];
    } else {
    	$id_order = "";
    }

    if (isset($_GET['id_cus'])) {
		$id_cus = $_GET['id_cus'];
    } else {
    	$id_cus = "";
    }
	
?>
<form action="process/fare.php" method="post" onsubmit="return validasi(this)">
	<input type="hidden" name="id_order" id="order" value="<?php echo $id_order; ?>">
	<input type="hidden" name="id_cus" value="<?php echo $id_cus; ?>">

	<table width="70%" align="center">
		<tr>
			<td><h2>Pilih Lokasi Pengiriman :</h2></td>
		</tr>
	</table>
	<table width="70%" align="center">
		<tr>
			<td width="200px"><b>Pilih Kota/Kabupaten</b></td>
			<td>
				<select size="0" name="kotamadya" id="kotamadya">
    				<option value="">- Pilih Kota/Kabupaten -</option>
    				<?php while($dataKota=mysql_fetch_array($resultKota)): ?>
    					<option value="<?php echo $dataKota["id_city"] ?>"><?php echo $dataKota["name_city"] ?></option>
    				<?php endwhile ?>
    			</select>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center"><img src="loader-icons/loader.GIF" width="64px" height="64px" id="imgLoadKec" style="display:none"></td>
		</tr>
		<tr>
			<td><b>Kecamatan</b></td>
			<td>
				<select size="0" name="kecamatan" id="kecamatan">
					<option value="">- Pilih Kecamatan -</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center"><img src="loader-icons/loader.GIF" width="64px" height="64px" id="imgLoadFare" style="display:none"></td>
		</tr>
	</table>
	<label id="fare"></label>
	<table width="70%" align="center">
		<tr>
			<td style="text-align:center; padding-top:25px;">
				<input type="submit" value="Simpan" class="button round"> 
				<a href="<?php echo "index.php?list=22&id_cus=$id_cus&id_order=$id_order" ?>" class="button round warning">Kembali</a>
				<!-- <a href="check.php?act=clear" class="button round error">Batal</a> -->
			</td>
		</tr>		
	</table>
</form>
<script>
	function validasi(form) {
		if (form.kotamadya.value == ""){
			alert("Silahkan Pilih Kota/Kabupaten Anda.");
			form.kotamadya.focus();
			return (false);
		}
		if (form.kecamatan.value == ""){
			alert("Silahkan Pilih Kecamatan Anda.");
			form.kecamatan.focus();
			return (false);
		}
		return (true);
	}

	$("#kotamadya").change(function(){
   
        // variabel dari nilai combo box provinsi
        var id_city = $("#kotamadya").val();
        console.log(id_city);
       
        // tampilkan image load
        $("#imgLoadKec").show("");
       
        // mengirim dan mengambil data
        $.ajax({
            type: "POST",
            dataType: "html",
            // url: "http://www.deezer.com",
            url: "process/cari_tarif.php",
            data: "city="+id_city,
            success: function(msg){
               
                // jika tidak ada data
                if(msg == ''){
                    alert('Silahkan Pilih Kota/Kabupaten Anda');
                }
               
                // jika dapat mengambil data,, tampilkan di combo box kota
                else{
                    $("#kecamatan").html(msg);                                                     
                }
               
                // hilangkan image load
                $("#imgLoadKec").hide();
            }
        });    
    });

    $("#kecamatan").change(function(){
   
        // variabel dari nilai combo box provinsi
        var id_kecamatan = $("#kecamatan").val();
        var id_order = $("#order").val();
        console.log(id_order);
       
        // tampilkan image load
        $("#imgLoadFare").show("");
       
        // mengirim dan mengambil data
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "process/price_fare.php",
            data: {fare:+id_kecamatan, order:id_order},
            success: function(msg){
            	console.log(msg);
               
                // jika tidak ada data
                if(msg == ''){
                    alert('Silahkan Pilih Kecamatan Anda');
                }
               
                // jika dapat mengambil data,, tampilkan di combo box kota
                else{
                    $("#fare").html(msg);                                                     
                }
               
                // hilangkan image load
                $("#imgLoadFare").hide();
            }
        });    
    });
</script>