<?php 
session_start();

require_once "../controller/clsRegJef.php";
require_once "../controller/clsGen.php";
require_once "../controller/clsCif.php";

$clsRegJef = new clsRegJef();
$clsGen = new clsGen();
$clsCif = new clsCif();

$prmOp="";
$prmOp=isset($_POST["prmOp"])? $clsGen->limpCad($_POST["prmOp"]):"";

switch ($prmOp) 
{

	case 'iniFrm':

		$cboLetRif=""; $cboCodTelf="";
		$cboEst=""; $prmIdEst="";
		$cboMun=""; $prmIdMun="";
		$cboParr=""; $prmIdParr="";
		$cboCentVot=""; $cboPerf="";
		$cboStat=""; $rsDat=Array();

		$cboLetRif=$clsRegJef->cboLetRif();
		$cboCodTelf=$clsRegJef->cboCodTelf();
		list($prmIdParr,$cboParr)=$clsRegJef->cboParr(390);
		$cboCentVot=$clsRegJef->cboCentVot($prmIdParr);
		$cboCom=$clsRegJef->cboCom($prmIdParr);
		$cboLetRif=$clsRegJef->cboLetRif();
		$cboStat=$clsRegJef->cboStat();

		$rsDat=array($cboLetRif,$cboCodTelf,                  
		$cboParr,$cboCentVot,$cboCom,$cboStat);
		echo json_encode($rsDat);
			
	break;

	case 'listDt':

		$dt=Array();
		$dt=$clsRegJef->listJef();
		echo json_encode($dt);
			
	break;

	case 'busCentVot':

		$cboCentVot="";
		$prmIdParr=isset($_POST["prmIdParr"])? $clsGen->limpCad($_POST["prmIdParr"]):"";
		$cboCentVot=$clsRegJef->cboCentVot($prmIdParr);
		echo json_encode($cboCentVot);
			
	break;

	case 'listCom':

		$cboCom="";
		$prmIdParr=isset($_POST["prmIdParr"])? $clsGen->limpCad($_POST["prmIdParr"]):"";
		$cboCom=$clsRegJef->cboCom($prmIdParr);
		echo json_encode($cboCom);
			
	break;

	case 'busInfJef':

		$dt=Array();
		$prmIdJef=isset($_POST["prmIdJef"])? $clsGen->limpCad($_POST["prmIdJef"]):"";
		$dt=$clsRegJef->busInfJef($prmIdJef);
		echo json_encode($dt);
			
	break;

	case 'validFrm':

		$rsDat=Array(); $valid=0; $msjInf="";
		$prmLetRif=''; $prmLetRif=isset($_POST["prmLetRif"]);
		$prmLetRif=$clsGen->limpCad($_POST["prmLetRif"]);

		$prmIdJef=isset($_POST["prmIdJef"]);
		$prmIdJef=$clsGen->limpCad($_POST["prmIdJef"]);

		$prmCed=isset($_POST["prmCed"]);
		$prmCed=$clsGen->limpCad($_POST["prmCed"]);

		$prmRs=isset($_POST["prmRs"]);
		$prmRs=$clsGen->limpCad($_POST["prmRs"]);

		$prmCodTelf=isset($_POST[" prmCodTelf"]);
		$prmCodTelf=$clsGen->limpCad($_POST["prmCodTelf"]);

		$prmNroTelf=isset($_POST["prmNroTelf"]);
		$prmNroTelf=$clsGen->limpCad($_POST["prmNroTelf"]);

		$prmDirec=isset($_POST["prmDirec"]); 
		$prmDirec=$clsGen->limpCad($_POST["prmDirec"]);

		$prmIdParr=isset($_POST["prmIdParr"]);
		$prmIdParr=$clsGen->limpCad($_POST["prmIdParr"]);

		$prmCodCentVot=isset($_POST["prmCodCentVot"]);
		$prmCodCentVot=$clsGen->limpCad($_POST["prmCodCentVot"]);

		$prmIdCom=isset($_POST["prmIdCom"]);
		$prmIdCom=$clsGen->limpCad($_POST["prmIdCom"]);

		$prmIdStat=isset($_POST["prmIdStat"]);
		$prmIdStat=$clsGen->limpCad($_POST["prmIdStat"]);

		//$prmCed=$prmLetRif.str_pad($prmCed,8,"0", STR_PAD_LEFT);
		$prmCed=$prmLetRif.$prmCed;
		$prmTelf=$prmCodTelf.$prmNroTelf;

		$rsDat=$clsRegJef->grdActJef
		(	
			$prmIdJef,
			$prmCed,
			strtoupper($prmRs),
			$prmTelf,
			$prmDirec,
			$prmIdParr,
			$prmCodCentVot,
			$prmIdCom,
			$prmIdStat
		);
		echo json_encode($rsDat);
		
	break;

/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////

	case 'busInfJefCed':

		$prmCed=isset($_POST["prmCed"])? $clsGen->limpCad($_POST["prmCed"]):"";
		$rsDat=Array(); $rsDatCed=Array();
		$count="0"; $msjInf="";
		$rsDatCed=$clsRegJef->busInfCedJef($prmCed);

			//var_dump($rsDatCed);
		$VerfCed=$rsDatCed['idVerf'];
		if ($VerfCed==0) 
	    {
			$count="0";
			$rs="";
			$idParr=0;
			$codCentVot="";
			$msjInf.="El Nro. Cedula: \"$prmCed\", no se ";
			$msjInf.="encuentra  registrado.";
			$rsDat=array($count,$msjInf,$rs,$idParr,$codCentVot);
		}
		else if ($VerfCed==1) 
	    {
			$count="1";
			$rs=$rsDatCed['rs'];
			$idParr=$rsDatCed['idParr'];
			$codCentVot=$rsDatCed['codCentVot'];
			$msjInf="";
			$rsDat=array($count,$msjInf,$rs,$idParr,$codCentVot);
		}
		echo json_encode($rsDat);
			
	break;

	case 'salir':

		$clsGen->cerrar_session();
	break;
}

/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////


?> 