<?php
	require_once("head.php");
	require_once("header.php");
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
								<input type="text" name="autor" id="autorRap">
							</p>

							<p>
								<label for="album">Álbum:</label>
								<input type="text" name="album" id="albumRap">
							</p>

							<p>
								<label for="titulo">Título:</label>
								<input type="text" name="titulo" id="tituloRap">
							</p>

						<button type="submit"><span id="butFiltBuscRap" class="icon-search"></span></button>
						<a href="formulario_busqueda.php" title="Hacer búsqueda avanzada">Más opciones...</a>
						
				</fieldset>			

			</form>
		</div>

		<section id="contFotosIndex"> 
			<h3>Últimas 5 imágenes subidas</h3>
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
				<article>
					<h4><a href="detalle_foto.php?id=4" title="Ver detalles de la foto">Titulo foto Ejemplo 4</a></h4>
					<figure>
						<a href="detalle_foto.php?id=4" title="Ver detalles de la foto"><img src="./imagen-muestra/images2.jpg" alt="Titulo foto Ejemplo 4"/></a>
					</figure>
					<footer>
						<p><time datetime="2018-09-15">Fecha de foto ejemplo 4, por ejemplo: 15 de septiembre de 2018</time></p>
						<p>Pais foto ejemplo 4</p>
					</footer>
				</article>
				<article>
					<h4><a href="detalle_foto.php?id=5" title="Ver detalles de la foto">Titulo foto Ejemplo 5</a></h4>
					<figure>
						<a href="detalle_foto.php?id=5" title="Ver detalles de la foto"><img src="./imagen-muestra/paisaje.jpg" alt="Titulo foto Ejemplo 5"/></a>
					</figure>
					<footer>
						<p><time datetime="2018-09-15">Fecha de foto ejemplo 5, por ejemplo: 15 de septiembre de 2018</time></p>
						<p>Pais foto ejemplo 5</p>
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