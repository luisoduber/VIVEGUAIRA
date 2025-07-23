<?php 
session_start(); 
if (!isset($_SESSION["idUsu"])) {  header('location:login.php'); }

include_once "../controller/clsRpt.php";
require_once "../controller/clsGen.php";
$clsRpt=new clsRpt();
$clsGen = new clsGen();

include_once "../vendor/autoload.php";
use Dompdf\Dompdf;

$prmIdJef=isset($_GET["a"])? $clsGen->limpCad($_GET["a"]):"";
//$prmIdJef=5;
$rsDatDet=$clsRpt->infJefRpt($prmIdJef);
$rsDat=$clsRpt->ListRptMil($prmIdJef);

$nombEst=$rsDatDet['nombEst'];
$nombMun=$rsDatDet['nombMun'];
$nombParr=$rsDatDet['nombParr'];
$codCentVot=$rsDatDet['codCentVot'];
$nombCentVot=$rsDatDet['nombCentVot'];
$rs=$rsDatDet['rs'];
$ced=$rsDatDet['ced'];

$tit="Planilla 1*10 territorial del estado La Guaira.";
$titFoot="Todos los miembros del equipo de calle y comunidad";
$titFoot.=" debe impulsar la conformación del 1x10 Territorial";

$nombEst='<strong>ESTADO: </strong>'.strtoupper($nombEst).'</BR>';
$nombMun='<strong>MUNICIPIO: </strong>'.strtoupper($nombMun).'</BR>';
$nombParr='<strong>PARROQUIA: </strong>'.strtoupper($nombParr).'</BR>';
$CodCentVot='<strong>CODIGO DE UBCH: </strong>'.strtoupper($codCentVot).'</BR>';
$nombCentVot='<strong>NOMBRE DE LA UBCH: </strong>'.strtoupper($nombCentVot).'</BR>';
$nombJef='<strong>JEFE DEL 1 X 10: </strong>'.strtoupper($rs).'</BR>';
$cedJef='<strong>CÉDULA JEFE DEL 1 X 10: </strong>'.strtoupper($ced).'</BR></BR></BR>';

$CandMen=$nombEst;
$CandMen.=$nombMun;
$CandMen.=$nombParr;
$CandMen.=$CodCentVot;
$CandMen.=$nombCentVot;
$CandMen.=$nombJef;
$CandMen.=$cedJef;
$tbl=""; $tblTit="";
$tblFoot="";

$tblTit.='</BR></BR>';
$tblTit.='<table style="border: 0px solid black; width: 100%;" ';
$tblTit.=' id="TabListMil">';
   $tblTit.='<thead>';
        $tblTit.='<tr>';
           $tblTit.='<th style="text-align:center;"><h3>'.$tit.'</h3></th>'; 
        $tblTit.='</tr>';
    $tblTit.='</thead>';
$tblTit.='</table>';
$tblTit.='</BR>';

$tblFoot.='</BR></BR>';
$tblFoot.='<table style="border: 0px solid black; width: 100%;" ';
$tblFoot.=' id="TabListMil">';
   $tblFoot.='<thead>';
       $tblFoot.='<tr>';
           $tblFoot.='<th style="text-align:center;"><h3>'.$titFoot.'</h3></th>'; 
        $tblFoot.='</tr>';
   $tblFoot.='</thead>';
$tblFoot.='</table>';
$tblFoot.='</BR>';

$tbl='<table style="border: 1px solid black; border-collapse: collapse;" ';
$tbl.=' id="TabListMil">';
    $tbl.='<thead>';
        $tbl.='<tr style="background-color:#e6e6e6;">';
            $tbl.='<th style="text-align:center;  border:solid 1px;">Nº</th>';
            $tbl.='<th style="text-align:center;  border:solid 1px;">Nombres y apellidos</th>';
            $tbl.='<th style="text-align:center;  border:solid 1px;">Cedula</th>';
            $tbl.='<th style="text-align:center;  border:solid 1px;">Telefono</th>';
            $tbl.='<th style="text-align:center;  border:solid 1px;">Muncicipio</th>';
            $tbl.='<th style="text-align:center;  border:solid 1px;">Parroquia</th>';   
            $tbl.='<th style="text-align:center;  border:solid 1px;">Centro Votación</th>';  
        $tbl.='</tr>';
    $tbl.='</thead>';
    $tbl.='<tbody>';

 $count=0;
foreach ($rsDat as $dt)
{
    $count++;
    $tbl.='<tr style="text-align:center;">';
        $tbl.='<td style="text-align:center;  border:solid 1px;">'.$count.'</td>';
        $tbl.='<td style="text-align:center;  border:solid 1px;">'.$dt['rs'].'</td>';
        $tbl.='<td style="text-align:center;  border:solid 1px;">'.$dt['ced'].'</td>';
        $tbl.='<td style="text-align:center;  border:solid 1px;">'.$dt['telf'].'</td>';
        $tbl.='<td style="text-align:center;  border:solid 1px;">'.$dt['nombMun'].'</td>';
        $tbl.='<td style="text-align:center;  border:solid 1px;">'.$dt['nombParr'].'</td>';
        $tbl.='<td style="text-align:center;  border:solid 1px;">'.$dt['nombCentVot'].'</td>';
    $tbl.='</tr>'; 

}

$tbl.='</tbody>';
$tbl.='</table>';

$dompdf = new Dompdf();
$dompdf->loadHtml($tblTit.$CandMen.$tbl.$tblFoot);
$dompdf->setPaper('A4', 'letter');
$dompdf->render();
$dompdf->stream('rptMil1x10.pdf');
?>

