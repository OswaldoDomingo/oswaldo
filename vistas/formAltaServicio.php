<?php
require_once (__DIR__ . "/../lib/funcionesFicheros.php");
require_once (__DIR__ . "/../lib/bGeneral6.php");
require_once (__DIR__ . "/../lib/bRafa.php");
cabecera("AltaServicio.php");
if (isset($errores)&&count($errores) === 0) {
    foreach ($errores as $val) {
        echo $val;
    }
}
?>

<form action="" method="POST" enctype="multipart/form-data">
	
    <h1>Dar de alta un servicio</h1>
    
    Nombre: <input TYPE="text" NAME="titulo" VALUE="<?= isset($titulo)?titulo: "";?>"><br><br>
	<br>
    <?php
        echo (isset($errores['titulo'])) ? "$errores[titulo] <br>" : "";
    ?>
	
    Categoría: <select id="categoria" name="categoria" VALUE="<?= isset($categoria)?$categoria: "";?>">
            <option value=""></option>
            <option value="Jardineria">Jardinería</option>
            <option value="Clases_Repaso">Clases de Repaso</option>
            <option value="Cuidado_Ancianos">Cuidado de ancianos</option>
            <option value="Cuidado_Ninos">Cuidado de niños</option>
            <option value="Mecanica">Mecánica</option>
        </select><br><br>
    <br>
	<?php
        echo (isset($errores['categoria'])) ? "$errores[categoria] <br>" : "";
    ?>
    
    Tipo Servicio: <select id="tipo" name="tipo" VALUE="<?= isset($tipo)?$ctipo: "";?>">
            <option value=""></option>
            <option value="Pago">De Pago</option>
            <option value="Intercambio">Por Intercambio</option>
            <option value="Ambos">Ambos</option>
        </select><br><br>
    <br>
	<?php
        echo (isset($errores['tipo'])) ? "$errores[tipo] <br>" : "";
    ?>
    
    Precio Hora: <input TYPE="text" NAME="precio" VALUE="<?= isset($precioHora)?precio: "";?>"><br><br>
    <br>
	<?php
        echo (isset($errores['precio'])) ? "$errores[precio] <br>" : "";
    ?>

    Ubicación: <input TYPE="text" NAME="ubicacion" VALUE="<?= isset($ubicacion)?$ubicacion: "";?>"><br><br>
    <br>
	<?php
        echo (isset($errores['ubicacion'])) ? "$errores[ubicacion] <br>" : "";
    ?>
    <?php
        if(isset($titulo) && isset($propietario))
        {
            $rutaImagenServicio = "./imagenes/servicios/".$titulo.$propietario.".jpg"; 
            echo "Foto de servicio: <img src = '$rutaImagenServicio' alt='Servicio'><br><br>";
        }
        else    
            echo "Foto de servicio: <img src = '' alt='Servicio'><br><br>";
        //echo "<input TYPE="file" id="foto" name="foto">;"
    ?>

    Disponibilidad: <select id="disponibilidad" name="disponibilidad" VALUE="<?= isset($disponibilidad)?$disponibilidad: "";?>">
            <option value=""></option>
            <option value="Completa">Completa</option>
            <option value="Manyanas">Mañanas</option>
            <option value="Tardes">Tardes</option>
            <option value="Noches">Noches</option>
            <option value="Fines_de_semana">Fines de semana</option>
        </select><br><br>
    <br>
	<?php
        echo (isset($errores['disponibilidad'])) ? "$errores[disponibilidad] <br>" : "";
    ?>

    Descripción Servicio: <textarea TYPE="text" NAME="descripcionServicio" rows="5" cols="30" VALUE ="<?= isset($descripcionServicio)?$descripcionServicio:"" ;?>"></textarea>
    
    <br><br><br>
	<?php
        echo (isset($errores['descripcionServicio'])) ? "$errores[descripcionServicio] <br>" : "";
    ?>

	<br>
    <input TYPE="submit" name="bGuardar" VALUE="Guardar">
</form>