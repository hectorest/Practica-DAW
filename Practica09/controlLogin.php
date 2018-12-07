<?php	
session_start();
require_once("conexion_db.php");
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

		$usu = $GLOBALS["mysqli"]->real_escape_string($usu);
		$pass = $GLOBALS["mysqli"]->real_escape_string($pass);

		$usu = "'" . $usu . "'";
		$pass = "'" . $pass . "'";

		 $sentencia = 'SELECT * FROM usuarios WHERE NomUsuario=' . $usu . ' and Clave=' . $pass;
		 if(!($usuario = $GLOBALS["mysqli"]->query($sentencia))) { 
		   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error; 
		   echo '</p>'; 
		   exit; 
		 } 

		 if(mysqli_num_rows($usuario)){
		 	$existe = true;
		 }

		$host = $_SERVER['HTTP_HOST']; 
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		 
		if($existe == true){

			$idUsu;

			$fila = $usuario->fetch_object();
		 	$idUsu = $fila->IdUsuario;

			$_SESSION["usuarioLog"] = $idUsu;

			if($GLOBALS["hayCookie"]){
				setcookie("idUsuario", $idUsu, time() + 90 * 24 * 60 * 60);
				setcookie("ultimaVisita", date("c"), time() + 90 * 24 * 60 * 60);

				$_COOKIE["idUsuario"] = $idUsu;
				$_COOKIE["ultimaVisita"] = date("c");

				//liberamos memoria y cerramos conexion
				$usuario->free();
				$GLOBALS["mysqli"]->close();

				$extra = 'perfil.php';
				header("Location: http://$host$uri/$extra");
			}
			else{

				//liberamos memoria y cerramos conexion
				$usuario->free();
				$GLOBALS["mysqli"]->close();

				$extra = 'perfil.php';
				header("Location: http://$host$uri/$extra");
			}

		}
		else{

			//liberamos memoria y cerramos conexion
			$usuario->free();
			$GLOBALS["mysqli"]->close();

			$extra = 'formulario_acceso.php';
			header("Location: http://$host$uri/$extra?er=404");

		}
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

		$host = $_SERVER['HTTP_HOST']; 
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
		if($existe == true){

			$_SESSION["usuarioLog"] = $_COOKIE["idUsuario"];

			//liberamos memoria y cerramos conexion
			$usuario->free();
			$GLOBALS["mysqli"]->close();

			$extra = "bienvenido.php?existe=true";
			header("Location: http://$host$uri/$extra");
		}
		else{

			//liberamos memoria y cerramos conexion
			$usuario->free();
			$GLOBALS["mysqli"]->close();

			$extra = "bienvenido.php?existe=false";
			header("Location: http://$host$uri/$extra");
		}
	}
?>