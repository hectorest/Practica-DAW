<?php

	function extraerPais(&$IdP){

		$sentencia = 'SELECT NomPais FROM paises WHERE IdPais =' . $IdP;
		
		if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))){
			echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
			echo '</p>'; 
			exit; 
		}

		$fila = $resultado->fetch_object();

		return $fila->NomPais;

	}

?>