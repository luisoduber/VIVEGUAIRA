<?php
require "../config/conexion.php";
class clsRpt
{
	public function __construct()
	{

	}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function InfVotFalt($prmCodCentVot,$prmIdEv)
	{
		try 
		{  
			$msjInf="";
			$clsCn = new conexion();
			$cn=$clsCn->cnBd();
			$sql = 'call spInfVotFalt(:prmCodCentVot,:prmIdEv)';
			$cmd = $cn->prepare($sql);
			$cmd ->bindParam(':prmCodCentVot',$prmCodCentVot,PDO::PARAM_STR);
			$cmd ->bindParam(':prmIdEv',$prmIdEv,PDO::PARAM_INT);
			$cmd->execute();
			$cmd-> setFetchMode(PDO::FETCH_ASSOC);
			
			while ($rsDat = $cmd->fetch()) 
			{
				$dt[]=array
				(
					"ced"=>$rsDat['ced'],
					"rs"=>$rsDat['rs'],
					"edad"=>$rsDat['edad'],
					"nombParr"=>$rsDat['nombParr']
				);
			}
			
			$rsDat=null;
			$clsCn-> descBd();
			return $dt;
		}
		catch (PDOException $e) { echo 'Ha Ocurrido el siguiente error: ' . $e->getMessage(); }
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function InfPartEv($prmIdEv,$prmCodCentVot)
	{
		try 
		{
			$msjInf="";
			$clsCn = new conexion();
			$cn=$clsCn->cnBd();
			$sql = 'call spBusPartEv(:prmIdEv,:prmCodCentVot)';
			$cmd = $cn->prepare($sql);
			$cmd ->bindParam(':prmIdEv',$prmIdEv,PDO::PARAM_INT);
			$cmd ->bindParam(':prmCodCentVot',$prmCodCentVot,PDO::PARAM_STR);
			$cmd->execute();
			$cmd-> setFetchMode(PDO::FETCH_ASSOC);
			
			while ($rsDat = $cmd->fetch()) 
			{
				$dt[]=array
				(
					"ced"=>$rsDat['ced'],
					"rs"=>$rsDat['rs'],
					"edad"=>$rsDat['edad'],
					"nombParr"=>$rsDat['nombParr'],
					"horReg"=>$rsDat['horReg']
				);
			}
			$rsDat=null;
			$clsCn-> descBd();
			return $dt;
		}
		catch (PDOException $e) { echo 'Ha Ocurrido el siguiente error: ' . $e->getMessage(); }
	}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function ListRptMil($prmIdJef)
	{
		try 
		{
			$msjInf="";
			$clsCn = new conexion();
			$cn=$clsCn->cnBd();
			$sql = 'call spListRptMil(:prmIdJef)';
			$cmd = $cn->prepare($sql);
			$cmd ->bindParam(':prmIdJef',$prmIdJef,PDO::PARAM_INT);
			$cmd->execute();
			$cmd-> setFetchMode(PDO::FETCH_ASSOC);
			
			while ($rsDat = $cmd->fetch()) 
			{
				$dt[]=array
				(
					"rs"=>$rsDat['rs'],
					"ced"=>$rsDat['ced'],
					"telf"=>$rsDat['telf'],
					"nombMun"=>$rsDat['nombMun'],
					"nombParr"=>$rsDat['nombParr'],
					"nombCentVot"=>$rsDat['nombCentVot']
				);
			}
			$rsDat=null;
			$clsCn-> descBd();
			return $dt;
		}
		catch (PDOException $e) { echo 'Ha Ocurrido el siguiente error: ' . $e->getMessage(); }
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function infJefRpt($prmIdJef)
	{
		try 
		{  
			$msjInf="";
			$clsCn=new conexion();
			$cn=$clsCn->cnBd();
			$sql= 'call spInfJefRpt(:prmIdJef)';
			$cmd=$cn->prepare($sql);
			$cmd->bindParam(':prmIdJef',$prmIdJef,PDO::PARAM_INT);
			$cmd->execute();
			$cmd->setFetchMode(PDO::FETCH_ASSOC);
			$rsDat=$cmd->fetch();

			if  ($rsDat>0) 
			{
				$dt=array
				(
					"nombEst"=>$rsDat['nombEst'],
					"nombMun"=>$rsDat['nombMun'],
					"nombParr"=>$rsDat['nombParr'],
					"codCentVot"=>$rsDat['codCentVot'],
					"nombCentVot"=>$rsDat['nombCentVot'],
					"rs"=>$rsDat['rs'],
					"ced"=>$rsDat['ced']
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

	public function ListMilJefTod()
	{
		try 
		{
			$msjInf="";
			$clsCn = new conexion();
			$cn=$clsCn->cnBd();
			$sql = 'call spListMilJefTod()';
			$cmd = $cn->prepare($sql);
			$cmd->execute();
			$cmd-> setFetchMode(PDO::FETCH_ASSOC);
			
			while ($rsDat = $cmd->fetch()) 
			{
				$dt[]=array
				(
					"rs"=>$rsDat['rs'],
					"ced"=>$rsDat['ced'],
					"telf"=>$rsDat['telf'],
					"nombParr"=>$rsDat['nombParr'],
					"nombCom"=>$rsDat['nombCom'],
					"rsMil"=>$rsDat['rsMil'],
					"cedMil"=>$rsDat['cedMil'],
					"telfMil"=>$rsDat['telfMil'],
					"nombParrMil"=>$rsDat['nombParrMil'],
					"nombComMil"=>$rsDat['nombComMil']
				);
			}
			$rsDat=null;
			$clsCn-> descBd();
			return $dt;
		}
		catch (PDOException $e) { echo 'Ha Ocurrido el siguiente error: ' . $e->getMessage(); }
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function ListJefTod()
	{
		try 
		{
			$msjInf="";
			$clsCn = new conexion();
			$cn=$clsCn->cnBd();
			$sql = 'call spListJefTod()';
			$cmd = $cn->prepare($sql);
			$cmd->execute();
			$cmd-> setFetchMode(PDO::FETCH_ASSOC);
			
			while ($rsDat = $cmd->fetch()) 
			{
				$dt[]=array
				(
					"rs"=>$rsDat['rs'],
					"ced"=>$rsDat['ced'],
					"telf"=>$rsDat['telf'],
					"nombParr"=>$rsDat['nombParr'],
					"nombCentVot"=>$rsDat['nombCentVot'],
					"nombCom"=>$rsDat['nombCom'],
					"dir"=>$rsDat['dir'],
					"nombStat"=>$rsDat['nombStat']
				);
			}
			$rsDat=null;
			$clsCn-> descBd();
			return $dt;
		}
		catch (PDOException $e) { echo 'Ha Ocurrido el siguiente error: ' . $e->getMessage(); }
	}
}
?>