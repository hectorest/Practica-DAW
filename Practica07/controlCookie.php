<?php
$usuarios = array(
"1" => ["pepee1", "11111111", "normal"],
"2" => ["manolo2","22222222","accesible"],
"3" => ["sergio3", "33333333","normal"],
"4" => ["juaan4", "44444444", "accesible"],
"5" => ["luiis5", "55555555", "normal"]);
if(isset($_COOKIE["idUsuario"])){
	hacerLoginCookie($_COOKIE["idUsuario"]);
}
function hacerLoginCookie(&$idUsu){
		$existe = false;
		foreach ($GLOBALS["usuarios"] as $key => $value) {
			if($key == $idUsu){
				$existe = true;
				break;
			}
		}
		if($existe == true){

			$_SESSION["usuarioLog"] = $_COOKIE["idUsuario"];

		}
}

?>