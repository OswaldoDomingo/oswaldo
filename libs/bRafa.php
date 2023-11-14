<?php

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

?>