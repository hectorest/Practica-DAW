
<?php

	/*Array de usuarios registrados provisionales*/
	$usuariosReg = array(
		"pepe1" => "11111111",
		"manolo2" => "22222222",
		"sergio3" => "33333333",
		"juan4" => "44444444",
		"luis5" => "55555555");

	$hayCookie = false;

	$ultimaVisita = "Ahora";
	
	if(isset($_POST["recordarme"])){

		if(isset($_COOKIE["ultimaVisita"])){
			$GLOBALS["ultimaVisita"] = $_COOKIE["ultimaVisita"];
		}

		$hayCookie = true;

		session_start();
		require_once("head.php");
		if(isset($_COOKIE["ultimaVisita"], $_COOKIE["usuarioRec"], $_COOKIE["passUsuarioRec"])){
			hacerLogin($_COOKIE["usuarioRec"], $_COOKIE["passUsuarioRec"]);
		}
		else{
			if(isset($_POST["login"], $_POST["pass"])){
				hacerLogin($_POST["login"], $_POST["pass"]);
			}
		}
	}
	else{
		session_start();
		require_once("head.php");
		if(isset($_POST["login"], $_POST["pass"])){
			hacerLogin($_POST["login"], $_POST["pass"]);
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

			$_SESSION["usuarioRec"] = true;

			if($GLOBALS["hayCookie"]){
				
				setcookie("usuarioRec", $usu, time() + 90 * 24 * 60 * 60);
				setcookie("passUsuarioRec", $pass, time() + 90 * 24 * 60 * 60);
				setcookie("ultimaVisita", date("c"), time() + 90 * 24 * 60 * 60);

				$_COOKIE["usuarioRec"] = $usu;
				$_COOKIE["passUsuarioRec"] = $pass;
				$_COOKIE["ultimaVisita"] = date("c");


				/*

					echo "<p>HAY COOKIE</p>\n";
					echo "<p>{$_COOKIE["usuarioRec"]}</p>\n";
					echo "<p>{$_COOKIE["passUsuarioRec"]}</p>\n";
					echo "<p>{$_COOKIE["ultimaVisita"]}</p>\n";

				*/
				
				$extra = "bienvenido.php?existe=true&date={$GLOBALS["ultimaVisita"]}";
				header("Location: http://$host$uri/$extra");
				
			}
			else{
				$extra = 'index.php';
				header("Location: http://$host$uri/$extra");
			}

		}
		else{
			$extra = 'formulario_acceso.php';
			header("Location: http://$host$uri/$extra?er=404");
		}
	}

?>