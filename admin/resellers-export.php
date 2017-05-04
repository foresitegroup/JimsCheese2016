<?php
include_once "../inc/dbconfig.php";

// require the PHPExcel file
require 'inc/PHPExcel.php';

// Create a new PHPExcel object
$objPHPExcel = new PHPExcel();

function PopulateSheet($objPHPExcel, $zone, $sheetname) {
	global $mysqli;
	
	$result = $mysqli->query("SELECT email,firstname,lastname,company FROM resellers WHERE zone = '" . $zone . "' ORDER BY email ASC");
	$headings = array("Email","First Name","Last Name","Company");
  $lastcol = "D";
	
	$rowNumber = 1;
	$col = 'A';
	foreach($headings as $heading) {
		$objPHPExcel->getActiveSheet()->setCellValue($col.$rowNumber,$heading);
		$col++;
	}
	
	// Loop through the result set
	$rowNumber = 2;
	while($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$col = 'A';
		foreach($row as $cell) {
			$objPHPExcel->getActiveSheet()->setCellValueExplicit($col.$rowNumber, $cell, PHPExcel_Cell_DataType::TYPE_STRING);
			$col++;
		}
		$rowNumber++;
	}
	
	// Format the header cells and autosize the columns
	$objPHPExcel->getActiveSheet()->getStyle('A1:'.$lastcol.'1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('DDDDDDDD');
	$objPHPExcel->getActiveSheet()->getStyle('A1:'.$lastcol.'1')->getFont()->setBold(true);
	for ($i=A; $i<=$lastcol; $i++) {
		$objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
	}
	
	$objPHPExcel->getActiveSheet()->setSelectedCell('A' . $rowNumber);
	
	$objPHPExcel->getActiveSheet()->setTitle($sheetname);
}

// Dump the info for this sort into first sheet
PopulateSheet($objPHPExcel, "1", "Zone 1");

// Create new sheet and set it as active, then dump the info into it
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(1);
PopulateSheet($objPHPExcel, "2", "Zone 2");

// Create new sheet and set it as active, then dump the info into it
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(2);
PopulateSheet($objPHPExcel, "3", "Zone 3");

// Create new sheet and set it as active, then dump the info into it
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(3);
PopulateSheet($objPHPExcel, "4", "Zone 4");

// Set first sheet as active
$objPHPExcel->setActiveSheetIndex(0);

// Save as an Excel BIFF (xls) file
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Resellers-' . date("Ymd-Hi") . '.xls"');
header('Cache-Control: max-age=0');

$objWriter->save('php://output');
?>