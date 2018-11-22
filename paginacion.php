<?php
	
	$tamPag = 5; //establezco el tamanyo de pagina, es decir, el numero tope de registros a mostrar

	if(!empty($_GET["pagina"]) && is_numeric($_GET["pagina"]) && $_GET["pagina"] > 0){ //si me han pasado un parametro y es numerico, mi inicio empieza desde esa pagina
		$pagina = $_GET["pagina"];
		$inicio = ($pagina - 1) * $tamPag;
	}
	else{ //si no, empiezo por la primera pagina
		$pagina = 1;
		$inicio = 0;
	}
	
	//si no hay ningun registro tendremos estos valores para la paginacion
	$numTotalRegistros = 0;
	$totalPaginas = 1;

	if(mysqli_num_rows($resultado) >= 1){
		$numTotalRegistros = mysqli_num_rows($resultado);
		$totalPaginas = ceil($numTotalRegistros / $tamPag);
	}

	//para pasar las paginas anterior y siguiente a la paginacion
	if(($pagina + 1) < $totalPaginas){
		$paginaSig = $pagina + 1;
	}
	else{
		$paginaSig = $totalPaginas;
	}

	if(($pagina - 1) > 0){
		$paginaAnt = $pagina - 1;	
	}
	else{
		$paginaAnt = 1;
	}

?>