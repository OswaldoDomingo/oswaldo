<?php
require_once (__DIR__ . "/../libs/funcionesFicheros.php");
require_once (__DIR__ . "/../libs/bGeneral6.php");
require_once (__DIR__ . "/../libs/config.php");
cabecera("Servicios.php");
?>

<style>
        body{
            background-color: <?php echo $colorFondo; ?>;
        }
</style>

<center><h1>Listado de Servicios</h1></center><br>

<img src="<?php echo $colorImagen; ?>" alt="CambioColor" style="width: 50px; height:50px; position: absolute; top: 0; right: 0; padding: 30px 215px;">

<a href="perfilUsuario.php">
        <img src="<?php echo $usuarioFoto; ?>" alt="perfilUsuario2" style="width: 50px; height:50px; cursor: pointer;  position: absolute; top: 0; right: 0; padding: 30px 115px;">
</a>

<label for="user"  style="witdh: 50px; height:50px; position: absolute; top: 0; right: 0; padding: 5px 70px;"><?php echo $usuarioNombre; ?></label>

<a href="cerrarSesion.php">
        <img src="../imagenes/logOut.png" alt="perfilUsuario2" style="witdh: 50px; height:50px; cursor: pointer;  position: absolute; top: 0; right: 0; padding: 30px 15px;">
</a>

<form action="" method="POST" enctype="multipart/form-data">
    
    <input type="submit" name="bNuevoServicio" VALUE="Crear Nuevo Servicio" style="padding: 5px 15px; background: #99e0b2; border: 0; cursor: pointer; -webkit-border-radius: 5px; border-radius: 5px; position: absolute; top: 40px; left: 30px;">

    <input type="submit" name="bCambioColor" VALUE="Cambiar" style="background: <?php echo $colorCambio; ?>; padding: 5px 15px; border: 0; cursor: pointer; -webkit-border-radius: 5px; border-radius: 5px; position: absolute; top: 5px; right: 200px;">
</form>
