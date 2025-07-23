<?php
namespace App\Controllers;
class Cif
{
    var $key;
    var $nonce;

    function __construct()
    {
    }

//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

    function encrypClave($prmCad)
    {
        $opc= Array();
        $opc=['cost' => 10]; 
        $prmCad=password_hash($prmCad,PASSWORD_ARGON2I);
        return $prmCad;
    }

//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

    function genKey()
    {
        $key="";
    	$clave='=-+.,*%{]/$![}1234567890ABCD';
        $clave.='EFGHIJKLMNOPQRSTUVWXYZabcde';
        $clave.='fghijklmnopqrstuvwxyz';

    	$cantDigClave=strlen($clave);
    	$cantDigClave=$cantDigClave -1;
    	
    	$i=0;
    	while ($i <32)
    	{
    		$i++;
    		$posicion=rand(1,$cantDigClave);
    		$key.=substr($clave,$posicion,1);
    	}
    	return $key;
    }

//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

    function encryptar($prmCad)
    {
        $key= random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES); // 256 bit
        $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES); // 24 bytes

        $this->key= base64_encode($key);         // Encrypt
        $ciphertext=sodium_crypto_secretbox($prmCad, $nonce, $key);

        $key=sodium_bin2hex($key);
        $nonce=sodium_bin2hex($nonce);
        $ciphertext =sodium_bin2hex($ciphertext);
        $ciphertext=$ciphertext;
        $rsDat= Array();
        $rsDat= ['0'=>$key,'1'=>$nonce,'2'=>$ciphertext];
        return $rsDat;
    }

//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

    function desencriptar($prmCad)
    {
        echo  "cadena: ";
    	echo  $prmCad."---- key:";
        echo  $this->key."---- nonce : ";
        echo  $_SESSION['nonce']." fin ----";
    }

}
?>
