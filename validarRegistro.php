<?php
	
	$expReg = [];
	$expReg[] = "/[A-Za-z0-9]{3,15}/";
	$expReg[] = "/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])[A-Za-z0-9_]{6,15}$/";
	$expReg[] = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/";
	
	$datosCorrectos = false;
	
	foreach ($sanearPost as $key => $value) {
		if($key == "usuario"){
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
		if($key == "passw1"){
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
		if($key == "email"){
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
			if(!empty($value) && is_numeric($value) && $value >= 1 && $value <=3){
				$datosCorrectos = true;
			}
			else{
				$datosCorrectos = false;
				break;
			}
		}
		if($key == "fNac"){
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