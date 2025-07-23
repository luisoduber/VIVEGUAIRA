
<?php 
require "../config/conexion.php";
class clsRegVot
{
    private $nombUsu;
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
		$clsCn = new conexion();
		$cn=$clsCn->cnBd();
		$sql ='call spBusLetRif()';
		$cmd = $cn->prepare($sql);
		$cmd->execute();
		$cmd-> setFetchMode (PDO::FETCH_ASSOC);

		while ($rsDat = $cmd->fetch()) 
		{
			$val=$rsDat['nombLet'];
			$det=$rsDat['nombLet'];

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
	public function cboTipVot()
	{
		try 
		{  
			$cboDat=""; $val=""; $det="";
			$clsCn = new conexion();
			$cn=$clsCn->cnBd();
			$sql ='call spBusTipVot()';
			$cmd = $cn->prepare($sql);
			$cmd->execute();
			$cmd-> setFetchMode (PDO::FETCH_ASSOC);

			while ($rsDat = $cmd->fetch()) 
			{
		  		$val=$rsDat['idVot'];
		  		$det=$rsDat['nombVot'];

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
					"6"=>"",
					"7"=>""
				);
			}
			else if  ($rsDat > 0) 
			{
				$dt=array
				(
					"0"=>"1",
					"1"=>$rsDat['IdEst'],
					"2"=>$rsDat['idMun'],
					"3"=>$rsDat['idParr'],
					"4"=>$rsDat['rs'],
					"5"=>$rsDat['codCentVot'],
					"6"=>$rsDat['nombCentVot'],
					"7"=>$rsDat['direccion']
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

	public function valPart($prmIdEv,$prmCed)
	{
		try 
		{  

			$msjInf="";
			$clsCn = new conexion();
			$cn=$clsCn->cnBd();
			$sql = 'call spValPart(:prmIdEv,:prmCed)';
			$cmd = $cn->prepare($sql);
			$cmd ->bindParam(':prmIdEv',$prmIdEv,PDO::PARAM_STR);
			$cmd ->bindParam(':prmCed',$prmCed,PDO::PARAM_STR);
			
			$cmd->execute();
			$cmd-> setFetchMode(PDO::FETCH_ASSOC);
			$rsDat=$cmd->fetch();
			
			$dt=array
			(
				"valPart"=>$rsDat['valPart']
			);
			
			$rsDat=null;
			$clsCn-> descBd();
			return $dt;
		}
		catch (PDOException $e) { echo 'Ha Ocurrido el siguiente error: ' . $e->getMessage(); }
	}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function verfPart($prmCed,$prmCodCent,$prmIdEvent)
	{
		try 
		{  

			$msjInf="";
			$clsCn = new conexion();
			$cn=$clsCn->cnBd();
			$sql = 'call spBusVerfPart(:prmCed,:prmCodCent,:prmIdEvent)';
			$cmd = $cn->prepare($sql);
			$cmd ->bindParam(':prmCed',$prmCed,PDO::PARAM_STR);
			$cmd ->bindParam(':prmCodCent',$prmCodCent,PDO::PARAM_STR);
			$cmd ->bindParam(':prmIdEvent',$prmIdEvent,PDO::PARAM_STR);
			$cmd->execute();
			$cmd-> setFetchMode(PDO::FETCH_ASSOC);
			$rsDat=$cmd->fetch();
			
			if  ($rsDat == 0) 
			{
				$dt=array
				(
					"0"=>"0",
					"1"=>""
				);
			}
			else if  ($rsDat > 0) 
			{
				$dt=array
				(
					"0"=>"1",
					"1"=>$rsDat['idPart']
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

public function grdPart($prmIdEst,$prmIdMun,$prmIdParr,
						$prmCodCentVot,$prmCed,
					    $prmIdEvent,$prmIdVot)
	{

		$rsDat=Array(); $valid=""; $msjInf="";

		try 
		{ 
			$clsCn = new conexion();
			$cn=$clsCn->cnBd();
			$sql = 'call spGrdPart(	:prmIdEst,:prmIdMun,
									:prmIdParr,:prmCodCent,
									:prmCed,:prmIdEvent,
									:prmIdVot)';

			$cmd =  $cn->prepare($sql);
			$cmd->bindParam(':prmIdEst',$prmIdEst,PDO::PARAM_STR);
			$cmd->bindParam(':prmIdMun',$prmIdMun,PDO::PARAM_STR);
			$cmd->bindParam(':prmIdParr',$prmIdParr,PDO::PARAM_STR);
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
}
?> 