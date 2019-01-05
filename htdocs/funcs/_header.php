<?php
$header = file_get_contents("parts/header.html");
$nonlog = false;
if(!empty($_COOKIE["gambasUsario"])){
	$link = conn();
	$result = $link->query("SELECT * FROM `sesiones` WHERE `sesion`='".$_COOKIE["gambasUsario"]."'");
	if($result != null){
		$row = $result->fetch_assoc();
		$ID = $row["usuario"];
		$result = $link->query("SELECT * FROM `usuarios` WHERE `ID`='".$ID."'");
		if($result != null){
			$row = $result->fetch_assoc();
			$cesta = $row["cesta"];
			$nombre = $row["apellido"].", ".$row["nombre"];
		}else{
			$nonlog = true;
		}
	}else{
		$nonlog = true;
	}
	$link->close();
}else{
	$nonlog = true;
}
if($nonlog){
	$usuario = '<a href="javascript:;" onclick="boton_mostrarLogin();" id="openLogin">Iniciar sesión</a><br>
			 <a href="/registrar.php" id="openReg">Crear Cuenta</a>';
	$cesta = '<span class="crt-text"><a href="/cesta.php">Tienes 0 articulos</a></span>';
	
}else{
	if($cesta == ""){
		$cesta = '<span class="crt-text"><a href="/cesta.php">Tienes 0 articulos</a></span>';
	}else{
		$productos = explode('|',$cesta);
		$cesta = '<span class="crt-text"><a href="/cesta.php#cesta">Tienes '.sizeof($productos).' articulos</a></span>';
	}
	$usuario = '<a href="/usuario.php"  id="openLogin">'.$nombre.'</a><br>
			 <a href="?cerar=true" id="openReg">Cerrar sesión</a>';
	
}
if(!empty($_GET["acountErr"])){
	if($_GET["acountErr"] == 1){
		$header = str_replace("[ERROR1]","block",$header);
		$header = str_replace("[ERROR2]","none",$header);
	}else{
		if($_GET["acountErr"] == 2){
			$header = str_replace("[ERROR1]","none",$header);
			$header = str_replace("[ERROR2]","block",$header);
		}
	}
}else{
	$header = str_replace("[ERROR1]","none",$header);
	$header = str_replace("[ERROR2]","none",$header);
}
if(empty($_GET["noSesion"])){
	$header = str_replace("[NOSESION]","none",$header);
}else{
	$header = str_replace("[NOSESION]","block",$header);
}
if(empty($_GET["cestaBlock"])){
	$header = str_replace("[BLOQUEO]","none",$header);
}else{
	$header = str_replace("[BLOQUEO]","block",$header);
}
if(empty($_GET["falloSesion"])){
	$header = str_replace("[FALLOSEION]","none",$header);
}else{
	$header = str_replace("[FALLOSEION]","block",$header);
}
if(!empty($_GET["activate"])){
	$link = conn();
	$result = $link->query("SELECT * FROM `usuarios` WHERE `ID`='".$_GET["activate"]."'");
	$row = $result->fetch_assoc();
	$link->query("DELETE FROM `usuarios` WHERE `ID`='".$_GET["activate"]."';");
	$link->query("INSERT INTO `usuarios` (`ID`,`nombre`,`apellido`,`email`,`hash`,`empresa`,`direccion`,`cesta`,`telefono`,`dni`,`estado`) VALUES ('".$row["ID"]."','".$row["nombre"]."','".$row["apellido"]."','".$row["email"]."','".$row["hash"]."','".$row["empresa"]."','".$row["direccion"]."','".$row["cesta"]."','".$row["telefono"]."','".$row["dni"]."','2');");
	$link->close();
	$header = str_replace("[ACTIVATE]","block",$header);
}else{
	$header = str_replace("[ACTIVATE]","none",$header);
}
$header = str_replace("[CURRENTFILE]",$_SERVER['PHP_SELF'],$header);
$header = str_replace("[CESTA]",$cesta,$header);
$header = str_replace("[SESION]",$usuario,$header);
echo $header;
?>