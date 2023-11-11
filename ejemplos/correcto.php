<?php
include ('./libs/bGeneral.php');
cabecera (""); //el archivo actual
/*
* Los datos enviados por la URL (GET) se reciben en $_GET y $_REQUEST.
Debemos sanitizarlos antes de utilizarlos
*/

echo "Nombre:", recoge('nombre');
echo '<br>';
echo "Edad:", recoge('edad');
pie();
?>