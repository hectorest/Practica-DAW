<?php

session_start();

/*Array que contiene los estilos de los usuarios por defecto, de manera provisional*/
$estilosUsuarios = array(
		"1" => "normal",
		"2" => "accesible",
		"3" => "normal",
		"4" => "accesible",
		"5" => "normal");

if(isset($_SESSION["usuarioLog"])){

	$estiloUsu;
	foreach ($GLOBALS["estilosUsuarios"] as $key => $value) {
		if($key == $_SESSION["usuarioLog"]){
			$estiloUsu = $value;
			break;
		}
	}

	if($estiloUsu == "normal"){
		$estiloCss = '<link rel="stylesheet" title="Normal" type="text/css" href="estilo.css" />';
		$estiloCssAlt = '<link rel="alternate stylesheet" title="Accesible" type="text/css" href="estilo_accesible.css" />';
	}
	else{
		$estiloCss = '<link rel="stylesheet" title="Accesible" type="text/css" href="estilo_accesible.css" />';
		$estiloCssAlt = '<link rel="alternate stylesheet" title="Normal" type="text/css" href="estilo.css" />';
	}

}
else{
	$estiloCss = '<link rel="stylesheet" title="Normal" type="text/css" href="estilo.css" />';
	$estiloCssAlt = '<link rel="alternate stylesheet" title="Accesible" type="text/css" href="estilo_accesible.css" />';
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
		"crearAlbum.php" => "Crear Álbum",
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
echo <<<cabecera
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
	{$GLOBALS['estiloCss']}
	{$GLOBALS['estiloCssAlt']}
	<link rel="stylesheet" type="text/css" media="print" href="print.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1"/> 
	<script type="text/javascript" src="script.js"></script>
</head> 
cabecera;
}

?>
