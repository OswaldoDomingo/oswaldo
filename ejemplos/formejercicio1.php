<!--IMPORTANTE
No ejecutes este fichero directamente. Se carga desde ejercicio1.php con un include
-->


<form action="" method='post'>
	Nombre: <input TYPE="text" NAME="nombre" VALUE="<?= isset($nombre)?$nombre: "";?>">
	<br>
<?php
echo (isset($errores['nombre'])) ? "$errores[nombre] <br>" : "";
?>
	    Edad: <input TYPE="text" NAME="edad" VALUE="<?= isset($edad)?$edad: "";?>">
	<br>
		<?php
echo (isset($errores['edad'])) ? "$errores[edad] <br>" : "";

?>
	<br>
    <input TYPE="submit" name="bAceptar" VALUE="aceptar">
</form>