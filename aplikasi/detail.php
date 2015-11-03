<?php

	$sql=mysql_query("SELECT * FROM product WHERE id_product='$_GET[id_product]'");
	$data=mysql_fetch_array($sql);
	$price = $data['price'];
	$stock = $data['stock'];
?>

<style type="text/css">
	table.padding tr > td { padding-left: 2%; }
	.top { vertical-align: top; }
	span.title { color: darkblue; font-size: 25px;}
	span.description { font-size: 14px; position: absolute; width: 550px; line-height: 25px; top: 235px;}
	span.price { font-size: x-large; color: darkblue; position: absolute; width: 550px; top: 400px; }
	span.btn { position: absolute; width: 550px; top: 440px; }
</style>

<table class="width padding">
	<tr>
		<td colspan="2">
			<span class="title"><?php echo $data['name_product']; ?> <?php echo $data['type'].' - '. $data['color'] ?></span>
		</td>
	</tr>
	<tr>
		<td style="width:250px">
			<?php if (!empty($data['image_product'])): ?>				
				<img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/'.$data['image_product']; ?>" width="100%"><br/>
			<?php else : ?>
				<img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/nadi_watch/image/product/no-image.jpg' ?>" width="100%"><br/>
			<?php endif ?>			
		</td>
		<td>
			<span class="description">Jam Tangan <?php echo ucwords($data['gender']).' '.ucwords($data['category']).', '.$data['description'] ?></span>
			<span class="price">Rp. <?php echo price($data['price']) ?></span>
			<?php if ($stock == 0): ?>
				<span class="btn">
					<span class="stock">STOK HABIS</span>
					<a href="index.php?list=1" class="button warning round-group-right">KEMBALI</a>
				</span>
			<?php else: ?>
				<span class="btn">
					<a href="index.php?list=4&act=add&amp;id=<?php echo $data[0]; ?>" class="button round-group">BELI</a>
					<a href="index.php?list=1" class="button warning round-group-right">KEMBALI</a>
				</span>
			<?php endif ?>
		</td>		
	</tr>
</table>