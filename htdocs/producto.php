<?php
	include "funcs/_conn.php";
	include "funcs/_loggin.php";
	include "funcs/_cesta.php";
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
			var foto = "A";
			function boton_avanzar(){
				switch(foto){
					case "A": foto="B"; break;
					case "B": foto="C"; break;
					case "C": foto="A"; break;
				}
				document.getElementById("imageHolder").src="img/productos/"+document.getElementById("productoID").innerHTML+foto+".jpg";
			}
			function boton_retroceder(){
				switch(foto){
					case "A": foto="C"; break;
					case "B": foto="A"; break;
					case "C": foto="B"; break;
				}
				document.getElementById("imageHolder").src="img/productos/"+document.getElementById("productoID").innerHTML+foto+".jpg";
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
					<?php
						$data = getProductosData($_GET["id"]);
					?>
					<div class="content-indent" style="position:static;">
						<div class="productdetails-view" style="position:static;">
							<div class="wrapper2">
								<div class="fright">
									<h1 class="title" style="font: normal 28px/30px Arial, Helvetica, sans-serif;"><?php echo $data["nombre"] ?></h1>
									<div class="s_desc">
										<p> <?php echo $data["descripcion"] ?> </p>
									</div>
									<div class="s_desc">
										<div class="camera_prev" style="left:100px;top:320px;" onclick="boton_retroceder()"><span></span></div>
										<div id="productoID" style="display:none;"><?php echo $data["ID"] ?></div>
										<img id="imageHolder" style="display: block;margin:auto;width:70%;" src="img/productos/<?php echo $data["ID"] ?>A.jpg">
										<div class="camera_next" style="right:100px;top:320px;" onclick="boton_avanzar()"><span></span></div>
									</div>
									<div class="product-box2">
										<div class="spacer-buy-area">
											<div class="addtocart-area">
												<div class="addtocart-area">
													<form method="post" class="product js-recalculate" action="producto.php?ces=1">
														<input name="quantity" type="hidden" value="1">
														<div class="price">
														<?php
															$descuento = getDescuento($_GET["id"]);
															if($descuento != null){
																echo '<span style="color: #3bba1f;font: 24px/26px Arial,Helvetica,sans-serif;" class="PricetaxAmount">Descuento del '.$descuento["descuento"].'%</span>';
															}
														?>
															<div class="product-price" id="productPrice125" style="opacity: 1;">
																<strong>Precio:</strong>
																<div class="PricesalesPrice" style="display : block;">
																	Precio de venta:
																	<span class="PricesalesPrice"><?php
																		if($descuento != null){
																			echo '<span style="color: #ba1f3b;font: 24px/26px Arial,Helvetica,sans-serif; text-decoration:line-through" class="PricetaxAmount">'.($data["precio"]*1.1).'%</span> 
																				<span style="color: #3bba1f;font: 28px/30px Arial,Helvetica,sans-serif;" class="PricetaxAmount">'.($data["precio"]*(1-($descuento["descuento"]/100))*1.1).'%</span>';
																		}else{
																			echo $data["precio"]*1.1;
																		}
																	?> €</span>
																</div>
																<div class="PricepriceWithoutTax" style="display : block;">
																	Precio de venta sin impuestos:
																	<span class="PricepriceWithoutTax">
																	<?php
																		if($descuento != null){
																			echo '<span style="font: 22px/24px Arial,Helvetica,sans-serif;" class="PricetaxAmount">'.($data["precio"]*(1-($descuento["descuento"]/100))).'%</span>';
																		}else{
																			echo $data["precio"];
																		}
																	?> €</span>
																</div>
																<div class="PricediscountAmount" style="display : none;">
																	0
																</div>
																<div class="PricetaxAmount" style="display : block;">
																	Cantidad de impuestos:
																	<span class="PricetaxAmount"><?php
																		if($descuento != null){
																			echo '<span style="font: 18px/20px Arial,Helvetica,sans-serif;" class="PricetaxAmount">'.($data["precio"]*(1-($descuento["descuento"]/100))*0.1).'%</span>';
																		}else{
																			echo $data["precio"]*0.1;
																		}
																	?> €</span>
																</div>
																<div class="PricetaxAmount" style="display:block; padding-top:10px;">
																	<?php
																		if($data["existencias"] == 0){
																			echo'<span style="color: #ba1f3b;font: 15px/17px Arial,Helvetica,sans-serif;" class="PricetaxAmount">FUERA DE STOCK</span>';
																		}else{
																			echo'<span style="color: #3bba1f;font: 15px/17px Arial,Helvetica,sans-serif;" class="PricetaxAmount">EN STOCK</span>';
																		}
																	?>
																</div>
															</div>
														</div>
														<div class="product-fields">
															<div class="product-field product-field-type-V">
																<span class="product-fields-title"><b>Fresco o Cocido</b></span>
																<span class="product-field-display">
																	<select id="customPrice148" name="cocido">
																		<option value="1">Fresco</option>
																		<option value="2">Cocido +1,50 €</option>
																	</select>
																</span>
															</div>
														</div>
														<div class="addtocart-bar2">
															<div class="wrapper2">
																<div class="controls">					
																	<span class="quantity-box">
																		<span class="product-field-desc">Cantidad</span>
																		<input type="text" class="quantity-input js-recalculate" name="cantidad" value="1">Kg
																	</span>
                                                                </div>
															</div>
															<span class="addtocart-button">
																<input type="submit" name="addtocart" class="addtocart-button cart-click2" value="Añadir al carro" title="Añadir al carro">
															</span>
														</div>
														<div class="clear"></div>
														<input type="hidden" name="id"  value="<?php echo $data["ID"] ?>">
														<input type="hidden" name="destino" value="cesta.php">
														<input type="hidden" name="mod" value="1">
													</form>
												</div>
												<div class="clear"></div>
											</div>
											<div class="clear"></div>
										</div>
									</div>
									<div class="share1" style="visibility: visible;">
										<a href="https://twitter.com/intent/tweet?screen_name=TwitterDev&ref_src=twsrc%5Etfw" class="twitter-mention-button" data-show-count="false">[TEXTO]</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
										<a href="https://twitter.com/intent/tweet?screen_name=TwitterDev&ref_src=twsrc%5Etfw" class="twitter-mention-button" data-show-count="false">[TEXTO]</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
										<a href="https://twitter.com/intent/tweet?screen_name=TwitterDev&ref_src=twsrc%5Etfw" class="twitter-mention-button" data-show-count="false">[TEXTO]</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
										<a href="https://twitter.com/intent/tweet?screen_name=TwitterDev&ref_src=twsrc%5Etfw" class="twitter-mention-button" data-show-count="false">[TEXTO]</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
									</div>
								</div>
							</div> 
							<div class="clear"></div>
							<div class="product-neighbours">
								<div class="clear"></div>
							</div>
						</div>
					</div>
				</div>
			<?php	echo file_get_contents("parts/footer.html");	?>
		</div>
	</body>
</html>