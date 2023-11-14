<?php

include (__DIR__ . "/../lib/funcionesFicheros.php");
include (__DIR__ . "/../lib/bGeneral6.php");
include (__DIR__ . "/../lib/bRafa.php");
$ruta = "../ficheros/servicios.txt";
$errores = [];
include (__DIR__ . "/../forms/formAltaServicio.php");
if (isset($_POST["bGuardar"])) {

    /*
     * Guardamos el comentario con <br> para luego mostrarlo
     * Otra opción sería guardarlo con saltos de línea pero tendríamos que tenerlo en cuenta
     * creando un separador de comentario único para guardar en fichero
     */
    $titulo = recoge("titulo");
    $categoria = recoge("categoria");
    $tipo = recoge("tipo");
    $precio = recoge("precio");
    $ubicacion = recoge("ubicacion");
    $foto = recoge("fotoServicio");
    $disponibilidad = recoge("disponibilidad");
    $descripcion = recoge("descripcionServicio");
    
    $descripcion = str_replace(PHP_EOL, "</br>", $descripcion);
    $messageError = "Error en el formulario : ";
    
    
    if ($titulo === "") {
        $errores["NoTitulo"] = $messageError . "Es obligatorio introducir el título.<br>";
    }

    if ($categoria === "") {
        $errores["NoCategoria"] = $messageError . "Es obligatorio introducir la categoría<br>";
    }
    
    if ($tipo === "") {
        $errores["NoTipo"] = $tipo . "Es obligatorio introducir el tipo<br>";
    }

    if ($ubicacion === "") {
        $errores["NoUbicacion"] = $tipo . "Es obligatorio introducir la ubicación<br>";
    }
    
    if ($disponibilidad === "") {
        $errores["NoDisponibilidad"] = $disponibilidad . "Es obligatorio introducir la disponibilidad<br>";
    }
    
    if ($descripcion === "") {
        $errores["NoDescripcion"] = $messageError . "Es obligatorio introducir una desripción<br>";
    }
    
    cTexto($titulo, $errores);
    cTexto($categoria, $errores);
    cTexto($tipo, $errores);
    cMoneda("precio", $precio, $errores);
    cTexto($ubicacion, $errores);
    cTexto($disponibilidad, $errores);
    
    if (count($errores) === 0) {
        $fechaAlta = date("d-m-Y H:i:s");
        $usuario = "rafamarmar@gmail.com";
        $texto = "$fechaAlta;$usuario;$titulo;$categoria;$tipo;$precio;$ubicacion;$foto;$disponibilidad;$descripcion" . PHP_EOL;
        guardarAlPrincipio($ruta, $texto);
    }
}

?>

