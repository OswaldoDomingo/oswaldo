<?php
require_once (__DIR__ . "/../lib/funcionesFicheros.php");
require_once (__DIR__ . "/../lib/bGeneral6.php");
require_once (__DIR__ . "/../lib/config.php");
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
            
                    <?php
                        $categoriaKeys = array_keys($categoriasServicio);

                        foreach($categoriaKeys as $categoriaKey)
                        {
                            echo("<option value=\"" . $categoriaKey . "\">" . $categoriasServicio[$categoriaKey] . "</option>");
                        }
                    ?>
    
        </select><br><br>
    <br>
	<?php
        echo (isset($errores['categoria'])) ? "$errores[categoria] <br>" : "";
    ?>
    
    Tipo Servicio: <select id="tipo" name="tipo" VALUE="<?= isset($tipo)?$tipo: "";?>">
                        <option value=""></option>
                        <?php
                            $tipoKeys = array_keys($tiposServicio);

                            foreach($tipoKeys as $tipoKey)
                            {
                                echo("<option value=\"" . $tipoKey . "\">" . $tiposServicio[$tipoKey] . "</option>");
                            }
                        ?>
        </select>
	<?php
        echo (isset($errores['tipo'])) ? "$errores[tipo] <br>" : "";
    ?>
    
    &nbsp&nbsp&nbsp&nbsp&nbsp
    
    Precio Hora: <input TYPE="text" NAME="precio" VALUE="<?= isset($precioHora)?precio: "";?>"><br><br>
    <br>
	<?php
        echo (isset($errores['precio'])) ? "$errores[precio] <br>" : "";
    ?>

    <!--<input TYPE="text" NAME="ubicacion" VALUE="<?= isset($ubicacion)?$ubicacion: "";?>"><br><br>-->
    <!--<br>-->
    Ámbito: <select id="ubicacion" name="ubicacion" VALUE="<?= isset($ubicacion)?$ubicacion: "";?>">
                <option value=""></option>
                <?php
                    $ambitoKeys = array_keys($ambitosServicio);

                    foreach($ambitoKeys as $ambitoKey)
                    {
                        echo("<option value=\"" . $ambitoKey . "\">" . $ambitosServicio[$ambitoKey] . "</option>");
                    }
                ?>
        </select><br><br><br>
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
        {
            echo "<input type=\"file\" id=\"myFile\" name=\"fotoServicio\"><br><br><br><br>";
            //echo "<input type=\"submit\" name=\"bSubirFoto\" VALUE=\"SubirFoto\"><br><br><br><br>";
        }   
    ?>

    Disponibilidad: <select id="disponibilidad" name="disponibilidad" VALUE="<?= isset($disponibilidad)?$disponibilidad: "";?>">
            <option value=""></option>
            <?php
                $disponibilidadKeys = array_keys($disponibilidadesServicio);

                foreach($disponibilidadKeys as $disponibilidadKey)
                {
                    echo("<option value=\"" . $disponibilidadKey . "\">" . $disponibilidadesServicio[$disponibilidadKey] . "</option>");
                }
            ?>
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