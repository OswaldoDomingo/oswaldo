<?php

function guardarAlPrincipio ($ruta, $msg) {
    $archivo = file_get_contents($ruta);
    $msg=$msg.$archivo;
    file_put_contents($ruta, $msg);
    
}

function insertarArchivoFinal($ruta, $msg){
    if($archivo=fopen($ruta, "a+")){
        fwrite($archivo, $msg.PHP_EOL);
        fclose($archivo);
        return "true";
    }else
        return "false";
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
            }
        }
    }
    
    return $mensajeError;
}


?>
