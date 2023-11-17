<?php
require_once (__DIR__ . "/../lib/funcionesFicheros.php");
require_once (__DIR__ . "/../lib/bGeneral6.php");
require_once (__DIR__ . "/../lib/bRafa.php");
require_once (__DIR__ . "/../lib/config.php");
require_once (__DIR__ . "/../forms/formServicios.php");

$rutaFichero = "../ficheros/servicios.txt";
$rutaImagenesServicios = RUTA_IMAGENES . "Servicios/";
$errores = [];


if ($archivo = is_file($rutaFichero)) {
    
    // Si hubiesemos guardado el fichero con saltos de línea
    // en el comentario la lectura sería de otra forma
    if ($archivo = fopen($rutaFichero, "r")) {
        
        $contador = 1;
        
        $tabla = "";
        
        $tabla = "<h2>Listado de Servicios</h2><br>";
        
        
        //Dibujamos la tabla
        
        $tabla .= "<table border=\"1\" style=\"border-color: black; border:none;\border-collapse: collapse;\";>";
        
        $tabla .= "<tr>";
        
        $centrado = true;
        
        //Dibujamos los header de las columnas de la tabla
        
        $tabla .= obtenerCabeceraColumna ( "Indice", 50, $centrado );
        $tabla .= obtenerCabeceraColumna ( "Título", 400, !$centrado );
        $tabla .= obtenerCabeceraColumna ( "Categoría", 150, $centrado );
        $tabla .= obtenerCabeceraColumna ( "Tipo", 120, $centrado );
        $tabla .= obtenerCabeceraColumna ( "Precio", 40, $centrado );
        $tabla .= obtenerCabeceraColumna ( "Ubicación", 200, $centrado );
        $tabla .= obtenerCabeceraColumna ( "Ruta Foto", 200, !$centrado );
        $tabla .= obtenerCabeceraColumna ( "Disponibilidad", 120, $centrado );
        $tabla .= obtenerCabeceraColumna ( "Descripción", 500, !$centrado );
        
        $tabla = $tabla . "</tr>";
        
        //Para recorrer los datos de los servicios recorremos el fihero
        
        while (!feof($archivo)) {
            
            //obtenemos una linea del fichero que corresponde a un registro de Servicio
            
            $servicio = fgets($archivo);
            $arrayServicio = explode(";", $servicio);

            if (! empty( $arrayServicio[FECHA_ALTA] ) && sizeof($arrayServicio)  >= 9 ) {
                
                //Si entra aquí es que es un registro de servicio válido, el array tiene todos los campos
                
                $strContador = strval( $contador );
                
                //Obtenemos los valores vienen desde el fichero y los pasamos a variables
                
                $titulo = $arrayServicio[TITULO];
                $precio = strval( $arrayServicio[PRECIO] );
                $foto = $arrayServicio[FOTO_SERVICIO];
                $descripcion = $arrayServicio[DESCRIPCION];
                
                //Obtenemos los valores de listas donde el texto mostrado varía del valor guardado
                //Para ello utilizamos las listas que tenemos en config para obtener el valor del texto
                
                $categoria = $categoriasServicio[$arrayServicio[CATEGORIA]];
                $tipo = $tiposServicio[$arrayServicio[TIPO]];
                $ubicacion = $ambitosServicio[$arrayServicio[UBICACION]];
                $disponibilidad = $disponibilidadesServicio[$arrayServicio[DISPONIBILIDAD]];
                
                
                
                //Dibujamos la linea de celdas de la tabla con los valores
                
                $tabla .= "<tr>";
                
                $tabla .= obtenerCelda ( $strContador, !$centrado );
                $tabla .= obtenerCelda ( $titulo, !$centrado );
                $tabla .= obtenerCelda ( $categoria, $centrado );
                $tabla .= obtenerCelda ( $tipo, $centrado );
                $tabla .= obtenerCelda ( $precio, $centrado );
                $tabla .= obtenerCelda ( $ubicacion, $centrado );
                
                
                if(isset($foto)  && $foto != "")
                {
                    $fotoRuta = $rutaImagenesServicios . $foto;
                    
                    if(!is_file($fotoRuta))
                        $fotoRuta = "";
                    
                    $tabla .= obtenerCeldaImagen ($fotoRuta);
                
                }
                else
                     $tabla .= obtenerCeldaImagen ("");
                
                
                $tabla .= obtenerCelda ( $disponibilidad, $centrado );
                $tabla .= obtenerCelda ( $descripcion, !$centrado );

                $tabla .= "</tr>";

            }
            
            $contador++;
        }
        
        $tabla .= "</table>";
        
        echo ($tabla);
        
        // Si lo he abierto, lo cierro
        fclose($archivo);
    }
}

function obtenerCabeceraColumna( string $titulo, int $width, bool $centrado )
{
    $cabeceraColumna = "<th style=\"width: " . strval($width) . "px; ";

    if ($centrado == true)
        $cabeceraColumna = $cabeceraColumna . "text-align: center";

    $cabeceraColumna = $cabeceraColumna . "\">" . $titulo . "</th>";
     
     return $cabeceraColumna;
}

function obtenerCelda( string $value, bool $centrado )
{
    $celda = "<td";

    if ($centrado == true)
        $celda .= " style=\" text-align: center\"";

    $celda .= ">" . $value . "</td>";
     
     return $celda;
}

function obtenerCeldaImagen(string $fotoRuta)
{
    $celdaImagen = "";
    
    if($fotoRuta === "")
        $celdaImagen  = "<td ><center><img src=\"" . $fotoRuta . "\" width=100 height=100></img></center></td>";
    else
    {
        $img_size_array = getimagesize($fotoRuta);
        
        $width = $img_size_array[0];
        $height = $img_size_array[1];

        //Nos aseguramos una altura de 100 pixeles y el ancho lo proporcionamos a esta medida
        
        if($height != 100)
        {
            $width = ($width * 100) / $height;
            
            $height = 100;        
        }

        $celdaImagen .="<td ><center><img src=\"" . $fotoRuta . "\" width= " . $width . " height=" . $height . " display : block></img></center></td>";
    }
    
    return $celdaImagen;
}

?>