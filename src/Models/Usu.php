<?php
namespace App\Models;
require '../../vendor/autoload.php';
use App\Conf\cn;
use PDO;
use PDOException;

class Usu
{
    private $nombUsu;
	private $cn;
	private $exitCn;

	public function __construct()
	{
		$cn=new cn();
        $this->cn=$cn->cnBd();
		$this->exitCn=$cn->descBd();
	}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

public function cboLetRif()
{
	try 
	{  
		$cboDat=""; $val=""; $det="";
		$sql='call spBusLetRif()';
		$cmd = $this->cn->prepare($sql);
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
		$this->exitCn;
		return $cboDat;
	}
	catch (PDOException $e) { echo 'Ha Ocurrido el siguiente error: '.$e->getMessage(); }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

public function cboCodTelf()
{
	try 
	{  
		$cboDat=""; $val=""; $det="";
		$sql='call spListCodTelf()';
		$cmd=$this->cn->prepare($sql);
		$cmd->execute();
		$cmd->setFetchMode(PDO::FETCH_ASSOC);

		while ($rsDat = $cmd->fetch()) 
		{
			$val=$rsDat['nombCodTelf'];
			$det=$rsDat['nombCodTelf'];

			$cboDat.="<option value='".$val."'>";
			$cboDat.=$det;
			$cboDat.="</option>";
		}
		
		$rsDat=null;
		$this->exitCn;
		return $cboDat;
	}
	catch (PDOException $e) { echo 'Ha Ocurrido el siguiente error: '.$e->getMessage(); }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

public function cboPerf()
{
	try 
	{  
		$cboDat=""; $val=""; $det="";
		$sql ='call spListPerf()';
		$cmd=$this->cn->prepare($sql);
		$cmd->execute();
		$cmd->setFetchMode(PDO::FETCH_ASSOC);

		while ($rsDat = $cmd->fetch()) 
		{
			$val=$rsDat['idPerf'];
			$det=$rsDat['nombPerf'];

			$cboDat.="<option value='".$val."'>";
			$cboDat.=$det;
			$cboDat.="</option>";
		}
		
		$rsDat=null;
		$this->exitCn;
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
		$sql='call spListStat()';
		$cmd=$this->cn->prepare($sql);
		$cmd->execute();
		$cmd->setFetchMode(PDO::FETCH_ASSOC);

		while ($rsDat = $cmd->fetch()) 
		{
			$val=$rsDat['idStat'];
			$det=$rsDat['nombStat'];

			$cboDat.="<option value='".$val."'>";
			$cboDat.=$det;
			$cboDat.="</option>";
		}
		$rsDat=null;
		$this->exitCn;
		return $cboDat;
	}
	catch (PDOException $e) { echo 'Ha Ocurrido el siguiente error: ' . $e->getMessage(); }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

public function grdActUsu($prmCed,$prmRs,
							$prmTelf,$prmEmail,
							$prmDirec,$prmClave,
							$prmIdEst,$prmIdMun,
							$prmIdParr,$prmCodCentVot,
							$prmIdPerf,$prmIdStat)
	{
		$rsDat=""; $valid=""; $msjInf="";
		try 
		{  
			$sql='call spGrdActUsu(:prmCed,:prmRs,
									:prmTelf,:prmEmail,
									:prmDirec,:prmClave,
									:prmIdEst,:prmIdMun,
									:prmIdParr,:prmCodCentVot,
									:prmIdPerf,:prmIdStat)';

			$cmd=$this->cn->prepare($sql);
			$cmd->bindParam(':prmCed',$prmCed,PDO::PARAM_STR);
		    $cmd->bindParam(':prmRs',$prmRs,PDO::PARAM_STR);
		    $cmd->bindParam(':prmTelf',$prmTelf,PDO::PARAM_STR);
		    $cmd->bindParam(':prmEmail',$prmEmail,PDO::PARAM_STR);
		    $cmd->bindParam(':prmDirec',$prmDirec,PDO::PARAM_STR);
			$cmd->bindParam(':prmClave',$prmClave,PDO::PARAM_STR);
			$cmd->bindParam(':prmIdEst',$prmIdEst,PDO::PARAM_STR);
			$cmd->bindParam(':prmIdMun',$prmIdMun,PDO::PARAM_STR);
			$cmd->bindParam(':prmIdParr',$prmIdParr,PDO::PARAM_STR);
			$cmd->bindParam(':prmIdMun',$prmIdMun,PDO::PARAM_STR);
		    $cmd->bindParam(':prmCodCentVot',$prmCodCentVot,PDO::PARAM_STR);
			$cmd->bindParam(':prmIdPerf',$prmIdPerf,PDO::PARAM_INT);
		    $cmd->bindParam(':prmIdStat',$prmIdStat,PDO::PARAM_INT);
			$cmd->execute();

			if ($cmd)
			{ 
				$valid='1';
				$msjInf="Usuario regist. / Act. satisfactoriamente.";
			}

			$this->exitCn;
			return $rsDat=array($valid,$msjInf);
		}
		catch (PDOException $e) 
		{ 
			$valid='0';
			$msjInf='Ha Ocurrido el siguiente error:'.$e->getMessage(); 
			return $rsDat=array($valid,$msjInf);
		}
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

public function listUsu()
{
	try 
	{  
		$dt=Array(); $rsDat=""; 
		$sql='call spListUsu()';
		$cmd=$this->cn->prepare($sql);
		$cmd->execute();
		$cmd->setFetchMode(PDO::FETCH_ASSOC);

		while ($rsDat=$cmd->fetch()) 
		{
			$idUsu=$rsDat['idUsu'];	
			$btn='<button type="button" data-toggle="modal"';
			$btn.='  data-target="#responsive-modal"'; 
			$btn.='   class="btn btn-danger"';
			$btn.='  onclick="busInfUsu(\''.$idUsu.'\')">';
			$btn.='<i class="fa fa-edit"></i> ';
			$btn.='</button>';

			$dt['data'][]=array
			(
				"idUsu"=>$btn,
				"rs"=>$rsDat['rs'],
				"ced"=>$rsDat['ced'],
				"telf"=>$rsDat['telf'],
				"email"=>$rsDat['email'],
				"nombPerf"=>$rsDat['nombPerf'],
				"nombStat"=>$rsDat['nombStat']
			);
		}

		$rsDat=null;
		$this->exitCn;
		return $dt; 
	}
	catch (PDOException $e) { echo 'Ha Ocurrido el siguiente error:'.$e->getMessage(); }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function busInfUsu($prmIdUsu)
	{
		try 
		{  
			$msjInf="";
			$sql= 'call spInfUsu(:prmIdUsu)';
			$cmd=$this->cn->prepare($sql);
			$cmd->bindParam(':prmIdUsu',$prmIdUsu,PDO::PARAM_STR);
			$cmd->execute();
			$cmd->setFetchMode(PDO::FETCH_ASSOC);
			$rsDat=$cmd->fetch();

			if  ($rsDat>0) 
			{
				$dt=array
				(
					"letCed"=>$rsDat['letCed'],
					"nroCed"=>$rsDat['nroCed'],
					"rs"=>$rsDat['rs'],
					"codTelf"=>$rsDat['codTelf'],
					"nroTelf"=>$rsDat['nroTelf'],
					"email"=>$rsDat['email'],
					"dir"=>$rsDat['dir'],
					"idEst"=>$rsDat['idEst'],
					"idMun"=>$rsDat['idMun'],
					"idParr"=>$rsDat['idParr'],
					"codCentVot"=>$rsDat['codCentVot'],
					"idPerf"=>$rsDat['idPerf'],
					"idStat"=>$rsDat['idStat']
				);
			}
			
			$rsDat=null;
			$this->exitCn;
			return $dt;
		}
		catch (PDOException $e) { echo 'Ha Ocurrido el siguiente error: ' . $e->getMessage(); }
	}
}
?> 