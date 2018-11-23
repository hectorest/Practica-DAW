<?php

	if(isset($_SESSION["usuarioLog"])){
		$sanearSesion = $_SESSION["usuarioLog"];
		$mysqli->real_escape_string($sanearSesion);
		extraerAlbumes($_SESSION["usuarioLog"]); 
	}

	function extraerAlbumes($usuario){
		$sentencia = 'SELECT * FROM albumes WHERE Usuario = ' . $usuario;
		echo "$sentencia";
		if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))){
			echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
			echo '</p>'; 
			exit; 
		}

		if(mysqli_num_rows($resultado) >= 1){
			while($fila = $resultado->fetch_assoc()){
				$IdAlbum = $fila["IdAlbum"];
				echo "<option value=$IdAlbum>{$fila['Titulo']}</option>";
			}
		}
		$resultado->free();
	}

?>