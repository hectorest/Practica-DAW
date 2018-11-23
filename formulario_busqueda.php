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
		<form action="resultado_busqueda.php" method="get"  class="formulario" id="formBuscAvanz">

			<fieldset>
			<legend>
				Búsqueda avanzada
			</legend>

				<p>
					<label for="titulo">Título:</label>
					<input type="text" name="Titulo" id="titulo"/>
				</p>
				<p>
					<label for="date">Fecha:</label>
					<input type="date" name="Fecha" id="date"/>
				</p>
				<p>
					<label for="pais">País:</label>
					<select name="Pais" id="pais">
						<option value="">Escoge</option>
						<?php  
							require_once("obtenerPaises.php");
							$GLOBALS{"mysqli"}->close();
						?>
					</select>
				</p>
				<p>
					<label for="album">Álbum:</label>
					<input type="text" name="Album" id="album"/>
				</p>
				<p>
					<label for="autor">Autor:</label>
					<input type="text" name="NomUsuario" id="autor"/>
				</p>
				<p>
					<button type="submit"><span class="icon-search">Buscar</span></button>
				</p>

			</fieldset>

		</form>

<?php
	require_once("footer.php");
?>