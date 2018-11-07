
<?php
	
	session_start();

	/*Array de usuarios registrados provisionales*/
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

	$ultimaVisita = "Ahora";
	$hayCookie = false;
	
	if(isset($_COOKIE["idUsuario"])){
		hacerLoginCookie($_COOKIE["idUsuario"]);
	}
	else{
		
		if(isset($_POST["recordarme"])){
			$hayCookie = true;
			if(isset($_POST["login"], $_POST["pass"])){
				hacerLogin($_POST["login"], $_POST["pass"]);
			}
		}
		else{
			if(isset($_POST["login"], $_POST["pass"])){
				hacerLogin($_POST["login"], $_POST["pass"]);
			}
		}

	}
	
	/*Funcion que realiza la comprobacion del login*/
	function hacerLogin(&$usu, &$pass){
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
			$idUsu;
			foreach ($GLOBALS["identUsuariosReg"] as $key => $value) {
				if($value == $usu){
					$idUsu = $key;
					break;
				}
			}

			$_SESSION["usuarioLog"] = $idUsu;

			if($GLOBALS["hayCookie"]){
				setcookie("idUsuario", $idUsu, time() + 90 * 24 * 60 * 60);
				setcookie("ultimaVisita", date("c"), time() + 90 * 24 * 60 * 60);

				$_COOKIE["idUsuario"] = $idUsu;
				$_COOKIE["ultimaVisita"] = date("c");

				$extra = 'perfil.php';
				header("Location: http://$host$uri/$extra");
			}
			else{
				$extra = 'perfil.php';
				header("Location: http://$host$uri/$extra");
			}

		}
		else{

			$extra = 'formulario_acceso.php';
			header("Location: http://$host$uri/$extra?er=404");

		}
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