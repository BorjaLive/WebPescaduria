<?php
	include "funcs/_conn.php";
	include "funcs/_bloqueo.php";
	include "funcs/_loggin.php";
	include "funcs/_usuario.php";
	if(empty($_COOKIE["gambasUsario"])){
		header("Location: index.php?noSesion=true");
		die();
	}
?>
<html>
	<head>
		<title>[Nombre de Empresa]</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="css/style.css" type="text/css" />
		<link rel="stylesheet" href="css/styleshell.css" type="text/css" />
		<script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
		<script>
			function boton_mostrarLogin(){
				document.getElementById("login_pop").style.display="block";
			}
			function boton_cerrarLogin(){
				document.getElementById("login_pop").style.display="none";
			}
		</script>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
	</head>
	<body style="position: relative; min-height: 100%; top: 0px; font-size: 14px;font-family: Arial, Helvetica, sans-serif;">
		<div class="body-top">
			<?php
				include "funcs/_header.php";
			?>
			<div class="clear"></div>
			<div class="content" style="padding: 30px 0 50px 0;    z-index: 1;    position: relative;    background: none;">
				<div class="main">

					<div class="wrapper2">
						<div id="left" style="width: 450px;" class="span3">
							<div class="wrapper2">
								<div class="extra-indent">
									<div class="module login">
										<div class="category-view" style="overflow: hidden;    position: relative;    margin-bottom: 10px;">
											<h1 style="margin-bottom: 20px;">Pedidos</h1>
											<?php
												if(empty($_GET["page"])){
													$page = 1;
												}else{
													$page = $_GET["page"];
												}
												$pedidos = getSomePedidos($page,$_COOKIE["gambasUsario"]);
												$userData = getAllUserData($_COOKIE["gambasUsario"]);
												$direccion = divideDireccion($userData["direccion"]);
												$productosData = getProductosOrganized();
												if($pedidos != "ninguno"){
													foreach( $pedidos as $key => $value ) {
														$pedido = explode("|",$pedidos[$key]["producto"]);
														$cositas = "<hr>";
														for($i = 0; $i < sizeof($pedido); $i++){
															if($i == 4){
																$cositas .= "...";
															}else{
																$cositas .= $productosData[explode("x",$pedido[$i])[0]]["nombre"]."<hr>";
															}
														}
														switch(sizeof($pedidos)){
															case 1: $pudding = "90"; break;
															case 2: $pudding = "70"; break;
															case 3: $pudding = "55"; break;
															case 4: $pudding = "50"; break;
															default: $pudding = "45"; break;
														}
														echo '
															<div class="row" style="padding-top:10px;">
																<div class="category floatleft vertical-separator">
																	<div class="spacer">
																		<h2>
																			<a href="pedido.php?id='.$pedidos[$key]["ID"].'" title="Pedido '.$pedidos[$key]["ID"].'">
																				<div class="category-border">
																					<img  src="img/productos/'.explode("x",$pedido[0])[0].'D.jpg" style="width: 220px;height: 220px;" alt="'.$pedidos[$key]["ID"].'">
																					<div style="float: right;padding-top: '.$pudding.'px;">
																						<font style="font: normal 18px/24px Arial, Helvetica, sans-serif; color: #191919; text-transform: none;">'.$cositas.'</font>
																					</div>
																				</div>
																				<div class="category-title" style="    background: url(img/categodies_marker.png) right center no-repeat; font: normal 18px/24px Arial, Helvetica, sans-serif;">'.getFecha($pedidos[$key]["ID"]).'</div>
																			</a>
																		</h2>
																	</div>
																</div>
																<div class="clear"></div>
															</div>';
													}
												}else{
													echo 'No has realizado pedidos.';
												}
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="wrapper2">
						<div id="container-box" class="container span12" style="width:50%;">
						<h3 id="error" style="color:red;display:<?php echo $userData["estado"]==3?"block":"none";?>;">Tu cuenta ha sido cancelada. No puedes realizar comopras.</h3>
							<div class="content-indent">
								<div class="item-page">
									<h2 id="envio">Dirección de envio</h2>
									<form method="post" action="usuario.php?usr=1">
										<p><span style="font-family: %value; font-size: medium;">Pais: </span><input name="pais" value="<?php echo $direccion["pais"]; ?>"></p>
										<p><span style="font-family: %value; font-size: medium;">Provincia: </span><input name="provincia" value="<?php echo $direccion["provincia"]; ?>"></p>
										<p><span style="font-family: %value; font-size: medium;">Localidad: </span><input name="localidad" value="<?php echo $direccion["localidad"]; ?>"></p>
										<p><span style="font-family: %value; font-size: medium;">Código Postal: </span><input name="cp" value="<?php echo $direccion["cp"]; ?>"></p>
										<p><span style="font-family: %value; font-size: medium;">Dirección 1 (Calle): </span><input name="direccion1" value="<?php echo $direccion["direccion1"]; ?>"></p>
										<p><span style="font-family: %value; font-size: medium;">Dirección 2 (Número, piso, puerta): </span><input name="direccion2" value="<?php echo $direccion["direccion2"]; ?>"></p>
										<input type="hidden" name="mod" value="1">
										<input type="hidden" name="destino" value="usuario.php">
										<input type="submit" value="Modificar" style="display: block;    background: url(/img/btn.gif) left top repeat-x;    border: none;    font: 400 18px/30px Arial, Helvetica, sans-serif;    font-family: 'Roboto', sans-serif;    padding: 0 10 0 10px;    text-transform: none;    border-radius: 0px!important;    color: #fff;    text-align: center;    text-decoration: none;    letter-spacing: 0;    cursor: pointer;    box-shadow: 0 3px 4px rgba(0,0,0,0.4);" title="DR_VIRTUEMART_SELECT_OPTION" class="addtocart-button hasTooltip">
									</form>
									<h2 id="datos">Datos personales</h2>
									<form method="post" action="usuario.php?usr=1">
										<p><span style="font-family: %value; font-size: medium;">Nombre: </span><input name="nombre" value="<?php echo $userData["nombre"]; ?>"></p>
										<p><span style="font-family: %value; font-size: medium;">Apellidos: </span><input name="apellido" value="<?php echo $userData["apellido"]; ?>"></p>
										<p><span style="font-family: %value; font-size: medium;">Contraseña (blanco para no cambiar): </span><input name="hash" value=""></p>
										<p><span style="font-family: %value; font-size: medium;">Empresa (blanco para particular): </span><input name="empresa" value="<?php echo $userData["empresa"]=="NAN"?"":$userData["empresa"]; ?>"></p>
										<p><span style="font-family: %value; font-size: medium;">Teléfono: </span><input name="telefono" value="<?php echo $userData["telefono"]; ?>"></p>
										<p><span style="font-family: %value; font-size: medium;">DNI: </span><input name="dni" value="<?php echo $userData["dni"]; ?>"></p>
										<input type="hidden" name="mod" value="2">
										<input type="hidden" name="destino" value="usuario.php">
										<input type="submit" value="Modificar" style="display: block;    background: url(/img/btn.gif) left top repeat-x;    border: none;    font: 400 18px/30px Arial, Helvetica, sans-serif;    font-family: 'Roboto', sans-serif;    padding: 0 10 0 10px;    text-transform: none;    border-radius: 0px!important;    color: #fff;    text-align: center;    text-decoration: none;    letter-spacing: 0;    cursor: pointer;    box-shadow: 0 3px 4px rgba(0,0,0,0.4);" title="DR_VIRTUEMART_SELECT_OPTION" class="addtocart-button hasTooltip">
									</form>
								</div>

							</div>
						</div>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="clear"></div>
			<?php	echo file_get_contents("parts/footer.html");	?>
		</div>
	</body>
</html>
