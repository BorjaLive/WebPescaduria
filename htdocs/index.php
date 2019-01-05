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

			var loaded = false;
			var carrusel = 0;
			var activada = true;
			function alternador(repetir){
				if(!activada){
					return;
				}
				switch (carrusel){
					case 0:
						document.getElementById("carrusel1").style.display="block";
						document.getElementById("carrusel2").style.display="none";
						document.getElementById("carrusel3").style.display="none";
						document.getElementById("carruselEnlace1").style.display="block";
						document.getElementById("carruselEnlace2").style.display="none";
						document.getElementById("carruselEnlace3").style.display="none";
						document.getElementById("carrusel1").style.opacity=1;
						document.getElementById("carrusel2").style.opacity=0;
						document.getElementById("carrusel3").style.opacity=0;
						carrusel = 1;
					break;
					case 1:
						document.getElementById("carrusel1").style.display="block";
						document.getElementById("carrusel2").style.display="block";
						document.getElementById("carrusel3").style.display="none";
						document.getElementById("carruselEnlace1").style.display="none";
						document.getElementById("carruselEnlace2").style.display="block";
						document.getElementById("carruselEnlace3").style.display="none";
						document.getElementById("carrusel2").style.opacity=0;
						alternador_fusion("carrusel1","carrusel2",0);
						carrusel = 2;
					break;
					case 2:
						document.getElementById("carrusel1").style.display="none";
						document.getElementById("carrusel2").style.display="block";
						document.getElementById("carrusel3").style.display="block";
						document.getElementById("carruselEnlace1").style.display="none";
						document.getElementById("carruselEnlace2").style.display="none";
						document.getElementById("carruselEnlace3").style.display="block";
						document.getElementById("carrusel3").style.opacity=0;
						alternador_fusion("carrusel2","carrusel3",0);
						carrusel = 3;
					break;
					case 3:
						document.getElementById("carrusel1").style.display="block";
						document.getElementById("carrusel2").style.display="none";
						document.getElementById("carrusel3").style.display="block";
						document.getElementById("carruselEnlace1").style.display="block";
						document.getElementById("carruselEnlace2").style.display="none";
						document.getElementById("carruselEnlace3").style.display="none";
						document.getElementById("carrusel1").style.opacity=0;
						alternador_fusion("carrusel3","carrusel1",0);
						carrusel = 1;
					break;
				}
				if(activada && repetir){
					setTimeout(function(){
						alternador(true);
					}, 4000);
				}
			}
			
			$(window).on("blur focus", function(e){
				var prevType = $(this).data("prevType");
				if(prevType != e.type){
					switch(e.type){
						case "blur":
							activada = false;
							break;
						case "focus":
							activada = true;
							if(loaded){
								carrusel = 0;
								alternador(true);
							}
							
							break;
					}
					$(this).data("prevType", e.type);
				}
			});
			function alternador_fusion(entrada, salida, nivel){
					document.getElementById(entrada).style.opacity=1-nivel;
					document.getElementById(salida).style.opacity=nivel;
					if(nivel < 1){
						if(activada){
							setTimeout(function(){
								alternador_fusion(entrada, salida, nivel+0.01);
							}, 10);
						}
					}
			}
			
			
		</script>
		
		<!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Droid+Sans" type="text/css" />
		<link rel="stylesheet" href="http://www.lagambadehuelva.com/modules/mod_yj_pop_login/css/stylesheet.css" type="text/css" />
		<link rel="stylesheet" href="http://www.lagambadehuelva.com/modules/mod_vm_ajax_search/css/mod_vm_ajax_search.css" type="text/css" />
		<link rel="stylesheet" href="http://www.lagambadehuelva.com/modules/mod_superfish_menu/css/superfish.css" type="text/css" />-->
	</head>
	<body style="position: relative; min-height: 100%; top: 0px;">
		<div class="body-top">
			<?php
				include "funcs/_header.php";
			?>
			<div class="clear"></div>
			<div class="content" style="padding: 30px 0 50px 0;    z-index: 1;    position: relative;    background: none;">
				<div class="main">
					<div class="box-shadow">
						<div class="moduletable_slider">
						
							<!-- Carrusel START -->
							<div class="slideshowck_slider camera_wrap camera_amber_skin" id="camera_wrap_130" style="width: 1170px; display: block; height: 370px;">
								<div class="camera_fakehover">
									<div class="camera_target">
										<div class="cameraCont">
											<div id="carrusel1" class="cameraSlide cameraSlide_0 cameracurrent" style="visibility: visible; z-index: 999; display: block;"><!--Cambiame para las imagenes-->
												<img src="/img/slide1.jpg" class="imgLoaded" style="visibility: visible; height: 371px; margin-left: 0px; margin-right: 0px; margin-top: -0.5px; position: absolute; width: 1170px;" data-alignment="" data-portrait="" width="1170" height="371">
												<div class="camerarelative" style="width: 1170px; height: 370px;"></div>
											</div>
											<div id="carrusel2" class="cameraSlide cameraSlide_1 cameranext" style="display: none; visibility: visible; z-index: 999; ">
												<img src="/img/slide2.jpg" class="imgLoaded" style="visibility: visible; height: 371px; margin-left: 0px; margin-right: 0px; margin-top: -0.5px; position: absolute; width: 1170px;" data-alignment="" data-portrait="" width="1170" height="371">
												<div class="camerarelative" style="width: 1170px; height: 370px;"></div>
											</div>
											<div id="carrusel3" class="cameraSlide cameraSlide_2" style="display: none; visibility: visible; z-index: 999;">
												<img src="/img/slide3.jpg" class="imgLoaded" style="visibility: visible; height: 371px; margin-left: 0px; margin-right: 0px; margin-top: -0.5px; position: absolute; width: 1170px;">
												<div class="camerarelative" style="width: 1170px; height: 370px;"></div>
											</div>
										</div>
									</div>
									<div class="camera_overlayer"></div>
									<div class="camera_target_content">
										<div class="cameraContents">
											<div class="cameraContent" id="carruselEnlace1" style="display: block;"><!--Nueva tienda digital-->
												<a class="camera_link" href="/tienda.php" target="_parent"></a>
											</div>
											<div class="cameraContent" id="carruselEnlace2" style="display: none;"><!--La gamba-->
												<a class="camera_link" href="/presentacion.php#gamba" target="_parent"></a>
											</div>
											<div class="cameraContent" id="carruselEnlace3" style="display: none;"><!--Reportaje fotográfico-->
												<a class="camera_link" href="/reportaje.php#fotos" target="_parent"></a>
											</div>
										</div>
									</div>
									<div class="camera_bar" style="display: none; top: auto; height: 7px;">
										<span class="camera_bar_cont" style="opacity: 0.8; position: absolute; left: 0px; right: 0px; top: 0px; bottom: 0px; background-color: rgb(34, 34, 34);">
											<span id="pie_camera_wrap_130" style="opacity: 0; position: absolute; background-color: rgb(238, 238, 238); left: 0px; right: 0px; top: 2px; bottom: 2px; display: none;"></span>
										</span>
									</div>
									<div class="camera_commands">
										<div class="camera_play" style="display: none;"></div>
										<div class="camera_stop" style="display: block;"></div>
									</div>
								</div>
								<div class="camera_loader" style="display: none;"></div>
							</div>
							<div style="clear:both;"></div>
							<!-- Carrusel END -->
							
						</div>
						<div class="moduletable banner2">
							<div class="banner_block" id="banner_box">
								<ul>		
									<li class="items1" style="width:390px; height:166px;">
										<a href="http://localhost/presentacion.php#gamba" target="_self" title="Presentación">
											<img class="banner_img" src="/img/banner1.jpg">
											<span>
												<div class="title">Gamba</div>
												<div class="desc">La autenta e inigualable gamba de Huelva.</div>
												<div class="btn">Más Info!</div>
											</span>
										</a>
									</li>
									<li class="items2" style="width:391px; height:166px;">
										<a href="http://localhost/presentacion.php#calidad" target="_self" title="Trazabilidad">
											<img class="banner_img" src="/img/banner2.jpg">
											<span><div class="title">Calidad</div>
											<div class="desc">Producto de calidad, autenticidad onubense.</div>
											<div class="btn">Más Info!</div></span>
										</a>
									</li>
									<li class="items3" style="width:389px; height:166px;">
										<a href="http://localhost/faqs.php#contacto" target="_self" title="Contacto">
											<img class="banner_img" src="/img/banner3.jpg">
											<span><div class="title">Más<span>info</span></div>
											<div class="desc">¿Necesitas ayuda? Contacto por correo o llamada telefónica.</div>
											<div class="btn">Más Info!</div></span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="wrapper2">
						<div id="container-box" class="container span12"> 
							<div class="error err-space">
								<div id="system-message-container"></div>
							</div> 
						 	<div class="module new">
								<h3><span><span>Productos Destacados</span></span></h3>
								<div class="boxIndent">
									<div class="wrapper2">
										<div class="vmgroup new">
											<ul id="vmproduct" class="vmproduct new">
												<li class="item">
													<?php
														$vars = getVariables();
														$catalogo = getProductosOrganized();
														for($i = 1; $i <= 4; $i++){
															$id = $vars["escaparate".$i];
															echo'
																<div class="product-box spacer ">
																	<div class="browseImage">
																		<div class="new"></div>
																		<a href="/producto.php?id='.$id.'" class="img2">
																			<img src="/img/productos/'.$id.'D.jpg" alt="'.$catalogo[$id]["nombre"].'" class="browseProductImage featuredProductImage" border="0">
																		</a>
																	</div>
																	<div class="fleft">
																		<div class="Title">
																			<span class="count">01.</span>
																			<a href="/producto.php?id='.$id.'" title="'.$catalogo[$id]["nombre"].'">'.$catalogo[$id]["nombre"].'</a>
																		</div>
																		<div class="description">
																			<p>'.$catalogo[$id]["descripcion"].'</p>
																		</div>
																		<div class="clear"></div>
																		<div class="Price">
																			<span class="sales">'.$catalogo[$id]["precio"].'€</span>
																		</div>
																		<div class="fright">
																			<div class="addtocart-area" style="padding: 8px 0 6px 0;    float: none;    height: 35px;    width: 105px;    margin: 0 auto;">
																				<form method="post" class="product" action="index.php?ces=1" id="addtocartproduct'.$i.'">
																					<input name="cantidad" type="hidden" value="1">
																					<div class="addtocart-bar2">
																						<div class="addtocart_button" style="display: block;">
																							<i></i>
																							<input type="submit" value="Añadir al carro" style="display: block;    background: url(/img/btn.gif) left top repeat-x;    border: none;    font: 400 18px/30px Arial, Helvetica, sans-serif;    font-family: '."'Roboto'".', sans-serif;    padding: 0 10 0 10px;    text-transform: none;    border-radius: 0px!important;    color: #fff;    text-align: center;    text-decoration: none;    letter-spacing: 0;    cursor: pointer;    box-shadow: 0 3px 4px rgba(0,0,0,0.4);" title="DR_VIRTUEMART_SELECT_OPTION" class="addtocart-button hasTooltip">
																							<span>&nbsp;</span>
																						</div>
																					</div>
																					<input type="hidden" name="mod" value="1">
																					<input type="hidden" name="cocido" value="1">
																					<input type="hidden" name="id" value="'.$id.'">
																					<input type="hidden" name="destino" value="cesta.php">
																				</form>
																			</div>
																		</div>
																		<div class="clear"></div>
																	</div>
																</div>
															';
														}
													?>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="clear"></div>
					</div>
				
				</div>
				<div class="clear"></div>
			</div>
			<?php	echo file_get_contents("parts/footer.html");	?>
			<script>
				alternador(true);
				loaded = true;
			</script>
		</div>
	</body>
</html>