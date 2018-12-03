<?php
	
	$expReg = [];
	$expReg[] = "/[A-Za-z0-9]{3,15}/";
	$expReg[] = "/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])[A-Za-z0-9_]{6,15}$/";
	$expReg[] = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/";
	
	// Filtra un número entero en un intervalo 
 	$int_options = array("options" => array("min_range" => 1, "max_range" => 3)); 

	$datosCorrectos = false;
	
	foreach ($sanearPost as $key => $value) {
		if($key == "NomUsuario"){
			if(!empty($value)){
				if(preg_match_all($expReg[0], $value)){
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
		if($key == "Clave"){
			if(!empty($value)){
				if(preg_match_all($expReg[1], $value)){
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
		if($key == "Sexo"){
			if(!empty($value) && filter_var($value, FILTER_VALIDATE_INT, $int_options)){
				$datosCorrectos = true;
			}
			else{
				$datosCorrectos = false;
				break;
			}
		}
		if($key == "FNacimiento"){
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
	}

?>