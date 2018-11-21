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
					<input type="text" name="titulo" id="titulo"/>
				</p>
				<p>
					<label for="date1">Fecha entre:</label>
					<input type="date" name="date1" id="date1"/>
				</p>
				<p>
					<label for="date2">y</label>
					<input type="date" name="date2" id="date2"/>
				</p>
				<p>
					<label for="pais">País:</label>
					<select name="pais" id="pais">
						<option value="">Escoge</option>
						<?php  
							require_once("obtenerPaises.php");
						?>
					</select>
				</p>
				<p>
					<label for="album">Álbum:</label>
					<input type="text" name="album" id="album"/>
				</p>
				<p>
					<label for="autor">Autor:</label>
					<input type="text" name="autor" id="autor"/>
				</p>
				<p>
					<button type="submit"><span class="icon-search">Buscar</span></button>
				</p>

			</fieldset>

		</form>

<?php
	require_once("footer.php");
?>