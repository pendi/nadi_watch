<?php
	if (!isset($_GET['head'])) {
		$_GET['head'] = "home";
	}

	if ($_GET['head'] == "home") {
		include "header/header.php";
	} elseif ($_GET['head'] == "admin") {
		include "header/header_admin.php";
	}
?>
<div class="row-isi">
	<?php include "list.php" ?>
	<table class="width">
		<tr>
			<td>
				<?php include "footer/footer.php"; ?>	
			</td>
		</tr>
	</table>
</div>