<?php
require_once (__DIR__ . "/../libs/funcionesFicheros.php");
require_once (__DIR__ . "/../libs/bGeneral6.php");
require_once (__DIR__ . "/../libs/config.php");
cabecera("Servicios.php");

$user_image = RUTA_IMAGENES . "usuario2.png";
?>

<center><h1>Listado de Servicios</h1></center><br>

<a href="otra_pagina.php">
        <img src="<?php echo $user_image; ?>" style="with: 50px; height:50px; position: absolute; top: 0; right: 0; padding: 15px 15px;">
</a>

<form action="" method="POST" enctype="multipart/form-data">
    
    <input type="submit" name="bNuevoServicio" VALUE="Crear Nuevo Servicio" style="padding: 5px 15px; background: #99e0b2; border: 0; cursor: pointer; -webkit-border-radius: 5px; border-radius: 5px; position: absolute; top: 40px; left: 30px;">

</form>
