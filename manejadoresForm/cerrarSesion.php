<?php

session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] == 0) {
     // Redirigir al usuario a la página de login si no está autenticado
     header("Location: login.php");
     exit();
 }

$ahora = date("Y-n-j H:i:s");

$_SESSION['autenticado'] = 0;
$_SESSION["ultimoAcceso"] = $ahora;

session_unset();     
session_destroy();   
header("Location: login.php");
exit();

?>