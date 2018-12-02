<?php
	
	$insertarDatos = "''";
	
	foreach ($sanearPost as $key => $value) {
		if($key == 'passw2' || $key == 'fPer'){
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

	if(!empty($sanearPost["fPer"])){
		$insertarDatos = $insertarDatos . ',' . "'" . $sanearPost["fPer"] . "'" . ',';
	}
	else{
		$insertarDatos = $insertarDatos . ",'',";
	}


?>