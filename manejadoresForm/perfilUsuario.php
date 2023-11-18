<?php
session_start();
echo "<h1>Perfil de usuario</h1>";

// if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] == 1) {
//     // Redirigir al usuario a la página de login si no está autenticado
//     header("Location: login.php");
//     exit();
// }
// Suponiendo que el correo y la contraseña están almacenados en la sesión
$correoUsuario = $_SESSION['usuario'];
$contrasenaUsuario = $_SESSION['contrasena']; // Asegúrate de que estás almacenando la contraseña de forma segura

// Leer el archivo de usuarios y buscar los datos del usuario actual
$usuarios = fopen('../ficheros/usuarios.txt', 'r');
 if($usuarios) {
    while (($linea = fgets($usuarios)) !== false) {
        // Asegúrate de que hay suficientes elementos en la línea
        $partes = explode(';', trim($linea));
        if (count($partes) >= 7) {
            list($nombre, $correo, $contrasena, $fechaNacimiento, $rutaFoto, $idioma, $comentarios) = $partes;

            if ($correo === $correoUsuario && $contrasena === $contrasenaUsuario) {
                // Encontrado el usuario, almacenar datos en la sesión
                $_SESSION['nombre'] = $nombre;
                $_SESSION['fechaNacimiento'] = $fechaNacimiento;
                $_SESSION['rutaFoto'] = $rutaFoto;
                $_SESSION['idioma'] = $idioma;
                $_SESSION['comentarios'] = $comentarios;
                break;
            }
        }
    }
    fclose($usuarios);
} else {
    echo "No se pudo abrir el archivo de usuarios.";
}

echo "Nombre: " . $_SESSION['nombre'] . "<br>";
echo "Correo: " . $correoUsuario . "<br>"; // ya que el correo está en la sesión
echo "<img src='" . $_SESSION['rutaFoto'] . "' alt='Foto de perfil'><br>";
echo "Fecha de Nacimiento: " . $_SESSION['fechaNacimiento'] . "<br>";
echo "Idioma: " . $_SESSION['idioma'] . "<br>";
echo "Comentarios: " . $_SESSION['comentarios'] . "<br>";
