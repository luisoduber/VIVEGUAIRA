<?php 
session_start();

$prmIdParr=$_POST["prmIdParr"];
$prmNombParr=$_POST["prmNombParr"];
require_once "../controller/clsSeg.php";
require_once "../controller/clsGen.php";
$clsSeg=new clsSeg();
$clsGen = new clsGen();

$rsDatEvCne=$clsSeg->EventCne();
$idEvent=$rsDatEvCne[0];
$nombEvent=$rsDatEvCne[1];
$fechEvent=$rsDatEvCne[2];

$TitEv=$nombEvent;
$TitParr=$prmNombParr;

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

$rsDatCentVot=$clsSeg->procPartCentVotTod($prmIdParr,$_SESSION['idEvent']);
	
$cardCentVot=""; $cont=0;
$ListCentVot=""; $ClsCol="";
$count=2; $script="";
$cont++; $count++;

foreach ($rsDatCentVot as $clave)
{
    $prmCodCentVot=$clave['codCentVot'];
    $prmNombCentVot=$clave['nombCentVot']." (".$clave['codCentVot'].")";
    $prmCantVot=$clave['cantVot'];
    $prmCantPart=$clave['cantPart'];

    //$prmCantVot=0;
    $unoPorc=$prmCantPart / 100;
    $prmPorcPart=$prmCantVot / $unoPorc;
    $prmPorcRest= 100 - $prmPorcPart;
    $prmCantFalt=($prmCantPart - $prmCantVot);


  $cardCentVot.='
            <div class="col-md-6 col-xl-3 ">
                <div class="card bg-c-blue order-card h-75">
                    <div class="card-body">
                        <h6 class="text-white"></h6>
                        <h5 class="text-center text-white">
                            '.$prmNombCentVot.' - '.number_format($prmPorcRest,1, '.', ' ').'%</span>
                        </h5>
                        <p class="m-b-0"><span class="float-right"></span></p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-green order-card order-card h-75">
                    <div class="card-body">
                        <h6 class="text-white"></h6>
                        <h3 class="text-center text-white"><span>votantes <br> '.$prmCantPart.'</span></h3>
                        <p class="m-b-0"><span class="float-right"></span></p>
                    </div>
                </div>
            </div>

              <div class="col-md-6 col-xl-3">
                <div class="card bg-c-yellow order-card order-card h-75">
                    <div class="card-body">
                        <h6 class="text-white"></h6>
                        <h3 class="text-center text-white"><span>Votos <br> '.$prmCantVot.'</span></h3>
                        <p class="m-b-0"><span class="float-right"></span></p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-red order-card order-card h-75">
                    <div class="card-body">
                        <h6 class="text-white"></h6>
                        <h3 class="text-center text-white"><span>Por Votar <br> '.$prmCantFalt.'</span></h3>
                        <p class="m-b-0"><span class="float-right"></span></p>
                    </div>
                </div>
            </div>
          ';
          $ListCentVot.='  <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body bg-patern">
                                <div class="row">
                                    <div class="col-auto">
                                <span><strong>'.$prmNombCentVot.'</strong></span>
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
$prmPorcPartInst,$prmPorcRestInst,$prmNombParr,$cardCentVot);
echo json_encode($rsDat);
?>