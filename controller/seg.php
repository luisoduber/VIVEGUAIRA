<?php 
session_start();

require_once "../controller/clsSeg.php";
require_once "../controller/clsGen.php";
$clsSeg=new clsSeg();
$clsGen = new clsGen();

$prmOp="";
$prmOp=isset($_POST["prmOp"])? $clsGen->limpCad($_POST["prmOp"]):"";

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

function constTit($prmTit)
{
	$divTit="";
	$divTit="<div class='row'>";
		$divTit.="<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
			$divTit.="<div class='divDat'>";
				$divTit.=strtoupper($prmTit);
			$divTit.="</div>";
		$divTit.="</div>";
	$divTit.="</div>";
	return $divTit;
}

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

function constTitInf($prmTit,$prmCod)
{
	$divTit="";
	$divTit="<div class='row'>";
	$divTit.="<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
		$divTit.="<div class='divDat'>";
			$divTit.="<a href='#' onClick='infEncUch(".$prmCod.");'>";
			$divTit.=$prmTit;
			$divTit.="</a>";
		$divTit.="</div>";
	$divTit.="</div>";
$divTit.="</div>";
	return $divTit;
}

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

function constDat($prmCantPart,$prmCantVot,$prmCantFalt)
{
	$divDat="";
	$divDat="<div class='row'>";
		$divDat.="<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>";
			$divDat.="<div class='divDatCantP'>";
				$divDat.="<span class='divDatCantTit'>VOTANTES</span><br><br>
						  <span class='divDatCantNum'>$prmCantPart</span>";
			$divDat.='</div>';
		$divDat.='</div>';

		$divDat.="<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>";
			$divDat.="<div class='divDatCantP'>";
				$divDat.="<span class='divDatCantTit'>VOTOS</span><br><br>
				          <span class='divDatCantNum'>$prmCantVot</span>";
			$divDat.='</div>';
		$divDat.='</div>';

		$divDat.="<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>";
			$divDat.="<div class='divDatCantF'>";
				$divDat.="<span class='divDatCantTit'>POR VOTAR</span><br><br>
				          <span class='divDatCantNum'>$prmCantFalt</span>";
			$divDat.='</div>';
		$divDat.='</div>';
	$divDat.='</div>';
	return $divDat;
}

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

function constDatII($prmCantPart,$prmCantVot,
				$prmCantFalt,$prmCodCentVot)
{
	$divDat="";
	$divDat="<div class='row'>";
		$divDat.="<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>";
			$divDat.="<div class='divDatCantP'>";
				$divDat.="<span class='divDatCantTit'>VOTANTES</span><br><br>
				          <span class='divDatCantNum'>$prmCantPart</span>";
			$divDat.='</div>';
		$divDat.='</div>';

		if ($_SESSION["idPerf"]==1)
		{
			$divDat.="<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>";
				$divDat.="<a href='../rpt/rptPartEv.php?a=".$prmCodCentVot."' target='_blank'>";
					$divDat.="<div class='divDatCantP'>";
						$divDat.="<span class='divDatCantTit'>VOTOS</span><br><br>
							<span class='divDatCantNum'>$prmCantVot</span>";
					$divDat.='</div>';
				$divDat.="</a'>";
			$divDat.='</div>';

			$divDat.="<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>";
				$divDat.="<a href='../rpt/rptVotFalt.php?a=".$prmCodCentVot."' target='_blank'>";
					$divDat.="<div class='divDatCantP'>";
						$divDat.="<span class='divDatCantTit'>POR VOTAR</span><br><br>
								<span class='divDatCantNum'>$prmCantFalt</span>";
						$divDat.='</div>';
					$divDat.='</div>';
				$divDat.="</a'>";
			$divDat.='</div>';
		}
		if ($_SESSION["idPerf"]==2)
		{
			$divDat.="<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>";
				$divDat.="<div class='divDatCantP'>";
					$divDat.="<span class='divDatCantTit'>VOTOS</span><br><br>
							<span class='divDatCantNum'>$prmCantVot</span>";
				$divDat.='</div>';
			$divDat.='</div>';

			$divDat.="<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>";
					$divDat.="<div class='divDatCantP'>";
						$divDat.="<span class='divDatCantTit'>POR VOTAR</span><br><br>
								<span class='divDatCantNum'>$prmCantFalt</span>";
						$divDat.='</div>';
					$divDat.='</div>';
			$divDat.='</div>';
		}
	return $divDat;
}

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

function constBarr($prmPorcPart,$prmPorcRest,$prmBord)
{
	$divBarr="";
	$divBarr.="<div class='row'>";
		$divBarr.="<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
			$divBarr.="<div class='divBarrPorcPart' style='width:$prmPorcPart%; $prmBord'>"
				.number_format($prmPorcPart, 1, '.', ',').'%';
			$divBarr.="</div>";

			$divBarr.="<div class='divBarrPorcRest' style='width:$prmPorcRest%;'>"
				.number_format($prmPorcRest, 1, '.', ',').'%';
			$divBarr.="</div>";
		$divBarr.="</div>";
	$divBarr.="</div>";
	return $divBarr;
}

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

switch ($prmOp) 
{
	case 'iniFrm':

		$cboParr=""; $rsDatEvCne=Array();
		$rsDatEvCne=$clsSeg->EventCne();
		$cboParr=$clsSeg->cboParr('390');

		$idEvent=$rsDatEvCne[0];
		$nombEvent=$rsDatEvCne[1];
		$fechEvent=$rsDatEvCne[2];
		$_SESSION['idEvent']=$idEvent;

		$date = new DateTime($fechEvent);
		$date->format('d/m/Y');
		
		//$fecha_evento=substr($fecha_evento,8,2).'-'.substr($fecha_evento,5,2).'-'.substr($fecha_evento,0,4);

		$divIni="";
		if ($_SESSION["idPerf"]==1)
		{
			$divPrincEst=""; $divTitEst="";
			$divDatEst=""; $divBarr="";

			$rsDatPartEst=$clsSeg->procPartEst($_SESSION['idEst'],$_SESSION['idEvent']);

			$prmNombEst="CONSOLIDADO EDO. ";
			$prmNombEst.=$rsDatPartEst[1];
			$prmCantPart=$rsDatPartEst[2];
			$prmCantVot=$rsDatPartEst[3];
			//$prmCantVot=1000;

			$unoPorc=$prmCantPart / 100;
			$prmPorcPart=$prmCantVot / $unoPorc;
			$prmPorcRest=100 - $prmPorcPart;
			$prmCantFalt=($prmCantPart - $prmCantVot);

			$prmBord="";
			if (floatval($prmPorcPart)>=8.5)	
			{ 
				$prmBord ='border-left:solid 2px #d2d6de;';
				$prmBord.='border-right:solid 2px #d2d6de;';
				$prmBord.='border-bottom:solid 2px #d2d6de;';	
			}	

			$divPrincEst="<div class='form-group divPrinc'>";
	
				
				$divTitEst=constTit($prmNombEst);
				$divDatEst=constDat($prmCantPart,$prmCantVot,$prmCantFalt);
				$divBarr=constBarr($prmPorcPart,$prmPorcRest,$prmBord);

			$divPrincEst.=$divTitEst.$divDatEst.$divBarr;
			$divPrincEst.="</div>";	

			##################################################################################################
			##################################################################################################

			$rsDatParr=$clsSeg->procPartParrTod($_SESSION['idMun'],$_SESSION['idEvent']);
			$divFinParr="";
			foreach ($rsDatParr as $clave)
			{
				$divPrincParr=""; $divTitParr="";
				$divDatParr=""; $divBarrParr="";

				$prmNombParr=$clave['nombParr'];
				$prmCantVot=$clave['cantVot'];
				$prmCantPart=$clave['cantPart'];

				//$prmCantVot=2000;
				$unoPorc=$prmCantPart / 100;
				$prmPorcPart=$prmCantVot / $unoPorc;
				$prmPorcRest= 100 - $prmPorcPart;
				$prmCantFalt=($prmCantPart - $prmCantVot);

				$prmBord="";
				if ($prmCantVot>=40)	
				{ 
					$prmBord ='border-left:solid 2px #d2d6de;';
					$prmBord.='border-right:solid 2px #d2d6de;';
					$prmBord.='border-bottom:solid 2px #d2d6de;';		
				}		
					
				$divPrincParr="<div class='form-group divPrinc'>";

					$divTitParr=constTit($prmNombParr);
					$divDatParr=constDat($prmCantPart,$prmCantVot,$prmCantFalt);
					$divBarrParr=constBarr($prmPorcPart,$prmPorcRest,$prmBord);

				$divPrincParr.=$divTitParr.$divDatParr.$divBarrParr;
				$divPrincParr.="</div>";
				$divFinParr.=$divPrincParr;
			}
			$divIni=$divPrincEst.$divFinParr;
		}
	    elseif ($_SESSION["idPerf"]==2)
		{
			$divPrincCentVot=""; $divTitCentVot="";
			$divDatCentVot=""; $divBarrCentVot="";
	
			$clave=$clsSeg->procPartCentVot($_SESSION["codCentVot"],$_SESSION['idEvent']);

			$prmCodCentVot=$clave['codCentVot'];
			$prmNombCentVot=$clave['nombCentVot']." (".$clave['codCentVot'].")";
			$prmCantVot=$clave['cantVot'];
			$prmCantPart=$clave['cantPart'];

			//$prmCantVot=200;
			$unoPorc=$prmCantPart / 100;
			$prmPorcPart=$prmCantVot / $unoPorc;
			$prmPorcRest= 100 - $prmPorcPart;
			$prmCantFalt=($prmCantPart - $prmCantVot);

			$prmBord="";
			if ($prmCantVot>=40)	
			{ 
				$prmBord ='border-left:solid 2px #d2d6de;';
				$prmBord.='border-right:solid 2px #d2d6de;';
				$prmBord.='border-bottom:solid 2px #d2d6de;';	
			}		

			$divPrincCentVot="<div class='form-group divPrinc'>";

				$divTitCentVot=constTitInf($prmNombCentVot,$prmCodCentVot);
				$divDatCentVot=constDatII($prmCantPart,$prmCantVot,$prmCantFalt,$prmCodCentVot);
				$divBarrCentVot=constBarr($prmPorcPart,$prmPorcRest,$prmBord);

			$divPrincCentVot.=$divTitCentVot.$divDatCentVot.$divBarrCentVot;
			$divPrincCentVot.="</div>";
			$divIni=$divPrincCentVot;
		}

		$rsDat=array($_SESSION["idPerf"],$_SESSION["idParr"],$nombEvent,$fechEvent,
		$cboParr,$divIni);
		echo json_encode($rsDat);
			
	break;

	case 'procPartTod':

		$divPrincEst=""; $divTitEst="";
		$divDatEst=""; $divBarr="";
		$divIni="";

		$prmIdParr=isset($_POST["prmIdParr"])? $clsGen->limpCad($_POST["prmIdParr"]):"";
		$rsDatPartEst=$clsSeg->procPartEst($_SESSION['idEst'],$_SESSION['idEvent']);

		$prmNombEst="CONSOLIDADO EDO. ";
	    $prmNombEst.=$rsDatPartEst[1];
		$prmCantPart=$rsDatPartEst[2];
		$prmCantVot=$rsDatPartEst[3];
		//$prmCantVot=0;

		$unoPorc=$prmCantPart / 100;
		$prmPorcPart=$prmCantVot / $unoPorc;
		$prmPorcRest=100 - $prmPorcPart;
		$prmCantFalt=($prmCantPart - $prmCantVot);

		$prmBord="";
		if (floatval($prmPorcPart)>=8.5)	
		{ 
			$prmBord ='border-left:solid 2px #d2d6de;';
			$prmBord.='border-right:solid 2px #d2d6de;';
			$prmBord.='border-bottom:solid 2px #d2d6de;';		
		}	

		$divPrincEst="<div class='form-group divPrinc'>";

			$divTitEst=constTit($prmNombEst);
			$divDatEst=constDat($prmCantPart,$prmCantVot,$prmCantFalt);
			$divBarr=constBarr($prmPorcPart,$prmPorcRest,$prmBord);

		$divPrincEst.=$divTitEst.$divDatEst.$divBarr;
		$divPrincEst.="</div>";	

		##################################################################################################
		##################################################################################################

		$rsDatParr=$clsSeg->procPartParrTod($_SESSION['idMun'],$_SESSION['idEvent']);
		$divFinParr="";
		foreach ($rsDatParr as $clave)
		{
			$divPrincParr=""; $divTitParr="";
			$divDatParr=""; $divBarrParr="";

			$prmNombParr=$clave['nombParr'];
			$prmCantVot=$clave['cantVot'];
			$prmCantPart=$clave['cantPart'];

			//$prmCantVot=1000;
			$unoPorc=$prmCantPart / 100;
			$prmPorcPart=$prmCantVot / $unoPorc;
			$prmPorcRest= 100 - $prmPorcPart;
			$prmCantFalt=($prmCantPart - $prmCantVot);

			$prmBord="";
			if ($prmCantVot>=40)	
			{ 
				$prmBord ='border-left:solid 2px #d2d6de;';
				$prmBord.='border-right:solid 2px #d2d6de;';
				$prmBord.='border-bottom:solid 2px #d2d6de;';	
			}		
				
			$divPrincParr="<div class='form-group divPrinc'>";

				$divTitParr=constTit($prmNombParr);
				$divDatParr=constDat($prmCantPart,$prmCantVot,$prmCantFalt);
				$divBarrParr=constBarr($prmPorcPart,$prmPorcRest,$prmBord);

			$divPrincParr.=$divTitParr.$divDatParr.$divBarrParr;
			$divPrincParr.="</div>";
			$divFinParr.=$divPrincParr;
		}
		$divIni=$divPrincEst.$divFinParr;
	    
		$rsDat=array($divIni);
		echo json_encode($rsDat);
			
	break;

	case 'procPartParr':

		$divPrincParr=""; $divTitParr="";
		$divDatParr=""; $divBarrParr="";
		$divIni="";

		$prmIdParr=isset($_POST["prmIdParr"])? $clsGen->limpCad($_POST["prmIdParr"]):"";
		$rsDatParr=$clsSeg->procPartParr($prmIdParr,$_SESSION['idEvent']);

		$prmNombParr=$rsDatParr['prmNombParr'];
		$prmCantVot=$rsDatParr['prmCantVot'];
		$prmCantPart=$rsDatParr['prmCantPart'];

		//$prmCantVot=1000;
		$unoPorc=$prmCantPart / 100;
		$prmPorcPart=$prmCantVot / $unoPorc;
		$prmPorcRest= 100 - $prmPorcPart;
		$prmCantFalt=($prmCantPart - $prmCantVot);

		$prmBord="";
		if ($prmCantVot>=40)	
		{ 
			$prmBord ='border-left:solid 2px #d2d6de;';
			$prmBord.='border-right:solid 2px #d2d6de;';
			$prmBord.='border-bottom:solid 2px #d2d6de;';	
		}		
			
		$divPrincParr="<div class='form-group divPrinc'>";

			$divTitParr=constTit($prmNombParr);
			$divDatParr=constDat($prmCantPart,$prmCantVot,$prmCantFalt);
			$divBarrParr=constBarr($prmPorcPart,$prmPorcRest,$prmBord);

		$divPrincParr.=$divTitParr.$divDatParr.$divBarrParr;
		$divPrincParr.="</div>";

		##################################################################################################
		##################################################################################################

		$rsDatCentVot=$clsSeg->procPartCentVotTod($prmIdParr,$_SESSION['idEvent']);
		$divFinCentVot="";
		foreach ($rsDatCentVot as $clave)
		{
			$divPrincCentVot=""; $divTitCentVot="";
			$divDatCentVot=""; $divBarrCentVot="";

			$prmCodCentVot=$clave['codCentVot'];
			$prmNombCentVot=$clave['nombCentVot']." (".$clave['codCentVot'].")";
			$prmCantVot=$clave['cantVot'];
			$prmCantPart=$clave['cantPart'];

			//$prmCantVot=0;
			$unoPorc=$prmCantPart / 100;
			$prmPorcPart=$prmCantVot / $unoPorc;
			$prmPorcRest= 100 - $prmPorcPart;
			$prmCantFalt=($prmCantPart - $prmCantVot);

			$prmBord="";
			if ($prmCantVot>=40)	
			{ 
				$prmBord ='border-left:solid 2px #d2d6de;';
				$prmBord.='border-right:solid 2px #d2d6de;';
				$prmBord.='border-bottom:solid 2px #d2d6de;';	
			}		

			$divPrincCentVot="<div class='form-group divPrinc'>";

				$divTitCentVot=constTitInf($prmNombCentVot,$prmCodCentVot);
				$divDatCentVot=constDatII($prmCantPart,$prmCantVot,$prmCantFalt,$prmCodCentVot);
				$divBarrCentVot=constBarr($prmPorcPart,$prmPorcRest,$prmBord);

			$divPrincCentVot.=$divTitCentVot.$divDatCentVot.$divBarrCentVot;
			$divPrincCentVot.="</div>";
			$divFinCentVot.=$divPrincCentVot;
	
		}
		$divIni=$divPrincParr.$divFinCentVot;
		echo json_encode($divIni);

	break;

	case 'infEncUbch':
		
		$rsDat=Array();
		$prmCodCentVot=isset($_POST["prmCodCentVot"])? $clsGen->limpCad($_POST["prmCodCentVot"]):"";
		
		$rsDat=$clsSeg->infEncUbch($prmCodCentVot);
		echo json_encode($rsDat);

	break;

	case 'salir':

		$clsGen->cerrar_session();
	break;
}



?> 