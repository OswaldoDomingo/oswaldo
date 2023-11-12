<?php
include("../libs/bGeneral.php");
include("../libs/bGeneralOswaldo.php");

//Variables que se van a usar en el proceso
$errores = [];
$correoLogin = "";
$contrasenyaLogin = "";

if(!isset($_REQUEST['enviarLogin'])){ //Si no se llega desde el botón enviar se carga el formulario
    
    include('../vistas/formLogin.php');

}else{
    //En este archivo se comprueba si los datos del usuario son correctos, si lo son se deberá pasar al siguiente página
    // que es la zona privada, si no pasa se volverá a cargar el formulario.

    $correoLogin =  cCorreo('correoLogin');
    $contrasenyaLogin = cPassword('contrasenyaLogin');


    //En esta fase se comprueba los requisitos que pedimos para poder crear la cuenta
}






?>