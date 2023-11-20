<?php
    /****
     * Librería donde incluimos aquellos datos (constantes, variables) 
     * que utilizaremos en todo el proyecto/ejercicio
     * @author Heike Bonilla
     * 
     */

     /**
      * Ruta donde almacenaremos las imágenes que nos suben los usuarios
      */
    const RUTA_IMAGENES ="../imagenes/";

    /**
     * Array que guarda las extensiones válidas
     */
    $extensionesValidas=["gif","jpg", "jpeg", "png"];

    /**
     * Tamaño máximo del fichero subido. En bytes
     */
    $maxFichero=300000;

    /**
    * Array que guarda los idiomas que puede seleccionar el usuario
    */
    $idiomasSistema = array("ingles" => "english", "espanol" => "castellano", "aleman" => "deutsch", "valenciano" => "valenciá");

    /**
     * Array que guarda las categorías de servicio válidas
     */
    $categoriasServicio = array("Jardineria" => "Jardinería", "Clases_Repaso" => "Clases de Repaso", 
                                      "Cuidado_Ancianos" => "Cuidado de ancianos", "Cuidado_Ninyos" => "Cuidado de niños", "Mecanica" => "Mecánica");
    /**
     * Array que guarda los tipos de pago del servicio válidas
     */
    $tiposServicio = array("Pago" => "Pago", "Intercambio" => "Intercambio", "Ambos" => "Ambos");

    /**
     * Array que guarda la disponibilidad del servicio válidas
     */
    $ambitosServicio = array("Valencia" => "Provincia de Valencia", "Comnunidad" => "Comnunidad Valenciana", "Nacional" => "Peninsula y Baleares");

    $categoriasServicio = array("Jardineria" => "Jardinería", "Clases_Repaso" => "Clases de Repaso", 
    "Cuidado_Ancianos" => "Cuidado de ancianos", "Cuidado_Ninyos" => "Cuidado de niños", "Mecanica" => "Mecánica");
    /**
    * Array que guarda los tipos de pago del servicio válidas
    */
    $tiposServicio = array("Pago" => "Pago", "Intercambio" => "Intercambio", "Ambos" => "Ambos");
    /**
    * Array que guarda la disponibilidad del servicio válidas
    */
    $ambitosServicio = array("Valencia" => "Provincia de Valencia", "Comnunidad" => "Comnunidad Valenciana", "Nacional" => "Peninsula y Baleares");
    /**
    * Array que guarda la disponibilidad del servicio válidas
    */
    $disponibilidadesServicio = array("Completa" => "Todo el día", "Manyanas" => "Por la mañana", 
    "Tardes" => "Por la tarde", "Noches" => "Por la noche", "Fines_Semana" => "Fines de semana");


    const TIEMPO_MAX_INACTIVIDAD = 1800;

    const COLOR_BLANCO = "#FFFFFF";
    const COLOR_NARANJA = "#FFD69A";

    const FECHA_ALTA = 0;
    /**
    * Indices del orden de los campos de Usuario en fichero
    */
    const NOMBRE = 1;
    const CORREO = 2;
    const CLAVE = 3;
    const FECHA_NACIMIENTO = 4;
    const FOTO_USUARIO = 5;
    const IDIOMA = 6;
    const DESCRIPCION_USUARIO = 7;

    const TOTAL_CAMPOS_USUARIO = 8;
    /**
    * Indices del orden de los campos de Servicio en fichero
    */
    const TITULO = 1;
    const CATEGORIA = 2;
    const TIPO = 3;
    const PRECIO = 4;
    const UBICACION = 5;
    const FOTO_SERVICIO = 6;
    const DISPONIBILIDAD = 7;
    const DESCRIPCION_SERVICIO = 8;

    const TOTAL_CAMPOS_SERVICIO = 9;
?>