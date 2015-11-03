<?php 
include "koneksi.php";
include "function/function.php";
require_once 'PHPExcel/Classes/PHPExcel.php';


$bulan = $_GET['bulan'];
$dateYear = date("Y");
$totals = 0;
$q=mysql_query("SELECT * FROM orders WHERE status_order <= 3 AND month(created_time_order)='$bulan' AND year(created_time_order)='$dateYear' ORDER BY created_time_order DESC");

// Create new PHPExcel object
$object = new PHPExcel();

// Set properties
// $object->getProperties()->setCreator("Tempo")
//                ->setLastModifiedBy("Tempo")
//                ->setCategory("Approve by");

$theadStyle = array(
	'font' => array(
		'name'  => 'Arial',
		'size' => 10
	),
	'fill' => array(
		'type' => PHPExcel_Style_Fill::FILL_SOLID,
		'color' => array('rgb' => 'CCCCCC')
	),
	'borders' => array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('rgb' => 'FF000000')
		)
	),
	'alignment' => array(
		'horizontal' => 'center'
	)
);

$tbodyStyle = array(
	'font' => array(
		'name'  => 'Arial',
		'size' => 10
	),
	'borders' => array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('rgb' => 'FF000000')
		)
	)
);

$ketStyle = array(
	'font' => array(
		'name'  => 'Arial',
		'size' => 10
	)
);

$titleStyle = array(
	'font' => array(
		'name'  => 'Arial',
		'size' => 10
	),
	'alignment' => array(
		'horizontal' => 'center'
	)
);

// Add some data
$object->getActiveSheet()->getStyle('A4:E4')->applyFromArray($theadStyle);
$object->getActiveSheet()->getStyle('A2:E2')->applyFromArray($titleStyle);
$object->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$object->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$object->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$object->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$object->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$object->getActiveSheet()->mergeCells('A1:E1');
$object->getActiveSheet()->mergeCells('A2:E2');
$object->setActiveSheetIndex(0)
            ->setCellValue('A2', 'Laporan Bulan '.date('F', strtotime('01-'.$bulan.'-2015')))
            ->setCellValue('A4', 'Kode Transaksi')
            ->setCellValue('B4', 'Invoice')
            ->setCellValue('C4', 'Tanggal Transaksi')
            ->setCellValue('D4', 'Total')
            ->setCellValue('E4', 'Status');

//add data
$c = 5;
$limit = $c + mysql_num_rows($q);
for ($i=$c; $i < $limit ; $i++) {
	$object->getActiveSheet()->getStyle('A'.$i.':E'.$i)->applyFromArray($tbodyStyle);
}

$counter=5;
$ex = $object->setActiveSheetIndex(0);
while($d=mysql_fetch_array($q)){
	if (!empty($d['invoice']) && $d['status_order'] <= 4) {
		$tanggal = date("d F Y", strtotime($d['created_time_order']));
		$ex->setCellValue("A".$counter,$d['id_order']);
		$ex->setCellValue("B".$counter,$d['invoice']);
		$ex->setCellValue("C".$counter,$tanggal);
		$ex->setCellValue("D".$counter,"Rp. ".price($d['total']));
		if ($d['status_order'] == 1){
			$ex->setCellValue("E".$counter,'Baru');
		} elseif ($d['status_order'] == 2) {
			$ex->setCellValue("E".$counter,'Konfirmasi');
		} elseif ($d['status_order'] == 3 || $dataOrd['status_order'] == 4) {
			$ex->setCellValue("E".$counter,'Lunas');
			$totals +=$d['total'];
		}
		$counter=$counter+1;
	}
}

$ket = $c + mysql_num_rows($q) + 1;
$object->getActiveSheet()->getStyle('A'.$ket.':E'.$ket)->applyFromArray($ketStyle);
$object->getActiveSheet()->mergeCells('A'.$ket.':E'.$ket);
$object->setActiveSheetIndex(0)->setCellValue('A'.$ket, 'Total pemasukan transaksi lunas Bulan '.date('F', strtotime('01-'.$bulan.'-2015')).' sebesar Rp. '.price($totals));

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$object->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Laporan.xlsx"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
$objWriter->save('php://output');
exit;
?>