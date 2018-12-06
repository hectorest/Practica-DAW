<?php
require_once("conexion_db.php");

$datosCorrectos = false;

	foreach ($sanearPost as $key => $value) {
		if($key == "Album"){
			if(!empty($value)){

				$sentencia = 'SELECT IdAlbum FROM albumes WHERE IdAlbum = ' . $value;
				if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))) { 
					echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
					echo '</p>'; 
					exit; 
				}

				if(mysqli_num_rows()>0){
					$datosCorrectos = true;
				}else{
					$datosCorrectos = false;
				}
				
			}
			else{
				$datosCorrectos = false;
				break;
			}
		}
		if($key == "Email"){
			if(!empty($value)){
				if(preg_match_all($expReg[2], $value)){
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
		if($key == "Pais"){
			if(!empty($value)){

				$sentencia = 'SELECT IdPais FROM paises WHERE IdPais = ' . $value;
				if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))) { 
					echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
					echo '</p>'; 
					exit; 
				}

				if(mysqli_num_rows()>0){
					$datosCorrectos = true;
				}else{
					$datosCorrectos = false;
				}
			}
			else{
				$datosCorrectos = false;
				break;
			}
		}
		if($key == "Frecep"){
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
?>