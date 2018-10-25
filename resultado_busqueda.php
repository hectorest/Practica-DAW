<?php
	require_once("head.php");
	require_once("header.php");
?>

		<section id="resultados"> 
			<?php

				if(!empty($_GET["palClave"]) || !empty($_GET["titulo"]) || !empty($_GET["date1"]) || !empty($_GET["date2"]) || !empty($_GET["pais"]) || !empty($_GET["album"]) || !empty($_GET["autor"])){

					echo<<<filtros

					<h3>Filtros de la búsqueda:</h3> 

					<div id="filtrosAplicados" class="mostrarDatos">
				
filtros;

						if (!empty($_GET["palClave"])) {

							$palClave = $_GET["palClave"];

							echo "<p>Palabra clave: $palClave</p>\n";
						}

						if (!empty($_GET["titulo"])) {

							$titulo = $_GET["titulo"];

							echo "<p>Titulo: $titulo</p>\n";
						}
						if (!empty($_GET["date1"])) {

							$fecha1 = $_GET["date1"];

							echo "<p>Desde: $fecha1</p>\n";
						}
						if (!empty($_GET["date2"])) {

							$fecha2 = $_GET["date2"];

							echo "<p>Hasta: $fecha2</p>\n";
						}
						if (!empty($_GET["pais"])) {

							$pais = $_GET["pais"];

							echo "<p>País: $pais</p>\n";
						}
						if (!empty($_GET["album"])) {

							$album = $_GET["album"];

							echo "<p>Álbum: $album</p>\n";
						}
						if (!empty($_GET["autor"])) {

							$autor = $_GET["autor"];

							echo "<p>Autor: $autor</p>\n";
						}

					echo "</div>";

				}
			?>

			<h3>Resultados de la búsqueda:</h3>
			<a href="formulario_busqueda.php" title="Realizar otra búsqueda"><span class="icon-search">Buscar de nuevo</span></a>

			<div class="imagenes">
				<article>
					<h4><a href="detalle_foto.php?id=1" title="Ver detalles de la foto">Titulo foto Ejemplo 1</a></h4>
					<figure>
						<a href="detalle_foto.php?id=1" title="Ver detalles de la foto"><img src="./imagen-muestra/imagen-muestra.jpg" alt="Titulo foto Ejemplo 1"/></a>
					</figure>
					<footer>
						<p><time datetime="2018-09-15">Fecha de foto ejemplo 1, por ejemplo: 15 de septiembre de 2018</time></p>
						<p>Pais foto ejemplo 1</p>
					</footer>
				</article>
				<article>
					<h4><a href="detalle_foto.php?id=2" title="Ver detalles de la foto">Titulo foto Ejemplo 2</a></h4>
					<figure>
						<a href="detalle_foto.php?id=2" title="Ver detalles de la foto"><img src="./imagen-muestra/descarga.jpg" alt="Titulo foto Ejemplo 2"/></a>
					</figure>
					<footer>
						<p><time datetime="2018-09-15">Fecha de foto ejemplo 2, por ejemplo: 15 de septiembre de 2018</time></p>
						<p>Pais foto ejemplo 2</p>
					</footer>
				</article>
				<article>
					<h4><a href="detalle_foto.php?id=3" title="Ver detalles de la foto">Titulo foto Ejemplo 3</a></h4>
					<figure>
						<a href="detalle_foto.php?id=3" title="Ver detalles de la foto"><img src="./imagen-muestra/images.jpg" alt="Titulo foto Ejemplo 3"/></a>
					</figure>
					<footer>
						<p><time datetime="2018-09-15">Fecha de foto ejemplo 3, por ejemplo: 15 de septiembre de 2018</time></p>
						<p>Pais foto ejemplo 3</p>
					</footer>
				</article>
			</div>
		</section> 
		
		<div class="paginacion">
			<div>
				<span class="icon-to-start" title="Primeras 5 imágenes"></span>
				<span class="icon-left-open" title="Anteriores 5 imágenes"></span>
				<p>Página <output>1</output> / 5</p>
				<span class="icon-right-open" title="Siguientes 5 imágenes"></span>
				<span class="icon-to-end" title="Últimas 5 imágenes"></span>
			</div>
		</div>

<?php
	require_once("footer.php");
?>