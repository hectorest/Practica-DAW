
function cerrarMensajeModal(){
	var modal = document.querySelector("body nav + button + div");
	var button = document.querySelector("body nav + button");
	modal.remove();
	button.remove();

	/*Hago una recarga de pagina para eliminar el parametro de la url*/
	
	var url = location.href;
	var arrayUrl = url.split("?");
	url = arrayUrl[0];
	url.toString();
	url = url + "#";
	location.href = url;
}