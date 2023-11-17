<?php
session_start();
include(__DIR__ . "/../libs/bGeneral.php");
include(__DIR__ . "/../libs/funcionesFicheros.php");
include(__DIR__ . "/../libs/bGeneralOswaldo.php");
include(__DIR__ . "/../libs/config.php");

// Directorio donde se guardan los datos del usuario
$ruta = RUTA_IMAGENES . "usuarios/";
$errores = [];
/**
 * nomnbreRegUser
 * correoRegUser
 * contrasenyaRegUser
 * fechaNacimientoRegUser
 * fotoPerfilRegUser
 * idiomaRegUser
 * comentariosRegUser
 * enviarRegUser
 */
if(isset($_POST['enviarRegUser'])){
    //Recoger valores
    $nombre = recoge("nomnbreRegUser");
    $correo = cCorreo("correoRegUser", $errores);
    $password = cPassword("contrasenyaRegUser", $errores);
    $rutaImagen = "../imagenes/usuarios";
    //Valida fecha
    //Recogemos fecha si es buena, 
    $fechaNacimiento = validarFecha($_POST['fechaNacimientoRegUser'], $errores);

    $fotoPerfil = recoge("fotoPerfilRegUser"); //Hacer función que compruebe que es una imagen

    //El idioma solo puede ser una de dos opciones, castellano o ingles. Poro ahora solo sanitizo con recoge() 
    $idioma = recoge("idiomaRegUser"); //Hacer función que compruebe si es español o ingles

    //Recoger los comentarios se sanitiza con recoge y se cambian los saltos linea por <br>
    $comentarios = recoge("comentariosRegUser");
    $comentarios = str_replace(PHP_EOL, "<br>", $comentarios);

    //Si no hay errores escribimos el fichero
    $fotoPerfil = cFile("fotoPerfilRegUser", $errores, $extensionesValidas, $rutaImagen, $maxFichero);

    if(empty($errores)){
        //Ponerle nombre a la foto y subirla al directorio $rutaImagen, averiguar el array de formatos

        //Todos estos datos debemos escribirlos en un fichero cada registro separado por un ";"
        $datos_usuario = "$nombre;$correo;$password;$fechaNacimiento;$fotoPerfil;$idioma;$comentarios\r\n";
        
        // Abrir/Crear archivo
        $archivo = fopen(__DIR__ . '/../ficheros/usuarios.txt', 'a');
        
        // Escribir en el archivo
        fwrite($archivo, $datos_usuario);
        
        // Cerrar archivo
        fclose($archivo);
    }

}else {
    include("../vistas/formRegistroUsuario.php");
}

?>