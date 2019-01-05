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
		<style>
			a{
				color: light_blue;
				text-decoration: none;
				font: 600 15px/32px Arial, Helvetica, sans-serif;
				font-family: 'Roboto', sans-serif;
			}
		</style>
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
						<div id="container-box" class="container span12"> 
							<div class="content-indent">
								<div style="text-align: center;" class="item-page">
									<h2 id="fotos">Fotografías</h2>
									<p><span style="color: #336699; font-family: %value; background-color: #ffffff;"><strong><span style="background-position: 0% 0%; background-image: none; background-attachment: scroll; background-repeat: repeat; background-size: auto; background-origin: padding-box; background-clip: border-box;"><span style="font-size: 26;">Título<br></span></span></strong></span>
									<span style="font-family: %value; font-size: 20;">Texto</span></p>
									<p><span style="font-family: %value; font-size: 20;">Línea</span></p>
									<div class="browseProductImageContainer" style="display: inline-block;background: #f6f6f6;    border: 1px solid #ededed;    height: auto;    padding: 20px 0;    text-align: center;    width: 900px;    border-radius: 12px;">
										<a href="" rel="" class="img-scr" style="display: inline-block;    height: auto;    width: auto;">
											<img src="/img/testBig.jpg" alt="fotografía" class="browseProductImage" border="0" title="Auténtica Gamba Blanca de la Costa" style="background: none;    height: auto;    width: 850px;">
										<br>Las instalaciones</a>
									</div>
									<p><span style="font-family: %value; font-size: 20;">Línea</span></p>
									<h2 id="videos">Videos</h2>
									<p><span style="color: #336699; font-family: %value; background-color: #ffffff;"><strong><span style="background-position: 0% 0%; background-image: none; background-attachment: scroll; background-repeat: repeat; background-size: auto; background-origin: padding-box; background-clip: border-box;"><span style="font-size: 26;">Título<br></span></span></strong></span>
									<span style="font-family: %value; font-size: 20;">Texto</span></p>
									<p><span style="font-family: %value; font-size: 20;">Línea</span></p>
									<div class="browseProductImageContainer" style="display: inline-block;background: #f6f6f6;    border: 1px solid #ededed;    height: auto;    padding: 20px 0;    text-align: center;    width: 900px;    border-radius: 12px;">
										<a href="" rel="" class="img-scr" style="display: inline-block;   height: 480px;    width: 854px;">
											<iframe class="browseProductImage" src="https://www.youtube.com/embed/f3IgwLT_mYc" frameborder="0" style="background: none; width:100%;height:100%;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
										<br>Las instalaciones</a>
									</div>
									<p><span style="font-family: %value; font-size: 20;">Línea</span></p>
								</div>
								
							</div>
						</div>
						<div class="clear"></div>
					</div>
					
				</div>
			</div>
			<div class="clear"></div>
			</div>
			<?php	echo file_get_contents("parts/footer.html");	?>
			<script>
				alternador();
				loaded = true;
			</script>
		</div>
	</body>
</html>