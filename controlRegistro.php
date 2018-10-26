<?php
	require_once("head.php");
	require_once("header.php");
?>

<?php

	/*if(!empty($_POST["usuario"]) && !empty($_POST["passw1"]) && !empty($_POST["passw2"])){
		if(!empty($_POST["email"]) && !empty($_POST["sexo"]) && !empty($_POST["fnac"])){
			if(!empty($_POST["cres"]) && !empty($_POST["pres"]) && !empty($_POST["fper"])){
				hacerRegistro($_POST["usuario"],$_POST["passw1"],$_POST["passw2"],$_POST["email"],$_POST["sexo"],$_POST["fnac"],$_POST["cres"],$_POST["pres"],$_POST["fper"]);
			}
		}
	}*/
?>

<?php
$completo = True;
	
	foreach ($_POST as $value){
		if(!isset($value)){
			$completo=false;
		}
	}

	if($completo==true){

		if($_POST["contrasenya"] != $_POST["contrasenya2"]){
			$host = $_SERVER['HTTP_HOST']; 
			$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');  
			$extra = 'formulario_registro.php';
			header("Location: http://$host$uri/$extra?er=300");
		}else{

			echo<<<arribaTabla

			<section>
				<div class="contTabla">

				<table class="tabla" title="Puedes hacer scroll lateral en la tabla si no cabe en tu pantalla para poder ver todos los datos que contiene">

				<caption>Datos de registro:</caption>

arribaTabla;

			foreach ($_POST as $key => $value) {
				if($key!="contrasenya2" && $key!="foto_de_perfil"){
					if($value == ""){
						echo"<tr><td>$clave:</td><td><i>No hay datos</i></td></tr>";
					}
					else{
						$clave = $key;
						cambiarAcentos($clave);
						$clave = ucfirst($clave);
						$clave = str_replace("_", " ", $clave);
						$clave = str_replace("ny", "ñ", $clave);
						echo"<tr><td>$clave:</td><td>$value</td></tr>";
					}
				}
			}

			echo<<<bajotabla

					</table>

				</div>

				<div class="enlPerf">
					<a href="index.php" title="Volver a inicio">Aceptar</a>
				</div>

			</section>

bajotabla;


		}

	}

function cambiarAcentos(&$clave){

	$pos = strpos($clave, "#");
	if($pos!=false){
		$vocal = substr($clave, $pos, 2);
		switch ($vocal) {
			case '#a':
				$clave = str_replace("#a", "á", $clave);
				break;
			case '#e':
				$clave = str_replace("#e", "é", $clave);
				break;
			case '#i':
				$clave = str_replace("#i", "í", $clave);
				break;
			case '#o':
				$clave = str_replace("#o", "ó", $clave);
				break;
			case '#u':
				$clave = str_replace("#u", "ú", $clave);
				break;			
			default:
				break;
		}
	}
}

?>



<?php
	require_once("footer.php");
?>