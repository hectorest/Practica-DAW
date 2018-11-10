<?php	
session_start();
$usuarios = array(
	"1" => ["pepee1", "11111111", "normal"],
	"2" => ["manolo2","22222222","accesible"],
	"3" => ["sergio3", "33333333","normal"],
	"4" => ["juaan4", "44444444", "accesible"],
	"5" => ["luiis5", "55555555", "normal"]);
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
		foreach ($GLOBALS["usuarios"] as $key => $value) {
			if($value[0] == $usu && $value[1] == $pass){
				$existe = true;
				break;
			}
		}

		$host = $_SERVER['HTTP_HOST']; 
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		 
		if($existe == true){
			$idUsu;
			foreach ($GLOBALS["usuarios"] as $key => $value) {
				if($value[0] == $usu){
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
		foreach ($GLOBALS["usuarios"] as $key => $value) {
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
		else{
			$extra = "bienvenido.php?existe=false";
			header("Location: http://$host$uri/$extra");
		}
	}
?>