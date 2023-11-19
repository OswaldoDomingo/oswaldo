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


function guardarImagen(array $imagen, string $rutaFoto, string $mensajeErrorImagen, int $maxFichero, array $extensionesValidas)
{
    $mensajeError = "";
    $errorImagen = $imagen["error"];
    if ($errorImagen != 0)
    {
        $mensajeError = $mensajeErrorImagen . $errorImagen;
        switch ($errorImagen) {
                
            case 1:         //"UPLOAD_ERR_INI_SIZE";
                $mensajeError = $mensajeErrorImagen . "Fichero demasiado grande";
                break;
            case 2:         //"UPLOAD_ERR_FORM_SIZE";
                $mensajeError = $mensajeErrorImagen . 'El fichero es demasiado grande';
                break;
            case 3:         //"UPLOAD_ERR_PARTIAL";
                $mensajeError = $mensajeErrorImagen . 'El fichero no se ha podido subir entero';
                break;
            case 4:         //"UPLOAD_ERR_NO_FILE";
                $mensajeError = $mensajeErrorImagen . 'No se ha podido subir el fichero';
                break;
            case 6:         //"UPLOAD_ERR_NO_TMP_DIR";
                $mensajeError = $mensajeErrorImagen . "Falta carpeta temporal";
                break;
            case 7:         //"UPLOAD_ERR_CANT_WRITE";
                $mensajeError = $mensajeErrorImagen . "No se ha podido escribir en el disco";
                break;
                
            default:
                $mensajeError = $mensajeErrorImagen . 'Error indeterminado.';
        }
    }
    else
    {
        $tamano = $imagen['size'];
        
        if($tamano > $maxFichero)
            $mensajeError = $mensajeErrorImagen . "<br>La foto es demasiado grande. <br>El tamaño máximo es de " . $maxFichero/1024 . "Kb";
        else
        {
            $nombreFotoPartes = explode('.', $imagen['name']);
            
            $extension = $nombreFotoPartes[count($nombreFotoPartes) - 1];
        
            if (!in_array($extension, $extensionesValidas))
                $mensajeError =  $mensajeErrorImagen . "<br>La extensión de la foto  no es correcta.<br> - Se permiten archivos .gif, .jpg, .png.";
        }
        
        
        if($mensajeError == "")
        {
            $nombreFoto = $imagen["name"];
            $rutaImagenTemporal = $imagen["tmp_name"];
            if (!move_uploaded_file($rutaImagenTemporal, $rutaFoto)) 
            {
                $mensajeError = $mensajeErrorImagen;
                return $mensajeError;
            }
        }
    }
}
