<?php

	$urlRel = $_SERVER['REQUEST_URI'];
	$pagArray = explode("?", $urlRel);
	$getUrl = (string) $pagArray[sizeof($pagArray) - 1];

	if(!empty($_GET["pagina"])){
		$getUrlSub = substr($getUrl, -9, 9);
		$getUrl = explode($getUrlSub, $getUrl);
		$getUrl = $getUrl[0];
	}

?>