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

		$usu = htmlentities($usu);
		$pass = htmlentities($pass);

		$usu = $GLOBALS["mysqli"]->real_escape_string($usu);
		$pass = $GLOBALS["mysqli"]->real_escape_string($pass);

		$usu = "'" . $usu . "'";
		$pass = "'" . $pass . "'";

		 $sentencia = 'SELECT * FROM usuarios WHERE NomUsuario=' . $usu . ' and Clave=' . $pass; //creo que asi te ahorras bucles, simplemente extraes el usuario directamente y si no lo ecuentra el numero de filas sera 0
		 if(!($usuario = $GLOBALS["mysqli"]->query($sentencia))) { 
		   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error; 
		   echo '</p>'; 
		   exit; 
		 } 

		 if(mysqli_num_rows($usuario)){
		 	$existe = true;
		 }

		// Recorre el resultado y pasa a true si encuentra un usuario con una contraseña coincidentes con los de la tabla
		 /*while($fila = $usuarios->fetch_assoc()) { 
		   if($fila['NomUsuario']== $usu && $fila['Clave'] == $pass){
		   	   $existe = true;
				break;
			}
		 }*/

		$host = $_SERVER['HTTP_HOST']; 
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		 
		if($existe == true){
			//echo "HOLA";
			$idUsu;

			$fila = $usuario->fetch_object();
		 	$idUsu = $fila->IdUsuario;

			/*foreach ($GLOBALS["usuarios"] as $key => $value) {
				if($value[0] == $usu){
					$idUsu = $key;
					break;
				}
			}*/
			/*$sentencia = 'SELECT * FROM usuarios'; 
				 if(!($usuarios =  $GLOBALS["mysqli"]->query($sentencia))) { 
				   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error; 
				   echo '</p>'; 
				   exit; 
				 } 
			 while($fila = $usuarios->fetch_assoc()) {
			 	if($fila['NomUsuario']== $usu){
			 		$idUsu = $fila['IdUsuario'];
					break;
			 	}
			 }*/
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
		/*foreach ($GLOBALS["usuarios"] as $key => $value) {
			if($key == $idUsu){
				$existe = true;
				break;
			}
		}*/
		$sentencia = 'SELECT * FROM usuarios'; 
		 if(!($usuarios = $GLOBALS["mysqli"]->query($sentencia))) { 
		   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error; 
		   echo '</p>'; 
		   exit; 
		 } 

		while($fila = $usuarios->fetch_assoc()) {
			 if($fila['IdUsuario']== $idUsu){
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