<?php
if(empty($_COOKIE["gambasUsario"])){
	header("Location: index.php");
}
if(!empty($_GET["usr"])){
	$link = conn();
	$ID = intercambiar($_COOKIE["gambasUsario"]);
	$result = $link->query("SELECT * FROM `usuarios` WHERE `ID`='".$ID."'");
	$row = $result->fetch_assoc();
	switch($_POST["mod"]){
		case 1: //cambiar dirección
			$nueva = unirDireccion(array('pais' => $_POST["pais"], 'provincia' => $_POST["provincia"], 'localidad' => $_POST["localidad"], 'cp' => $_POST["cp"], 'direccion1' => $_POST["direccion1"], 'direccion2' => $_POST["direccion2"]));
			$link->query("DELETE FROM `usuarios` WHERE `ID`='".$ID."';");
			$link->query("INSERT INTO `usuarios` (`ID`,`nombre`,`apellido`,`email`,`hash`,`empresa`,`direccion`,`cesta`,`telefono`,`dni`,`estado`) VALUES ('".$ID."','".$row["nombre"]."','".$row["apellido"]."','".$row["email"]."','".$row["hash"]."','".$row["empresa"]."','".$nueva."','".$row["cesta"]."','".$row["telefono"]."','".$row["dni"]."','".$row["estado"]."');");
		break;
		case 2: //cambiar datos personales
			$link->query("DELETE FROM `usuarios` WHERE `ID`='".$ID."';");
			$link->query("INSERT INTO `usuarios` (`ID`,`nombre`,`apellido`,`email`,`hash`,`empresa`,`direccion`,`cesta`,`telefono`,`dni`,`estado`) VALUES ('".$ID."','".$_POST["nombre"]."','".$_POST["apellido"]."','".$row["email"]."','".(empty($_POST["hash"]?$row["hash"]:md5($_POST["hash"])))."','".(empty($_POST["empresa"])?"NAN":$_POST["empresa"])."','".$row["direccion"]."','".$row["cesta"]."','".$_POST["telefono"]."','".$_POST["dni"]."','".$row["estado"]."');");
		break;
	}
	
	$link->close();
	header("Location: ".$_POST["destino"]);
	die();
}
?>