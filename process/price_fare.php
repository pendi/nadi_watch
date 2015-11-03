<?php
    include "../koneksi.php";
    include "../function/function.php";

    $sel_order = mysql_query("SELECT * FROM orders WHERE id_order = '".$_POST["order"]."'");
    $data_order = mysql_fetch_array($sel_order);
   
    $sel_fare = "SELECT tarif FROM tarif WHERE id_tarif='".$_POST["fare"]."'";
    $q = mysql_query($sel_fare);
    $data_fare = mysql_fetch_array($q);

    $ongkir = ceil($data_order['weight_order'])*$data_fare['tarif'];
   
?>
<style type="text/css">
	.height { line-height: 43px; }
	.ket-price { font-size: 15px; color: rgb(84, 84, 84); }
</style>

<table width="70%" align="center">
	<tr class="height">
		<td width="200px"><b>Harga</b></td>
		<td>
			Rp. <input type="text" name="ongkir" value="<?php echo price($data_fare["tarif"]) ?>" class="input" readonly>
		</td>
	</tr>
	<tr>
		<td><b>Berat Total</b></td>
		<td><?php echo $data_order["weight_order"] ?> Kg</td>
	</tr>
	<tr class="height">
		<td><b>Ongkir</b></td>
		<td>
			Rp. <input type="text" name="fare" value="<?php echo price($ongkir) ?>" class="input" readonly>
			<span class="ket-price">(<?php echo ceil($data_order['weight_order']).' X '.$data_fare['tarif'] ?>)</span>
		</td>
	</tr>
</table>
