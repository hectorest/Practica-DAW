<?php
$serverCorrecto = false;
function comprobarServer(&$urlPag){
	if(empty($_SERVER["HTTP_REFERER"])){
			$GLOBALS["serverCorrecto"] = false;
			$host = $_SERVER['HTTP_HOST']; 
			$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');  
			$extra = "$urlPag";
			header("Location: http://$host$uri/$extra?er=310");
			exit;
		}
		else{
			$url = parse_url($_SERVER["HTTP_REFERER"]);
			if($url["host"] != $_SERVER["SERVER_NAME"]){
				$GLOBALS["serverCorrecto"] = false;
				$host = $_SERVER['HTTP_HOST']; 
				$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');  
				$extra = "$urlPag";
				header("Location: http://$host$uri/$extra?er=310");
				exit;
			}
			else{
				$GLOBALS["serverCorrecto"] = true;
			}
		}
}
?>