<?php

session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] == 0) {
     // Redirigir al usuario a la página de login si no está autenticado
     header("Location: login.php");
     exit();
 }

require_once(__DIR__ . "/../libs/bGeneral6.php");
require_once(__DIR__ . "/../libs/config.php");
require_once(__DIR__ . "/../libs/funcionesFicheros.php");
require_once(__DIR__ . "/../libs/bGeneralOswaldo.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Fichero donde se guardan los datos del usuario
$ruta = "../ficheros/usuarios.txt";
$rutaImagenesUsuarios = RUTA_IMAGENES . "Usuarios/";

$errores = [];
$messageError = "Error en el formulario : ";

/**
 * nomnbreRegUser
 * contrasenyaRegUser
 * fotoPerfilRegUser
 * idiomaRegUser
 * comentariosRegUser
 * enviarRegUser
 */

//PASO 1-Al cargar el formulario Recogemos los valores originales del usuario

if(isset($_POST['enviarRegUser'])){
    
    //Primero recogemos las obligatorias $nombre, $correo, $password
    
    $nombre = recoge("nomnbreRegUser");

    $correo = cCorreo("correoRegUser", $errores);
    if($correo){$correoValidado = $_POST["correoRegUser"];}

    $password = cPassword("contrasenyaRegUser", $errores);
    if($password){ $passwordValidado = $_POST["contrasenyaRegUser"];}

    //Valida fecha
    //Recogemos fecha si es buena, 
    $fechaNacimiento = validarFecha($_POST['fechaNacimientoRegUser'], $errores);
    
    $fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
    $fecha_18 = strtotime($fecha_actual."- 18 year");
    
    if($fecha_18 < $fechaNacimiento)
    {
        $errores["ErrorFechaNacimiento"] = "Es imposible darse de alta si no se han cumplido 18 años";
    }
    
    //El idioma solo puede ser una de dos opciones, castellano o ingles. Poro ahora solo sanitizo con recoge() 
    //Al ser no obligatorio comprobamos si el idioma ha sido asignado o o no con el if(isset)
    if(isset($_POST["idiomaRegUser"])){
        $idioma = recoge("idiomaRegUser"); //Hacer función que compruebe si es español o ingles
    }
   

    //Recoger los comentarios se sanitiza con recoge y se cambian los saltos linea por <br>
    //Al ser no obligatorio comprobamos si el comentario ha sido asignado o o no con el if(isset)
    if(isset($_POST["comentariosRegUser"])){
        $comentarios = recoge("comentariosRegUser");
        $comentarios = str_replace(PHP_EOL, "<br>", $comentarios);
    }

    
    $fotoPerfil = "";

    //Al ser no obligatorio comprobamos si la foto ha sido asignado o o no con el if(isset)
    if(isset ($_FILES["fotoPerfilRegUser"]) && isset ($_FILES["fotoPerfilRegUser"]["name"]) && $_FILES["fotoPerfilRegUser"]["name"] != "")
    {
        echo("FOTO PERFIL = " . $_FILES["fotoPerfilRegUser"]["name"]);
        $fotoPerfil = $rutaImagenesUsuarios . uniqid() . $_FILES["fotoPerfilRegUser"]["name"];
    }  
    
    //Si no hay errores escribimos el fichero   
    
    if (empty($errores)) {
        
        $fechaAlta = date("d-m-Y H:i:s");
        
        $datos_usuario = "$fechaAlta;$nombre;$correoValidado;$passwordValidado;$fechaNacimiento;$fotoPerfil;$idioma;$comentarios\r\n";

        guardarAlPrincipio(__DIR__ . '/../ficheros/usuarios.txt', $datos_usuario);
        
        if(isset ($fotoPerfil) && $fotoPerfil != "")
        {   
            $mensajeErrorImagen = "El servicio se ha registrado pero se ha producido un error subiendo su imagen. ";

            $errorGuardadoImagen = guardarImagen($_FILES["fotoPerfilRegUser"], $fotoPerfil, $mensajeErrorImagen, $maxFichero, $extensionesValidas);
            
            if($errorGuardadoImagen != "") 
            {
                $errores["ErrorFoto"] = $errorGuardadoImagen;
                
                $fotoPerfilRegUser = "";
            }      
        }
        else
            $fotoPerfilRegUser = "";
        
        header("Location: ../manejadoresForm/login.php");
        
    } 
    else {
        
        $mensajeError = "<br><br><br><br><div><b>" . $mensajeError . array_values($errores)[0] . "</b></div>";
        echo($mensajeError);
        
    }
} 
else {
    include("../vistas/formAltaUsuario.php");
}
 
?>