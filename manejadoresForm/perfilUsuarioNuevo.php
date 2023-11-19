<?php
session_start();
echo "<h1>Perfil de usuario</h1>";

// Suponiendo que el correo y la contraseña están almacenados en la sesión
$correoUsuario = $_SESSION['usuario'];
$contrasenaUsuario = $_SESSION['contrasena'];

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] == 1) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Leer el archivo de usuarios en un array
    $usuarios = file('../ficheros/usuarios.txt', FILE_IGNORE_NEW_LINES);

    // Buscar la línea que contiene la información del usuario actual
    $usuarioEncontrado = false;
    $index = 0;
    while(!$usuarioEncontrado && $index < count($usuarios)) {
        $partes = explode(';', trim($usuarios[$index]));
        if ($partes[2] === $correoUsuario && $partes[3] === $contrasenaUsuario) {
            // Para cada campo, verificar si el valor enviado es diferente al valor en la sesión
            if ($_FILES['foto']['name'] !== $_SESSION['rutaFoto']) {
                // Actualizar el valor en la sesión y en el archivo
                $_SESSION['rutaFoto'] = $_FILES['foto']['name'];
                $partes[5] = $_SESSION['rutaFoto'];
            }
            if ($_POST['idioma'] !== $_SESSION['idioma']) {
                $_SESSION['idioma'] = $_POST['idioma'];
                $partes[6] = $_SESSION['idioma'];
            }
            if ($_POST['comentarios'] !== $_SESSION['comentarios']) {
                $_SESSION['comentarios'] = $_POST['comentarios'];
                $partes[7] = $_SESSION['comentarios'];
            }

            $usuarios[$index] = implode(';', $partes);
            $usuarioEncontrado = true;
        }
        $index++;
    }

    // Reescribir el archivo de usuarios con el array actualizado
    file_put_contents('../ficheros/usuarios.txt', implode("\n", $usuarios));
}

?>

<!-- Formulario HTML para actualizar la foto, el idioma y los comentarios -->
<form method="post" enctype="multipart/form-data">
    <label for="foto">Foto:</label>
    <input type="file" id="foto" name="foto" required><br>
    <label for="idioma">Idioma:</label>
    <select id="idioma" name="idioma" required>
        <option value="es">Español</option>
        <option value="en">Inglés</option>
    </select><br>
    <label for="comentarios">Comentarios:</label>
    <textarea id="comentarios" name="comentarios" required></textarea><br>
    <input type="submit" value="Actualizar">
</form>