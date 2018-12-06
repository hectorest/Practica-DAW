<?php
require_once("conexion_db.php");

	$expReg = [];
	$expReg[] = "/^[A-Za-z0-9]{3,15}$/";
	$expReg[] = "/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])[A-Za-z0-9_]{6,15}$/";
	$expReg[] = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})$/";


$datosCorrectos = false;
$continuo = true;

	$sentenciaPost = "";
	
	foreach ($sanearPost as $key => $value) {
		if($key == "album"){
			if(!empty($value)){
				$sentenciaPost = $sentenciaPost."and Album = $value ";
			}
			else{
				$sentenciaPost = $sentenciaPost." and Album = ''";
			}
		}
		if($key == "nombre"){
			if(!empty($value)){
				$sentenciaPost = $sentenciaPost." Nombre = '$value' ";
			}
			else{
				$sentenciaPost = $sentenciaPost." Nombre = '' ";
			}
		}
		if($key == "titulo"){
			if(!empty($value)){
				$sentenciaPost = $sentenciaPost." and titulo = '$value' ";
			}
			else{
				$sentenciaPost = $sentenciaPost." and titulo = '' ";
			}
		}
		if($key == "texto_adicional"){
			if(!empty($value)){
				$sentenciaPost = $sentenciaPost." and Descripcion = '$value' ";
			}
			else{
				$sentenciaPost = $sentenciaPost." and Descripcion = '' ";
			}
		}
		if($key == "email"){
			if(!empty($value)){
				$sentenciaPost = $sentenciaPost." and Email = '$value' ";
			}
			else{
				$sentenciaPost = $sentenciaPost." and Email = '' ";
			}
		}
		if($key == "calle"){
			if(!empty($value)){
				$sentenciaPost = $sentenciaPost." and d_Calle = '$value' ";
			}
			else{
				$sentenciaPost = $sentenciaPost." and d_Calle = '' ";
			}
		}
		if($key == "numero"){
			if(!empty($value)){
				$sentenciaPost = $sentenciaPost." and d_Numero = $value ";
			}
			else{
				$sentenciaPost = $sentenciaPost." and d_Numero = '' ";
			}
		}
		if($key == "cp"){
			if(!empty($value)){
				$sentenciaPost = $sentenciaPost." and d_CP = $value ";
			}
			else{
				$sentenciaPost = $sentenciaPost." and d_CP = '' ";
			}
		}
		if($key == "pais"){
			if(!empty($value)){
				$sentenciaPost = $sentenciaPost." and d_Pais = $value ";
			}
			else{
				$sentenciaPost = $sentenciaPost." and d_Pais = '' ";
			}
		}
		if($key == "local"){
			if(!empty($value)){
				$sentenciaPost = $sentenciaPost." and d_Localidad = '$value' ";
			}
			else{
				$sentenciaPost = $sentenciaPost." and d_Localidad = '' ";
			}
		}
		if($key == "prov"){
			if(!empty($value)){
				$sentenciaPost = $sentenciaPost." and d_Provincia = '$value' ";
			}
			else{
				$sentenciaPost = $sentenciaPost." and d_Provincia = '' ";
			}
		}
		if($key == "color_portada"){
			if(!empty($value)){
				$sentenciaPost = $sentenciaPost." and Color = '$value' ";
			}
			else{
				$sentenciaPost = $sentenciaPost." and Color = '' ";
			}
		}
		if($key == "num_copias"){
			if(!empty($value)){
				$sentenciaPost = $sentenciaPost." and Copias = $value ";
			}
			else{
				$sentenciaPost = $sentenciaPost." and Copias = '' ";
			}
		}
		if($key == "resolucion"){
			if(!empty($value)){
				$sentenciaPost = $sentenciaPost." and Resolucion = $value ";
			}
			else{
				$sentenciaPost = $sentenciaPost." and Resolucion = '' ";
			}
		}
		if($key == "frecep"){
			if(!empty($value)){
				$sentenciaPost = $sentenciaPost." and Fecha = $value ";
			}
			else{
				$sentenciaPost = $sentenciaPost." and Fecha = '' ";
			}
		}
		if($key == "colorobn"){
			if(!empty($value)){

				if($value=="A Color"){
						$value = "true";
					}
					else{
						$value = "false";
					}
					$sentenciaPost = $sentenciaPost." and IColor = $value ";
					if($value=="true"){
						$value = "A Color";
					}
					else{
						$value = "Blanco y negro";
					}

			}
			else{
				$sentenciaPost = $sentenciaPost." and IColor = '' ";
			}
		}
	}

		$sentencia = 'SELECT*FROM solicitudes WHERE '.$sentenciaPost;
		if(!($resultado = $mysqli->query($sentencia))) { 
			echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error; 
			echo '</p>'; 
			exit; 
		}

		if(mysqli_num_rows($resultado)>0){
			$continuo = false;
		}

		if($continuo==true){

		foreach ($sanearPost as $key => $value) {
			if($key == "album"){
					echo "valido 1";
				if(!empty($value)){
					$sentencia = 'SELECT IdAlbum FROM albumes WHERE IdAlbum = ' . $value;
					if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))) { 
						echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
						echo '</p>'; 
						exit; 
					}

					if(mysqli_num_rows($resultado)>0){
						$datosCorrectos = true;
					}else{
						$datosCorrectos = false;
						echo "no valido 1";
						break;
					}
					
				}
				else{
					$datosCorrectos = false;
					echo "no valido 1";
					break;
				}
			}					
			if($key == "email"){
				echo "valido 2";
				if(!empty($value)){
					if(preg_match_all($expReg[2], $value)){
						$datosCorrectos = true;
					}
					else{
						$datosCorrectos = false;
						echo "no valido 2";
						break;
					}
				}
				else{
					$datosCorrectos = false;
					echo "no valido 2";
					break;
				}
			}
			if($key == "pais"){
				echo "valido 3";
				if(!empty($value)){

					$sentencia = 'SELECT IdPais FROM paises WHERE IdPais = ' . $value;
					if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))) { 
						echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
						echo '</p>'; 
						exit; 
					}

					if(mysqli_num_rows($resultado)>0){
						$datosCorrectos = true;
					}else{
						$datosCorrectos = false;
						echo "no valido 3";
					}
				}
				else{
					$datosCorrectos = false;
					echo "no valido 3";
					break;
				}
			}
			if($key == "frecep"){
				echo "valido 4";
				if(!empty($value)){
					$fec = strtotime($value);
					$fecha = date('Y-m-d', $fec);
					$fechaActual = date('Y-m-d');
						if($fecha > $fechaActual){
							$datosCorrectos = true;
						}
						else{
							$datosCorrectos = false;
							echo "no valido 4";
							break;
						}
				}
				else{
					$datosCorrectos = true;
				}
			}
			if($key == "nombre"){
				echo "valido 5";
				if(!empty($value)){
					$datosCorrectos = true;
				}
				else{
					$datosCorrectos = false;
					echo "no valido 5";
					break;
				}
			}
			if($key == "titulo"){
				echo "valido 6";
				if(!empty($value)){
					$datosCorrectos = true;
				}
				else{
					$datosCorrectos = false;
					echo "no valido 6";
					break;
				}
			}
			if($key == "calle"){
				echo "valido 7";
				if(!empty($value)){
					$datosCorrectos = true;
				}
				else{
					$datosCorrectos = false;
					echo "no valido 7";
					break;
				}
			}
			if($key == "local"){
				echo "valido 8";
				if(!empty($value)){
					$datosCorrectos = true;
				}
				else{
					$datosCorrectos = false;
					echo "no valido 8";
					break;
				}
			}
			if($key == "prov"){
				echo "valido 9";
				if(!empty($value)){
					$datosCorrectos = true;
				}
				else{
					$datosCorrectos = false;
					echo "no valido 9";
					break;
				}
			}
			if($key == "numero"){
				echo "valido 10";
				if(!empty($value) && filter_var($value, FILTER_VALIDATE_INT)){
					$datosCorrectos = true;
				}
				else{
					$datosCorrectos = false;
					echo "no valido 10";
					break;
				}
			}
			if($key == "cp"){
				echo "valido 11 con valor $value ";
				if(!empty($value) && filter_var($value, FILTER_VALIDATE_INT)){
					$datosCorrectos = true;
				}
				else{
					$datosCorrectos = false;
					echo "no valido 11";
					break;
				}
			}
			if($key == "copias"){
				echo "valido 12";
				if(!empty($value) && filter_var($value, FILTER_VALIDATE_INT)){
					$datosCorrectos = true;
				}
				else{
					$datosCorrectos = false;
					echo "no valido 12";
					break;
				}
			}
			if($key == "resolucion"){
				echo "valido 13";
				if(!empty($value) && filter_var($value, FILTER_VALIDATE_INT)){
					$datosCorrectos = true;
				}
				else{
					$datosCorrectos = false;
					echo "no valido 13";
					break;
				}
			}
		}
	}
?>