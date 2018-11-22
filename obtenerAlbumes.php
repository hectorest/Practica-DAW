<?php
session_start();
	
	if(isset($_SESSION["usuarioLog"])){
		extraerAlbumes($_SESSION["usuarioLog"]); 
	}

	function extraerAlbumes($usuario){
		$sentencia = 'SELECT * FROM albumes WHERE Usuario = ' . "'" . $usuario . "'";
		if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))){
			echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
			echo '</p>'; 
			exit; 
		}

		while($fila = $resultado->fetch_assoc()){
			$IdAlbum = $fila["IdAlbum"];
			echo "<option value=$IdAlbum>{$fila['Titulo']}</option>";
		}
	}

?>