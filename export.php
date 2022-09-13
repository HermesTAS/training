<?php
require_once "core/init.php";
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once "function/report.php";
$customers = json_decode(report());
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();


$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'No Faktur');
$sheet->setCellValue('C1', 'Tanggal');
$sheet->setCellValue('D1', 'Nama');
$sheet->setCellValue('E1', 'JenKel');
$sheet->setCellValue('F1', 'Phone');
$sheet->setCellValue('G1', 'Saldo');
$sheet->setCellValue('H1', 'Alamat');



$row=2;
foreach ($customers as $customer) {
    $no =$row-1;
    $sheet->setCellValue('A'.$row, $no);
    $sheet->setCellValue('B'.$row, $customer->nofaktur);
    $sheet->setCellValue('C'.$row, $customer->tanggal);
    $sheet->setCellValue('D'.$row, $customer->nama);
    $sheet->setCellValue('E'.$row, $customer->genders);
    $sheet->setCellValue('F'.$row, $customer->phone);
    $sheet->setCellValue('G'.$row, $customer->saldo)->getStyle('G'.$row)->getNumberFormat()
    // ->setFormatCode('#,##0');
    ->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_IDR_SIMPLE);

    $sheet->setCellValue('H'.$row, $customer->address);
    $row++;
}
$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'. urlencode('data_pelangan.xlsx').'"');
$writer->save('php://output');
// $writer->save('hello world.xlsx');
