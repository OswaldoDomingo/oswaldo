<?php
//Pinta la cabecera HTML
function cabecera($titulo=NULL) // el archivo actual
{
    if (is_null($titulo)) {
        $titulo = basename(__FILE__);
    }
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>
				<?php
    echo $titulo;
    ?>
			
			</title>
<meta charset="utf-8" />
</head>
<body>
<?php
}

//Pinta el pie de página HTML
function pie()
{
    echo "</body>
	</html>";
}

//Función que sustituye las vocales con tilde por la misma sin tildes
function sinTildes($frase)
{
    $no_permitidas = array(
        "á",
        "é",
        "í",
        "ó",
        "ú",
        "Á",
        "É",
        "Í",
        "Ó",
        "Ú",
        "à",
        "è",
        "ì",
        "ò",
        "ù",
        "À",
        "È",
        "Ì",
        "Ò",
        "Ù"
    );
    $permitidas = array(
        "a",
        "e",
        "i",
        "o",
        "u",
        "A",
        "E",
        "I",
        "O",
        "U",
        "a",
        "e",
        "i",
        "o",
        "u",
        "A",
        "E",
        "I",
        "O",
        "U"
    );
    $texto = str_replace($no_permitidas, $permitidas, $frase);
    return $texto;
}

//Función que elimina los espacios sobrantes, 
//al inicio de la cadena y más de uno en los caracteres intermedios
function sinEspacios($frase)
{
    $texto = trim(preg_replace('/ +/', ' ', $frase));
    return $texto;
}

//Función que sanitiza la información. Además si no existe el control lo pone a ""
function recoge($var)
{
    if (isset($_REQUEST[$var])&&(!is_array($_REQUEST[$var]))){
        $tmp=sinEspacios($_REQUEST[$var]);
        $tmp = strip_tags($tmp);
        
    }
    else
        $tmp = "";

    return $tmp;
}
/*
Función que permite validar cadenas de texto.
Le pasamos cadena, nombre de campo y array de errores y 
de manera voluntaria mínimo y máximo de caracteres (si = sería campo no requerido) , 
si permitimos o no espacios en nuestra cadena y si la cadena es o no sensible a mayúsculas
*/

function cTexto(string $text, string $campo, array &$errores, int $max = 30, int $min = 1, bool $espacios = TRUE, bool $case = TRUE)
{
$case=($case===TRUE)?"i":"";
$espacios=($espacios===TRUE)?" ":"";
if ((preg_match("/^[a-zñ$espacios]{" . $min . "," . $max . "}$/u$case", sinTildes($text)))) {
    return true;
}
$errores[$campo] = "Error en el campo $campo";
 return false;
}

/*
Función que valida una cadena que contiene sólo números.
Además valida si el campo es o no requerido y el valor máximo
*/
function cNum(string $num, string $campo, array &$errores, bool $requerido=TRUE, int $max=PHP_INT_MAX)
{   $cuantificador= ($requerido)?"+":"*";
        if ((preg_match("/^[0-9]".$cuantificador."$/", $num))&&($num<=$max) ) {

        return true;
    }
    $errores[$campo] = "Error en el campo $campo";
    return false;
}

function cCheck (array $text, string $campo, array &$errores, array $valores, bool $requerido=TRUE)
{
   
    if (($requerido) && (count($text)==0)){
        $errores[$campo] = "Error en el campo $campo";
        return false;
        }
    foreach ($text as $valor){
        if (!in_array($valor, $valores)){
            $errores[$campo] = "Error en el campo $campo";
            return false;
        }
        
    }
    return true;
}

function cFile(string $nombre, array &$errores, array $extensionesValidas, string $directorio, int  $max_file_size,  bool $required = TRUE)
{
    
    if ((!$required) && $_FILES[$nombre]['error'] === 4)
        return true;
    
    if ($_FILES[$nombre]['error'] != 0) {
        $errores["$nombre"] = "Error al subir el archivo " . $nombre . ". Prueba de nuevo";
        return false;
    } else {

        $nombreArchivo = strip_tags($_FILES["$nombre"]['name']);
       
        $directorioTemp = $_FILES["$nombre"]['tmp_name'];
        
        $tamanyoFile = filesize($directorioTemp);
        
        
        $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));

        if (!in_array($extension, $extensionesValidas)) {
            $errores["$nombre"] = "La extensión del archivo no es válida";
            return false;
        }
       
        if ($tamanyoFile > $max_file_size) {
            $errores["$nombre"] = "La imagen debe de tener un tamaño inferior a $max_file_size kb";
            return false;
        }


        if (empty($errores)) {
         
            if (is_dir($directorio)) {
             
                $nombreArchivo = is_file($directorio . DIRECTORY_SEPARATOR . $nombreArchivo) ? time() . $nombreArchivo : $nombreArchivo;
                $nombreCompleto = $directorio . DIRECTORY_SEPARATOR . $nombreArchivo;
               
                if (move_uploaded_file($directorioTemp, $nombreCompleto)) {
                   
                    return $nombreCompleto;
                } else {
                    $errores["$nombre"] = "Ha habido un error al subir el fichero";
                    return false;
                }
            }else {
                $errores["$nombre"] = "Ha habido un error al subir el fichero";
                return false;
            }
        }
    }
}



//***** Funciones de sanitización **** //

function recogeArray(string $var):array
{
    $array=[];
    if (isset($_REQUEST[$var])&&(is_array($_REQUEST[$var]))){
        foreach($_REQUEST[$var] as $valor)
        $array[]=strip_tags(sinEspacios($valor));
        
    }
    
    return $array;
}
   



?>