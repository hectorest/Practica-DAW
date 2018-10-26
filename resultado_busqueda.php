
<?php
	require_once("head.php");
	require_once("header.php");
?>	

<?php

		$hayGet = false;
		$hayFiltros = false;

		foreach ($_GET as $value){
			if(isset($value)){
				$hayGet=true;
			}
			if(!empty($value)){
				$hayFiltros = true;
			}
		}

		if($hayGet==true){	

			if($hayFiltros == true){

				echo<<<filtros

				<section id="resultados">

				<h3>Filtros de la búsqueda:</h3> 

				<div id="filtrosAplicados" class="mostrarDatos">
				
filtros;

				foreach ($_GET as $key => $value) {
					$clave = $key;
					cambiarClave($clave);
					if($value != ""){
						echo"<p><b>$clave:</b> $value</p>";
					}
				}

				echo "</div>";
				mostrarResultBusq();

		}
		
		else{

			echo<<<noHayResultBusq

				<section id="resultados">
				<p><b>No hay resultados</b></p>
				</section>

noHayResultBusq;

		}
	}
		else{

			echo<<<noHayResultBusq

				<section id="resultados">
				<p><b>No hay resultados</b></p>
				</section>

noHayResultBusq;
			}

function cambiarClave(&$clave){
	$clav = array(
		"album" => "Álbum",
		"autor" => "Autor",
		"date1" => "Desde",
		"date2" => "Hasta",
		"titulo" => "Título",
		"desc" => "Descripción",
		"palClave" => "Palabra clave",
		"passw1" => "Contraseña",
		"pass" => "Contraseña",
		"sexo" => "Sexo",
		"fNac" => "Fecha de nacimiento",
		"cRes" => "Ciudad de residencia",
		"pais" => "País",
		"local" => "Localidad",
		"pRes" => "País de residencia",
		"usuario" => "Usuario",
		"email" => "Email",
		"texto_adicional" => "Texto adicional",
		"cp" => "Código Postal",
		"calle" => "Calle",
		"numero" => "Número",
		"local" => "Localidad",
		"prov" => "Provincia",
		"telefono" => "Teléfono",
		"color_portada" => "Color portada",
		"num_copias" => "Número de copias",
		"resolucion" => "Resolución",
		"frecep" => "Fecha de recepción",
		"colorobn" => "Color o Blanco y negro",
		"nombre" => "Nombre"
		);

	foreach ($clav as $key => $value) {
		if($clave == $key){
			$clave = $value;
			break;
		}
	}
}

function mostrarResultBusq(){

	echo <<<resultadoBusqueda

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
}

resultadoBusqueda;

}

?>

<?php
	require_once("footer.php");
?>