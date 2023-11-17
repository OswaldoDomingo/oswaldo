<?php

require_once (__DIR__ . "/../libs/funcionesFicheros.php");
require_once (__DIR__ . "/../libs/bGeneral6.php");
require_once (__DIR__ . "/../libs/bRafa.php");
require_once (__DIR__ . "/../libs/config.php");
require_once (__DIR__ . "/../vistas/formAltaServicio.php");

$ruta = "../ficheros/servicios.txt";
$rutaImagenesServicios = RUTA_IMAGENES . "Servicios/";

$errores = [];
$messageError = "Error en el formulario : ";

/**
 * flujo de código principal del fichero
 */

if (isset($_POST["bVolver"])) {
    
    header('Location: servicios.php');
}

if (isset($_POST["bGuardar"])) {

    //PASO 1-Recogemos los valores
    
    $fechaAlta = date("d-m-Y H:i:s");
    $titulo = recoge("titulo");
    $categoria = recoge("categoria");
    $tipo = recoge("tipo");
    $precio = recoge("precio");
    $foto = "";
    $ubicacion = recoge("ubicacion");
    $disponibilidad = recoge("disponibilidad");
    
    $descripcion = recoge("descripcionServicio");
    $descripcion = str_replace(PHP_EOL, "</br>", $descripcion);
    
    if(isset ($_FILES["fotoServicio"]) && isset ($_FILES["fotoServicio"]["name"]) && $_FILES["fotoServicio"]["name"] != "")
    {
        $foto = uniqid() . $_FILES["fotoServicio"]["name"];
    }  
    
    //PASO 2-Validamos que los campos obligatorios han sido rellenados
    
    if ($titulo === "") {
        $errores["NoTitulo"] = "Es obligatorio introducir el título.<br>";
    }

    if ($categoria === "") {
        $errores["NoCategoria"] = "Es obligatorio introducir la categoría<br>";
    }
    
    if ($tipo === "") {
        $errores["NoTipo"] = "Es obligatorio introducir el tipo<br>";
    }

    if ($ubicacion === "") {
        $errores["NoUbicacion"] = "Es obligatorio introducir la ubicación<br>";
    }
    
    if ($disponibilidad === "") {
        $errores["NoDisponibilidad"] = "Es obligatorio introducir la disponibilidad<br>";
    }
    
    if ($descripcion === "") {
        $errores["NoDescripcion"] = "Es obligatorio introducir una desripción<br>";
    }
    
    
    //PASO 3 -Si no hay errores, validamos que las listas tienen valores admitidos, 
    
    if (count($errores) === 0) { 
        
        
        $categoriasKeys = array_keys($categoriasServicio);
        
        if(!in_array($categoria, $categoriasKeys))
            $errores["CategoriaNoExiste"] = "La categoría no es válida<br>";

        
        $tiposKeys = array_keys($tiposServicio);
        
        if(!in_array($tipo, $tiposKeys))
            $errores["TipoNoExiste"] = "El tipo no es válido<br>";
        
        $ambitosKeys = array_keys($ambitosServicio);
        
        if(!in_array($ubicacion, $ambitosKeys))
            $errores["UbicacionNoExiste"] = "La ubicación no es válida<br>";

        
        $disponibilidadKeys = array_keys($disponibilidadesServicio);
        
        if(!in_array($disponibilidad, $disponibilidadKeys))
            $errores["DisponibilidadNoExiste"] = "La disponibilidad no es válida<br>";  
        
    }
    
    //PASO 4 -Si no hay errores, sanitizamos los valores que son necesarios (el resto no hace falta, o bien son listas cerradas)
    
    if (count($errores) === 0) {
        
        cTexto($titulo, $errores);
    
        if($tipo != "Intercambio")
            cMoneda("precio", $precio, $errores);
        else
            $precio = 0;
    
        cTexto($ubicacion, $errores);
    }
    

    //PASO 5 -Finalmente si hay errores los mostramos y si no guardamos el registro del servicio y guardamos la imagen
    
    if (count($errores) === 0) {
        
        //Primero gestionamos la imagen
        
        if(isset ($foto))
        {   
            $mensajeErrorImagen = "El servicio se ha registrado pero se ha producido un error subiendo su imagen. ";
            
            $rutaFoto = $rutaImagenesServicios . $foto;
            
            $errorGuardadoImagen = guardarImagen($_FILES["fotoServicio"], $rutaFoto, $mensajeErrorImagen, $maxFichero, $extensionesValidas);
            
            if($errorGuardadoImagen != "") 
            {
                $errores["ErrorFoto"] = $errorGuardadoImagen;
                
                $foto = "";
            }      
        }
        else
            $foto = "";
        
        
        //Luego guardamos el servicio en cualquier caso, independientemente de si hemos podido guardar la imagen o no

        $lineaServicio = "$fechaAlta;$titulo;$categoria;$tipo;$precio;$ubicacion;$foto;$disponibilidad;$descripcion";

        $lineaServicio = $lineaServicio . PHP_EOL;
    
        guardarAlPrincipio($ruta, $lineaServicio);

    }
    
    if(count($errores) > 0)
    {   
        $messageError = "<br><br><div><b>" . $messageError . array_values($errores)[0] . "</b></div>";
        
        echo($messageError);
        
    }    
    
}

?>
