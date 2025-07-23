<?php
session_start();
if (!isset($_SESSION["idUsu"])) {  header('location:login.php'); }

include_once "../controller/clsRpt.php";
require_once "../controller/clsGen.php";
$clsRpt=new clsRpt();
$clsGen = new clsGen();

$CodCentVot=isset($_GET["a"])? $clsGen->limpCad($_GET["a"]):"";
$rsDat=$clsRpt->InfPartEv("1",$CodCentVot);

include_once "../vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$doc= new Spreadsheet();
$hojProd = $doc->getActiveSheet();
$hojProd->setTitle($CodCentVot);

$hojProd->getColumnDimension('A')->setAutoSize(true);
$hojProd->getColumnDimension('B')->setAutoSize(true);
$hojProd->getColumnDimension('C')->setAutoSize(true);
$hojProd->getColumnDimension('D')->setAutoSize(true);
$hojProd->getColumnDimension('E')->setAutoSize(true);
$hojProd->setCellValue('A1',"Cedula");
$hojProd->setCellValue('B1',"Razon social");
$hojProd->setCellValue('C1',"Edad");
$hojProd->setCellValue('D1',"Parroquia");
$hojProd->setCellValue('E1',"Hora");
$numFil=2;
foreach ($rsDat as $dt)
{
    $hojProd->setCellValue('A'.$numFil,$dt['ced']);
    $hojProd->setCellValue('B'.$numFil,$dt['rs']);
    $hojProd->setCellValue('C'.$numFil,$dt['edad']);
    $hojProd->setCellValue('D'.$numFil,$dt['nombParr']);
    $hojProd->setCellValue('E'.$numFil,$dt['horReg']);
    $numFil++;
}
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$CodCentVot.'.xls"');
header('Cache-Control: max-age=0');
$writer = IOFactory::createWriter($doc, 'Xls');
$writer->save('php://output');
exit;
?>

