<?php 
session_start(); 
if (!isset($_SESSION["idUsu"])) {  header('location:login.php'); }

include_once "../controller/clsRpt.php";
require_once "../controller/clsGen.php";
$clsRpt=new clsRpt();
$clsGen = new clsGen();

include_once "../vendor/autoload.php";
use Dompdf\Dompdf;

$CodCentVot=isset($_GET["a"])? $clsGen->limpCad($_GET["a"]):"";
$rsDat=$clsRpt->InfVotFalt($CodCentVot,$_SESSION['idEvent']);

$tbl="";

$tbl='<table class="table table-striped table-hover ';
$tbl.='table-responsive cell-border" id="TabLisClientes">';
    $tbl.='<thead>';
        $tbl.='<tr style="background-color:#e6e6e6;">';
            $tbl.='<th>Cedula</th>';
            $tbl.='<th>Razón Social</th>';
            $tbl.='<th>Edad</th>';
            $tbl.='<th>Parroquia</th>';   
        $tbl.='</tr>';
    $tbl.='</thead>';
    $tbl.='<tbody>';

foreach ($rsDat as $dt)
{
    $tbl.='<tr style="text-align:center;">>';
        $tbl.='<td>'.$dt['ced'].'</td>';
        $tbl.='<td>'.$dt['rs'].'</td>';
        $tbl.='<td>'.$dt['edad'].'</td>';
        $tbl.='<td>'.$dt['nombParr'].'</td>';
    $tbl.='</tr>'; 
}

$tbl.='</tbody>';
$tbl.='</table>';

$dompdf = new Dompdf();
$dompdf->loadHtml($tbl);
$dompdf->setPaper('A4', 'letter');
$dompdf->render();
$dompdf->stream('rptVotFalt-'.$CodCentVot.'.pdf');
?>

