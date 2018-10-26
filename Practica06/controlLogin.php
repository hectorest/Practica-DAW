<title>Pictures & Images - Control Acceso</title>

<?php
	
	/*Array de usuarios registrados provisionales*/
	$usuariosReg = array(
		"pepe1" => "11111111",
		"manolo2" => "22222222",
		"sergio3" => "33333333",
		"juan4" => "44444444",
		"luis5" => "55555555");
	
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
			$extra = 'index.php';
			header("Location: http://$host$uri/$extra"); 
		}
		else{
			$extra = 'formulario_acceso.php';
			header("Location: http://$host$uri/$extra?er=404");
		}
	}

	if(isset($_POST["login"], $_POST["pass"])){
		hacerLogin($_POST["login"], $_POST["pass"]);
	}
	
?>