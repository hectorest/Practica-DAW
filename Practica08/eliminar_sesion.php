<?php  
session_start();
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
	redirigirAIndex();
}
else{
	if(isset($_COOKIE["idUsuario"])) { 
   		setcookie("idUsuario", '', time() - 42000);
   		setcookie("ultimaVisita", '', time() - 42000);
   		redirigirAIndex();
 	}
}

	function redirigirAIndex(){
		$host = $_SERVER['HTTP_HOST']; 
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
		$extra = 'index.php';
		header("Location: http://$host$uri/$extra"); 
	}

?>