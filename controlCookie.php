<?php

	$usuariosReg = array(
		"pepee1" => "11111111",
		"manolo2" => "22222222",
		"sergio3" => "33333333",
		"juaan4" => "44444444",
		"luiis5" => "55555555");

	/*Array de identificadores de los usuarios registrados*/
	$identUsuariosReg = array(
		"1" => "pepee1",
		"2" => "manolo2",
		"3" => "sergio3",
		"4" => "juaan4",
		"5" => "luiis5");

	if(isset($_COOKIE["idUsuario"])){
		hacerLoginCookie($_COOKIE["idUsuario"]);
	}

	function hacerLoginCookie(&$idUsu){
		$existe = false;
		foreach ($GLOBALS["identUsuariosReg"] as $key => $value) {
			if($key == $idUsu){
				$existe = true;
				break;
			}
		}
		$host = $_SERVER['HTTP_HOST']; 
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
		if($existe == true){

			$_SESSION["usuarioLog"] = $_COOKIE["idUsuario"];

			$extra = "bienvenido.php?existe=true";
			header("Location: http://$host$uri/$extra");
		}
	}

?>