<?php
session_start();
if (!isset($_SESSION["idUsu"])) {  header('location:login.php'); }

include_once "../controller/clsRpt.php";
require_once "../controller/clsGen.php";
$clsRpt=new clsRpt();
$clsGen = new clsGen();
$rsDat=$clsRpt->ListJefTod();

include_once "../vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$doc= new Spreadsheet();
$hojProd = $doc->getActiveSheet();
$hojProd->setTitle("Jefes");

$hojProd->getColumnDimension('A')->setAutoSize(true);
$hojProd->getColumnDimension('B')->setAutoSize(true);
$hojProd->getColumnDimension('C')->setAutoSize(true);
$hojProd->getColumnDimension('D')->setAutoSize(true);
$hojProd->getColumnDimension('E')->setAutoSize(true);
$hojProd->getColumnDimension('F')->setAutoSize(true);
$hojProd->getColumnDimension('G')->setAutoSize(true);
$hojProd->getColumnDimension('H')->setAutoSize(true);

$hojProd->setCellValue('A1',"Jefes");
$hojProd->setCellValue('B1',"Cedula");
$hojProd->setCellValue('C1',"Telefono");
$hojProd->setCellValue('D1',"Parroquia");
$hojProd->setCellValue('E1',"Centro Votación");
$hojProd->setCellValue('F1',"Comunidad");
$hojProd->setCellValue('G1',"Dirección");
$hojProd->setCellValue('H1',"Estatus");
$numFil=2;
foreach ($rsDat as $dt)
{
    $hojProd->setCellValue('A'.$numFil,$dt['rs']);
    $hojProd->setCellValue('B'.$numFil,$dt['ced']);
    $hojProd->setCellValue('C'.$numFil,$dt['telf']);
    $hojProd->setCellValue('D'.$numFil,$dt['nombParr']);
    $hojProd->setCellValue('E'.$numFil,$dt['nombCentVot']);
    $hojProd->setCellValue('F'.$numFil,$dt['nombCom']);
    $hojProd->setCellValue('G'.$numFil,$dt['dir']);
    $hojProd->setCellValue('H'.$numFil,$dt['nombStat']);
    $numFil++;
}
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="jefes.xls"');
header('Cache-Control: max-age=0');
$writer = IOFactory::createWriter($doc, 'Xls');
$writer->save('php://output');
exit;
?>

