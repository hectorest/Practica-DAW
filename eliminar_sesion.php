<?php  

	session_start();

	if(isset($_SESSION["usuarioRec"])){
		// Borra todas las variables de sesión 
 		$_SESSION = array(); 
 
 		// Borra la cookie que almacena la sesión 
 		if(isset($_COOKIE["usuarioRec"])) { 
   			setcookie("usuarioRec", '', time() - 42000); 
   			setcookie("passUsuarioRec", '', time() - 42000);
   			setcookie("ultimaVisita", '', time() - 42000);
 		} 
 
 		// Finalmente, destruye la sesión 
 		session_destroy(); 
		redirigirAIndex();
	}

	function redirigirAIndex(){
		$host = $_SERVER['HTTP_HOST']; 
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
		$_SESSION["usuarioRec"] = $usu;
		$extra = 'index.php';
		header("Location: http://$host$uri/$extra"); 
	}

?>