
<?php 

require "../config/conexion.php";
class clsSeg
{
    private $nombUsu;
	public function __construct()
	{

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
		$sql ='call spBusParr(:prmIdMun)';
		$cmd = $cn->prepare($sql);
		$cmd ->bindParam(':prmIdMun',$prmIdMun,PDO::PARAM_STR);
		$cmd->execute();
		$cmd-> setFetchMode (PDO::FETCH_ASSOC);

		while ($rsDat = $cmd->fetch()) 
		{
			$val= $rsDat['idParr'];
			$det=$rsDat['nombParr'];

			$cboDat.="<option value='".$val."'>";
			$cboDat.=$det;
			$cboDat.="</option>";
		  }
		
		$rsDat=null;
		$clsCn-> descBd();
		return $cboDat;
	}
	catch (PDOException $e) { echo 'Ha Ocurrido el siguiente error: ' . $e->getMessage(); }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function EventCne()
	{
		try 
		{  
			$msjInf="";
			$clsCn = new conexion();
			$cn=$clsCn->cnBd();
			$sql = 'call spbusEvent()';
			$cmd = $cn->prepare($sql);
			$cmd->execute();
			$cmd-> setFetchMode (PDO::FETCH_ASSOC);
			$rsDat=$cmd->fetch();
			
			if  ($rsDat > 0) 
			{
		  		$dt=array(
				"0"=>$rsDat['idEvent'],
				"1"=>$rsDat['nombEvent'],
				"2"=>$rsDat['fechEvent']);
		  	}
			
			$rsDat=null;
			$clsCn-> descBd();
			return $dt;
		}
		catch (PDOException $e) { echo 'Ha Ocurrido el siguiente error: ' . $e->getMessage(); }
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function busInfCed($prmCed)
	{
		try 
		{  
			$msjInf="";
			$clsCn = new conexion();
			$cn=$clsCn->cnBd();
			$sql = 'call spBusInfCed(:prmCed)';
			$cmd = $cn->prepare($sql);
			$cmd ->bindParam(':prmCed',$prmCed,PDO::PARAM_STR);
			$cmd->execute();
			$cmd-> setFetchMode(PDO::FETCH_ASSOC);
			$rsDat=$cmd->fetch();
			if  ($rsDat == false) 
			{
				$dt=array
				(
					"0"=>"0",
					"1"=>"",
					"2"=>"",
					"3"=>"",
					"4"=>"",
					"5"=>"",
					"6"=>""
				);
			}
			else if  ($rsDat > 0) 
			{
				$dt=array
				(
					"0"=>"1",
					"1"=>$rsDat['IdEst'],
					"2"=>$rsDat['idParr'],
					"3"=>$rsDat['rs'],
					"4"=>$rsDat['codCentVot'],
					"5"=>$rsDat['nombCentVot'],
					"6"=>$rsDat['direccion']
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

	public function procPartEst($prmIdEst,$prmIdEvent)
	{
		try 
		{  
			$msjInf="";
			$clsCn = new conexion();
			$cn=$clsCn->cnBd();
			$sql = 'call spPartEst(:prmIdEst,:prmIdEvent)';
			$cmd = $cn->prepare($sql);
			$cmd ->bindParam(':prmIdEst',$prmIdEst,PDO::PARAM_STR);
			$cmd ->bindParam(':prmIdEvent',$prmIdEvent,PDO::PARAM_STR);
			$cmd->execute();
			$cmd-> setFetchMode(PDO::FETCH_ASSOC);
			$rsDat=$cmd->fetch();
			
			if  ($rsDat == 0) 
			{
				$dt=array
				(
					"0"=>"0",
					"1"=>"",
					"2"=>"",
					"3"=>""
				);
			}
			else if  ($rsDat > 0) 
			{
				$dt=array
				(
					"0"=>"1",
					"1"=>$rsDat['prmNombEst'],
					"2"=>$rsDat['prmCantPart'],
					"3"=>$rsDat['prmCantVotPart']
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

public function procPartParrTod($prmIdMun,$prmIdEvent)
{
	try 
	{  
		$msjInf="";
		$clsCn = new conexion();
		$cn=$clsCn->cnBd();
		$sql = 'call spPartParrTod(:prmIdMun,:prmIdEvent)';
		$cmd = $cn->prepare($sql);
		$cmd ->bindParam(':prmIdMun',$prmIdMun,PDO::PARAM_STR);
		$cmd ->bindParam(':prmIdEvent',$prmIdEvent,PDO::PARAM_STR);
		$cmd->execute();
		$cmd-> setFetchMode(PDO::FETCH_ASSOC);
		
		while ($rsDat = $cmd->fetch()) 
		{
			$dt[]=array
			(
				"idParr"=>$rsDat['idParr'],
				"nombParr"=>$rsDat['nombParr'],
				"cantPart"=>$rsDat['cantPart'],
				"cantVot"=>$rsDat['cantVot']
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

public function procPartCentVotTod($prmIdParr,$prmIdEvent)
{
	try 
	{  
		$msjInf="";
		$clsCn = new conexion();
		$cn=$clsCn->cnBd();
		$sql = 'call spPartCentVotTod(:prmIdParr,:prmIdEvent)';
		$cmd = $cn->prepare($sql);
		$cmd ->bindParam(':prmIdParr',$prmIdParr,PDO::PARAM_STR);
		$cmd ->bindParam(':prmIdEvent',$prmIdEvent,PDO::PARAM_STR);
		$cmd->execute();
		$cmd-> setFetchMode(PDO::FETCH_ASSOC);
		
		while ($rsDat = $cmd->fetch()) 
		{
			$dt[]=array
			(
				"codCentVot"=>$rsDat['codCentVot'],
				"nombCentVot"=>$rsDat['nombCentVot'],
				"cantPart"=>$rsDat['cantPart'],
				"cantVot"=>$rsDat['cantVot']
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

public function procPartCentVot($prmCodCentVot,$prmIdEvent)
{
	try 
	{  
		$msjInf="";
		$clsCn = new conexion();
		$cn=$clsCn->cnBd();
		$sql = 'call spPartCentVot(:prmCodCentVot,:prmIdEvent)';
		$cmd = $cn->prepare($sql);
		$cmd ->bindParam(':prmCodCentVot',$prmCodCentVot,PDO::PARAM_STR);
		$cmd ->bindParam(':prmIdEvent',$prmIdEvent,PDO::PARAM_STR);
		$cmd->execute();
		$cmd-> setFetchMode(PDO::FETCH_ASSOC);
		$rsDat=$cmd->fetch();
		
		if ($rsDat >0) 
		{
			$dt=array
			(
				"codCentVot"=>$rsDat['codCentVot'],
				"nombCentVot"=>$rsDat['nombCentVot'],
				"cantPart"=>$rsDat['cantPart'],
				"cantVot"=>$rsDat['cantVot']
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

public function procPartParr($prmIdParr,$prmIdEv)
{
	try 
	{  
		$msjInf="";
		$clsCn = new conexion();
		$cn=$clsCn->cnBd();
		$sql = 'call spPartParr(:prmIdParr,:prmIdEv)';
		$cmd = $cn->prepare($sql);
		$cmd ->bindParam(':prmIdParr',$prmIdParr,PDO::PARAM_STR);
		$cmd ->bindParam(':prmIdEv',$prmIdEv,PDO::PARAM_STR);
		$cmd->execute();
		$cmd-> setFetchMode(PDO::FETCH_ASSOC);
		$rsDat=$cmd->fetch();
		
		if  ($rsDat > 0) 
		{
			$dt=array
			(
				"prmNombParr"=>$rsDat['prmNombParr'],
				"prmCantPart"=>$rsDat['prmCantPart'],
				"prmCantVot"=>$rsDat['prmCantVot']
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

	public function procPartInst($prmIdInst,$prmIdEvent)
	{
		try 
		{  
			$msjInf="";
			$clsCn = new conexion();
			$cn=$clsCn->cnBd();
			$sql = 'call procPartInst(:prmIdInst,:prmIdEvent)';
			$cmd = $cn->prepare($sql);
			$cmd ->bindParam(':prmIdInst',$prmIdInst,PDO::PARAM_STR);
			$cmd ->bindParam(':prmIdEvent',$prmIdEvent,PDO::PARAM_STR);
			$cmd->execute();
			$cmd-> setFetchMode(PDO::FETCH_ASSOC);
			$rsDat=$cmd->fetch();
			
			if  ($rsDat == 0) 
			{
				$dt=array
				(
					"0"=>"0",
					"1"=>"",
					"2"=>"",
					"3"=>""
				);
			}
			else if  ($rsDat > 0) 
			{
				$dt=array
				(
					"0"=>"1",
					"1"=>$rsDat['prmNombInst'],
					"2"=>$rsDat['prmCantPartInst'],
					"3"=>$rsDat['prmCantVotInst']
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

public function procPartInstTod($prmIdInst,$prmIdEv)
{
	try 
	{  
		$msjInf="";
		$clsCn = new conexion();
		$cn=$clsCn->cnBd();
		$sql = 'call spPartInstTod(:prmIdInst,:prmIdEv)';
		$cmd = $cn->prepare($sql);
		$cmd ->bindParam(':prmIdInst',$prmIdInst,PDO::PARAM_STR);
		$cmd ->bindParam(':prmIdEv',$prmIdEv,PDO::PARAM_STR);
		$cmd->execute();
		$cmd-> setFetchMode(PDO::FETCH_ASSOC);
		
		while ($rsDat = $cmd->fetch()) 
		{
			$dt[]=array
			(
				"nombUni"=>$rsDat['nombUni'],
				"cantPart"=>$rsDat['cantPart'],
				"cantVot"=>$rsDat['cantVot']
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

public function grdPart($prmIdEst,$prmIdParr,
						$prmCed,$prmCodCentVot,
					    $prmIdEvent,$prmIdVot)
{

		$rsDat=Array(); $valid=""; $msjInf="";

		try 
		{ 
			$clsCn = new conexion();
			$cn=$clsCn->cnBd();
			$sql = 'call spGrdPart(:prmCodCent,:prmCed,
									:prmIdEvent,:prmIdVot)';

			$cmd =  $cn->prepare($sql);
		    $cmd->bindParam(':prmCodCent',$prmCodCentVot,PDO::PARAM_STR);
		    $cmd->bindParam(':prmCed',$prmCed,PDO::PARAM_STR);
		    $cmd->bindParam(':prmIdEvent',$prmIdEvent,PDO::PARAM_STR);
		    $cmd->bindParam(':prmIdVot',$prmIdVot,PDO::PARAM_STR);
			$cmd->execute();

			if ($cmd)
			{ 
				$valid='1';
				$msjInf="El Elector(a) a sido registrado / actualizad(a) ";
				$msjInf.="satisfactoriamente.";
			}

			$clsCn-> descBd();
			return $rsDat=array($valid,$msjInf);
		}
		catch (PDOException $e) 
		{ 
			$validar='0';
			$msjInf='Ha Ocurrido el siguiente error: ' . $e->getMessage(); 
			return $rsDat=array($valid,$msjInf);
		}
	}


	//////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function infEncUbch($prmCodCentVot)
	{
		try 
		{  
			$dt=Array(); $rsDat=""; 
			$clsCn=new conexion();
			$cn=$clsCn->cnBd();
			$sql='call spInfEncUbch(:prmCodCentVot)';
			$cmd=$cn->prepare($sql);
			$cmd->bindParam(':prmCodCentVot',$prmCodCentVot,PDO::PARAM_STR);
			$cmd->execute();
			$cmd->setFetchMode(PDO::FETCH_ASSOC);

			while ($rsDat=$cmd->fetch()) 
			{
				
				$dt[]=array
				(
					"rs"=>$rsDat['rs'],
					"telf"=>$rsDat['telf']
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

	public function procPart1x10Jef($prmIdEv)
	{
		try 
		{  
			
			$msjInf="";
			$clsCn = new conexion();
			$cn=$clsCn->cnBd();
			$sql = 'call spPart1x10Jef(:prmIdEv)';
			$cmd = $cn->prepare($sql);
			$cmd ->bindParam(':prmIdEv',$prmIdEv,PDO::PARAM_STR);
			$cmd->execute();
			$cmd-> setFetchMode(PDO::FETCH_ASSOC);
			$rsDat=$cmd->fetch();

			if  ($rsDat>0) 
			{
				$dt=array
				(
					"nombJef"=>$rsDat['nombJef'],
					"cantPart"=>$rsDat['cantPart'],
					"cantVot"=>$rsDat['cantVot']
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

	public function procPart1x10Mil($prmIdEv)
	{
		try 
		{  
			
			$msjInf="";
			$clsCn = new conexion();
			$cn=$clsCn->cnBd();
			$sql = 'call spPart1x10Mil(:prmIdEv)';
			$cmd = $cn->prepare($sql);
			$cmd ->bindParam(':prmIdEv',$prmIdEv,PDO::PARAM_STR);
			$cmd->execute();
			$cmd-> setFetchMode(PDO::FETCH_ASSOC);
			
			while ($rsDat = $cmd->fetch()) 
			{
			
				$dt[]=array
				(
					"nombJef"=>$rsDat['nombJef'],
					"cantPart"=>$rsDat['cantPart'],
					"cantVot"=>$rsDat['cantVot']
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