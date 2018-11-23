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

	function extraerPais(&$IdP){

		$sentencia = 'SELECT NomPais FROM paises WHERE IdPais =' . $IdP;
		
		if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))){
			echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
			echo '</p>'; 
			exit; 
		}

		$fila = $resultado->fetch_object();

		$resultado->free();

		return $fila->NomPais;

	}
	
	function extraerUsuario(&$IdUsu){

		if(is_numeric($IdUsu)){

			$sentencia = 'SELECT NomUsuario FROM usuarios WHERE IdUsuario =' . $IdUsu;
			
			if(!($resultado = $GLOBALS["mysqli"]->query($sentencia))){
				echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $GLOBALS["mysqli"]->error; 
				echo '</p>'; 
				exit; 
			}

			$fila = $resultado->fetch_object();

			$resultado->free();

			return $fila->NomUsuario;

		}
		else{
			return $IdUsu;
		}

	}

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
						if($key != "pagina"){
							echo"<p><b>$clave:</b> $value</p>";
						}
					}
				}

				echo "</div>";
				
				$busqueda = '';
				$contador = 0;
				$comparador = "=";

				foreach ($getSaneado as $key => $value){
					if($key == "pagina"){
						$value = null;
					}
					if(!empty($value)){
						if($contador == 0){
							if($key == "Album" || $key == "a.Album"){
								$key = 'a.' . 'Titulo';
								$comparador = ' LIKE ';
								$value = (string) $value;
								$value = "%$value%";
							}
							if($key == "Titulo" || $key == "f.Titulo"){
								$key = 'f.' . 'Titulo';
								$comparador = ' LIKE ';
								$value = (string) $value;
								$value = "%$value%";
							}
							if($key == "palClave"){
								$key = 'f.' . 'Descripcion';
								$comparador = ' LIKE ';
								$value = (string) $value;
								$value = "%$value%";
							}
							if($key == "Fecha"){
								$comparador = ' LIKE ';
								$value = (string) $value;
								$value = "%$value%";
							}
							if($key == "Usuario"){
								if(!is_numeric($value)){
									$value = "";
								}
							}
							if($key == "Pais" || $key == "f.Pais"){
								$key = 'f.' . 'Pais';
							}
							if(is_numeric($value)){
								$busqueda = $busqueda . $key . $comparador . $value; 
							}
							else{
								$busqueda = $busqueda . $key . $comparador . "'" . $value . "'";
							}
							
							$contador = $contador + 1;
						}
						else{
							if($key == "Album" || $key == "a.Album"){
								$key = 'a.' . 'Titulo';
								$comparador = ' LIKE ';
								$value = (string) $value;
								$value = "%$value%";
							}
							if($key == "Titulo" || $key == "f.Titulo"){
								$key = 'f.' . 'Titulo';
							}
							if($key == "palClave"){
								$key = 'f.' . 'Descripcion';
								$comparador = ' LIKE ';
								$value = (string) $value;
								$value = "%$value%";
							}
							if($key == "Fecha"){
								$comparador = ' LIKE ';
								$value = (string) $value;
								$value = "%$value%";
							}
							if($key == "Usuario"){
								if(!is_numeric($value)){
									$value = "";
								}
							}
							if($key == "Pais" || $key == "f.Pais"){
								$key = 'f.' . 'Pais';
							}
							if(is_numeric($value)){
								$busqueda = $busqueda . ' AND ' . $key . $comparador . $value; 
							}
							else{
								$busqueda = $busqueda . ' AND ' . $key . $comparador . "'" . $value . "'";
							}
						}
					}
				}

				$sentencia = 'SELECT IdFoto, f.Titulo, a.Titulo AS AlbumTit, NomUsuario, Fichero, Alternativo, Fecha, NomPais FROM fotos f JOIN albumes a on (f.Album = a.IdAlbum) JOIN usuarios ON (a.Usuario = usuarios.IdUsuario) JOIN paises ON (usuarios.Pais = paises.IdPais) WHERE ' . $busqueda;
				if(!($resultado = $mysqli->query($sentencia))) { 
					echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error; 
					echo '</p>'; 
					exit; 
				}

				$tamPag = 5; //establezco el tamanyo de pagina, es decir, el numero tope de registros a mostrar
				require_once("paginacion.php");

				$resultado->free();

				if(!empty($_GET["pagina"]) && ($_GET["pagina"] > $totalPaginas || !is_numeric($_GET["pagina"]))){
					$pagina = $totalPaginas;
					echo<<<cerrarSection
						</div>
					</section> 
cerrarSection;
					mostrarErrorPaginaNoExistente();
				}
				else{
					mostrarResultBusq();
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

		$sentencia = $sentencia = 'SELECT IdFoto, f.Titulo, a.Titulo AS AlbumTit, NomUsuario, Fichero, Alternativo, Fecha, NomPais FROM fotos f JOIN albumes a on (f.Album = a.IdAlbum) JOIN usuarios ON (a.Usuario = usuarios.IdUsuario) JOIN paises ON (f.Pais = paises.IdPais) WHERE ' . $GLOBALS["busqueda"] . ' ORDER BY (f.FRegistro) DESC ' . 'LIMIT ' . $GLOBALS["inicio"] . ',' . $GLOBALS["tamPag"];

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