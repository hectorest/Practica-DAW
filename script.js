
function cerrarMensajeModal(param){
	var modal = document.querySelector("body nav + button + div");
	var button = document.querySelector("body nav + button");
	if(modal != null && modal != undefined) modal.remove(); else{ modal = document.querySelector("div"); modal.remove(); }
	if(button != null && button != undefined) button.remove();

	/*Hago una recarga de pagina para eliminar el parametro de la url*/
	if(param == 1){
		var url = location.href;
		var arrayUrl = url.split("?");
		url = arrayUrl[0];
		url.toString();
		url = url + "#";
		location.href = url;
	}
	else if (param == 3){
		location.href = "./eliminar_sesion.php";
	}
	else if (param == 4){
		location.href = "./perfil.php";
	}
	else if (param == 5){
		location.href = "./formulario_acceso.php";
	}
	else{
		location.href = "./index.php";
	}
}