<?php

	function compExistPais(&$pais){
		$sentencia = 'SELECT * FROM paises WHERE IdPais =' . $pais;
		if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))) { 
			echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
			echo '</p>'; 
			exit; 
		}

		if(mysqli_num_rows($resultado)){
			$resultado->free();
			return true;
		}
		else{
			$resultado->free();
			return false;
		}
	}


	function compExistAlbum(&$album){
		$sentencia = 'SELECT * FROM albumes WHERE IdAlbum =' . $album;
		if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))) { 
			echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
			echo '</p>'; 
			exit; 
		}

		if(mysqli_num_rows($resultado)){
			$resultado->free();
			return true;
		}
		else{
			$resultado->free();
			return false;
		}
	}


?>