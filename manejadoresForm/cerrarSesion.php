<?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] == 0) {
     // Redirigir al usuario a la página de login si no está autenticado
     header("Location: login.php");
     exit();
 }

session_destroy(); // destruyo la sesión

$ahora = date("Y-n-j H:i:s");

$_SESSION['autenticado'] = 0;
$_SESSION["ultimoAcceso"] = $ahora;

header("Location: login.php"); 

?>