<?php
include(__DIR__ . "/../libs/bGeneral.php");
include(__DIR__ . "/../libs/funcionesFicheros.php");
include(__DIR__ . "/../libs/bGeneralOswaldo.php");
// Fichero donde se guardan los datos del usuario
$ruta = "../ficheros/usuarios.txt";
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

    //Valida fecha
    $fechaNacimiento = validarFecha($_POST['fechaNacimientoRegUser'], $errores);
    $fotoPerfil = recoge("fotoPerfilRegUser"); //Hacer función que compruebe que es una imagen

    //El idioma solo puede ser una de dos opciones, castellano o ingles. Poro ahora solo sanitizo con recoge() 
    $idioma = recoge("idiomaRegUser"); //Hacer función que compruebe si es español o ingles

    //Recoger los comentarios se sanitiza con recoge y se cambian los saltos linea por <br>
    $comentarios = recoge("comentariosRegUser");
    $comentarios = str_replace(PHP_EOL, "<br>", $comentarios);

    //Todos estos datos debemos escribirlos en un fichero cada registro separado por un ";"
    $datos_usuario = "$nombre;$correo;$password;$fechaNacimiento;$fotoPerfil;$idioma;$comentarios\r\n";

     // Abrir/Crear archivo
     $archivo = fopen(__DIR__ . '/../ficheros/usuarios.txt', 'a');

     // Escribir en el archivo
     fwrite($archivo, $datos_usuario);
 
     // Cerrar archivo
     fclose($archivo);

}







?>