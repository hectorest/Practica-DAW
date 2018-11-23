<?php
if(!empty($_GET["idPais"])){
	$getSaneado = $_GET;
	$idPaisSaneado;
	foreach($getSaneado as $key => $value){
		if(!empty($value)){
			$GLOBALS["mysqli"]->real_escape_string($value);
			if($key=="idPais"){
				$idPaisSaneado=$value;
			}
		}

	}
}
	extraerContinentes();
	
	function extraerContinentes(){
		$sentencia = 'SELECT DISTINCT Continente FROM paises order by (Continente) ASC';
		if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))){
			echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
			echo '</p>'; 
			exit; 
		}

		while($fila = $resultado->fetch_assoc()){
			echo "<optgroup label='{$fila['Continente']}'>";
			extraerPaisesContinente($fila['Continente']);
			echo "</optgroup>";
		}
		$resultado->free();
	}

	function extraerPaisesContinente(&$continente){
		$sentencia = 'SELECT IdPais, NomPais FROM paises p WHERE p.Continente='. "'" . $continente . "'" . 'ORDER BY (NomPais) ASC';
		if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))){
			echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
			echo '</p>'; 
			exit; 
		}

		while($fila = $resultado->fetch_assoc()){
			$IdPais = $fila["IdPais"];
			if(!empty($GLOBALS["idPaisSaneado"]) && $IdPais==$GLOBALS["idPaisSaneado"]){
				echo "<option selected value=$IdPais>{$fila['NomPais']}</option>";
			}else{
				echo "<option value=$IdPais>{$fila['NomPais']}</option>";
			}
		}
		$resultado->free();
	}

?>