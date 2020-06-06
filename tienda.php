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
					<div id="container-box" class="container span9">
						<div class="content-indent">
							<div class="Front_VM2">
								<div class="category_description">
									<p>Bienvenidos a nuestra Tienda Online.</p>
									<p>Aquí podrás encontrar un catálogo completo con los mejores productos de la costa onubense.</p>
									<p>Disponemos de una clasificación por familias, para que sea más sencillo encontrar lo que estés buscando. </p>
									<p>Recalcamos que lo que ves, es lo que obtienes; con la calidad de los mariscos proveniente de la costa de huelva.</p>
									<p>Disfrute su compra.</p>
									<p>&nbsp;</p>
								</div>

								<div class="topten-view">
									<h1>Todos los productos</h1>
									<div class="browse-view front" style="border: medium none;margin-left: -30px;margin-bottom: 10px;width: auto;    margin: 0px 0 30px 0;">
										<div class="row boxIndent">
											<?php
												$productos = getProductosPlus();
												foreach( $productos as $key => $value ) {
													if(empty($_GET["categoria"]) or $productos[$key]["categoria"] == $_GET["categoria"]){
														echo '
															<div class="product floatleft vertical-separator" style="width:33%">
																<div class="spacer" style="    background: none;    border: none;    border-radius: 0 0 0 0;    margin: 0px 0 0 30px;    overflow: inherit;    padding: 0px;    position: relative;">
																	<div class="floatleft col-1" style="float: none;    height: auto;    margin-right: 0;    padding-top: 0;    width: 100%;">
																		<div class="browseProductImageContainer" style="background: #f6f6f6;    border: 1px solid #ededed;    height: auto;    padding: 20px 0;    text-align: center;    width: 99%;    border-radius: 12px;">
																			<a href="producto.php?id='.$productos[$key]["ID"].'" rel="img/productos/'.$productos[$key]["ID"].'D.jpg" class="img-scr" style="display: inline-block;    height: auto;    width: auto;">
																				<img src="img/productos/'.$productos[$key]["ID"].'D.jpg" alt="catalogo_gamba6" class="browseProductImage" border="0" title="'.$productos[$key]["nombre"].'" style="background: none;    height: 220px;    width: 220px;">
																			</a>
																		</div>
																	</div>
																	<div class="floatleft col-3" style="padding-top: 0;    padding-bottom: 0;">
																		<div class="title-indent" style="    padding: 0;    padding-top: 20px;    margin: 0;    border: none;">
																			<h2><a href="producto.php?id=[ID]">'.$productos[$key]["nombre"].'</a></h2>
																			<p style="color: #aeadad;    font: normal 12px/19px Arial, Helvetica, sans-serif;    font-family: "Roboto", sans-serif;    padding: 13px 0 20px 0;    margin-bottom: 0;">'.$productos[$key]["descripcion"].'</p>
																		</div>
																	</div>
																	<div class="floatright col-2" style="    float: none;    height: auto;    margin-right: 0;">
																		<div class="product-price marginbottom12" id="productPrice125" style="margin-bottom: 10px;    overflow: hidden;    width: 100%;">
																			<div class="PricesalesPrice" style="display : block; float: left;    color: #333;    font: 400 18px/30px Arial, Helvetica, sans-serif;    padding-right: 5px;    font-family: "Roboto", sans-serif;">
																				<span class="PricesalesPrice" style="    float: left;    color: #333;    font: 400 18px/30px Arial, Helvetica, sans-serif;    padding-right: 5px;    font-family: "Roboto", sans-serif;">'.$productos[$key]["precio"].' €</span>
																			</div>
																		</div>
																		<div class="addtocart-area" style="width: 100%;    margin: 0;    padding-top: 0px;">
																			<form method="post" class="product" action="tienda.php?ces=1" id="addtocartproduct'.$productos[$key]["ID"].'">
																				<input name="cantidad" type="hidden" value="1">
																				<div class="addtocart-bar2">
																					<div class="addtocart_button" style="display: block;">
																						<i></i>
																						<input type="submit" value="Añadir al carro" style="    display: block;    background: url(img/btn.gif) left top repeat-x;    border: none;    width: 104px;    height: 35px;    font: 400 13px/32px Arial, Helvetica, sans-serif;    font-family: '."'Roboto'".', sans-serif;    padding: 0 0 0 0px;    text-transform: none;    border-radius: 0px!important;    color: #fff;    text-align: center;    text-decoration: none;    letter-spacing: 0;    cursor: pointer;    box-shadow: 0 3px 4px rgba(0,0,0,0.4);" title="DR_VIRTUEMART_SELECT_OPTION" class="addtocart-button hasTooltip">
																						<span>&nbsp;</span>
																					</div>
																				</div>
																				<input type="hidden" name="mod" value="1">
																				<input type="hidden" name="id" value="'.$productos[$key]["ID"].'">
																				<input type="hidden" name="destino" value="cesta.php">
																			</form>
																		</div>
																	</div>
																</div>
															</div>
														';
													}
												}
											?>
											<div class="clear"></div>
										</div>
									</div>
								</div>
									
								<div class="featured-view">
									<h1>Productos destacados</h1>
									<div class="browse-view front">
										<div class="row boxIndent">
											<div class="clear"></div>
										</div>
										<div class="horizontal-separator"></div>
										<div class="row boxIndent">
											<?php
												$vars = getVariables();
												$catalogo = getProductosOrganized();
												for($i = 1; $i <= 3; $i++){
													$id = $vars["escaparate".$i];
													echo '
														<div class="product floatleft vertical-separator" style="width:33%">
															<div class="spacer" style="    background: none;    border: none;    border-radius: 0 0 0 0;    margin: 0px 0 0 30px;    overflow: inherit;    padding: 0px;    position: relative;">
																<div class="floatleft col-1" style="float: none;    height: auto;    margin-right: 0;    padding-top: 0;    width: 100%;">
																	<div class="browseProductImageContainer" style="background: #f6f6f6;    border: 1px solid #ededed;    height: auto;    padding: 20px 0;    text-align: center;    width: 99%;    border-radius: 12px;">
																		<a href="producto.php?id='.$id.'" rel="img/productos/'.$id.'D.jpg" class="img-scr" style="display: inline-block;    height: auto;    width: auto;">
																			<img src="img/productos/'.$id.'D.jpg" alt="catalogo_gamba6" class="browseProductImage" border="0" title="'.$catalogo[$id]["nombre"].'" style="background: none;    height: 220px;    width: 220px;">
																		</a>
																	</div>
																</div>
																<div class="floatleft col-3" style="padding-top: 0;    padding-bottom: 0;">
																	<div class="title-indent" style="    padding: 0;    padding-top: 20px;    margin: 0;    border: none;">
																		<h2><a href="producto.php?id=[ID]">'.$catalogo[$id]["nombre"].'</a></h2>
																		<p style="color: #aeadad;    font: normal 12px/19px Arial, Helvetica, sans-serif;    font-family: "Roboto", sans-serif;    padding: 13px 0 20px 0;    margin-bottom: 0;">'.$catalogo[$id]["descripcion"].'</p>
																	</div>
																</div>
																<div class="floatright col-2" style="    float: none;    height: auto;    margin-right: 0;">
																	<div class="product-price marginbottom12" id="productPrice125" style="margin-bottom: 10px;    overflow: hidden;    width: 100%;">
																		<div class="PricesalesPrice" style="display : block; float: left;    color: #333;    font: 400 18px/30px Arial, Helvetica, sans-serif;    padding-right: 5px;    font-family: "Roboto", sans-serif;">
																			<span class="PricesalesPrice" style="    float: left;    color: #333;    font: 400 18px/30px Arial, Helvetica, sans-serif;    padding-right: 5px;    font-family: "Roboto", sans-serif;">'.$catalogo[$id]["precio"].' €</span>
																		</div>
																	</div>
																	<div class="addtocart-area" style="width: 100%;    margin: 0;    padding-top: 0px;">
																		<form method="post" class="product" action="tienda.php?ces=1" id="addtocartproduct'.$id.'">
																			<input name="cantidad" type="hidden" value="1">
																			<div class="addtocart-bar2">
																				<div class="addtocart_button" style="display: block;">
																					<i></i>
																					<input type="submit" value="Añadir al carro" style="display: block;    background: url(img/btn.gif) left top repeat-x;    border: none;    width: 104px;    height: 35px;    font: 400 13px/32px Arial, Helvetica, sans-serif;    font-family: '."'Roboto'".', sans-serif;    padding: 0 0 0 0px;    text-transform: none;    border-radius: 0px!important;    color: #fff;    text-align: center;    text-decoration: none;    letter-spacing: 0;    cursor: pointer;    box-shadow: 0 3px 4px rgba(0,0,0,0.4);" title="DR_VIRTUEMART_SELECT_OPTION" class="addtocart-button hasTooltip">
																					<span>&nbsp;</span>
																				</div>
																			</div>
																			<input type="hidden" name="cocido" value="1">
																			<input type="hidden" name="mod" value="1">
																			<input type="hidden" name="id" value="'.$id.'">
																			<input type="hidden" name="destino" value="cesta.php">
																		</form>
																	</div>
																</div>
															</div>
														</div>
													';
												}
											?>
											<div class="clear"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="clear"></div>
			<?php	echo file_get_contents("parts/footer.html");	?>
			<script>
				alternador();
				loaded = true;
			</script>
		</div>
	</body>
</html>