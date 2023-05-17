<?php
	/**
	 * Establecer Hora Predeterminada Para El Sitema
	*/
	ini_set('date.timezone','America/El_Salvador');

	/**
	 * Variable Global Para La Fecha
	*/
    $FechaActual = date('Y-m-d H:i:s', time());

    /**
     * Array con la fecha y hora: array(0 => 'yy-mm-dd', 1 => '00:00:00')
    */
    $FechaHora = explode(' ', $FechaActual);
    
    /**
     * Ruta principal del server
    */
    define('PATH', 'http://' . $_SERVER['SERVER_NAME'] . '/rygo');

	/**
	 * Ruta principal para guardar archivos
	*/
	define('PATH_IMG', $_SERVER['DOCUMENT_ROOT'] . '/rygo/assets/files');
?>