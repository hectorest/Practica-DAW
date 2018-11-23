<?php

	extraerContinentes();
	
	function extraerContinentes(){
		$sentencia = 'SELECT DISTINCT Continente FROM paises order by (Continente) ASC';
		if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))){
			echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
			echo '</p>'; 
			exit; 
		}

		while($fila = $resultado->fetch_assoc()){
			echo "<optgroup label='{$fila['Continente']}'>";
			extraerPaisesContinente($fila['Continente']);
			echo "</optgroup>";
		}
		$resultado->free();
	}

	function extraerPaisesContinente(&$continente){
		$sentencia = 'SELECT IdPais, NomPais FROM paises p WHERE p.Continente='. "'" . $continente . "'" . 'ORDER BY (NomPais) ASC';
		if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))){
			echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
			echo '</p>'; 
			exit; 
		}

		while($fila = $resultado->fetch_assoc()){
			$IdPais = $fila["IdPais"];
			echo "<option value=$IdPais>{$fila['NomPais']}</option>";
		}
		$resultado->free();
	}


?>