<?php

	$busqueda = '';
	$contador = 0;
	$comparador = "=";

	foreach ($getSaneado as $key => $value){
		if($key == "pagina"){
			$value = null;
		}
		if($key == "Usuario"){
			if(!is_numeric($value)){
				$busqueda = "No";
				break;
			}
		}
		if($key == "Desde" || $key == "Hasta"){
			$value = null;
		}
		if(!empty($value)){
			if($contador == 0){
				if($key == "Album"){
					$key = 'a.' . 'Titulo';
					$comparador = ' LIKE ';
					$value = (string) $value;
					$value = "%$value%";
				}
				if($key == "Titulo"){
					$key = 'f.' . 'Titulo';
					$comparador = ' LIKE ';
					$value = (string) $value;
					$value = "%$value%";
				}
				if($key == "palClave"){
					$key = 'f.' . 'Descripcion';
					$comparador = ' LIKE ';
					$value = (string) $value;
					$value = "%$value%";
				}
				if($key == "Pais"){
					$key = 'f.' . 'Pais';
				}
				if(is_numeric($value)){
					$busqueda = $busqueda . $key . $comparador . $value; 
				}
				else{
					$busqueda = $busqueda . $key . $comparador . "'" . $value . "'";
				}
						
				$contador = $contador + 1;
			}
			else{
				if($key == "Album"){
					$key = 'a.' . 'Titulo';
					$comparador = ' LIKE ';
					$value = (string) $value;
					$value = "%$value%";
				}
				if($key == "Titulo"){
					$key = 'f.' . 'Titulo';
				}
				if($key == "palClave"){
					$key = 'f.' . 'Descripcion';
					$comparador = ' LIKE ';
					$value = (string) $value;
					$value = "%$value%";
				}
				if($key == "Pais"){
					$key = 'f.' . 'Pais';
				}
				if(is_numeric($value)){
					$busqueda = $busqueda . ' AND ' . $key . $comparador . $value; 
				}
				else{
					$busqueda = $busqueda . ' AND ' . $key . $comparador . "'" . $value . "'";
				}
			}
		}
	}

	//trato los parametros de busqueda desde y hasta al final a parte para poder concatenar su expresion de manera correcta en la variable $busqueda
	if($busqueda != "No"){
		if(!empty($getSaneado["Desde"]) && !empty($getSaneado["Hasta"])){
			if($getSaneado["Desde"] > $getSaneado["Hasta"]){
				$FechasValidas = false;
				echo <<<cerrarSection
						</div>
					</section>
cerrarSection;
				mostrarMensErrorFechasInvalidas();
			}
			else{

				$key = 'Fecha';
				$comparador = ' BETWEEN ';

				$desde = $getSaneado["Desde"];
				$hasta = $getSaneado["Hasta"];

				$desde = str_replace("-", "", $desde);
				$hasta = str_replace("-", "", $hasta);

				if(is_numeric($desde) && is_numeric($hasta)){

					$desde = (int) $desde;
					$hasta = (int) $hasta;

					$desde = "$desde";
					$hasta = "$hasta";

					if($contador == 0){
						$busqueda = $busqueda . $key . $comparador . $desde . ' AND ' . $hasta; 
					}
					else{
						$busqueda = $busqueda . ' AND ' . $key . $comparador . $desde . ' AND ' . $hasta;
					}
				}
				else{

					$busqueda = '';

				}
			}
		}
		else{
			$key = 'Fecha';
			$comparador = ' LIKE ';
			if(!empty($getSaneado["Desde"]) && empty($getSaneado["Hasta"])){
				$value = (string) $getSaneado["Desde"];
				$value = "'%$value%'";
				if($contador == 0){
					$busqueda = $busqueda . $key . $comparador . $value;
				}
				else{
					$busqueda = $busqueda . ' AND ' . $key . $comparador . $value;
				}
			}
			else if(empty($getSaneado["Desde"]) && !empty($getSaneado["Hasta"])){
				$value = (string) $getSaneado["Hasta"];
				$value = "'%$value%'";
				if($contador == 0){
					$busqueda = $busqueda . $key . $comparador . $value;
				}
				else{
					$busqueda = $busqueda . ' AND ' . $key . $comparador . $value;
				}
			}
			else{
				$busqueda = $busqueda;
			}
		}
	}
	else{
		$busqueda = '';
	}

?>