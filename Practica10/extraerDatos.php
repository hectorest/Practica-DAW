<?php
function extraerPais(&$IdP){

			$sentencia = 'SELECT NomPais FROM paises WHERE IdPais =' . $IdP;
			
			if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))){
				echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
				echo '</p>'; 
				exit; 
			}

			$fila = $resultado->fetch_object();

			$resultado->free();

			return $fila->NomPais;

	}

		function extraerAlbum(&$IdAlbum){

		if(is_numeric($IdAlbum)){

			$sentencia = 'SELECT Titulo FROM albumes WHERE IdAlbum =' . $IdAlbum;
			
			if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))){
				echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
				echo '</p>'; 
				exit; 
			}

			$fila = $resultado->fetch_object();

			$resultado->free();

			return $fila->Titulo;

		}
		else{
			return $IdAlbum;
		}

	}

	function extraerUsuario(&$IdUsu){

		if(is_numeric($IdUsu)){

			$sentencia = 'SELECT NomUsuario FROM usuarios WHERE IdUsuario =' . $IdUsu;
			
			if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))){
				echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
				echo '</p>'; 
				exit; 
			}

			$fila = $resultado->fetch_object();

			$resultado->free();

			return $fila->NomUsuario;

		}
		else{
			return $IdUsu;
		}

	}
	
?>