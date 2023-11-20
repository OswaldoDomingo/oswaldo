<?php

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
$mensajeError = "Error en el formulario : ";

/**
 * nomnbreRegUser
 * contrasenyaRegUser
 * fotoPerfilRegUser
 * idiomaRegUser
 * comentariosRegUser
 * enviarRegUser
 */

//PASO 1-Al cargar el formulario Recogemos los valores originales del usuario

if (isset($_POST["bVolver"])) {
    
    header('Location: login.php');
}

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

    //se calcula la diferencia entre ambos timestamps y se divide por el número de segundos en un año para 
    //obtener el número de años. Luego, se compara la edad obtenida con 18 para determinar si la persona es mayor o menor de edad.
    $fecha_actual = time();
    $edad = floor(($fecha_actual - $fechaNacimiento) / (60 * 60 * 24 * 365));

									
    if ($edad < 18) {
        $errores["ErrorFechaNacimiento"] = "Es imposible darse de alta si no se han cumplido 18 años";
    }
    
    //El idioma solo puede ser varias opciones se recogen en checkboxes 
    //Al ser no obligatorio comprobamos si el idioma ha sido asignado o o no con el if(isset)
    $idiomas = "";
    
    if(isset($_POST["idiomaRegUser[]"])){
        $idiomasSeleccionados = $_POST['idiomaRegUser[]'];
        $idiomas = implode(",", $idiomasSeleccionados);
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
        $fotoPerfil = $rutaImagenesUsuarios . uniqid() . $_FILES["fotoPerfilRegUser"]["name"];
    }  
    
    //Si no hay errores escribimos el fichero   
    
    if (empty($errores)) {
        
        $fechaAlta = date("d-m-Y H:i:s");
        
        $datos_usuario = "$fechaAlta;$nombre;$correoValidado;$passwordValidado;$fechaNacimiento;$fotoPerfil;$idiomas;$comentarios\r\n";

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