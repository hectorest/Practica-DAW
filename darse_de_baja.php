<?php
session_start();
require_once("conexion_db.php");

	require_once("comprobacionServer.php");
	$urlPag = "dar_baja.php";
	comprobarServer($urlPag);

	if($serverCorrecto){
		if(isset($_POST["usu"], $_POST["pass"])){
			borrarCuenta($_POST["usu"], $_POST["pass"]);
		}
	}
	else{
		$host = $_SERVER['HTTP_HOST']; 
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');  
		$extra = 'dar_baja.php';
		header("Location: http://$host$uri/$extra?er=310");
	}

function borrarCuenta(&$usu, &$pass){
	$existe = false;

	$usu = $GLOBALS["mysqli"]->real_escape_string($usu);
	$pass = $GLOBALS["mysqli"]->real_escape_string($pass);

	$usu = "'" . $usu . "'";
	$pass = "'" . $pass . "'";

	$sentencia = 'SELECT * FROM usuarios WHERE IdUsuario=' . $usu . ' and Clave=' . $pass;
		 if(!($usuario = $GLOBALS["mysqli"]->query($sentencia))) { 
		   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error; 
		   echo '</p>'; 
		   exit; 
		 } 
		
		 if(mysqli_num_rows($usuario)>0){
		 	$existe = true;
		 }

	if($existe == true){
		if(isset($_SESSION["usuarioLog"])){
			// Borra todas las variables de sesión 
		 	$_SESSION = array(); 
		 	// Borra la cookie que almacena la sesión 
		 	if(isset($_COOKIE["idUsuario"])) { 
		   		setcookie("idUsuario", '', time() - 42000);
		   		setcookie("ultimaVisita", '', time() - 42000);
		 	}
		 	// Finalmente, destruye la sesión 
		 	session_destroy(); 
		}
		else{
			if(isset($_COOKIE["idUsuario"])) { 
		   		setcookie("idUsuario", '', time() - 42000);
		   		setcookie("ultimaVisita", '', time() - 42000);
		 	}
		}

		$sentenciaBorrar = 'DELETE FROM usuarios WHERE IdUsuario=' . $usu;
		 if(!($borrarUsuario = $GLOBALS["mysqli"]->query($sentenciaBorrar))) { 
		   echo "<p>Error al ejecutar la sentencia <b>$sentenciaBorrar</b>: " . $mysqli->error; 
		   echo '</p>'; 
		   exit; 
		 } 

		 if($GLOBALS["mysqli"]->affected_rows>0){
		 	$host = $_SERVER['HTTP_HOST']; 
			$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
			$extra = 'baja_confirmada.php';
			header("Location: http://$host$uri/$extra"); 
		 }

	}

}
?>