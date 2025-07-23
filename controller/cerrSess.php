<?php 
session_start();

require_once "../controller/clsGen.php";
$clsGen = new clsGen();

$prmOp="";
$prmOp=isset($_GET["prmOp"])? $clsGen->limpCad($_GET["prmOp"]):"";

switch ($prmOp) 
{
	case 'salir':
		$clsGen->cerrSess();
		header("Location: ../vistas/login.php");
	break;
}

?> 