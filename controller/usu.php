<?php 
session_start();

require_once "../controller/clsUsu.php";
require_once "../controller/clsGen.php";
require_once "../controller/clsCif.php";

$clsUsu = new clsUsu();
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

		$cboLetRif=$clsUsu->cboLetRif();
		$cboCodTelf=$clsUsu->cboCodTelf();
		list($prmIdEst,$cboEst)=$clsUsu->cboEst();
		list($prmIdMun,$cboMun)=$clsUsu->cboMun($prmIdEst);
		list($prmIdParr,$cboParr)=$clsUsu->cboParr($prmIdMun);
		$cboCentVot=$clsUsu->cboCentVot($prmIdParr);
		$cboLetRif=$clsUsu->cboLetRif();
		$cboPerf=$clsUsu->cboPerf();
		$cboStat=$clsUsu->cboStat();

		$rsDat=array($cboLetRif,$cboCodTelf,$cboEst,$cboMun,
		$cboParr,$cboCentVot,$cboPerf,$cboStat);
		echo json_encode($rsDat);
			
	break;

	case 'listDt':

		$dt=Array();
		$dt=$clsUsu->listUsu();
		echo json_encode($dt);
			
	break;

	case 'busCentVot':

		$cboCentVot="";
		$prmIdParr=isset($_POST["prmIdParr"])? $clsGen->limpCad($_POST["prmIdParr"]):"";
		$cboCentVot=$clsUsu->cboCentVot($prmIdParr);
		echo json_encode($cboCentVot);
			
	break;

	case 'busInfUsu':

		$dt=Array();
		$prmIdUsu=isset($_POST["prmIdUsu"])? $clsGen->limpCad($_POST["prmIdUsu"]):"";
		$dt=$clsUsu->busInfUsu($prmIdUsu);
		echo json_encode($dt);
			
	break;

	case 'validFrm':

		$rsDat=Array(); $valid=0; $msjInf="";
		$prmLetRif=''; $prmLetRif=isset($_POST["prmLetRif"]);
		$prmLetRif=$clsGen->limpCad($_POST["prmLetRif"]);

		$prmCed=isset($_POST["prmCed"]);
		$prmCed=$clsGen->limpCad($_POST["prmCed"]);
		$prmRs=isset($_POST["prmRs"]);
		$prmRs=$clsGen->limpCad($_POST["prmRs"]);

		$prmCodTelf=isset($_POST[" prmCodTelf"]);
		$prmCodTelf=$clsGen->limpCad($_POST["prmCodTelf"]);

		$prmNroTelf=isset($_POST["prmNroTelf"]);
		$prmNroTelf=$clsGen->limpCad($_POST["prmNroTelf"]);

		$prmEmail=isset($_POST["prmEmail"]);
		$prmEmail=$clsGen->limpCad($_POST["prmEmail"]);

		$prmDirec=isset($_POST["prmDirec"]); 
		$prmDirec=$clsGen->limpCad($_POST["prmDirec"]);

		$prmClave=isset($_POST["prmClave"]);
		$prmClave=$clsGen->limpCad($_POST["prmClave"]);
		//$prmClave=$clsCif->encrypClave($prmClave); volver a colocar

		$prmIdEst=isset($_POST["prmIdEst"]);
		$prmIdEst=$clsGen->limpCad($_POST["prmIdEst"]);

		$prmIdMun=isset($_POST["prmIdMun"]);
		$prmIdMun=$clsGen->limpCad($_POST["prmIdMun"]);

		$prmIdParr=isset($_POST["prmIdParr"]);
		$prmIdParr=$clsGen->limpCad($_POST["prmIdParr"]);

		$prmCodCentVot=isset($_POST["prmCodCentVot"]);
		$prmCodCentVot=$clsGen->limpCad($_POST["prmCodCentVot"]);
		
		$prmIdPerf=isset($_POST["prmIdPerf"]);
		$prmIdPerf=$clsGen->limpCad($_POST["prmIdPerf"]);

		$prmIdStat=isset($_POST["prmIdStat"]);
		$prmIdStat=$clsGen->limpCad($_POST["prmIdStat"]);

		//$prmCed=$prmLetRif.str_pad($prmCed,8,"0", STR_PAD_LEFT);
		$prmCed=$prmLetRif.$prmCed;
		$prmTelf=$prmCodTelf.$prmNroTelf;

		$rsDat=$clsUsu->grdActUsu
		(
			$prmCed,
			strtoupper($prmRs),
			$prmTelf,$prmEmail,
			$prmDirec,$prmClave,
			$prmIdEst,$prmIdMun,
			$prmIdParr,$prmCodCentVot,
			$prmIdPerf,$prmIdStat
		);
		echo json_encode($rsDat);
		
	break;

	case 'busInfCed':

		$prmCed=isset($_POST["prmCed"])? $clsGen->limpCad($_POST["prmCed"]):"";
		$rsDat=Array(); $rsDatCed=Array();
		$count="0"; $msjInf="";
		$rsDatCed=$clsRegVot->busInfCed($prmCed);

			//var_dump($rsDatCed);
		$VerfCed=$rsDatCed[0];
		if ($VerfCed==0) 
	    {
			$count="0";
			$rs="";
			$codCentVot="";
			$nombCentVot="";
			$direccion="";
			$msjInf.="Elector / Electora, con el ";
			$msjInf.="Nro. Cedula: \"$prmCed\", no se encuentra ";
			$msjInf.="registrado.";
			$rsDat=array($count,$msjInf,$rs,$nombCentVot,$direccion);
		}
		else if ($VerfCed==1) 
	    {
			$idEst=$rsDatCed[1];
			$idMun=$rsDatCed[2];
			$idParr=$rsDatCed[3];
			$rs=$rsDatCed[4];
			$codCentVot=$rsDatCed[5];
			$nombCentVot=$rsDatCed[6];
			$direccion=$rsDatCed[7];

			$_SESSION['idEst']=$idEst;
			$_SESSION['idMun']=$idMun;
			$_SESSION['idParr']=$idParr;

			if ($_SESSION['codCentVot']!=$codCentVot)
			{
				$count="1";
				$msjInf.="El Elector / Electora: \"$rs\", no perternece";
				$msjInf.=" a este centro de votación.";

			    $rsDat=array($count,$msjInf,$rs,$nombCentVot,$direccion);
			}
			elseif ($_SESSION['codCentVot']==$codCentVot)
			{
				$count="2";
			    $rsDat=array($count,$msjInf,$rs,$nombCentVot,$direccion);
			}
		}
		echo json_encode($rsDat);
			
	break;

	case 'salir':

		$clsGen->cerrar_session();
	break;
}

/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////

function validFrm($prmUsu,$prmClav)
{

	 $valid=1;
	 $nombTxt="";
	 $msjInf="";
	 
	if (empty($prmUsu))
	{
		$msjInf="Ingrese su Usuario.";
		$nombTxt='txt_usuario';
		$valid=0;
	}
	else if (empty($prmClav))
	{
		$msjInf="Ingrese su Clave.";
		$nombTxt='txt_clave';
		$valid=0;
	}

	$rsDat=array($valid,$nombTxt,$msjInf);
	return $rsDat;
}

?> 