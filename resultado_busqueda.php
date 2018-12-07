<?php
session_start();
require_once("head.php");
require_once("header.php");
require_once("conexion_db.php");
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

<?php
	
	function mostrarErrorPaginaNoExistente(){
		echo<<<modalDetalle
				<button type="button" onclick="cerrarMensajeModal(8);">X</button>
				<div class="modal">
					<div class="contenido">
						<span>
							<img src="./img/error.png" alt="error-detalle-foto">
							<h2>Error</h2>
						</span>
						<p>Esta página del resultado de la búsqueda no existe</p>
						<button type="button" onclick="cerrarMensajeModal(8);">Cerrar</button>
					</div>
				</div>
modalDetalle;
	}

	function mostrarErrorNoHaBuscado(){
		echo<<<modalDetalle
				<button type="button" onclick="cerrarMensajeModal(8);">X</button>
				<div class="modal">
					<div class="contenido">
						<span>
							<img src="./img/error.png" alt="error-detalle-foto">
							<h2>Error</h2>
						</span>
						<p>No has realizado ninguna búsqueda. ¡Anímate y busca algo en PI!</p>
						<button type="button" onclick="cerrarMensajeModal(8);">Buscar</button>
					</div>
				</div>
modalDetalle;
	}

	function mostrarMensErrorFechasInvalidas(){
		echo<<<modalDetalle
				<button type="button" onclick="cerrarMensajeModal(8);">X</button>
				<div class="modal">
					<div class="contenido">
						<span>
							<img src="./img/error.png" alt="error-detalle-foto">
							<h2>Error</h2>
						</span>
						<p>La primera fecha que introduces (Desde) no puede ser mayor que la segunda (Hasta). Emplea un formato correcto para realizar la búsqueda utilizando fechas.</p>
						<button type="button" onclick="cerrarMensajeModal(8);">Buscar</button>
					</div>
				</div>
modalDetalle;
	}
	
	require_once("extraerDatos.php");
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

				require_once("controlUrlPag.php");

				$getSaneado = $_GET;

				foreach ($getSaneado as $key => $value){
					if(!empty($value)){
						$GLOBALS["mysqli"]->real_escape_string($value);
					}
				}

				$hay2Fechas = false;
				if(!empty($getSaneado["Desde"]) && !empty($getSaneado["Hasta"])){
					$hay2Fechas = true;
				}

				foreach ($getSaneado as $key => $value) {
					$clave = $key;
					cambiarClave($clave);
					if(!empty($value)){
						if($key == "Pais"){
							$value = extraerPais($value); 
						}
						if($key == "Usuario"){
							$value = extraerUsuario($value); 
						}
						if(!$hay2Fechas){
							if($key == "Desde" || $key == "Hasta"){
								$clave = "Fecha";
							}
						}
						if($key != "pagina"){
							echo"<p><b>$clave:</b> $value</p>";
						}
					}
				}

				echo "</div>";
				
				$FechasValidas = true;
				require_once("rellenarVariableBusqueda.php");

				if(!empty($busqueda)){
					$sentencia = 'SELECT IdFoto, f.Titulo, a.Titulo AS AlbumTit, NomUsuario, Fichero, Alternativo, Fecha, NomPais FROM fotos f JOIN albumes a on (f.Album = a.IdAlbum) JOIN usuarios ON (a.Usuario = usuarios.IdUsuario) JOIN paises ON (usuarios.Pais = paises.IdPais) WHERE ' . $busqueda;
					if(!($resultado = $mysqli->query($sentencia))) { 
						echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error; 
						echo '</p>'; 
						exit; 
					}

					$tamPag = 5; //establezco el tamanyo de pagina, es decir, el numero tope de registros a mostrar
					require_once("paginacion.php");

					$resultado->free(); //liberamos de la memoria el resultado de la consulta

					if(!empty($_GET["pagina"]) && ($_GET["pagina"] > $totalPaginas || !is_numeric($_GET["pagina"]))){
						$pagina = $totalPaginas;
						echo<<<cerrarSection
							</div>
						</section> 
cerrarSection;
						mostrarErrorPaginaNoExistente();
					}
					else{
						if($FechasValidas){
							mostrarResultBusq();
						}
					}	
				}
				else{
					if($FechasValidas){
						echo<<<SinResultados
								<h3>Resultados de la búsqueda:</h3>
								<a href="formulario_busqueda.php" title="Realizar otra búsqueda"><span class="icon-search">Buscar de nuevo</span></a>

								<div class="imagenes">
									<p><b>No hay resultados</b></p>
								</div>
							</section>
SinResultados;
					}
				}
	
		}
		else{

			mostrarErrorNoHaBuscado();

		}
	}
	else{

		mostrarErrorNoHaBuscado();

	}	


function cambiarClave(&$clave){
	$clav = array(
		"Album" => "Álbum",
		"NomUsuario" => "Autor",
		"Usuario" => "Autor",
		"FRegistro" => "Fecha",
		"Titulo" => "Título",
		"Descripcion" => "Descripción",
		"palClave" => "Palabra clave",
		"Pais" => "País",
	);

	foreach ($clav as $key => $value) {
		if($clave == $key){
			$clave = $value;
			break;
		}
	}
}

function mostrarResultBusq(){

	echo<<<resultadoBusqueda1

		<h3>Resultados de la búsqueda:</h3>
		<a href="formulario_busqueda.php" title="Realizar otra búsqueda"><span class="icon-search">Buscar de nuevo</span></a>

		<div class="imagenes">
resultadoBusqueda1;

		require_once("paginacion.php");

		$sentencia = $sentencia = 'SELECT IdFoto, f.Titulo, a.Titulo AS AlbumTit, NomUsuario, Fichero, Alternativo, Fecha, NomPais FROM fotos f JOIN albumes a on (f.Album = a.IdAlbum) JOIN usuarios ON (a.Usuario = usuarios.IdUsuario) JOIN paises ON (f.Pais = paises.IdPais) WHERE ' . $GLOBALS["busqueda"] . ' ORDER BY (Fecha) DESC ' . 'LIMIT ' . $GLOBALS["inicio"] . ',' . $GLOBALS["tamPag"];

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
		else{
			echo "<p><b>No hay resultados</b></p>";
		}
			
	echo<<<resultadoBusqueda2
		</div>
		</section> 
		
		<div class="paginacion">
			<div>
				<a href="resultado_busqueda.php?{$GLOBALS['getUrl']}&pagina=1"><span class="icon-to-start" title="Primeras 5 imágenes"></span></a>
				<a href="resultado_busqueda.php?{$GLOBALS['getUrl']}&pagina={$GLOBALS['paginaAnt']}"><span class="icon-left-open" title="Anteriores 5 imágenes"></span></a>
				<p>Página <output>{$GLOBALS['pagina']}</output> / {$GLOBALS['totalPaginas']}</p>
				<a href="resultado_busqueda.php?{$GLOBALS['getUrl']}&pagina={$GLOBALS['paginaSig']}"><span class="icon-right-open" title="Siguientes 5 imágenes"></span></a>
				<a href="resultado_busqueda.php?{$GLOBALS['getUrl']}&pagina={$GLOBALS['totalPaginas']}"><span class="icon-to-end" title="Últimas 5 imágenes"></span></a>
			</div>
		</div>
resultadoBusqueda2;

		$resultado->free();
		$GLOBALS["mysqli"]->close();

}

?>

<?php
	require_once("footer.php");
?>