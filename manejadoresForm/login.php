<?php
include("../libs/bGeneral.php");
include("../libs/bGeneralOswaldo.php");
session_start();
//Variables que se van a usar en el proceso
$errores = [];
$correoLogin = "";
$contrasenyaLogin = "";

// Inicializar o actualizar el contador de intentos fallidos
if (!isset($_SESSION['intentos_fallidos'])) {
    $_SESSION['intentos_fallidos'] = 0;
}
//Verificamos que viene del botón enviar del formulario
if(!isset($_POST['enviarLogin'])) {
    //Si no viene del formulario
    include('../vistas/formLogin.php');
} else {
    $correoLogin = recoge('correoLogin');
    $contrasenyaLogin = recoge('contrasenyaLogin');

    if(usuarioValido($correoLogin, $contrasenyaLogin)) {

        $_SESSION['usuario'] = $correoLogin;
        $_SESSION['autenticado'] = 1;
        $_SESSION['intentos_fallidos'] = 0; // Reiniciar los intentos fallidos
        $_SESSION['contrasena'] = $contrasenyaLogin;

        header("Location: ../manejadoresForm/perfilUsuario.php");

        exit();
    } else {
        //Si no entra porque puso algo mal
        $_SESSION['intentos_fallidos']++;//Se suma el intento y se registra en el log
        file_put_contents("../ficheros/logLogin.txt", "$correoLogin; $contrasenyaLogin ;" . date("Y-m-d H:i:s") . "\n", FILE_APPEND);
        
        if ($_SESSION['intentos_fallidos'] >= 3) {
            // Redirigir al formulario de registro tras 3 intentos fallidos
            header("Location: ../vistas/formRegistroUsuario.php");
            exit();
        } else {
            $errores['login'] = "Usuario o contraseña incorrectos";
            include('../vistas/formLogin.php');
        }
    }
}
?>