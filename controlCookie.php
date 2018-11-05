<?php

	$usuariosReg = array(
		"pepee1" => "11111111",
		"manolo2" => "22222222",
		"sergio3" => "33333333",
		"juaan4" => "44444444",
		"luiis5" => "55555555");

	if(isset($_COOKIE["usuarioRec"], $_COOKIE["passUsuarioRec"])){
		comprobarCookie($_COOKIE["usuarioRec"], $_COOKIE["passUsuarioRec"]);
	}

	function comprobarCookie(&$usu, &$pass){
		$existe = false;
		foreach ($GLOBALS["usuariosReg"] as $key => $value) {
			if($key == $usu && $value == $pass){
				$existe = true;
				break;
			}
		}
		$host = $_SERVER['HTTP_HOST']; 
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
		if($existe == true){
			$_SESSION["usuarioRec"] = $_COOKIE["usuarioRec"];
			$_SESSION["permisos"] = true;
			$extra = 'bienvenido.php?existe=true';
			header("Location: http://$host$uri/$extra");
		}
		else{
			$extra = 'bienvenido.php?existe=false';
			header("Location: http://$host$uri/$extra");
		}

	}

?>