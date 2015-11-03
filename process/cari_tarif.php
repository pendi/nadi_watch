<option value="">- Pilih Kecamatan -</option>
<?php
    include "../koneksi.php";
   
    $selKecamatan = "SELECT id_tarif, kecamatan FROM tarif WHERE id_city='".$_POST["city"]."' ORDER BY kecamatan ASC";
    $q = mysql_query($selKecamatan);
    while($data_city = mysql_fetch_array($q)){
   
    ?>
        <option value="<?php echo $data_city["id_tarif"] ?>"><?php echo $data_city["kecamatan"] ?></option>
   
    <?php
    }
?>