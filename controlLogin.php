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
			if($key == "$usu" && $value =="$pass"){
				$existe = true;
				break;
			}
		}
		if($existe == true){
			header("refresh: 0; perfil.php");
		}
		else{
			header("refresh: 0; formulario_acceso.php?er=404");
		}
	}

	/*Extraigo los parametros que he enviado con post y compruebo si son distintos de null y undefined para saber si me ha legado algo de ellos, no puedo usar empty debido al propio metodo post que, al ocultarme los datos que le estoy enviando al servidor, no puedo saber si el value que me han mandado esta relleno o no, es decir, si es cadena vacia o no. Solo puedo saber si contiene un dato, es decir, si de verdad me han mandado los datos y eso se hace con isset que comprueba si los datos son distinto de null y de undefined, cosa que demostraria que si tengo esos datos y que no me han pasado datos vacios*/
	if(isset($_POST["login"]) && isset($_POST["pass"])){
		hacerLogin($_POST["login"], $_POST["pass"]);
	}
	
?>