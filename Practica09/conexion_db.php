<?php

// Conecta con el servidor de MySQL 
 $mysqli = @new mysqli( 
	'localhost',   // El servidor 
	'root',    // El usuario 
	'',          // La contraseña 
	'pidb'); // La base de datos 

	if($mysqli->connect_errno) { 
		echo '<p>Error al conectar con la base de datos: ' . $mysqli->connect_error; 
		echo '</p>'; 
		exit; 
	} 

	if (!$mysqli->set_charset("utf8")) { //(1)
    	printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
    	exit;
	}


	//ACLARACIONES:

	//(1): Para establecer la codificacion al recibir y enviar datos del servidor de la base de datos a utf-8 para asi poder enviar y recibir sin ningun problema caracteres especiales como la ñ, los acentos, etc. Sin esta instruccion, php puede trabajar con otra codificacion por defecto como puede ser latin1 y es por esto que no todos los caracteres se enviaran correctamente al servidor de la base de datos al ser codificaciones distintas y ademas no se mostraran correctamente los datos proporcionados mediante una consulta select a dicho servidor de base de datos

?>