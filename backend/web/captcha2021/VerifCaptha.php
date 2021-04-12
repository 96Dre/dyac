<?php 
session_start();
require_once 'classphp/PasswordLib/PasswordLib.php';
//Verificamos la entrada de variable global
if(!empty($_POST['valor'])){
	$PasswordLib = new PasswordLib\PasswordLib();
    //Verificamos la clave encriptado en el contenido de la cookie
    $boolean = $PasswordLib->verifyPasswordHash($_POST['valor'],$_COOKIE["captcha"]);
	//Se imprime el mesaje
    if($boolean==true){
    	echo "Captcha Correcta";
    }else{
    	echo "Captcha Incorrecta";
    }
}
 ?>