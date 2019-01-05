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
		<script src="/js/jquery-3.3.1.min.js" type="text/javascript"></script>
		<script>
			function boton_mostrarLogin(){
				document.getElementById("login_pop").style.display="block";
			}
			function boton_cerrarLogin(){
				document.getElementById("login_pop").style.display="none";
			}
			function OpenPedido(id){
				window.location.href = "/parts/factura.php?id="+id;
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
												$productosData = getProductosOrganized();
												$pedidoData = getPedidoData($_GET["id"]);
												$userDireccion = divideDireccion($pedidoData["direccion"]);
												switch($pedidoData["estado"]){
													case 1:
														$estadoDra = '<font style="color:#000">Pendiente de confirmación</font>';
													break;
													case 2:
														$estadoDra = '<font style="color:#000">Esperando el pago</font>';
													break;
													case 3:
														$estadoDra = '<font style="color:#0eff00">Enviado</font>';
													break;
													case 4:
														$estadoDra = '<font style="color:#00ff00">Finalizado</font>';
													break;
													case 5:
														$estadoDra = '<font style="color:#f00">Cancelado</font>';
													break;
												}
												if($pedidoData["seguimiento"] != ""){
													$segimientoDra = '<br><font style="color:#000">Número de seguimiento: </font>'.$pedidoData["seguimiento"];
												}else{
													$segimientoDra = "";
												}
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
						
						<div class="cart-view" style="width: 58%">
								<h3 style="margin-left: 25px;"><span><span>Información del pedido</span></span></h3>
								<div class="billing-box">
								<font style="font: normal 18px/24px Arial, Helvetica, sans-serif;">Estado: <?php echo $estadoDra.$segimientoDra;?></font>
								<?php
									if($pedidoData["estado"] != 1){
										echo '<br><form method="post" action="/parts/factura.php?id='.$pedidoData["ID"].'" target=_blank"><button style=" display: block;    background: url(/img/btn.gif) left top repeat-x;    border: none;    font: 400 18px/30px Arial, Helvetica, sans-serif;    font-family: '."'Roboto'".', sans-serif;    padding: 0 10 0 10px;    text-transform: none;    border-radius: 0px!important;    color: #fff;    text-align: center;    text-decoration: none;    letter-spacing: 0;    cursor: pointer;    box-shadow: 0 3px 4px rgba(0,0,0,0.4);">Ver factura</button></form>';
									}
								?>
								
									<div class="billto-shipto">
										<div class="width50 floatleft">
											<h1><span class="vmicon vm2-billto-icon"></span>Datos de facturación</h1>
											<div class="output-billto">
												<span class="titless">E-Mail: </span>
												<span class="values vm2-email"><?php echo $userData["email"]; ?></span>
												<br class="clear">
												<span class="titless">Nombre: </span>
												<span class="values vm2-first_name"><?php echo $userData["apellido"].", ".$userData["nombre"]; ?></span>
												<br class="clear">
												<span class="titless">Empresa: </span>
												<span class="values vm2-company"><?php echo $userData["empresa"]=="NAN"?"Particular":$userData["empresa"]; ?></span>
												<br class="clear">
												<span class="titless">Teléfono: </span>
												<span class="values vm2-phone_1"><?php echo $userData["telefono"]; ?></span>
												<br class="clear">
												<span class="titless">NIF: </span>
												<span class="values vm2-phone_2"><?php echo $userData["dni"]; ?></span>
												<br class="clear">
												<div class="clear"></div>
											</div>
										</div>
										<div class="width50 floatleft">
											<h1><span class="vmicon vm2-billto-icon"></span>Dirección de envio</h1>
											<div class="output-billto">
												<span class="titless">Pais: </span>
												<span class="values vm2-email"><?php echo $userDireccion["pais"]; ?></span>
												<br class="clear">
												<span class="titless">Provincia: </span>
												<span class="values vm2-first_name"><?php echo $userDireccion["provincia"]; ?></span>
												<br class="clear">
												<span class="titless">Localidad: </span>
												<span class="values vm2-company"><?php echo $userDireccion["localidad"]; ?></span>
												<br class="clear">
												<span class="titless">Código Postal: </span>
												<span class="values vm2-virtuemart_country_id"><?php echo $userDireccion["cp"]; ?></span>
												<br class="clear">
												<span class="titless">Dirección 1: </span>
												<span class="values vm2-phone_1"><?php echo $userDireccion["direccion1"]; ?></span>
												<br class="clear">
												<span class="titless">Dirección 2: </span>
												<span class="values vm2-phone_2"><?php echo $userDireccion["direccion2"]; ?></span>
												<br class="clear">
												<div class="clear"></div>
											</div>
											<!--<a class="details" href="/usuario.php#envio">Cambiar la dirección de envio</a>-->
										</div>
									</div>
								</div>
							</div>
							
							<div id="cesta" class="cart-view" style="width:58%;">
								<h3 style="margin-left: 25px;"><span><span>Elementos en el pedido <font id="cambios" color="#FF0000"></font></span></span></h3>
								<div class="billing-box">
								<fieldset>
									<table class="cart-summary" cellspacing="0" cellpadding="0" border="0" width="100%">
										<tbody>
											<tr>
												<th align="left">Nombre</th>
												<th align="left">Estado</th>
												<th align="center" width="60px">Precio:</th>
												<th align="right" width="120px">Cantidad</th>
												<th align="right" width="60px"><span class="priceColor2">Impuestos</span></th>
				                                <th align="right" width="60px"><span class="priceColor2">Descuento</span></th>
												<th align="right" width="70px">Total</th>
											</tr>
											<form action="" method="post" class="inline">
											<?php
												$pagadorium = false;
												$Tprecios = 0;
												$Tdescuentos = 0;
												$Timpuestos = 0;
												$kilosTotales = 0;
												$variables = getVariables();
													$productos = dividePedido($pedidoData["producto"]);
													foreach( $productos as $key => $value ) {
														$kilosTotales += $productos[$key]["cantidad"];
														$productoData = getProductosData($productos[$key]["id"]);
														if($productos[$key]["cocido"] == 2){
															$productos[$key]["precio"] += $variables["costeCocedura"];
														}
														if($productoData["existencias"] < $productos[$key]["cantidad"]){
															$pagadorium = true;
															$precio = "??";
															$impuestos = "??";
															$total = "??";
															$unidad = "??";
														}else{
															$precio = $productos[$key]["precio"]*$productos[$key]["cantidad"];
															$descuento = $productos[$key]["descuento"];
															$Tdescuentos = + $descuento;
															$impuestos = ($precio - $descuento)*($userData["empresa"]=="NAN"?0.114:0.1);
															$total = $precio+$impuestos-$descuento;
															$Tprecios += $total;
															$Timpuestos += $impuestos;
															$unidad = ($productos[$key]["precio"]=="??"?$productos[$key]["precio"]:number_format($productos[$key]["precio"],2));
														}
														echo '
															<tr valign="top" class="sectiontableentry1">
																<td align="center">
																	<span class="cart-images"><a href="producto.php?id='.$productos[$key]["id"].'"><img src="/img/productos/'.$productos[$key]["id"].'D.jpg" alt="'.$productoData["nombre"].'"></a></span>
																	<span class="cart-title"><a href="producto.php?id='.$productos[$key]["id"].'">'.$productoData["nombre"].'</a></span>					
																	<br><spam style="color: #ba1f3b;font: 15px/17px Arial,Helvetica,sans-serif;">'.($precio=="??"?"[PRECIO NO DEFINIDO]":"").'</spam>
																</td>
																<td align="center">
																	'.($productos[$key]["cocido"]==1?"Fesco":"Cocido&nbsp+1,50€").'
																</td>
																<td align="center"><div class="PricebasePriceVariant" style="display : block;"><span class="PricebasePriceVariant">'.$unidad.'&nbsp€</span></div></td>
																<td align="left">
																	'.$productos[$key]["cantidad"].' Kg
																</td>
																<td align="center"><span class="priceColor2"><div class="PricetaxAmount" style="display : block;"><span class="PricetaxAmount">'.($impuestos=="??"?$impuestos:number_format($impuestos,2)).' €</span></div></span></td>
																<td align="center">'.($descuento==0?"--":number_format(-$descuento,2)." €").'</td>
																<td align="center"><div class="PricesalesPrice" style="display : block;"><span class="PricesalesPrice">'.($total=="??"?$total:number_format($total,2)).'&nbsp€</span></div></td>
															</tr>
														';
													}
													if($kilosTotales >= 10){
														$envio = 0;
														$envioDra = "0.00";
													}else{
														if($pedidoData["envio"] == ""){
															$envioDra = "*".number_format($variables["costeEnvio"],2);
															$envio = $variables["costeEnvio"];
														}else{
															$envioDra = "*".number_format($pedidoData["envio"],2);
															$envio = $pedidoData["envio"];
														}
														
													}
											?>
											
											</form>
											<tr class="pad"><td></td></tr>
											<tr class="sectiontableentry1 bg-top">
												<td colspan="4" align="right">Totales:</td>
												<td align="center"><span class="priceColor2"><div class="PricetaxAmount" style="display : block;"><span class="PricetaxAmount"><?php echo number_format($Timpuestos,2); ?>&nbsp€</span></div></span></td>
												<td align="center"><?php echo ($Tdescuentos==0?"--":number_format(-$Tdescuentos,2)." €");?></td>
												<td align="center"><div class="PricesalesPrice" style="display : block;"><span class="PricesalesPrice"><?php echo number_format($Tprecios,2); ?>&nbsp€</span></div></td>
											</tr>
											<tr class="pad"><td></td></tr>
											<tr class="sectiontableentry1 bg-top">
												<td colspan="4" align="center">
													<span class="vmCartPaymentLogo"><img align="middle" src="http://www.lagambadehuelva.com/images/stories/virtuemart/shipment/logomrw.jpg" alt="logomrw"></span>
													<span class="vmshipment_description">Entrega en 24/48 horas. <a href="faq.php#envio">Excepciones</a></span><br>
												</td>
												<td align="center"><span class="priceColor2"></span></td>
												<td align="center">--</td>
												<td align="center"><div class="PricesalesPriceShipment" style="display : block;"><span class="PricesalesPriceShipment"><?php echo $envioDra; ?>&nbsp€</span></div></td>
											</tr>
											<tr class="pad"><td></td></tr>
											<tr class="sectiontableentry2 bg-top">
												<td colspan="4" align="right">Total: </td>
												<td align="right"> <span class="priceColor2"><div class="PricebillTaxAmount" style="display : block;"><span class="PricebillTaxAmount"><?php echo number_format($Timpuestos,2); ?>&nbsp€</span></div></span></td>
												<td align="center"> <span class="priceColor2"></span></td>
												<td align="center" class="color"><strong><div class="PricebillTotal" style="display : block;"><span class="PricebillTotal"><?php echo number_format($Tprecios+$envio,2); ?>&nbsp€</span></div></strong></td>
											</tr>
										</tbody>
									</table>
									<span class="comment"><?php echo ($pedidoData["envio"]==""?"*Costes de envio estimados.":"");?></span><br>
								</fieldset>
									<div class="customer-comment marginbottom15">
										<span class="comment">Notas y solicitudes especiales</span><br>
										<textarea class="customer-comment" name="comentario" cols="60" rows="1" readonly><?php echo $pedidoData["anotaciones"];?></textarea>
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