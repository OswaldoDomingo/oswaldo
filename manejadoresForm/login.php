<?php
require_once("../libs/bGeneral.php");
require_once("../libs/bGeneralOswaldo.php");
require_once("../libs/config.php");
require_once("../libs/bRafa.php");
session_start();

$_SESSION['autenticado'] = 0;

//Variables que se van a usar en el proceso
$errores = [];
$correoLogin = "";
$contrasenyaLogin = "";
$rutaFichero = "../ficheros/servicios.txt";

// Inicializar o actualizar el contador de intentos fallidos
if (!isset($_SESSION['intentos_fallidos'])) {
    $_SESSION['intentos_fallidos'] = 0;
}
//Verificamos que viene del botón enviar del formulario
if(!isset($_POST['enviarLogin'])) {
    //Si no viene del formulario
    require_once('../vistas/formLogin.php');
    
    //Si existe el fichero servicios lo recorremos y listamos los títulos de servicios
    //Si no existe lo creamos
    if(is_file($rutaFichero))
    {
        $servicios = file($rutaFichero, FILE_IGNORE_NEW_LINES);
    
        if(count($servicios) > 0)
        {
            echo("<center><h2>Listado de servicios</h2></center>");
            echo("<center><ul></center>");

            foreach($servicios as $servicio)
            {
                $arrayServicio = explode(';', $servicio);
                
                if(sizeof($arrayServicio) > TITULO)
                {
                    echo("<center><li>" . $arrayServicio[TITULO] . "</li><br></center>");
                }
            }

            echo("<center></ul></center>");
        }
    }
    else if(fopen($rutaFichero, "w") != false)
    {
        fclose($file);
    }
    
    
} else {
    
    $correoLogin = recoge('correoLogin');
    $contrasenyaLogin = recoge('contrasenyaLogin');

    if(usuarioValido($correoLogin, $contrasenyaLogin)) {

        session_start();

        $_SESSION['direccion_ip'] = $_SERVER['REMOTE_ADDR'];

        $_SESSION['usuario'] = $correoLogin;
        $_SESSION['autenticado'] = 1;
        $_SESSION['intentos_fallidos'] = 0; // Reiniciar los intentos fallidos
        $_SESSION['contrasena'] = $contrasenyaLogin;
        
        $usuario = obtenerUsuario($correoLogin);

        $_SESSION["nombre"] = $usuario[FOTO_USUARIO];
        $_SESSION["rutaFoto"] = $usuario[FOTO_USUARIO];
        $_SESSION['idioma'] = $usuario[IDIOMA];

        header("Location: ../manejadoresForm/servicios.php");

        exit();
    } else {
        //Si no entra porque puso algo mal
        $_SESSION['intentos_fallidos']++;//Se suma el intento y se registra en el log
        file_put_contents("../ficheros/logLogin.txt", "$correoLogin; $contrasenyaLogin ;" . date("Y-m-d H:i:s") . "\n", FILE_APPEND);
        
        if ($_SESSION['intentos_fallidos'] >= 3) {
            // Redirigir al formulario de registro tras 3 intentos fallidos
            header("Location: ../manejadoresForm/altaUsuario.php");
            //exit();
        } else {
            $errores['login'] = "Usuario o contraseña incorrectos";
            require_once('../manejadoresForm/login.php');
        }
    }
}
?>