<?php
require_once "core/init.php";
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once "function/report.php";
$customers = json_decode(report());
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();





$row=1;
foreach ($customers as $customer) {
    $no =$row-1;
    // $sheet->setCellValue('A'.$row++, $no);
    $sheet->setCellValue('A'.$row, 'No Faktur');
    $sheet->setCellValue('B'.$row++, $customer->nofaktur);
    $sheet->setCellValue('A'.$row, 'Tanggal');
    $sheet->setCellValue('B'.$row++, $customer->tanggal);
    $sheet->setCellValue('A'.$row, 'Nama');
    $sheet->setCellValue('B'.$row++, $customer->nama);
    $sheet->setCellValue('A'.$row, 'JenKel');
    $sheet->setCellValue('B'.$row++, $customer->genders);
    $sheet->setCellValue('A'.$row, 'Phone');
    $sheet->setCellValue('B'.$row++, $customer->phone);
    $sheet->setCellValue('A'.$row, 'Saldo');
    $sheet->setCellValue('B'.$row, $customer->saldo)->getStyle('B'.$row++)->getNumberFormat()
    ->setFormatCode('"Rp "#,##_-');
    $sheet->setCellValue('A'.$row, 'Alamat');
    $sheet->setCellValue('B'.$row++, $customer->address);

    $sheet->setCellValue('A'.$row, 'Barang');
    $sheet->setCellValue('B'.$row, 'Harga');
    $sheet->setCellValue('C'.$row, 'Quantity');
    $sheet->setCellValue('D'.$row++, 'Total Barang');
    $totalFaktur =0;
    foreach ($customer->detail as $detail) {
        $totalBarang = $detail->harga * $detail->quantity;
        $sheet->setCellValue('A'.$row, $detail->barang );
        $sheet->setCellValue('B'.$row, $detail->harga )->getStyle('B'.$row)->getNumberFormat()
        ->setFormatCode('"Rp "#,##_-');
        $sheet->setCellValue('C'.$row, $detail->quantity )->getStyle('C'.$row)->getNumberFormat()
        ->setFormatCode('#,##_-');
        $sheet->setCellValue('D'.$row, $totalBarang )->getStyle('D'.$row++)->getNumberFormat()
        ->setFormatCode('"Rp "#,##_-');
        $totalFaktur += $totalBarang;
    }
    $sheet->setCellValue('C'.$row, 'Total Faktur');
    $sheet->setCellValue('D'.$row, $totalFaktur)->getStyle('D'.$row++)->getNumberFormat()
    ->setFormatCode('"Rp "#,##_-');


    
    $row+=2;
}
$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'. urlencode('data_pelangan.xlsx').'"');
$writer->save('php://output');
// $writer->save('hello world.xlsx');
