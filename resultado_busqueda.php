<?php
	require_once("head.php");
	require_once("header.php");
?>

		<section id="resultados"> 
			<?php
				if(!empty($_GET["titulo"]) || !empty($_GET["date1"]) || !empty($_GET["date2"]) || !empty($_GET["pais"]) || !empty($_GET["album"]) || !empty($_GET["autor"])){
					
					$arrayBusc = "Búsqueda por -> ";

					if (!empty($_GET["titulo"])) {
						$arrayBusc = $arrayBusc . "Título: ". $_GET["titulo"] . "; ";
					}
					if (!empty($_GET["date1"])) {
						$arrayBusc = $arrayBusc . "Desde: " . $_GET["date1"] . "; ";
					}
					if (!empty($_GET["date2"])) {
						$arrayBusc = $arrayBusc . "Hasta: " . $_GET["date2"] . "; ";
					}
					if (!empty($_GET["pais"])) {
						$arrayBusc = $arrayBusc . "País: " . $_GET["pais"] . "; ";
					}
					if (!empty($_GET["album"])) {
						$arrayBusc = $arrayBusc . "Álbum: " . $_GET["album"] . "; ";
					}
					if (!empty($_GET["autor"])) {
						$arrayBusc = $arrayBusc . "Autor: " . $_GET["autor"] . "; ";
					}

					$arrayBusc = rtrim($arrayBusc);
					$arrayBusc[strlen($arrayBusc) - 1] = ".";

					if(!empty($arrayBusc)) echo "<p>$arrayBusc</p>";		
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