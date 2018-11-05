<?php

	$usuariosReg = array(
		"pepe1" => "11111111",
		"manolo2" => "22222222",
		"sergio3" => "33333333",
		"juan4" => "44444444",
		"luis5" => "55555555");

	if(isset($COOKIE["usuarioRec"], $COOKIE["passUsuarioRec"])){
		comprobarCookie($COOKIE["usuarioRec"], $COOKIE["passUsuarioRec"]);
	}

	function comprobarCookie(&$usu, &$pass){
		$existe = false;
		foreach ($GLOBALS["usuariosReg"] as $key => $value) {
			if($key == $usu && $value == $pass){
				$existe = true;
				break;
			}
		}
		$_SESSION["usuarioRec"] = $_COOKIE["usuarioRec"];
		$host = $_SERVER['HTTP_HOST']; 
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
		if($existe == true){
			$extra = 'bienvenido.php?existe=true';
			header("Location: http://$host$uri/$extra");
		}
		else{
			$extra = 'bienvenido.php?existe=false';
			header("Location: http://$host$uri/$extra");
		}

	}

?>