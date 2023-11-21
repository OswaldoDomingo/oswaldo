<?php
require_once (__DIR__ . "/../libs/config.php");
function cTextoAlfanumerico($nombreVariable, $text, &$errores, $max = 200, $min = 1)
{
    $valido = true;
    if ((mb_strlen($text) > $max) || (mb_strlen($text) < $min)) {
        $errores["name_1"] = "El nombre debe tener entre $min y $max letras";
        $valido = false;
    }
    
    if (! preg_match("/^[a-zA-Z0-9_]+$/", sinTildes($text))) 
    {
        $errores[$nombreVariable] = $nombreVariable . " no sólo tiene letras y números";
        $valido = false;
    }
    
    return $valido;
}
function cMoneda($nombreVariable, $num, &$errores, $min = 0.001, $max = PHP_INT_MAX)
{
    $valido = true;
    if ($num >= $max || $num <= $min) {
        $valido = false;
        $errores[$nombreVariable] = "La cantidad de " . $nombreVariable . " es demasiado grande";
    }
    
    if (! preg_match("/^[0-9]+$/", $num)) {
        $valido = false;
        $errores[$nombreVariable] = $nombreVariable . " sólo puede contener números";
    }
    return $valido;
}

function obtenerUsuario($correo) {
    // Abrir el archivo de usuarios para lectura
    $archivoUsuarios = fopen("../ficheros/usuarios.txt", "r");
    if ($archivoUsuarios) {
        // Leer el archivo línea por línea
        $lineaIndex = 0;
        while (($linea = fgets($archivoUsuarios)) !== false) {
            $lineaIndex++;
            // Descomponer la línea en sus partes y comprobar si coinciden con los datos del formulario
            $usuario = explode(';', trim($linea));
            if ($correo === $usuario[CORREO]) {
                // Si los datos coinciden, cerrar el archivo y retornar verdadero
                fclose($archivoUsuarios);
                return $usuario;
            }
        }
        // Cerrar el archivo si no se encuentra el usuario
        fclose($archivoUsuarios);
    } 
    // Retornar falso si el usuario no es válido
    return false;
} 

function existeUsuario($correo) {
    // Abrir el archivo de usuarios para lectura
    $archivoUsuarios = fopen("../ficheros/usuarios.txt", "r");
    if ($archivoUsuarios) {
        // Leer el archivo línea por línea
        $lineaIndex = 0;
        while (($linea = fgets($archivoUsuarios)) !== false) {
            $lineaIndex++;
            // Descomponer la línea en sus partes y comprobar si coinciden con los datos del formulario
            $usuario = explode(';', trim($linea));
            if ($correo === $usuario[CORREO]) {
                return true;
            }
        }
        // Cerrar el archivo si no se encuentra el usuario
        fclose($archivoUsuarios);
    } 
    // Retornar falso si el usuario no es válido
    return false;
} 

?>
