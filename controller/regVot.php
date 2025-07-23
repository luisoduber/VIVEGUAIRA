<?php 
session_start();

require_once "../controller/clsRegVot.php";
require_once "../controller/clsGen.php";
$clsRegVot=new clsRegVot();
$clsGen = new clsGen();

$prmOp="";
$prmOp=isset($_POST["prmOp"])? $clsGen->limpCad($_POST["prmOp"]):"";

switch ($prmOp) 
{

	case 'iniFrm':

		$cboTipVot=""; $rsDatEvCne=Array();
		$rsDat=Array();
		$cboLetRif=$clsRegVot->cboLetRif();
		$cboTipVot=$clsRegVot->cboTipVot();
		$rsDatEvCne=$clsRegVot->EventCne();

		$idEvent=$rsDatEvCne[0];
		$nombEvent=$rsDatEvCne[1];
		$fechEvent=$rsDatEvCne[2];
		$_SESSION['idEvent']=$idEvent;

		$rsDat=array($nombEvent,$fechEvent,$cboLetRif,$cboTipVot);
		echo json_encode($rsDat);
			
	break;

	case 'valPart':

		$prmCed=isset($_POST["prmCed"])? $clsGen->limpCad($_POST["prmCed"]):"";
		$rsDat=Array(); 
		$rsDatValPart=$clsRegVot->valPart($_SESSION['idEvent'],$prmCed);

		$valPart=$rsDatValPart['valPart'];
		$rsDat=array($valPart);
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

	case 'regPart':

		$prmCed=isset($_POST["prmCed"])? $clsGen->limpCad($_POST["prmCed"]):"";
		$prmIdVot=isset($_POST["prmIdVot"])? $clsGen->limpCad($_POST["prmIdVot"]):"";

		//$rsDatPart=$clsRegVot->verfPart($prmCed,$_SESSION['codCentVot'],$_SESSION['idEvent']);
		//$verfPart=$rsDatPart[0];
		$rDat="";
		$msjInf="";
		$count="0";

		$rs="";
		$codCent="";
		$nombCent="";
		$direccion="";
		$idPart="";

	    	$rsDatRegPart="";
	    	$rsDatRegPart=$clsRegVot->grdPart($_SESSION['idEst'],$_SESSION['idMun'],
											$_SESSION['idParr'],$_SESSION['codCentVot'],
											$prmCed,$_SESSION['idEvent'],
											$prmIdVot);

			$valid=$rsDatRegPart[0];
			$msjInf=$rsDatRegPart[1];

			$rsDat=array($valid,$msjInf);
			echo json_encode($rsDat);
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