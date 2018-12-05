<?php

	$datosCorrectos = true;

		//primero comprobamos si existe ya el titulo
	$sentenciaComprobarTitulo = 'SELECT * FROM fotos WHERE Titulo =' . "'" . $sanearPost["titulo"] . "'";
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


	/*foreach ($sanearPost as $key => $value) {
		if($key == "fechaFoto"){
			if(!empty($value)){
				$fec = strtotime($value);
				$fecha = date('Y-m-d', $fec);
				if($fecha == $value){
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
	}*/

?>