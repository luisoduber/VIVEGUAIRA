<?php 
require  '../../vendor/autoload.php';
use App\Models\Log;
use App\Controllers\Gen;
$clsLog=new Log();
$clsGen=new Gen();
session_start();

$prmOp="";
$prmOp=isset($_POST["prmOp"])? $clsGen->limpCad($_POST["prmOp"]):"";

switch ($prmOp) 
{
	case 'log':
		$prm_usuario=""; $prm_clave="";
		$validar=0; $nomb_txt="0"; $msj_info="";

		$prmUsu=isset($_POST["prmUsu"])? $clsGen->limpCad($_POST["prmUsu"]):"";
		$prmClav=isset($_POST["prmClav"])? $clsGen->limpCad($_POST["prmClav"]):"";

		list($valid,$nombTxt,$msjInf)=validFrm($prmUsu,$prmClav);

		if ($valid==0) 
		{
			$rsDat=array($valid,$nombTxt,$msjInf);
			echo json_encode($rsDat);
		}
		else if ($valid==1) 
		{
			$rsDatLog=Array();
			$claveBd=""; $idPerf=""; $idStat="";
			$rsDatLog=$clsLog->verfLog($prmUsu);
			if ($rsDatLog['idUsu']=="") 
			{
				$valid=0;
				$nombTxt='txt_usuario';
				$msjInf="El Usuario es incorrecto.";

				$rsDat=array($valid,$nombTxt,$msjInf);
				echo json_encode($rsDat);
			}

			elseif ($rsDatLog['idUsu']!="") 
			{
				$claveBd=$rsDatLog['clave'];
				$idUsu=$rsDatLog['idUsu'];
				$idPerf=$rsDatLog['idPerf'];
				$idStat=$rsDatLog['idStat'];
		
				if (password_verify($prmClav,$claveBd))
				{

					if ($idStat==1) 
					{
						$_SESSION["idUsu"]=$rsDatLog['idUsu'];
						$_SESSION["nombUsu"]=strtoupper($prmUsu);
						$_SESSION["usuario"]=$rsDatLog['rs'];
						$_SESSION["nombPerf"]=$rsDatLog['nombPerf'];
						$_SESSION["idPerf"]=$rsDatLog['idPerf'];

						$valid=1;

						$rsDat=array($valid,$idPerf,$msjInf);
						echo json_encode($rsDat);
					}

					else if ($idStat==2) 
					{
						$valid=0;
						$nombTxt="0";
						$msjInf="Usuario Inactivo.";

						$rsDat=array($valid,$nombTxt,$msjInf);
						echo json_encode($rsDat);
					}
				}
				else 
				{
					$valid=0;
					$nombTxt='txt_clave';
					$msjInf="La Clave es incorrecta.";

					$rsDat=array($valid,$nombTxt,$msjInf);
					echo json_encode($rsDat);
				}
			}
		}

	break;

	case 'salir':
	{
		$clsGen->cerrar_session();
	}
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