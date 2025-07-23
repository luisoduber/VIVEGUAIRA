<?php 
namespace App\Conf;
use PDO;
use PDOException;

class cn
{
    private $host = '162.212.158.103';
    private $dbName = 'vivguaira';
	private $port ='3306';
    private $username = 'pwGob';
    private $password = '4D,_rA2TV~YpA3_Di8gJnkn)';
    private $conn;

	function __construct()
	{	
	}

	public function cnBd():PDO 
	{
        try 
		{
            $this->conn=new PDO(
                "mysql:host={$this->host};dbname={$this->dbName}",
                $this->username,
                $this->password
            );
			$this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } 
		catch (PDOException $e) { echo 'Falló la conexión: ' . $e->getMessage(); }
    }

	function descBd()
	{
		try {  $this->conn=null; return $this->conn;  } 
		catch (PDOException $e) { echo 'Ha Ocurrido el siguiente error: ' . $e->getMessage(); }
	}

}

 ?>