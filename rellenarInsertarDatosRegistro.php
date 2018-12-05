<?php
	
	$insertarDatos = "''";
	
	foreach ($sanearPost as $key => $value) {
		if($key == 'passw2' || $key == 'Foto'){
			$insertarDatos = $insertarDatos;
		}
		else{
			if(!empty($value)){
				if(is_numeric($value)){
					$insertarDatos = $insertarDatos . ',' . $value;
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