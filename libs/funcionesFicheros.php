<?php




function guardarAlPrincipio ($ruta, $msg) {
    echo "guardarAlPrincipio";
    $archivo = file_get_contents($ruta);
    $msg=$msg.$archivo;
    echo "file_put_contents";
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


function imprimirLineaALinea($ruta, $arrayLabels){
    
    while (!feof($ruta)) {
        
        $linea = fgets($ruta);
        $valores = explode(";", $linea);

        if (! empty($valores[0]) && sizeof($valores) >= sizeof($arrayLabels) )
        {
            for($i = 0; $i < sizeof($arrayLabels); $i++)
            {
                echo $arrayLabels[$i] . " :  " . $arrayServicio[$i];

                echo "<br>";
            }
        }
    }
     
}

?>
