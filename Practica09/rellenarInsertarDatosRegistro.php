<?php
	
	$insertarDatos = "''";
	
	foreach ($sanearPost as $key => $value) {
		if($key == 'passw2' || $key == 'Foto' || $key == 'fotosXpagina'){
			$insertarDatos = $insertarDatos;
		}
		else{
			if(!empty($value)){
				if(is_numeric($value)){
					$insertarDatos = $insertarDatos . ',' . $value;
				}
				else if($key=='colorobn'){
					if($value=="A Color"){
						$value = "true";
					}
					else{
						$value = "false";
					}
					$insertarDatos = $insertarDatos . ',' . $value;
					if($value=="true"){
						$value = "A Color";
					}
					else{
						$value = "Blanco y negro";
					}
				}
				else{
					$insertarDatos = $insertarDatos . ',' . "'". $value . "'";
				}
			}
			else{
				$insertarDatos = $insertarDatos . ",''";
			}
		}
	}

?>