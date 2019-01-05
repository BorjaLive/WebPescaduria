<?php
	if(getVariables()["cesta"] == 2){
		header("Location: /index.php?cestaBlock=true");
		die();
	}
?>