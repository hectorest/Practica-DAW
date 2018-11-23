<?php
session_start();
require_once("head.php");
require_once("header.php");
if(isset($_SESSION["usuarioLog"]) && $cookieFalsa == false){
	require_once("barraNavSesionIniciada.php");
}
else{
	require_once("barraNavSesionNoIniciada.php");
	if($cookieFalsa){
		mostrarMensErrorCookie();
	}
}
?>

<!-- El cuerpo -->		
		<div id="formBusc">	
			
			<form id="buscTexto" action="resultado_busqueda.php" method="get" class="formulario">
				<input type="search" name="palClave" id="buscRap" placeholder="Buscar...">
				<button type="submit"><span id="butBuscRap" class="icon-search"></span></button>
			</form>

			<form id="miniFilBusc" action="resultado_busqueda.php" method="get" class="formulario">
				<fieldset>

					<legend>
						Búsqueda Avanzada
					</legend>

							<p>
								<label for="autor">Autor:</label>
								<input type="text" name="NomUsuario" id="autorRap">
							</p>

							<p>
								<label for="album">Álbum:</label>
								<input type="text" name="Album" id="albumRap">
							</p>

							<p>
								<label for="titulo">Título:</label>
								<input type="text" name="Titulo" id="tituloRap">
							</p>

						<button type="submit"><span id="butFiltBuscRap" class="icon-search"></span></button>
						<a href="formulario_busqueda.php" title="Hacer búsqueda avanzada">Más opciones...</a>
						
				</fieldset>			

			</form>
		</div>

<?php

	require_once("conexion_db.php");
	require_once("controlUrlPag.php");

	//realizamos la sentencia sql para extraer la totalidad de datos de la base de datos con el fin de establecer las paginas totales de las que dispondre
	$sentencia = 'SELECT * FROM fotos';
	if(!($resultado = $mysqli->query($sentencia))) { 
		echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error; 
		echo '</p>'; 
		exit; 
	}

	require_once("paginacion.php");

	//liberamos memoria y cerramos conexion
	$resultado->free();

	crearIndex();

	function crearIndex(){

		echo<<<indexParte1
		<section id="contFotosIndex"> 
			<h3>Últimas 5 imágenes subidas</h3>
			<div class="imagenes">
indexParte1;

		//extraigo las fotos indicando por cual pagina debo empezar y cuantas imagenes mostrar como tope
		$sentencia = 'SELECT * FROM fotos JOIN paises ON (IdPais = Pais)' . ' ORDER BY (FRegistro) DESC ' . 'LIMIT ' . $GLOBALS["inicio"] . ',' . $GLOBALS["tamPag"];
		if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))) { 
			echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
			echo '</p>'; 
			exit; 
		}

		if(mysqli_num_rows($resultado) >= 1){
			while($fila = $resultado->fetch_assoc()){

				$idFoto = $fila["IdFoto"];
				$titulo = $fila["Titulo"];
				$fichero = $fila["Fichero"];
				$alt = $fila["Alternativo"];
				$fecha = $fila["Fecha"];
				$pais = $fila["NomPais"];

				echo<<<articulo

			<article>
				<h4><a href="detalle_foto.php?id=$idFoto" title="Ver detalles de la foto">$titulo</a></h4>
				<figure>
					<a href="detalle_foto.php?id=$idFoto" title="Ver detalles de la foto"><img src="./$fichero" alt="$alt"/></a>
				</figure>
				<footer>
					<p><time datetime="$fecha">$fecha</time></p>
					<p>$pais</p>
				</footer>
			</article>
articulo;
			}
		}

		echo<<<indexParte2
			</div> 
		</section>
		<div class="paginacion">
			<div>
				<a href="{$GLOBALS['getUrl']}?pagina=1"><span class="icon-to-start" title="Primeras 5 imágenes"></span></a>
				<a href="{$GLOBALS['getUrl']}?pagina={$GLOBALS['paginaAnt']}"><span class="icon-left-open" title="Anteriores 5 imágenes"></span></a>
				<p>Página <output>{$GLOBALS['pagina']}</output> / {$GLOBALS['totalPaginas']}</p>
				<a href="{$GLOBALS['getUrl']}?pagina={$GLOBALS['paginaSig']}"><span class="icon-right-open" title="Siguientes 5 imágenes"></span></a>
				<a href="{$GLOBALS['getUrl']}?pagina={$GLOBALS['totalPaginas']}"><span class="icon-to-end" title="Últimas 5 imágenes"></span></a>
			</div>
		</div>
indexParte2;

		//liberamos memoria y cerramos conexion
		$resultado->free();
		$GLOBALS["mysqli"]->close();

	}


 ?>

<?php
	require_once("footer.php");
?>