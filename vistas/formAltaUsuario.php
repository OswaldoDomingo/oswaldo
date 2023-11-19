<?php
require_once (__DIR__ . "/../libs/funcionesFicheros.php");
require_once (__DIR__ . "/../libs/bGeneral6.php");
require_once (__DIR__ . "/../libs/config.php");
require_once (__DIR__ . "/../libs/bRafa.php");
cabecera("Test.php");
if (isset($errores)&&count($errores) === 0) {
    foreach ($errores as $val) {
        echo $val;
    }
}
?>

<h1>Registro Usuario</h1>
<form action="" method="POST" enctype="multipart/form-data">
    <label for="nombre">Nombre</label><br>
    <input type="text" name="nomnbreRegUser" id="nombre" VALUE="<?= isset($nombre)?$nombre: "";?>"><br>
    <?php echo (isset($errores['nomnbreRegUser'])) ? "$errores[nomnbreRegUser]" : "";
    echo "<br>"; ?>

    <label for="correo">Correo</label><br>
    <input type="text" name="correoRegUser" id="correo" VALUE="<?= isset($correo)?$correo: "";?>"><br>
    <?php echo (isset($errores['correoRegUser'])) ? "$errores[correoRegUser]" : "";
    echo "<br>"; ?>

    <label for="acceso">Contraseña</label><br>
    <input type="password" name="contrasenyaRegUser" id="acceso" VALUE="<?= isset($contrasenya)?$contrasenya: "";?>"><br>
    <?php echo (isset($errores['contrasenyaRegUser'])) ? "$errores[contrasenyaRegUser]" : "";
    echo "<br>"; ?>

    <label for="fechaNacimiento">Fecha nacimiento</label><br>
    <input type="date" name="fechaNacimientoRegUser" id="fechaNacimiento" VALUE="<?= isset($fechaNacimiento)?$fechaNacimiento: "";?>"><br>
    <?php echo (isset($errores['fechaNacimientoRegUser'])) ? "$errores[fechaNacimientoRegUser]" : "";
    echo "<br>"; ?>

    <label for="fotoPerfil">Foto de perfil</label><br>
    <input type="file" name="fotoPerfilRegUser" id="fotoPerfilRegUser" VALUE="<?= isset($fotoPerfil)?$fotoPerfil: "";?>"><br>
    <?php echo (isset($errores['fotoPerfilRegUser'])) ? "$errores[fotoPerfilRegUser]" : "";
    echo "<br>"; ?>
    
    <label for="idiomas">Idioma</label><br>
    <select name="idiomaRegUser" id="idiomas">
        <option value="">--Por favor elige una opción--</option>
        <option value="ingles">English</option>
        <option value="castellano">Castellano</option>
    </select>
    <?php echo (isset($errores['idiomaRegUser'])) ? "$errores[idiomaRegUser]" : "";
    echo "<br>"; ?>

    <label for="comentarios">Comentarios</label><br>
    <textarea name="comentariosRegUser" id="comentarios" cols="30" rows="10" placeholder="Escribe una reseña sobre tí."></textarea><br>
    <?php echo (isset($errores['comentariosRegUser'])) ? "$errores[comentariosRegUser]" : "";
    echo "<br>"; ?>
    
    <input type="submit" value="Enviar" name="enviarRegUser">
 
<!--</form>
	<input type="file" id="myFile" name="fotoServicio"><br><br><br><br>

    <input TYPE="submit" name="bGuardar" VALUE="Guardar" style="padding: 5px 15px; background: #99e0b2; border: 0; cursor: pointer; position: absolute; top: 585px; left: 350px;">-->
    
</form>