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

    /**
     * Array que guarda la disponibilidad del servicio válidas
     */
    $disponibilidadesServicio = array("Completa" => "Todo el día", "Manyanas" => "Por la mañana", 
                                      "Tardes" => "Por la tarde", "Noches" => "Por la noche", "Fines_Semana" => "Fines de semana");

    /**
     * Indices del orden de los campos de Servicio en fichero
     */
     const FECHA_ALTA = 0;
     const TITULO = 1;
     const CATEGORIA = 2;
     const TIPO = 3;
     const PRECIO = 4;
     const UBICACION = 5;
     const FOTO_SERVICIO = 6;
     const DISPONIBILIDAD = 7;
     const DESCRIPCION = 8;
?>