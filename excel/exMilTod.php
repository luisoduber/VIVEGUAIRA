<?php
session_start();
if (!isset($_SESSION["idUsu"])) {  header('location:login.php'); }

include_once "../controller/clsRpt.php";
require_once "../controller/clsGen.php";
$clsRpt=new clsRpt();
$clsGen = new clsGen();
$rsDat=$clsRpt->ListMilJefTod();

include_once "../vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$doc= new Spreadsheet();
$hojProd = $doc->getActiveSheet();
$hojProd->setTitle("JefMil");

$hojProd->getColumnDimension('A')->setAutoSize(true);
$hojProd->getColumnDimension('B')->setAutoSize(true);
$hojProd->getColumnDimension('C')->setAutoSize(true);
$hojProd->getColumnDimension('D')->setAutoSize(true);
$hojProd->getColumnDimension('E')->setAutoSize(true);
$hojProd->getColumnDimension('F')->setAutoSize(true);
$hojProd->getColumnDimension('G')->setAutoSize(true);
$hojProd->getColumnDimension('H')->setAutoSize(true);
$hojProd->getColumnDimension('I')->setAutoSize(true);
$hojProd->getColumnDimension('J')->setAutoSize(true);

$hojProd->setCellValue('A1',"Jefes");
$hojProd->setCellValue('B1',"Cedula");
$hojProd->setCellValue('C1',"Telefono");
$hojProd->setCellValue('D1',"Parroquia");
$hojProd->setCellValue('E1',"Comunidad");
$hojProd->setCellValue('F1',"Militante");
$hojProd->setCellValue('G1',"Cedula");
$hojProd->setCellValue('H1',"Telefono");
$hojProd->setCellValue('I1',"Parroquia");
$hojProd->setCellValue('J1',"Comunidad");

$numFil=2;
foreach ($rsDat as $dt)
{
    $hojProd->setCellValue('A'.$numFil,$dt['rs']);
    $hojProd->setCellValue('B'.$numFil,$dt['ced']);
    $hojProd->setCellValue('C'.$numFil,$dt['telf']);
    $hojProd->setCellValue('D'.$numFil,$dt['nombParr']);
    $hojProd->setCellValue('E'.$numFil,$dt['nombCom']);
    $hojProd->setCellValue('F'.$numFil,$dt['rsMil']);
    $hojProd->setCellValue('G'.$numFil,$dt['cedMil']);
    $hojProd->setCellValue('H'.$numFil,$dt['telfMil']);
    $hojProd->setCellValue('I'.$numFil,$dt['nombParrMil']);
    $hojProd->setCellValue('J'.$numFil,$dt['nombComMil']);
    $numFil++;
}
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="jefMil.xls"');
header('Cache-Control: max-age=0');
$writer = IOFactory::createWriter($doc, 'Xls');
$writer->save('php://output');
exit;
?>

