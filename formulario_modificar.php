<?php
session_start();
require_once("head.php");
require_once("header.php");
require_once("conexion_db.php");
if(isset($_SESSION["usuarioLog"]) && $cookieFalsa == false){
	
	require_once("barraNavSesionIniciada.php");

		$msgError = array(0 => "No hay error, el fichero se subió con éxito", 
                                       1 => "El tamaño del fichero supera la directiva 
                                           upload_max_filesize el php.ini", 
                                       2 => "El tamaño del fichero supera el límite permitido (2MB)", 
                                       3 => "El fichero fue parcialmente subido", 
                                       4 => "No se ha subido un fichero", 
                                       6 => "No existe un directorio temporal", 
                                       7 => "Fallo al escribir el fichero al disco", 
                                       8 => "La subida del fichero fue detenida por la extensión"); 

	if(!empty($_GET["er"])){
		if($_GET["er"] == 300){
			echo<<<modalModificar

				<button type="button" onclick="cerrarMensajeModal(1);">X</button>
				<div class="modal">
					<div class="contenido">
					<span>
						<img src="./img/error.png" alt="error-registro">
						<h2>Error</h2>
					</span>
						<p>¡Las contraseñas no coinciden!</p>
						<button type="button" onclick="cerrarMensajeModal(1);">Cerrar</button>
					</div>
				</div>

modalModificar;
		}
		else if($_GET["er"] == 302){
			echo<<<modalModificar

				<button type="button" onclick="cerrarMensajeModal(1);">X</button>
				<div class="modal">
					<div class="contenido">
					<span>
						<img src="./img/error.png" alt="error-registro">
						<h2>Error</h2>
					</span>
						<p>¡El nombre de usuario ya existe!</p>
						<button type="button" onclick="cerrarMensajeModal(1);">Cerrar</button>
					</div>
				</div>

modalModificar;
		}
		else if($_GET["er"] == 305){
			echo<<<modalModificar

				<button type="button" onclick="cerrarMensajeModal(1);">X</button>
				<div class="modal">
					<div class="contenido">
					<span>
						<img src="./img/error.png" alt="error-registro">
						<h2>Error</h2>
					</span>
						<p>No has introducido correctamente tu contraseña actual</p>
						<button type="button" onclick="cerrarMensajeModal(1);">Cerrar</button>
					</div>
				</div>

modalModificar;
		}
		else if($_GET["er"] == 310){
			echo<<<modalControlModificar

			<button type="button" onclick="cerrarMensajeModal(0);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-control-registro">
					<h2>Error</h2>
				</span>
					<p>Para poder realizar cualquier cambio en los datos almacenados en Pictures & Images debes enviar los datos desde la dirección del propio sitio web</p>
					<button type="button" onclick="cerrarMensajeModal(0);">Cerrar</button>
				</div>
			</div>

modalControlModificar;
		}
		else if($_GET["er"] == 320){
			echo<<<modalControlModificar

			<button type="button" onclick="cerrarMensajeModal(1);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-control-registro">
					<h2>Error</h2>
				</span>
					<p>La fecha de nacimiento debe ser menor que la fecha actual</p>
					<button type="button" onclick="cerrarMensajeModal(1);">Cerrar</button>
				</div>
			</div>

modalControlModificar;
		}
		else if(!empty($_GET["erFile"])){
			$errorFile = $msgError[$_GET["erFile"]];
			echo<<<modalControlRegistro

			<button type="button" onclick="cerrarMensajeModal(1);">X</button>
			<div class="modal">
				<div class="contenido">
				<span>
					<img src="./img/error.png" alt="error-control-registro">
					<h2>Error</h2>
				</span>
					<p>$errorFile</p>
					<button type="button" onclick="cerrarMensajeModal(1);">Cerrar</button>
				</div>
			</div>

modalControlRegistro;
		}
	}
		echo<<<arribaFormulario
		<form action="actualizarDatosUsuario.php" method="post" class="formulario" id="formReg" enctype="multipart/form-data">
			
			<fieldset>
					<legend>
						Modificar Datos
					</legend>
arribaFormulario;

			require_once("formulario_registroYmodificar.php");

		echo<<<debajoFormulario
				<p>
					<button type="submit">Modificar</button>
				</p>
				<p>
					En el caso de no insertar ningún valor en alguno de los campos que eran obligatorios en el formulario de registro de un nuevo usuario se mantendrá su valor actual en el sistema
				</p>
			</fieldset>
		</form>
debajoFormulario;
	}
	else{
		if($cookieFalsa){
			mostrarMensErrorCookie();
		}
		else{

			require_once("barraNavSesionNoIniciada.php");

		echo<<<modalModificarPorUrl

				<button type="button" onclick="cerrarMensajeModal(0);">X</button>
				<div class="modal">
					<div class="contenido">
						<span>
							<h2><span class="icon-attention-circled"></span>¡Atención!</h2>
						</span>
						<p>Debes iniciar sesión para poder modificar los datos.</p>
						<button type="button" onclick="cerrarMensajeModal(4);">Iniciar Sesión</button>
						<button type="button" onclick="cerrarMensajeModal(0);">Volver a Inicio</button>
					</div>
				</div>

modalModificarPorUrl;

			}
		}

	?>

<?php
	require_once("footer.php");
?>