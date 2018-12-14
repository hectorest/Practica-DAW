<?php
require_once("conexion_db.php");
if(isset($_COOKIE["idUsuario"])){
	hacerLoginCookie($_COOKIE["idUsuario"]);
}
function hacerLoginCookie(&$idUsu){
		$existe = false;

		$usuarioCookie = $idUsu;
		$usuarioCookie = $GLOBALS["mysqli"]->real_escape_string($usuarioCookie);
		$usuarioCookie = (int) $usuarioCookie;

		// Ejecuta una sentencia SQL 
		$sentencia = 'SELECT * FROM usuarios WHERE IdUsuario = '. $usuarioCookie; 
		if(!($usuario = $GLOBALS["mysqli"]->query($sentencia))) { 
			echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error; 
			echo '</p>'; 
			exit; 
		}

		if(mysqli_num_rows($usuario)){
			$existe = true;
		}
		
		if($existe == false){

			$GLOBALS["cookieFalsa"] = true;
			$GLOBALS["cookieFalsaFormAcceso"] = true;

		}
}

?>