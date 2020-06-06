<?php
if(!empty($_GET["ces"])){
	if(!empty($_COOKIE["gambasUsario"])){
		$link = conn();
		$ID = intercambiar($_COOKIE["gambasUsario"]);
		$result = $link->query("SELECT * FROM `usuarios` WHERE `ID`='".$ID."'");
		$row = $result->fetch_assoc();
		$actual = $row["cesta"];
		switch($_POST["mod"]){
			case 1: //agrear producto
				$nueva = $actual.($actual==""?"":"|").$_POST["id"]."x".$_POST["cantidad"]."x".$_POST["cocido"];
			break;
			case 2: //eliminar producto
				$actuales = explode("|",$actual);
				$nueva = "";
				for($i = 0; i < sizeof($actuales); $i++){
					$partes = explode("x",$actuales[$i]);
					if($partes[0] != $_POST["id"]){
						$nueva .= ($nueva==""?"":"|").$partes[0]."x"+$partes[1]."x"+$partes[2];
					}
				}
			break;
			case 3: //modificar cantidad
				$actuales = explode("|",$actual);
				$nueva = "";
				for($i = 0; $i < sizeof($actuales); $i++){
					$partes = explode("x",$actuales[$i]);
					if($partes[0] != $_POST["id"]){
						$nueva .= ($nueva==""?"":"|").$partes[0]."x".$partes[1]."x".$partes[2];
					}else{
						$nueva .= ($nueva==""?"":"|").$partes[0]."x".$_POST["cantidad"]."x".$partes[2];
					}
				}
			break;
			//Nota, una vez agregas un producto a la cesta, el precio puede seguir variando. Pero cuando haces la compra, el precio se determina al actual y queda invariable.
		}
		$link->query("DELETE FROM `usuarios` WHERE `ID`='".$ID."';");
		$link->query("INSERT INTO `usuarios` (`ID`,`nombre`,`apellido`,`email`,`hash`,`empresa`,`direccion`,`cesta`,`telefono`,`dni`,`estado`) VALUES ('".$ID."','".$row["nombre"]."','".$row["apellido"]."','".$row["email"]."','".$row["hash"]."','".$row["empresa"]."','".$row["direccion"]."','".$nueva."','".$row["telefono"]."','".$row["dni"]."','".$row["estado"]."');");
		$link->close();
		header("Location: ".$_POST["destino"]);
		die();
	}else{
		header("Location: registrar.php?error=true");
	}
}else{
	if(!empty($_GET["cesGETe"])){
		$link = conn();
		$ID = intercambiar($_COOKIE["gambasUsario"]);
		$result = $link->query("SELECT * FROM `usuarios` WHERE `ID`='".$ID."'");
		$row = $result->fetch_assoc();
		$actual = $row["cesta"];
		
		$n = 0;
		for($i = 0; $i < $_GET["n"]; $i++){
			if(!empty($_GET["cantidad".$i])){
				$actuales = explode("|",$actual);
				$nueva = "";
				for($j = 0; $j < sizeof($actuales); $j++){
					$partes = explode("x",$actuales[$j]);
					if($i != $j){
						$nueva .= ($nueva==""?"":"|").$partes[0]."x".$partes[1]."x".$partes[2];
					}else{
						$nueva .= ($nueva==""?"":"|").$partes[0]."x".$_GET["cantidad".$i]."x".$partes[2];
					}
				}
			}else{
				if(!empty($_GET["cocido".$i])){
					$actuales = explode("|",$actual);
					$nueva = "";
					for($j = 0; $j < sizeof($actuales); $j++){
						$partes = explode("x",$actuales[$j]);
						if($i != $j){
							$nueva .= ($nueva==""?"":"|").$partes[0]."x".$partes[1]."x".$partes[2];
						}else{
							$nueva .= ($nueva==""?"":"|").$partes[0]."x".$partes[1]."x".$_GET["cocido".$i];
						}
					}
				}
			}
		}
		
		$link->query("DELETE FROM `usuarios` WHERE `ID`='".$ID."';");
		$link->query("INSERT INTO `usuarios` (`ID`,`nombre`,`apellido`,`email`,`hash`,`empresa`,`direccion`,`cesta`,`telefono`,`dni`,`estado`) VALUES ('".$ID."','".$row["nombre"]."','".$row["apellido"]."','".$row["email"]."','".$row["hash"]."','".$row["empresa"]."','".$row["direccion"]."','".$nueva."','".$row["telefono"]."','".$row["dni"]."','".$row["estado"]."');");
		$link->close();
		header("Location: cesta.php#cesta");
		die();
	}else{
		if(!empty($_GET["cesGETd"])){
			$link = conn();
			$ID = intercambiar($_COOKIE["gambasUsario"]);
			$result = $link->query("SELECT * FROM `usuarios` WHERE `ID`='".$ID."'");
			$row = $result->fetch_assoc();
			$actual = $row["cesta"];
			$actuales = explode("|",$actual);
			$nueva = "";
			for($i = 0; $i < sizeof($actuales); $i++){
				if($i != $_GET["n"]){
					$nueva .= ($nueva==""?"":"|").$actuales[$i];
				}
			}
			echo $nueva;
			$link->query("DELETE FROM `usuarios` WHERE `ID`='".$ID."';");
			$link->query("INSERT INTO `usuarios` (`ID`,`nombre`,`apellido`,`email`,`hash`,`empresa`,`direccion`,`cesta`,`telefono`,`dni`,`estado`) VALUES ('".$ID."','".$row["nombre"]."','".$row["apellido"]."','".$row["email"]."','".$row["hash"]."','".$row["empresa"]."','".$row["direccion"]."','".$nueva."','".$row["telefono"]."','".$row["dni"]."','".$row["estado"]."');");
			$link->close();
			header("Location: cesta.php#cesta");
			die();
		}else{
			if(!empty($_GET["cesMake"])){
				$link = conn();
				$ID = intercambiar($_COOKIE["gambasUsario"]);
				$userData = getAllUserData($_COOKIE["gambasUsario"]);
				
				if($userData["estado"] != 3){
					$nueva = "";
					$actuales = explode("|",$userData["cesta"]);
					for($i = 0; $i < sizeof($actuales); $i++){
						$partes = explode("x",$actuales[$i]);// 0: ID; 1: cantidad; 2: cocido; 3: precio; 4: descuento
						$productoData = getProductosData($partes[0]);
						if($productoData["existencias"] < $partes[1]){
							$precio = 0;
							$descuento = 0;
						}else{
							$precio = $productoData["precio"];
							$descuentos = getDescuento($partes[0]);
							if($descuentos != null){
								if($descuentos["cantidad"] >= $partes[1]){
									$descuento = $precio * $partes[1] * (1-($descuentos["descuento"]/100));
								}else{
									$descuento = $precio*$descuentos["cantidad"] * (1-($descuentos["descuento"]/100));
								}
								userDescuento($partes[0],$partes[1]);
							}else{
								$descuento = 0;
							}
						}
						$nueva .= ($nueva==""?"":"|").$partes[0]."x".$partes[1]."x".$partes[2]."x".$precio."x".$descuento;
					}
					
					$idPedido = "V".getTCode();
					$link->query("INSERT INTO `pedidos` (`ID`,`usuario`,`producto`,`direccion`,`anotaciones`,`estado`,`seguimiento`) VALUES ('".$idPedido."','".$ID."','".$nueva."','".$userData["direccion"]."','".$_POST["comentario"]."','1','');");
					sleep(1);
					$link->query("DELETE FROM `usuarios` WHERE `ID`='".$ID."';");
					$link->query("INSERT INTO `usuarios` (`ID`,`nombre`,`apellido`,`email`,`hash`,`empresa`,`direccion`,`cesta`,`telefono`,`dni`,`estado`) VALUES ('".$ID."','".$userData["nombre"]."','".$userData["apellido"]."','".$userData["email"]."','".$userData["hash"]."','".$userData["empresa"]."','".$userData["direccion"]."','','".$userData["telefono"]."','".$userData["dni"]."','".$userData["estado"]."');");
					$link->close();
					$array_remplazo = array('ID' => $idPedido);
					sendMail($userData["email"],"","","pedidoRecibido",$array_remplazo,"Compra realizada en [NOMBRE DE EMPRESA]","");
					header("Location: usuario.php");
					die();
				}else{
					$link->query("DELETE FROM `usuarios` WHERE `ID`='".$ID."';");
					$link->query("INSERT INTO `usuarios` (`ID`,`nombre`,`apellido`,`email`,`hash`,`empresa`,`direccion`,`cesta`,`telefono`,`dni`,`estado`) VALUES ('".$ID."','".$userData["nombre"]."','".$userData["apellido"]."','".$userData["email"]."','".$userData["hash"]."','".$userData["empresa"]."','".$userData["direccion"]."','','".$userData["telefono"]."','".$userData["dni"]."','".$userData["estado"]."');");
					$link->close();
					header("Location: usuario.php");
					die();
				}
			}
		}
	}
}
?>