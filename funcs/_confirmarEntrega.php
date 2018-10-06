<?php
	include "_conn.php";
	$link = conn();
	$result = $link->query("SELECT * FROM `pedidos` WHERE `ID`='".$_GET["id"]."'");
	$row = $result->fetch_assoc();
	$link->query("DELETE FROM `pedidos` WHERE `ID`='".$_GET["id"]."';");
	$link->query("INSERT INTO `pedidos` (`ID`,`usuario`,`producto`,`direccion`,`anotaciones`,`estado`,`seguimiento`) VALUES ('".$_GET["id"]."','".$row["usuario"]."','".$row["producto"]."','".$row["direccion"]."','".$row["anotaciones"]."','4','".$row["seguimiento"]."');");
	$link->close();
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
<title>Gracias</title>
</head>
<body>
</body>
<html>