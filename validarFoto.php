<?php

	$datosCorrectos = true;



		//primero comprobamos si existe ya el titulo
	$sentenciaComprobarTitulo = 'SELECT * FROM fotos f JOIN albumes a ON (f.Album = a.IdAlbum) WHERE f.Titulo =' . "'" . $sanearPost["titulo"] . "' and Usuario = ".$_SESSION["usuarioLog"];
	if(!($resultadoComprobarTitulo = $mysqli->query($sentenciaComprobarTitulo))) { 
		echo "<p>Error al ejecutar la sentencia <b>$sentenciaComprobarTitulo</b>: " . $mysqli->error; 
		echo '</p>'; 
		exit; 
	}
	
			if(mysqli_num_rows($resultadoComprobarTitulo)){
				$filaComprobarTitulo = $resultadoComprobarTitulo->fetch_object();

				$tituloExistente = $filaComprobarTitulo->Titulo;
				$datosCorrectos = false;

			}

?>