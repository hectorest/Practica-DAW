<?php

	$datosCorrectos = true;

	foreach ($sanearPost as $key => $value) {
		if($key == "titulo"){
			if(!empty($value)){
				$datosCorrectos = true;
			}
			else{
				$datosCorrectos = false;
				break;
			}
		}
		if($key == "texto_alternativo"){
			if(!empty($value) && strlen($value) >= 10){
				$datosCorrectos = true;
			}
			else{
				$datosCorrectos = false;
				break;
			}
		}
		if($key == "Pais"){
			if(!empty($value) && filter_var($value, FILTER_VALIDATE_INT)){
				$datosCorrectos = true;
			}
			else{
				$datosCorrectos = false;
				break;
			}
		}
		if($key == "album"){
			if(!empty($value) && filter_var($value, FILTER_VALIDATE_INT)){
				$datosCorrectos = true;
			}
			else{
				$datosCorrectos = false;
				break;
			}
		}
		if($key == "fechaFoto"){
			if(!empty($value)){
				$fec = strtotime($value);
				$fecha = date('Y-m-d', $fec);
				if($fecha == $value){
					$fechaActual = date('Y-m-d');
					if($value < $fechaActual){
						$datosCorrectos = true;
					}
					else{
						$datosCorrectos = false;
						break;
					}
				}
				else{
					$datosCorrectos = false;
					break;
				}
			}
			else{
				$datosCorrectos = false;
				break;
			}
		}
	}

	require_once("comprobarExistenciaDatos.php");

	if($datosCorrectos && compExistPais($sanearPost["Pais"])){
		if(!compExistAlbum($sanearPost["album"])){
			$datosCorrectos = false;
		}
	}
	else{
		$datosCorrectos = false;
	}

	if($datosCorrectos){

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
			
	}

?>