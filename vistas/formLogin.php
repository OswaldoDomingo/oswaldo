<form action="" method="post">
    <label for="correo">Usuario</label>
    <input type="email" name="correoLogin" id="correo" novalidate>
    <br>
        <?php echo (isset($errores['correoLogin'])) ? "$errores[correoLogin]" : ""; echo "<br>"; ?>
    <label for="acceso">Contraseña</label>
    <input type="password" name="contrasenyaLogin" id="acceso" novalidate>
    <br>
        <?php echo (isset($errores['contrasenyaLogin'])) ? "$errores[contrasenyaLogin]" : ""; echo "<br>"; ?>
    <br>
    <input type="submit" value="Enviar" name="enviarLogin">

</form>