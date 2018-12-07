<?php
session_start();
require_once("head.php");
require_once("header.php");
require_once("barraNavSesionNoIniciada.php");

	echo<<<modalBajaConfirmada
			<button type="button" onclick="cerrarMensajeModal(0);">X</button>
			<div class="modal">
				<div class="contenido">
					<span>
						<h2>Baja realizada con éxito</h2>
					</span>
					<p>Le informamos que tanto su cuenta como las fotos y álbumes asociados a esta han sido eliminados</p>
					<button type="button" onclick="cerrarMensajeModal(0);">Aceptar</button>
				</div>
				</div>
modalBajaConfirmada;

require_once("footer.php");
?>