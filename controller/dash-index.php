<?php 
session_start();

require_once "../controller/clsSeg.php";
require_once "../controller/clsGen.php";
$clsSeg=new clsSeg();
$clsGen = new clsGen();

$rsDatEvCne=$clsSeg->EventCne();
$idEvent=$rsDatEvCne[0];
$nombEvent=$rsDatEvCne[1];
$fechEvent=$rsDatEvCne[2];

$TitEv=$nombEvent;

$rsDatPartEst=$clsSeg->procPartEst($_SESSION['idEst'],$_SESSION['idEvent']);

$prmNombEst="CONSOLIDADO EDO. ";
$prmNombEst.=$rsDatPartEst[1];
$prmNombEst=strtoupper($prmNombEst);
$prmCantPartEst=$rsDatPartEst[2];
$prmCantVotEst=$rsDatPartEst[3];

$unoPorcEst=$prmCantPartEst / 100;
$prmPorcPartEst=$prmCantVotEst / $unoPorcEst;
$prmPorcRestEst=100 - $prmPorcPartEst;
$prmCantFaltEst=($prmCantPartEst - $prmCantVotEst);
$prmPorcPartEst=number_format($prmPorcPartEst,2, '.', ' ');

$rsDatPartInst=$clsSeg->procPartInst(1,$_SESSION['idEvent']);
      
$prmNombInst="CONSOLIDADO ";
$prmNombInst.=$rsDatPartInst[1];
$prmNombInst=strtoupper($prmNombInst);
$prmCantPartInst=$rsDatPartInst[2];
$prmCantVotInst=$rsDatPartInst[3];

$unoPorcInst=$prmCantPartInst / 100;
$prmPorcPartInst=$prmCantVotInst / $unoPorcInst;
$prmPorcRestInst=100 - $prmPorcPartInst;
$prmCantFaltInst=($prmCantPartInst - $prmCantVotInst);
$prmPorcPartInst=number_format($prmPorcPartInst,2, '.', ' ');

$rsDatParr=$clsSeg->procPartParrTod($_SESSION['idMun'],$_SESSION['idEvent']);
			
$cardParr=""; $cont=0;
$ListParr=""; $ClsCol="";
$count=2; $script="";
foreach ($rsDatParr as $clave)
{
  $cont++;
  $count++;

  if ($cont==1) {$ClsCol="bg-grd-success"; }
  elseif ($cont==2) {$ClsCol="bg-grd-warning"; }
  elseif ($cont==3) {$ClsCol="bg-grd-danger"; $cont=0; }

    $idParr=$clave['idParr'];
	$prmNombParr=$clave['nombParr'];
	$prmCantVot=$clave['cantVot'];
	$prmCantPart=$clave['cantPart'];

	//$prmCantVot=2000;
	$unoPorc=$prmCantPart / 100;
	$prmPorcPart=$prmCantVot / $unoPorc;
	$prmPorcRest= 100 - $prmPorcPart;
	$prmCantFalt=($prmCantPart - $prmCantVot);

  $cardParr.='
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-blue order-card">
                    <div class="card-body">
                        <h2 class="text-center text-white">
                            <a href="dashCentVot.php?a='.$idParr.'&b='.$prmNombParr.'" target="_blank" 
                            class="text-decoration-none text-white">
                                '.$prmNombParr.'<br>'.number_format($prmPorcRest,1, '.', ' ').'%</span>
                            </a>
                        </h2>
                        <p class="m-b-0"><span class="float-right"></span></p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-green order-card">
                    <div class="card-body">
                        <h2 class="text-center text-white"><span>votantes <br> '.$prmCantPart.'</span></h2>
                        <p class="m-b-0"><span class="float-right"></span></p>
                    </div>
                </div>
            </div>

              <div class="col-md-6 col-xl-3">
                <div class="card bg-c-yellow order-card">
                    <div class="card-body">
                        <h2 class="text-center text-white"><span>Votos <br> '.$prmCantVot.'</span></h2>
                        <p class="m-b-0"><span class="float-right"></span></p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-red order-card">
                    <div class="card-body">
                        <h2 class="text-center text-white"><span>Por Votar <br> '.$prmCantFalt.'</span></h2>
                        <p class="m-b-0"><span class="float-right"></span></p>
                    </div>
                </div>
            </div>
          ';
          $ListParr.='  <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body bg-patern">
                                <div class="row">
                                    <div class="col-auto">
                                <span><strong>'.$prmNombParr.'</strong></span>
                                    </div>
                                    <div class="col text-right">
                                        <h2 class="mb-0"><?php echo $prmCantPartEst; ?></h2>
                                        <span class="text-c-green">'.$prmCantPart.number_format($prmPorcRest,1, '.', ' ').'%<i class="feather icon-trending-up ml-1"></i></span>
                                    </div>
                                </div>
                                <div id="customer-chart'.$count.'"></div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <h3 class="m-0"><i class="fas fa-circle f-10 m-r-5 text-success"></i>'.$prmCantVot.'</h3>
                                        <span class="ml-3">Votos</span>
                                    </div>
                                    <div class="col">
                                        <h3 class="m-0"><i class="fas fa-circle text-primary f-10 m-r-5"></i>'.$prmCantFalt.'</h3>
                                        <span class="ml-3">Por Votar</span>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
        ';
        
        $script.="
        var options".$count." = {
            chart: {
                height: 150,
                type: 'donut',
            },
            dataLabels: {
                enabled: false
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '65%'
                    }
                }
            },
            labels: ['Participación', 'Faltante'],
            series: 
            [
              ".$prmPorcPart.",
               ".$prmPorcRest."
            ],
            legend: {
                show: true
            },
            tooltip: {
                theme: 'datk'
            },
            grid: {
                padding: {
                    top: 20,
                    right: 0,
                    bottom: 0,
                    left: 0
                },
            },
            colors: ['#4680ff', '#2ed8b6'],
            fill: {
                opacity: [1, 1]
            },
            stroke: {
                width: 0,
            }
        }
       var chart".$count." = new ApexCharts(document.querySelector('#customer-chart".$count."'), options".$count.");
      chart".$count.".render();
      ";

  
}
$rsDat=array($TitEv,$prmNombEst,$prmCantVotEst,$prmPorcPartEst,$prmCantPartEst,$prmCantFaltEst,
$prmNombInst,$prmCantPartInst,$prmPorcPartInst,$prmCantVotInst,$prmCantFaltInst,$prmPorcPartEst,$prmPorcRestEst,
$prmPorcPartInst,$prmPorcRestInst,$cardParr);
echo json_encode($rsDat);
?>