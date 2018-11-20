<?php
require_once("conexion_db.php");
$cookieFalsa = false;
if(isset($_COOKIE["idUsuario"])){
	require_once("controlCookie.php");
	if(isset($_SESSION["usuarioLog"])){
		if(isset($_COOKIE["ultimaVisita"])){
			setcookie("ultimaVisita", date("c"), time() + 90 * 24 * 60 * 60);
			$_COOKIE["ultimaVisita"] = date("c");
		}

		$usuarioSesion = $_SESSION["usuarioLog"];
		$usuarioSesion = $GLOBALS["mysqli"]->real_escape_string($usuarioSesion);
		$usuarioSesion = (int) $usuarioSesion;

		// Ejecuta una sentencia SQL 
		$sentencia = 'SELECT e.IdEstilo, e.Nombre, e.Descripcion, e.Fichero FROM usuarios u JOIN estilos e ON (u.Estilo = e.IdEstilo) WHERE u.IdUsuario = '. $usuarioSesion; 
		if(!($estilo = $GLOBALS["mysqli"]->query($sentencia))) { 
			echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error; 
			echo '</p>'; 
			exit; 
		}

		if(mysqli_num_rows($estilo)){
			$fila = $estilo->fetch_object();
			$nombreEstiloUsu = "'" . $fila->Nombre . "'";
			$ficheroEstiloUsu = "'" . $fila->Fichero . "'";
			$IdEstilo = (int) $fila->IdEstilo;
		}
	}
	else{
		$nombreEstiloUsu = "'Normal'";
		$ficheroEstiloUsu = "'estilo.css'";
		$sentencia = 'SELECT IdEstilo FROM estilos WHERE Fichero = '. $ficheroEstiloUsu; 
		if(!($estilo = $GLOBALS["mysqli"]->query($sentencia))) { 
			echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error; 
			echo '</p>'; 
			exit; 
		}
		if(mysqli_num_rows($estilo)){
			$fila = $estilo->fetch_object();
			$IdEstilo = $fila->IdEstilo;
		}
	}
}
else{
	if(isset($_SESSION["usuarioLog"])){

		$usuarioSesion = $_SESSION["usuarioLog"];
		$usuarioSesion = $GLOBALS["mysqli"]->real_escape_string($usuarioSesion);
		$usuarioSesion = (int) $usuarioSesion;

		// Ejecuta una sentencia SQL 
		$sentencia = 'SELECT e.IdEstilo, e.Nombre, e.Descripcion, e.Fichero FROM usuarios u JOIN estilos e ON (u.Estilo = e.IdEstilo) WHERE u.IdUsuario = '. $usuarioSesion; 
		if(!($estilo = $GLOBALS["mysqli"]->query($sentencia))) { 
			echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error; 
			echo '</p>'; 
			exit; 
		}

		if(mysqli_num_rows($estilo)){
			$fila = $estilo->fetch_object();
			$nombreEstiloUsu = "'" . $fila->Nombre . "'";
			$ficheroEstiloUsu = "'" . $fila->Fichero . "'";
			$IdEstilo = (int) $fila->IdEstilo;
		}
	}
	else{
		$nombreEstiloUsu = "'Normal'";
		$ficheroEstiloUsu = "'estilo.css'";
		$sentencia = 'SELECT IdEstilo FROM estilos WHERE Fichero = '. $ficheroEstiloUsu; 
		if(!($estilo = $GLOBALS["mysqli"]->query($sentencia))) { 
			echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error; 
			echo '</p>'; 
			exit; 
		}
		if(mysqli_num_rows($estilo)){
			$fila = $estilo->fetch_object();
			$IdEstilo = $fila->IdEstilo;
		}
	}
}

function mostrarMensErrorCookie(){
			echo <<<errorCookie
			<button type="button" onclick="cerrarMensajeModal(2);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-login">
					<h2>Error</h2>
				</span>
					<p>El usuario almacenado no es válido o ha expirado</p>
					<button type="button" onclick="cerrarMensajeModal(2);">Aceptar</button>
				</div>
			</div>
errorCookie;
}

extraerUrl();
function extraerUrl(){
	$urlRel = $_SERVER['REQUEST_URI'];
	$pagArray = explode("/", $urlRel);
	$pag = (string) $pagArray[sizeof($pagArray) - 1];
	$pagSinParams = explode("?", $pag);
	if(!empty($pagSinParams)){
		$pag = $pagSinParams[0];
	}
	obtenerTitle($pag);
}

function obtenerTitle(&$pagina){
	$title;
	$hayTitle = false;
	$paginasWeb = array(
		"index.php" => "Inicio",
		"acerca.php" => "Acerca",
		"controlRegistro.php" => "Registrarse",
		"crear_album.php" => "Crear Álbum",
		"respuesta_crear_album.php" => "Crear Álbum",
		"solicitar_album.php" => "Solicitar Álbum",
		"respuesta_sol_album.php" => "Solicitar Álbum",
		"formulario_busqueda.php" => "Búsqueda",
		"resultado_busqueda.php" => "Resultados de la Búsqueda",
		"formulario_registro.php" => "Registrarse",
		"formulario_acceso.php" => "Iniciar Sesión",
		"detalle_foto.php" => "Detalle de Foto",
		"perfil.php" => "Perfil",
		"perfil2.php" => "Perfil"
	);

	foreach ($paginasWeb as $key => $value) {
		if($pagina == $key){
			$title = "Pictures & Images - $value";
			$hayTitle = true;
			break;
		}
	}

	if ($hayTitle == false){
		$title = "Pictures & Images";
	}

	escribirHead($title);
}

function escribirHead(&$title){
echo <<<cabeceraParte1
<!DOCTYPE html> 
<html lang="es"> 
<!-- La cabecera --> 
<head>
	<title>$title</title>
	<meta charset="utf-8" /> 
	<meta name="generator" content="Bloc de notas" /> 
	<meta name="author" content="Hector Esteve Yagüe & Fco. Javier García Fernández" /> 
	<meta name="keywords" content="HTML5, web, Pictures & Images, PI, fotos, imagenes"/> 
	<meta name="description" content="Pagina principal de PI" />
	<link rel="shortcut icon" type="image/x-icon" href="./logotipo-e-icono/icono-pi-daw.ico"/>
	<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="./logotipo-e-icono/icono-pi-daw.ico"/>
	<link rel="stylesheet" type="text/css" href="fontello/css/fontello.css"/>
	<link rel='stylesheet' title={$GLOBALS['nombreEstiloUsu']} type='text/css' href={$GLOBALS['ficheroEstiloUsu']} />
cabeceraParte1;

//Extraemos estilos alternativos atendiendo al estilo elegido

$sentencia = 'SELECT IdEstilo, Nombre, Fichero FROM estilos WHERE IdEstilo NOT IN('. $GLOBALS['IdEstilo'] . ')'; 
if(!($estilosAlt = $GLOBALS["mysqli"]->query($sentencia))) { 
	echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error; 
	echo '</p>'; 
	exit; 
}

if(mysqli_num_rows($estilosAlt) >= 1){
	while($fila = $estilosAlt->fetch_assoc()){
		$nombreEstiloAltUsu = "'" . $fila["Nombre"] . "'";
		$ficheroEstiloAltUsu = "'" . $fila["Fichero"] . "'";
		echo "<link rel='alternate stylesheet' title=$nombreEstiloAltUsu type='text/css' href=$ficheroEstiloAltUsu />";
	}
}

echo <<<cabeceraParte2
	<link rel="stylesheet" type="text/css" media="print" href="print.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1"/> 
	<script type="text/javascript" src="script.js"></script>
</head> 
cabeceraParte2;
}

?>
