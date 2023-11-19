<?php

session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] == 0) {
     // Redirigir al usuario a la página de login si no está autenticado
     header("Location: login.php");
     exit();
 }

include(__DIR__ . "/../libs/bGeneral.php");
include(__DIR__ . "/../libs/config.php");
include(__DIR__ . "/../libs/funcionesFicheros.php");
include(__DIR__ . "/../libs/bGeneralOswaldo.php");

// Fichero donde se guardan los datos del usuario
$ruta = "../ficheros/usuarios.txt";
$rutaImagenesUsuarios = RUTA_IMAGENES . "Usuarios/";

$errores = [];
$messageError = "Error en el formulario : ";

/**
 * clave
 * fotoUsuario
 * idioma
 * descripcionUsuario
 * bGuardar
 */

//PASO 1-Al cargar el formulario Recogemos los valores originales del usuario

if (isset($_POST["bVolver"])) {
    
    header('Location: servicios.php');
}

$lineas = [];

$encontrado = false;

//Borrame tras la implementación de $_SESSION[];
$usuario = "carlospelaezmenendez@gmail.com";
$clave = "Elefante";

$usuario = "rodolfoprestonmanrique@gmail.com";
$clave = "Monday";

//Si es un fichero existente traemos sus lineas y buscamos el registro
if(count($errores) > 0)
{   
    $messageError = "<br><br><br><br><div><b>" . $messageError . array_values($errores)[0] . "</b></div>";

    echo($messageError);

}    

if(is_file($ruta))
{
    $lineas = file($ruta, FILE_IGNORE_NEW_LINES);

    for($i = 0; $i<count($lineas) && !$encontrado; $i++)
    {
        $arrayUsuarioGuardado =  explode(";", $lineas[$i]);

        if($arrayUsuarioGuardado[CLAVE] === $clave)
        {
            
            $fechaAlta = $arrayUsuarioGuardado[FECHA_ALTA];
            $clave = $arrayUsuarioGuardado[CLAVE];
            $fotoUsuario = $arrayUsuarioGuardado[FOTO_USUARIO];
            $idioma = $arrayUsuarioGuardado[IDIOMA];
            $descripcionUsuario = $arrayUsuarioGuardado[DESCRIPCION_USUARIO];
            $descripcionUsuario = str_replace("<br>", PHP_EOL, $descripcionUsuario);
            
            if(isset($fotoUsuario) && is_file($fotoUsuario))
                $fotoMostrada = $fotoUsuario;
            else
                $fotoMostrada = "../imagenes/subidaImagen.png";
                
            $encontrado = true;
        }
    }
}
else
{
    //Si no es un fichero existente creamos el fichero;
    
    $encontrado = false;
    
    $archivo = fopen($ruta, 'w');
        
    if($archivo !== false );
    {
        fclose($archivo);
    }
}

if(!$encontrado)
{
    $errores["ErrorUsuario"] = "Ha habido un error recuperando sus datos de perfil de usuario. Consulte con su administrador de sistemas.";
}
else
{
    require_once (__DIR__ . "/../vistas/formPerfilUsuario_v2.php");

    if(isset($_POST['bGuardar'])){

        
        //PASO 1-Recogemos el valor del password introducido lo sanitizamos y validamos que no está vacio, pues es un dato obligatorio
        
        $nuevaClave = recoge("clave");

        if (isset($nuevaClave) && $nuevaClave === "") {
            $errores["NoClave"] = "Es obligatorio introducir una contraseña.<br>";
        }
        
        //Validamos que el password es correcto
        cPassword("clave", $errores);
        
        
        if (count($errores) === 0) {
            
            //PASO 2 - Recogemos otros valores. 
            
            //Si la fecha de alta no está asignada, cosa que no debería ocurrir, le damos la fecha actual
            
            if(!isset($fechaAlta))
                    $fechaAlta = date("d-m-Y H:i:s");
               
            $nuevoIdioma = recoge("idioma");
            
            $nuevaDescripcion = recoge("descripcionUsuario");     

            if(isset ($_FILES["fotoUsuario"]) && isset ($_FILES["fotoUsuario"]["name"]) && $_FILES["fotoUsuario"]["name"] != "")
            {
                $nuevaFoto = $rutaImagenesUsuarios . uniqid() . $_FILES["fotoUsuario"]["name"];
            } 

             //PASO 3 - Comprobamos si ha habido cambios con respecto a los valores anteriores
            
            $conCambios = false;
            $fotoCambiada = false;
            
            if(isset($clave) && $clave === $nuevaClave || !isset($clave))
                $conCambios = true;
            else if(isset ($idioma) && $idioma === $nuevoIdioma || !isset($idioma) && $nuevoIdioma != "")
                $conCambios = true;
            else if(isset ($descripcion) && $descripcion === $nuevaDescripcion  || !isset($descripcion) && $nuevaDescripcion != "")
                $conCambios = true;
            else if(isset ($nuevaFoto))
                $conCambios = true;
            
            // PASO 4 - Si no ha habido cambios volvemos a la página de Servicios. Si los ha habido continuamos.
            
           if(!$conCambios)
            {
                header('Location: servicios.php');
            }
            else
            {
                //PASO 5 -Finalmente si no hay errores guardamos el registro del servicio y guardamos la imagen

                 if (count($errores) === 0) {

                    //Recuperamos el archivo lo recorremos linea a linea y cuando encontramos el usuario cambiamos la linea

                    $lineas = file($ruta, FILE_IGNORE_NEW_LINES);
                     
                    $numeroLinea = -1;
                    
                     
                    for($i = 0; $i<count($lineas) && $numeroLinea === -1; $i++)
                    {
                        $arrayUsuario =  explode(";", $lineas[$i]);
                        
                        if($arrayUsuario[CLAVE] === $clave)
                        {
                            $numeroLinea = $i;
                            
                            $rutaFoto = isset ($nuevaFoto)? nuevaFoto : $arrayUsuario[FOTO_USUARIO];
                                
                            $fechaAlta = $arrayUsuario[FECHA_ALTA];
                            $nombre = $arrayUsuario[NOMBRE];
                            $correo = $arrayUsuario[CORREO];
                            $fechaNacimiento = $arrayUsuario[FECHA_NACIMIENTO];
                            $nuevaDescripcion = str_replace(PHP_EOL, "<br>", $nuevaDescripcion);
                            
                            //Actualizamos los datos en session
                            $_SESSION['$nuevoIdioma'] = $idioma;
                            $_SESSION['$contrasena'] = $nuevaClave;
                           
                            $lineas[$i] = "$fechaAlta;$nombre;$correo;$nuevaClave;$fechaNacimiento;$rutaFoto;$nuevoIdioma;$nuevaDescripcion";
                        }
                    }
                    
                    
                    //Si no se ha encontrado guardamos error, en otro caso seguimos con el guardado
                    if( $numeroLinea === -1)
                    {
                        $errores["ErrorUsuario"] = "No se ha encontrado el usuario. ";
                    }
                    else
                    {
                        // Unir todas las líneas 
                        $nuevoContenido = implode(PHP_EOL, $lineas);

                         //Sobrescribir el archivo con el nuevo contenido
                        $guardado = file_put_contents($ruta, $nuevoContenido);
                        
                        print_r($_FILES);
                        
                        //Finalmente, si ha dado error de guardao registramos error y si todo ha ido bien guardamos la imagen
                        if($guardado === false)
                        {
                            $errores["ErrorUsuario"] = "Se ha producido un error guardando su usuario. ";
                        }
                        else 
                        {   
                             if(isset ($nuevaFoto)){

                                $rutaFoto = $rutaImagenesUsuarios . $nuevaFoto;

                                $mensajeErrorImagen = "El perfil del usuario se ha modificado correctamente pero se ha producido un error subiendo su imagen. ";
                                
                                $errorGuardadoImagen = guardarImagen($_FILES["fotoUsuario"], $rutaFoto, $mensajeErrorImagen, $maxFichero, $extensionesValidas);

                                if($errorGuardadoImagen != "") 
                                {
                                    $errores["ErrorFoto"] = $errorGuardadoImagen;
                                }  
                                else
                                {
                                    $_SESSION['rutaFoto'] = $rutaFoto;
                                }
                             }
                            
                             $descripcionUsuario = $nuevaDescripcion;
                            
                              header('Location: servicios.php');
                        }
                    }
                }
            }
        }
    }
}

if(count($errores) > 0)
{   
    $messageError = "<br><br><br><br><div><b>" . $messageError . array_values($errores)[0] . "</b></div>";

    echo($messageError);

}    
?>