
function cerrarMensajeModal(){
	var modal = document.querySelector("body nav + button + div");
	var button = document.querySelector("body nav + button");
	modal.remove();
	button.remove();
}