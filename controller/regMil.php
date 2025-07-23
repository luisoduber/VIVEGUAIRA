<?php 
session_start();

require_once "../controller/clsRegMil.php";
require_once "../controller/clsGen.php";
require_once "../controller/clsCif.php";

$clsRegMil= new clsRegMil();
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

		$cboLetRif=$clsRegMil->cboLetRif();
		$cboCodTelf=$clsRegMil->cboCodTelf();
		list($prmIdParr,$cboParr)=$clsRegMil->cboParr(390);
		$cboCentVot=$clsRegMil->cboCentVot($prmIdParr);
		$cboCom=$clsRegMil->cboCom($prmIdParr);
		$cboLetRif=$clsRegMil->cboLetRif();
		$cboStat=$clsRegMil->cboStat();

		$rsDat=array($cboLetRif,$cboCodTelf,                  
		$cboParr,$cboCentVot,$cboCom,$cboStat);
		echo json_encode($rsDat);
			
	break;

	case 'listDt':

		$dt=Array();
		$prmIdJef=isset($_POST["prmIdJef"])? $clsGen->limpCad($_POST["prmIdJef"]):"";
		$dt=$clsRegMil->listMil($prmIdJef);
		echo json_encode($dt);
			
	break;

	case 'busCentVot':

		$cboCentVot="";
		$prmIdParr=isset($_POST["prmIdParr"])? $clsGen->limpCad($_POST["prmIdParr"]):"";
		$cboCentVot=$clsRegMil->cboCentVot($prmIdParr);
		echo json_encode($cboCentVot);
			
	break;

	
	case 'listCom':

		$cboCom="";
		$prmIdParr=isset($_POST["prmIdParr"])? $clsGen->limpCad($_POST["prmIdParr"]):"";
		$cboCom=$clsRegMil->cboCom($prmIdParr);
		echo json_encode($cboCom);
			
	break;

	case 'busInfMil':

		$dt=Array();
		$prmIdMil=isset($_POST["prmIdMil"])? $clsGen->limpCad($_POST["prmIdMil"]):"";
		$dt=$clsRegMil->busInfMil($prmIdMil);
		echo json_encode($dt);
			
	break;

	case 'validFrm':

		$rsDat=Array(); $valid=0; $msjInf="";
		$prmLetRif=''; $prmLetRif=isset($_POST["prmLetRif"]);
		$prmLetRif=$clsGen->limpCad($_POST["prmLetRif"]);

		$prmIdJef=isset($_POST["prmIdJef"]);
		$prmIdJef=$clsGen->limpCad($_POST["prmIdJef"]);

		$prmIdMil=isset($_POST["prmIdMil"]);
		$prmIdMil=$clsGen->limpCad($_POST["prmIdMil"]);

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

		$prmEmail=isset($_POST["prmEmail"]);
		$prmEmail=$clsGen->limpCad($_POST["prmEmail"]);

		$prmIdStat=isset($_POST["prmIdStat"]);
		$prmIdStat=$clsGen->limpCad($_POST["prmIdStat"]);

		//$prmCed=$prmLetRif.str_pad($prmCed,8,"0", STR_PAD_LEFT);
		$prmCed=$prmLetRif.$prmCed;
		$prmTelf=$prmCodTelf.$prmNroTelf;

		
		$rsDat=$clsRegMil->VerfMilJef($prmIdJef,$prmCed);
		$validMilJef=$rsDat['validMil'];

		$rsDat=$clsRegMil->busCantMil($prmIdJef);
		$validMil=$rsDat['validMil'];

		if ($prmIdMil==0)
		{
			if ($validMilJef==1)
			{
					$valid='0';
					$msjInf=" El jefe de 1 x 10 no puede, ";
					$msjInf.=" ser militantes del mismo.";
					$rsDat=array($valid,$msjInf);
			}
			elseif ($validMil==1)
			{
					$valid='0';
					$msjInf="Ya se a alcanzado la cantidad maxima, ";
					$msjInf.=" de militantes del 1 x 10.";
					$rsDat=array($valid,$msjInf);
			}
			else
			{
				$rsDat=$clsRegMil->grdActMIl
				(	
					$prmIdJef,
					$prmIdMil,
					$prmCed,
					strtoupper($prmRs),
					$prmTelf,
					$prmDirec,
					$prmIdParr,
					$prmCodCentVot,
					$prmIdCom,
					$prmEmail,
					$prmIdStat
				);
			}
		}
		if ($prmIdMil>0)
		{
			$rsDat=$clsRegMil->grdActMIl
			(	
				$prmIdJef,
				$prmIdMil,
				$prmCed,
				strtoupper($prmRs),
				$prmTelf,
				$prmDirec,
				$prmIdParr,
				$prmCodCentVot,
				$prmIdCom,
				$prmEmail,
				$prmIdStat
			);
		}

		
	
		echo json_encode($rsDat);
	
	break;

/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////

	case 'busInfJefCed':

		$prmCed=isset($_POST["prmCed"])? $clsGen->limpCad($_POST["prmCed"]):"";
		$rsDat=Array(); $rsDatCed=Array();
		$count="0"; $msjInf="";
		$rsDatCed=$clsRegMil->busInfCedJef($prmCed);

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