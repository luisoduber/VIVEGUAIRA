<?php
namespace App\Models;
require '../../vendor/autoload.php';
use App\Conf\cn;
use PDO;
use PDOException;

class Log
{
    private $nombUsu;
	private $cn;
	private $exitCn;

	public function __construct()
	{
		$cn = new cn();
        $this->cn=$cn->cnBd();
		$this->exitCn=$cn->descBd();
	}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function verfLog($prmNombUsu): array
	{
		try 
		{  $dt=Array();
			$this->nombUsu=$prmNombUsu;
			$msjInf="";
			$sql = 'call spVerfLog(:prmNombUsu)';
			$cmd = $this->cn->prepare($sql);
		    $cmd ->bindParam(':prmNombUsu',$this->nombUsu,PDO::PARAM_STR);
			$cmd ->execute();
			$cmd ->setFetchMode(PDO::FETCH_ASSOC);
			$rsDat=$cmd->fetch();
			
			if  ($rsDat==0) 
			{
		  		$dt=array(
				"idUsu"=>"",
				"rs"=>"",
				"clave"=>"",
				"idPerf"=>"",
				"idStat"=>"",
				"nombPerf"=>""
				);
			}
			elseif  ($rsDat > 0) 
			{
		  		$dt=array(
				"idUsu"=>$rsDat['idUsu'],
				"rs"=>$rsDat['rs'],
				"clave"=>$rsDat['clave'],
				"idPerf"=>$rsDat['idPerf'],
				"idStat"=>$rsDat['idStat'],
				"nombPerf"=>$rsDat['nombPerf']
			);
		  	}
			$this->exitCn;
			return $dt; 
		}
		catch (PDOException $e) { echo 'Ha Ocurrido el siguiente error: '.$e->getMessage(); }
	}

}
?> 