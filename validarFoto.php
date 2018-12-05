<?php
	
	$expReg = [];
	$expReg[] = "/[A-Za-z0-9]{3,15}/";
	$expReg[] = "/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])[A-Za-z0-9_]{6,15}$/";
	$expReg[] = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/";
	
	// Filtra un número entero en un intervalo 
 	$int_options = array("options" => array("min_range" => 1, "max_range" => 3)); 

	$datosCorrectos = true;

		//primero comprobamos si existe ya el nombre de usuario
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