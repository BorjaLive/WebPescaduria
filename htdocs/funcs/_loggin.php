<?php
if(!empty($_GET["mod"])){
	$link = conn();
	$result = $link->query("SELECT * FROM `usuarios` WHERE `email`='".$_POST["email"]."'");
	$row = $result->fetch_assoc();
	switch($row["estado"]){
		case 1:
			header("Location: ".$_SERVER['PHP_SELF']."?acountErr=1");
		break;
		case 2:
			if(md5($_POST["hash"]) == $row["hash"]){
				$sesion = "S".getTCode();
				$link->query("INSERT INTO `sesiones` (`sesion`,`usuario`) VALUES ('".$sesion."','".$row["ID"]."');");
				setcookie("gambasUsario",$sesion,$_POST["recordar"]==true?-1:0);
				$link->close();
				header("Location: ".$_SERVER['PHP_SELF']);
			}else{
				header("Location: ".$_SERVER['PHP_SELF']."?falloSesion=true");
			}
		break;
		case 3:
			header("Location: ".$_SERVER['PHP_SELF']."?acountErr=2");
		break;
	}
	die();
}else{
	if(!empty($_GET["cerar"])){
		unset($_COOKIE["gambasUsario"]);
		setcookie("gambasUsario", "", time() - 3600);
		header("Location: ".$_SERVER['PHP_SELF']);
		die();
	}
}
?>