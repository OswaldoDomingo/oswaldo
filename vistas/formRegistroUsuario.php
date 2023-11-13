<!-- Este formulario se llamará desde el botón “AltaUsuario” del formulario inicial de Login.
En el se incluirán los siguientes campos:
[x] Nombre- Campo de texto donde el usuario deberá introducir el nombre completo
[x] Correo- Campo de texto donde el usuario deberá introducir su dirección de email.
[x] Clave- Campo de texto donde el usuario deberá introducir su clave de acceso. Por seguridad deberán ocultarse los caracteres con un carácter máscara (asterisco, por ejemplo).
[x] Fecha de nacimiento - Campo de tipo Fecha donde el usuario deberá introducir su fecha de nacimiento.
[x] Foto de perfil - Espacio para imagen vacío, con un botón al lado. Al pulsar el botón deberá cargar una imagen (tipo carnet) desde el disco del usuario.
[x] Idioma - Control desplegable de selección para que el usuario seleccione su idioma preferente en una lista de ellos.
[] Texto sobre tí - Descripción, texto libre donde el usuario se presente a sí mismo o hable de gustos y preferencias o escriba cualquier cosa que le identifique.
Y el botón siguientes :
[] Guardar- Botón de acción de guardar que deberá ejecutar el archivo altaUsuario.php. -->

<h1>Alta usuario</h1>
<form action="" method="post">
    <label for="nombre">Nombre</label><br>
    <input type="text" name="nomnbreRegUser" id="nombre"><br>
    <?php echo (isset($errores['nomnbreRegUser'])) ? "$errores[nomnbreRegUser]" : "";
    echo "<br>"; ?>

    <label for="correo">Correo</label><br>
    <input type="text" name="correoRegUser" id="correo"><br>
    <?php echo (isset($errores['correoRegUser'])) ? "$errores[correoRegUser]" : "";
    echo "<br>"; ?>

    <label for="acceso">Contraseña</label><br>
    <input type="password" name="contrasenyaRegUser" id="acceso"><br>
    <?php echo (isset($errores['contrasenyaRegUser'])) ? "$errores[contrasenyaRegUser]" : "";
    echo "<br>"; ?>

    <label for="fechaNacimiento">Fecha nacimiento</label><br>
    <input type="date" name="fechaNacimientoRegUser" id="fechaNacimiento"><br>
    <?php echo (isset($errores['fechaNacimientoRegUser'])) ? "$errores[fechaNacimientoRegUser]" : "";
    echo "<br>"; ?>

    <label for="fotoPerfil">Foto de perfil</label><br>
    <input type="file" name="fotoPerfilRegUser" id="fotoPerfilRegUser"><br>
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
 
</form>