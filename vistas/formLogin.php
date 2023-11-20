<form action="" method="post">
    <center><h1>Accede para ofrecer y contratar servicios con particulares</h1></center>
    <center><p>
            <label for="correo">Usuario</label>
            <input type="email" name="correoLogin" size="25" id="correo" novalidate>
    </p></center>
    
        <?php echo (isset($errores['correoLogin'])) ? "$errores[correoLogin]" : ""; ?>
    
    <center><p>
            <label for="acceso">Contraseña</label>
            <input type="password" name="contrasenyaLogin" size="25"  id="acceso" novalidate>
    </p></center>
    
        <?php echo (isset($errores['contrasenyaLogin'])) ? "$errores[contrasenyaLogin]" : "";  ?>
    
    
    <center><input type="submit" value="Enviar" name="enviarLogin"></center>

</form>

<center><a href="../manejadoresForm/altaUsuario.php">Registrarse como nuevo usuario</a></center><br><br><br>