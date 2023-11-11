<?php
/*
Realizamos la carga del formulario en caso de que todavía no tengamos datos que procesar 
(no hemos pulsado el botón del formulario) o cuando hay errores de validación.
*/
include ('./libs/bGeneral.php');
cabecera();
$error = false;

// array donde almacenaremos el texto de los errores encontrados
$errores=[];
$nombre="";
$edad="";
//Compruebo si se ha pulsado el botón del formulario
if (!isset($_REQUEST['bAceptar'])) {

/*
Realizamos la carga del formulario en caso de que todavía no tengamos datos que procesar 
(no hemos pulsado el botón del formulario). Sería lo mismo que tener aquí el código del
formulario pero de esta manera el código es más claro y más facil para modificar  y
realizar en equipo
*/
include ('formEjercicio1.php');

} // Si se ha pulsado procesamos los datos recibidos
else {
    //Sanitizamos
    $nombre = recoge("nombre");
    $edad = recoge('edad');

    //Validamos cadena campo nombre requerido, tamaño 40 caracteres
    cTexto($nombre, "nombre", $errores,40);

    //Validamos cadena campo edad, requerido, menor de 150
    cNum($edad, "edad", $errores,true,150);

    //Sino se han encontrado errores pasamos a otra página
    if (empty($errores)) {

        /* 
        * Realizamos la redirección a correcto.php. Le pasamos datos por la URL (GET)
        * En correcto.php recibiremos los datos pasados por la URL y tendremos que sanitizarlos (recogerlos)
        */

        header("location:correcto.php?nombre=$nombre&edad=$edad");
    } else {

        //Volvemos a mostrar el formulario y mostraremos &errores
        include ('formEjercicio1.php');
    }
}
?>
		  

<?php

pie();
?>
