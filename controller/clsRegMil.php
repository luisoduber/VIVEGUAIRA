
<?php 
require "../config/conexion.php";
class clsRegMil
{
    private $idEst;
	private $idMun;
	private $idParr;

	public function __construct()
	{

	}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

public function cboLetRif()
{
	try 
	{  
		$cboDat=""; $val=""; $det="";
		$clsCn=new conexion();
		$cn=$clsCn->cnBd();
		$sql='call spBusLetRif()';
		$cmd=$cn->prepare($sql);
		$cmd->execute();
		$cmd->setFetchMode (PDO::FETCH_ASSOC);

		while ($rsDat = $cmd->fetch()) 
		{
			$val=$rsDat['nombLet'];
			$det=$rsDat['nombLet'];

			$cboDat.="<option value='".$val."'>";
			$cboDat.=$det;
			$cboDat.="</option>";
		}
		
		$rsDat=null;
		$clsCn->descBd();
		return $cboDat;
	}
	catch (PDOException $e) { echo 'Ha Ocurrido el siguiente error: ' . $e->getMessage(); }
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

public function cboCodTelf()
{
	try 
	{  
		$cboDat=""; $val=""; $det="";
		$clsCn=new conexion();
		$cn=$clsCn->cnBd();
		$sql='call spListCodTelf()';
		$cmd=$cn->prepare($sql);
		$cmd->execute();
		$cmd->setFetchMode (PDO::FETCH_ASSOC);

		while ($rsDat = $cmd->fetch()) 
		{
			$val=$rsDat['nombCodTelf'];
			$det=$rsDat['nombCodTelf'];

			$cboDat.="<option value='".$val."'>";
			$cboDat.=$det;
			$cboDat.="</option>";
		}
		
		$rsDat=null;
		$clsCn->descBd();
		return $cboDat;
	}
	catch (PDOException $e) { echo 'Ha Ocurrido el siguiente error: ' . $e->getMessage(); }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

public function cboStat()
{
	try 
	{  
		$cboDat=""; $val=""; $det="";
		$clsCn=new conexion();
		$cn=$clsCn->cnBd();
		$sql='call spListStat()';
		$cmd=$cn->prepare($sql);
		$cmd->execute();
		$cmd-> setFetchMode (PDO::FETCH_ASSOC);

		while ($rsDat = $cmd->fetch()) 
		{
			$val=$rsDat['idStat'];
			$det=$rsDat['nombStat'];

			$cboDat.="<option value='".$val."'>";
			$cboDat.=$det;
			$cboDat.="</option>";
		}
		$rsDat=null;
		$clsCn->descBd();
		return $cboDat;
	}
	catch (PDOException $e) { echo 'Ha Ocurrido el siguiente error: ' . $e->getMessage(); }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

public function cboParr($prmIdMun)
{
	try 
	{  
		$cboDat=""; $val=""; $det="";
		$clsCn = new conexion();
		$cn=$clsCn->cnBd();
		$sql='call spListParr(:prmIdMun)';
		$cmd=$cn->prepare($sql);
		
		$cmd ->bindParam(':prmIdMun',$prmIdMun,PDO::PARAM_STR);
		$cmd->execute();
		$cmd->setFetchMode (PDO::FETCH_ASSOC);

		$i=0;
		while ($rsDat = $cmd->fetch()) 
		{
			$i++;
			$val= $rsDat['idParr'];
			$det=$rsDat['nombParr'];
			if ($i==1) { $this->idParr=$rsDat['idParr']; }

			$cboDat.="<option value='".$val."'>";
			$cboDat.=$det;
			$cboDat.="</option>";
		  }
		
		$rsDat=null;
		$clsCn->descBd();
		$rsDat=array($this->idParr,$cboDat);
		return $rsDat;
	}
	catch (PDOException $e) { echo 'Ha Ocurrido el siguiente error: ' . $e->getMessage(); }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

public function cboCom($prmIdParr)
{
	try 
	{  
		$cboDat=""; $val=""; $det="";
		$clsCn = new conexion();
		$cn=$clsCn->cnBd();
		$sql='call spListCom(:prmIdParr)';
		$cmd=$cn->prepare($sql);
		$cmd ->bindParam(':prmIdParr',$prmIdParr,PDO::PARAM_INT);
		$cmd->execute();
		$cmd->setFetchMode (PDO::FETCH_ASSOC);

		$i=0;
		while ($rsDat = $cmd->fetch()) 
		{
			$i++;
			$val= $rsDat['idCom'];
			$det=$rsDat['nombCom'];
			if ($i==1) { $this->idParr=$rsDat['idCom']; }

			$cboDat.="<option value='".$val."'>";
			$cboDat.=$det;
			$cboDat.="</option>";
		  }
		
		$rsDat=null;
		$clsCn->descBd();
		$rsDat=array($this->idParr,$cboDat);
		return $rsDat;
	}
	catch (PDOException $e) { echo 'Ha Ocurrido el siguiente error: ' . $e->getMessage(); }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

public function cboCentVot($prmIdParr)
{
	try 
	{  
		$cboDat=""; $val=""; $det="";
		$clsCn = new conexion();
		$cn=$clsCn->cnBd();
		$sql='call spListInst(:prmIdParr)';
		$cmd=$cn->prepare($sql);
		$cmd->bindParam(':prmIdParr',$prmIdParr,PDO::PARAM_STR);
		$cmd->execute();
		$cmd->setFetchMode (PDO::FETCH_ASSOC);

		while ($rsDat = $cmd->fetch()) 
		{
			$val= $rsDat['codCentVot'];
			$det=$rsDat['nombCentVot'];

			$cboDat.="<option value='".$val."'>";
			$cboDat.=$det;
			$cboDat.="</option>";
		}
		
		$rsDat=null;
		$clsCn->descBd();
		return $cboDat;
	}
	catch (PDOException $e) { echo 'Ha Ocurrido el siguiente error: ' . $e->getMessage(); }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

public function grdActMil(	$prmIdJef,$prmIdMil,
							$prmCed,$prmRs,
							$prmTelf,$prmDirec,
							$prmIdParr,$prmCodCentVot,
							$prmIdCom,$prmEmail,
							$prmIdStat)
	{
		$rsDat=""; $valid=""; $msjInf="";
		try 
		{  
			$clsCn=new conexion();
			$cn=$clsCn->cnBd();
			$sql='call spGrdActMil(:prmIdJef,:prmIdMil,
									:prmCed,:prmRs,
									:prmTelf,
									:prmDirec,
									:prmIdParr,:prmCodCentVot,
									:prmIdCom,:prmEmail,
									:prmIdStat)';

			$command= $cn->prepare($sql);
			$command->bindParam(':prmIdJef',$prmIdJef,PDO::PARAM_INT);
			$command->bindParam(':prmIdMil',$prmIdMil,PDO::PARAM_INT);
			$command->bindParam(':prmCed',$prmCed,PDO::PARAM_STR);
		    $command->bindParam(':prmRs',$prmRs,PDO::PARAM_STR);
		    $command->bindParam(':prmTelf',$prmTelf,PDO::PARAM_STR);
		    $command->bindParam(':prmDirec',$prmDirec,PDO::PARAM_STR);
			$command->bindParam(':prmIdParr',$prmIdParr,PDO::PARAM_STR);
		    $command->bindParam(':prmCodCentVot',$prmCodCentVot,PDO::PARAM_STR);
			$command->bindParam(':prmIdCom',$prmIdCom,PDO::PARAM_STR);
			$command->bindParam(':prmEmail',$prmEmail,PDO::PARAM_STR);
		    $command->bindParam(':prmIdStat',$prmIdStat,PDO::PARAM_INT);
			$command->execute();

			if ($command)
			{ 
				$valid='1';
				$msjInf="Militante 1 x 10, regist. / Act. satisfactoriamente.";
			}

			$clsCn->descBd();
			return $rsDat=array($valid,$msjInf);
		}
		catch (PDOException $e) 
		{ 
			//$codErr=$e->getCode(); 
			$msjErr=$e->getMessage();
			$msjBusqCed=""; $msjBusqTelf="";
			$msjBusqTelf="for key 'militantes.telf'";
			$msjBusqCed="for key 'militantes.ced'";

			$rsBusqCed=strpos($msjErr,$msjBusqCed);
			$rsBusqTelf=strpos($msjErr,$msjBusqTelf);
			
			if ($rsBusqCed==true) 
			{ 
				$msjInf.='Ha Ocurrido el siguiente error:';
				$msjInf.=" El Nro. de cedula: ".$prmCed; 
				$msjInf.=" ya se encuentra registrado.";  
			}
			else if ($rsBusqTelf==true) 
			{ 
				$msjInf.='Ha Ocurrido el siguiente error:';
				$msjInf.=" El Nro. de telf: ".$prmTelf; 
				$msjInf.=" ya se encuentra registrado."; 
			}
			else { $msjInf='Ha Ocurrido el siguiente error:'.$e->getMessage(); }
			$valid='0';
			return $rsDat=array($valid,$msjInf);
		}
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

public function listMil($prmIdJef)
{
	try 
	{  
		
		$dt=Array(); $rsDat=""; 
		$clsCn=new conexion();
		$cn=$clsCn->cnBd();
		$sql='call spListMil(:prmIdJef)';
		$command=$cn->prepare($sql);
		$command->bindParam(':prmIdJef',$prmIdJef,PDO::PARAM_INT);
		$command->execute();
		$command->setFetchMode(PDO::FETCH_ASSOC);

		while ($rsDat=$command->fetch()) 
		{
			$idMil=$rsDat['idMil'];	

			$btn='<span style="padding:0px 2px;">';
			$btn.='<button type="button" data-toggle="modal"';
			$btn.='  data-target="#responsive-modal"'; 
			$btn.='   class="btn-danger"';
			$btn.='  onclick="busInfJef(\''.$idMil.'\')">';
			$btn.='<i class="fa fa-edit"></i> ';
			$btn.='</button>';
			$btn.='</span>';

			$dt['data'][]=array
			(
				"idMil"=>$btn,
				"rs"=>$rsDat['rs'],
				"ced"=>$rsDat['ced'],
				"nombParr"=>$rsDat['nombParr'],
				"nombCentVot"=>$rsDat['nombCentVot'],
				"nombCom"=>$rsDat['nombCom'],
				"dir"=>$rsDat['dir'],
				"telf"=>$rsDat['telf'],
				"nombStat"=>$rsDat['nombStat']
			);
		}

		$rsDat=null;
		$clsCn->descBd();
		return $dt; 
	}
	catch (PDOException $e) { echo 'Ha Ocurrido el siguiente error:'.$e->getMessage(); }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function busInfMil($prmIdMil)
	{
		try 
		{  
			$msjInf="";
			$clsCn=new conexion();
			$cn=$clsCn->cnBd();
			$sql= 'call spInfMil(:prmIdMil)';
			$cmd=$cn->prepare($sql);
			$cmd->bindParam(':prmIdMil',$prmIdMil,PDO::PARAM_STR);
			$cmd->execute();
			$cmd->setFetchMode(PDO::FETCH_ASSOC);
			$rsDat=$cmd->fetch();

			if  ($rsDat>0) 
			{
				$dt=array
				(
					"idMil"=>$rsDat['idMil'],
					"letCed"=>$rsDat['letCed'],
					"nroCed"=>$rsDat['nroCed'],
					"rs"=>$rsDat['rs'],
					"codTelf"=>$rsDat['codTelf'],
					"nroTelf"=>$rsDat['nroTelf'],
					"dir"=>$rsDat['dir'],
					"idParr"=>$rsDat['idParr'],
					"codCentVot"=>$rsDat['codCentVot'],
					"idCom"=>$rsDat['idCom'],
					"email"=>$rsDat['email'],
					"idStat"=>$rsDat['idStat']
				);
			}
			
			$rsDat=null;
			$clsCn->descBd();
			return $dt;
		}
		catch (PDOException $e) { echo 'Ha Ocurrido el siguiente error: ' . $e->getMessage(); }
	}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function busCantMil($prmIdJef)
	{
		try 
		{  
			$msjInf="";
			$clsCn=new conexion();
			$cn=$clsCn->cnBd();
			$sql= 'call spVerfCantMil(:prmIdJef)';
			$cmd=$cn->prepare($sql);
			$cmd->bindParam(':prmIdJef',$prmIdJef,PDO::PARAM_STR);
			$cmd->execute();
			$cmd->setFetchMode(PDO::FETCH_ASSOC);
			$rsDat=$cmd->fetch();

			if  ($rsDat>0) 
			{
				$dt=array
				(
					"validMil"=>$rsDat['validMil']
				);
			}
			
			$rsDat=null;
			$clsCn->descBd();
			return $dt;
		}
		catch (PDOException $e) { echo 'Ha Ocurrido el siguiente error: ' . $e->getMessage(); }
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

public function VerfMilJef($prmIdJef,$prmCedMil)
{
	try 
	{  
		$msjInf="";
		$clsCn=new conexion();
		$cn=$clsCn->cnBd();
		$sql= 'call spVerfMilJef(:prmIdJef,:prmCedMil)';
		$cmd=$cn->prepare($sql);
		$cmd->bindParam(':prmIdJef',$prmIdJef,PDO::PARAM_INT);
		$cmd->bindParam(':prmCedMil',$prmCedMil,PDO::PARAM_STR);
		$cmd->execute();
		$cmd->setFetchMode(PDO::FETCH_ASSOC);
		$rsDat=$cmd->fetch();

		if  ($rsDat>0) 
		{
			$dt=array
			(
				"validMil"=>$rsDat['validMil']
			);
		}
		
		$rsDat=null;
		$clsCn->descBd();
		return $dt;
	}
	catch (PDOException $e) { echo 'Ha Ocurrido el siguiente error: ' . $e->getMessage(); }
}



}
?> 