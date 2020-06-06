<?php
	include "funcs/_conn.php";
	include "funcs/_bloqueo.php";
	include "funcs/_loggin.php";
	include "funcs/_cesta.php";
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
			function change(){
				for(var i = 0; i < cantidades.length; i++){
					if(document.getElementById("cantidad"+i).value != cantidades[i]){
						window.location.href = "cesta.php?cesGETe=true&cantidad"+i+"="+document.getElementById("cantidad"+i).value+"&n="+cantidades.length;
						return;
					}
					if(document.getElementById("cocido"+i).value != cocidos[i]){
						window.location.href = "cesta.php?cesGETe=true&cocido"+i+"="+document.getElementById("cocido"+i).value+"&n="+cantidades.length;
						return;
					}
				}
			}
			function eliminate(n){
				window.location.href = "cesta.php?cesGETd=true&n="+n;
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
						<div id="left" class="span3">
							<div class="wrapper2">
								<div class="extra-indent">
									<div class="module login">
										<div class="category-view" style="overflow: hidden;    position: relative;    margin-bottom: 10px;">
											<h1 style="margin-bottom: 20px;">Categorías</h1>
											<?php
												$categorias = getAllCategorias();
												$userData = getAllUserData($_COOKIE["gambasUsario"]);
												$userDireccion = divideDireccion($userData["direccion"]);
												for($key = 0; $key < sizeof($categorias); $key++) {
													echo '
														<div class="row" style="padding-top:10px;">
															<div class="category floatleft vertical-separator">
																<div class="spacer">
																	<h2>
																		<a href="tienda.php?categoria='.$categorias["nombre"][$key].'" title="'.$categorias["nombre"][$key].'">
																			<div class="category-border"><img src="img/productos/'.$categorias["id"][$key].'D.jpg" alt="'.$categorias["nombre"][$key].'"></div>
																			<div class="category-title" style="    background: url(img/categodies_marker.png) right center no-repeat; font: normal 18px/24px Arial, Helvetica, sans-serif;">'.$categorias["nombre"][$key].'</div>
																		</a>
																	</h2>
																</div>
															</div>
															<div class="clear"></div>
														</div>';
												}
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>


					<div id="container-box" class="container span9">
						<div class="content-indent">
							<div class="cart-view">
								<h3 style="margin-left: 25px;"><span><span>Información de Compra y Envío</span></span></h3>
								<div class="billing-box">
									<div class="billto-shipto">
										<div class="width50 floatleft">
											<h1><span class="vmicon vm2-billto-icon"></span>Información de facturación</h1>
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
											<a class="details" href="usuario.php#datos">Cambiar información de facturación</a>
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
											<a class="details" href="usuario.php#envio">Cambiar la dirección de envio</a>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
							<div id="cesta" class="cart-view" style="margin-bottom:0;">
								<h3 style="margin-left: 25px;"><span><span>Elementos en la cesta <font id="cambios" color="#FF0000"></font></span></span></h3>
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
												if($userData["cesta"] != ""){
													$productos = dividePedido($userData["cesta"]);
													foreach( $productos as $key => $value ) {
														$kilosTotales += $productos[$key]["cantidad"];
														$productoData = getProductosData($productos[$key]["id"]);
														if($productos[$key]["cocido"] == 2){
															$productoData["precio"] += $variables["costeCocedura"];
														}
														if($productoData["existencias"] < $productos[$key]["cantidad"]){
															$pagadorium = true;
															$precio = "??";
															$impuestos = "??";
															$total = "??";
															$unidad = "??";
														}else{
															$precio = $productoData["precio"]*$productos[$key]["cantidad"];
															$descuento = getDescuento($productos[$key]["id"]);
															if($descuento == null){
																$descuento = 0;
															}else{
																if($descuento["cantidad"] >= $productos[$key]["cantidad"]){
																	$descuento = $precio * (1-($descuento["descuento"]/100));
																}else{
																	$descuento = $productoData["precio"]*$descuento["cantidad"] * (1-($descuento["descuento"]/100));
																}
																$Tdescuentos += $descuento;
															}
															$impuestos = ($precio - $descuento)*($userData["empresa"]=="NAN"?0.114:0.1);
															$total = $precio+$impuestos-$descuento;
															$Tprecios += $total;
															$Timpuestos += $impuestos;
															$unidad = ($productoData["precio"]=="??"?$productoData["precio"]:number_format($productoData["precio"],2));
														}
														echo '
															<tr valign="top" class="sectiontableentry1">
																<td align="center">
																	<span class="cart-images"><a href="producto.php?id='.$productos[$key]["id"].'"><img src="img/productos/'.$productos[$key]["id"].'D.jpg" alt="'.$productoData["nombre"].'"></a></span>
																	<span class="cart-title"><a href="producto.php?id='.$productos[$key]["id"].'">'.$productoData["nombre"].'</a></span>
																	<br><spam style="color: #ba1f3b;font: 15px/17px Arial,Helvetica,sans-serif;">'.($precio=="??"?"[SIN EXISTENCIAS]":"").'</spam>
																</td>
																<td align="center">
																	<select onchange="change();" id="cocido'.$key.'" name="cocido'.$key.'">
																		<option value="1">Fresco</option>
																		<option value="2">Cocido +1,50 €</option>
																	</select>
																</td>
																<td align="center"><div class="PricebasePriceVariant" style="display : block;"><span class="PricebasePriceVariant">'.$unidad.' €</span></div></td>
																<td align="left">
																	<input type="text" id="cantidad'.$key.'"  onchange="change();" title="Actualizar cantidad en el carro" class="quantity-input js-recalculate" size="3" maxlength="4" name="cantidad'.$key.'" value="'.$productos[$key]["cantidad"].'">Kg
																	<input type="submit" class="vmicon vm2-add_quantity_cart" name="update" title="Actualizar cantidad en el carro" align="middle" value=" ">
																	<a class="vmicon vm2-remove_from_cart" title="Borrar producto del carro" align="middle" onclick="eliminate('.$key.')"></a>
																</td>
																<td align="center"><span class="priceColor2"><div class="PricetaxAmount" style="display : block;"><span class="PricetaxAmount">'.($impuestos=="??"?$impuestos:number_format($impuestos,2)).' €</span></div></span></td>
																<td align="center">'.($descuento==0?"--":number_format(-$descuento,2)." €").'</td>
																<td align="center"><div class="PricesalesPrice" style="display : block;"><span class="PricesalesPrice">'.($total=="??"?$total:number_format($total,2)).' €</span></div></td>
															</tr>
														';
													}
													if($kilosTotales >= 10){
														$envio = 0;
													}else{
														$envio = $variables["costeEnvio"];
													}
												}else{
													$envio = 0;
												}
											?>

											</form>
											<tr class="pad"><td></td></tr>
											<tr class="sectiontableentry1 bg-top">
												<td colspan="4" align="right">Totales:</td>
												<td align="center"><span class="priceColor2"><div class="PricetaxAmount" style="display : block;"><span class="PricetaxAmount"><?php echo number_format($Timpuestos,2); ?> €</span></div></span></td>
												<td align="center"><?php echo ($Tdescuentos==0?"--":number_format(-$Tdescuentos,2)." €");?></td>
												<td align="center"><div class="PricesalesPrice" style="display : block;"><span class="PricesalesPrice"><?php echo number_format($Tprecios,2); ?> €</span></div></td>
											</tr>
											<tr class="pad"><td></td></tr>
											<tr class="sectiontableentry1 bg-top">
												<td colspan="4" align="center">
													<span class="vmCartPaymentLogo"><img align="middle" src="img/logomrw.jpg" alt="logomrw"></span>
													<span class="vmshipment_description">Entrega en 24/48 horas. <a href="faq.php#envio">Excepciones</a></span><br>
												</td>
												<td align="center"><span class="priceColor2"></span></td>
												<td align="center">--</td>
												<td align="center"><div class="PricesalesPriceShipment" style="display : block;"><span class="PricesalesPriceShipment">*<?php echo number_format($userData["cesta"]==""?$variables["costeEnvio"]:$envio,2); ?> €</span></div></td>
											</tr>
											<tr class="pad"><td></td></tr>
											<tr class="sectiontableentry2 bg-top">
												<td colspan="4" align="right">Total: </td>
												<td align="right"> <span class="priceColor2"><div class="PricebillTaxAmount" style="display : block;"><span class="PricebillTaxAmount"><?php echo number_format($Timpuestos,2); ?> €</span></div></span></td>
												<td align="center"> <span class="priceColor2"></span></td>
												<td align="center" class="color"><strong><div class="PricebillTotal" style="display : block;"><span class="PricebillTotal"><?php echo number_format($Tprecios+$envio,2); ?> €</span></div></strong></td>
											</tr>
										</tbody>
									</table>
									<span class="comment">*Costes de envio estimados. A partir de 10Kg, el porte es gratuito.</span><br>
								</fieldset>
								<form method="post" id="checkoutForm" name="checkoutForm" action="cesta.php?cesMake=true">
									<div class="customer-comment marginbottom15">
										<span class="comment">Notas y solicitudes especiales</span><br>
										<textarea class="customer-comment" name="comentario" cols="60" rows="1" placeholder="<?php echo $pagadorium?"Es aconsejable que detalles el precio máximo que estas dispuesto a pagar por los artículos que no se encuentran disponibles.":"¿Tienes alguna necesidad especial?"; ?>"></textarea>
									</div>
									<div class="checkout-button-top" style="visibility: visible; display: block;">
										<input type="submit" value="Comprar" style="margin-left: 150px; display: block;    background: url(/img/btn.gif) left top repeat-x;    border: none;    font: 400 18px/30px Arial, Helvetica, sans-serif;    font-family: 'Roboto', sans-serif;    padding: 0 10 0 10px;    text-transform: none;    border-radius: 0px!important;    color: #fff;    text-align: center;    text-decoration: none;    letter-spacing: 0;    cursor: pointer;    box-shadow: 0 3px 4px rgba(0,0,0,0.4);" title="DR_VIRTUEMART_SELECT_OPTION" class="addtocart-button hasTooltip">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
			<?php	echo file_get_contents("parts/footer.html");	?>
			<script>
			var cantidades = [
			<?php
				$primera = true;
				foreach( $productos as $key => $value ) {
					echo ($primera?"":",").'"'.$productos[$key]["cantidad"].'"';
					$primera = false;
				}
			?>
			];
			var cocidos = [
			<?php
				$primera = true;
				foreach( $productos as $key => $value ) {
					echo ($primera?"":",").'"'.$productos[$key]["cocido"].'"';
					$primera = false;
				}
			?>
			];
			for(var i = 0; i < cocidos.length; i++){
				document.getElementById("cocido"+i).selectedIndex = cocidos[i]-1;
			}
			</script>
		</div>
	</body>
</html>
