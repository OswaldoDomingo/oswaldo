<h1>Perfil usuario</h1>
<form action="" method="post">

    <label for="acceso">Contraseña</label><br>
    <input type="password" name="clave" id="clave" VALUE="<?= isset($clave)?$clave: "";?>"><br>
    <?php echo (isset($errores['clave'])) ? "$errores[clave]" : "";
    echo "<br>"; ?>
<!--password-->
    <label for="fotoPerfil">Foto de perfil</label><br>
    <img src="<?= isset($fotoMostrada)?$fotoMostrada: "";?>"  width="100px" height="100px" alt="MDN"/><br>
    <?php
            if(isset($fotoUsuario) && is_file($fotoUsuario))
                echo("<label for=\"SeleccionaFoto\">Cambia tu foto pulsando el botón</label>");
            else
                echo("<label for=\"SeleccionaFoto\">Sube la foto pulsando el botón</label>");
        ?>
    <input type="file" id="myFile" name="fotoServicio"><br><br><br><br>";
<!--    <input type="file" name="fotoUsuario" id="fotoUsuario"><br>-->
    <?php echo (isset($errores['fotoUsuario'])) ? "$errores[fotoUsuario]" : "";
    echo "<br><br>"; ?>

    <label for="idiomas">Idioma</label><br>
    <select name="idioma" id="idioma" VALUE="ingles">
        <?php
            if(isset($idioma))
            {
                switch($idioma)
                {
                    case ("castellano"):
                        echo("<option value=\"\">--Por favor elige una opción--</option>");
                        echo("<option value=\"ingles\">English</option>");
                        echo("<option value=\"castellano\" selected>Castellano</option>");
                        break;
                    case ("ingles"):
                        echo("<option value=\"\">--Por favor elige una opción--</option>");
                        echo("<option value=\"ingles\" selected>English</option>");
                        echo("<option value=\"castellano\">Castellano</option>");
                        break;
                    default:
                        echo("<option value=\"\" selected>--Por favor elige una opción--</option>");
                        echo("<option value=\"ingles\" selected>English</option>");
                        echo("<option value=\"castellano\">Castellano</option>");
                        
                        if($idioma !== "")
                            $idioma = "";
                        break;    
                }
            }
        ?>
    </select>
    <?php echo (isset($errores['idioma'])) ? "$errores[idioma]" : "";
    echo "<br><br><br>"; ?>

    <label for="comentarios">Comentarios</label><br>
    <textarea TYPE="text"  NAME="descripcionUsuario" id="descripcionUsuario" cols="30" rows="10" placeholder="Escribe una reseña sobre tí."><?= isset($descripcionUsuario)?$descripcionUsuario: "";?>"></textarea><br>                         
    <?php echo (isset($errores['descripcionUsuario'])) ? "$errores[descripcionUsuario]" : "";
    echo "<br>"; ?>
    
    <input TYPE="submit" name="bGuardar" VALUE="Guardar" style="padding: 5px 15px; background: #99e0b2; border: 0; cursor: pointer; position: absolute; top: 600px; left: 210px;">
    
    <input type="submit" name="bVolver" VALUE="<- Volver" style="padding: 5px 15px; background: #99e0b2; border: 0; cursor: pointer; position: absolute; top: 600px; left: 10px;">
    
</form>