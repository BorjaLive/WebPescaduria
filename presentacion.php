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
						<div id="container-box" class="container span12">
							<div class="content-indent">
								<div class="item-page">
									<h2>Presentación</h2>
									<p><span style="color: #336699; font-family: %value; background-color: #ffffff;"><strong><span style="background-position: 0% 0%; background-image: none; background-attachment: scroll; background-repeat: repeat; background-size: auto; background-origin: padding-box; background-clip: border-box;"><span style="font-size: 22;">La costa onubense<br></span></span></strong></span>
									<span style="font-family: %value; font-size: 15;">Nuestra Costa es conocida y valorada en España y resto del mundo por la alta calidad de sus mariscos, sobre todo por la, merecidamente glorificada, Gamba de Huelva.</span></p>
									<p><span style="font-family: %value; font-size: 15;">La gran popularidad de la costa de Huelva viene dada por su preferente posición. El enclave en el golfo de Cádiz bañado por el atlántico resulta ideal para la captura de mariscos sin iguales. Es por esto que el producto Onubense es un bien apreciado en toda España y a nivel mundial.</span></p>
									<p><span style="font-family: %value; font-size: 15;">Todos nuestros proveedores cumplen con los parones biológicos que se realizan cada año para mantener a flote las reproducciones.</span></p>
									<p><span style="color: #336699; font-family: %value; background-color: #ffffff;"><strong><span style="background-position: 0% 0%; background-image: none; background-attachment: scroll; background-repeat: repeat; background-size: auto; background-origin: padding-box; background-clip: border-box;"><span style="font-size: 22;">La empresa<br></span></span></strong></span>
									<span style="font-family: %value; font-size: 15;">En [NOMBRE DE EMPRESA] comerciamos exclusivamente con los mariscos capturados en la costa de Huelva. Años de experiencia a nuestras espaldas son la clave para poder traer la mejor relación calidad precio.</span></p>
									<p><span style="font-family: %value; font-size: 15;">Muchos han intentado estafar con productos sucédanos provenientes de zonas como Italia o Marruecos, pero ninguno ha igualado el sabor y aspecto de la autentica Gamba de Huelva.</span></p>
									<p><span style="font-family: %value; font-size: 15;">Desde el proceso de selección de la mercancia, hasta el empaquetado previo al envio, se realizan pensando en las necesidades del cliente. Innumerables clientes satisfechos respaldan nuestra profesionalidad.</span></p>
									<h2 id="gamba">La Gamba</h2>
									<p><span style="color: #336699; font-family: %value; background-color: #ffffff;"><strong><span style="background-position: 0% 0%; background-image: none; background-attachment: scroll; background-repeat: repeat; background-size: auto; background-origin: padding-box; background-clip: border-box;"><span style="font-size: 22;">La gamba de Huelva<br></span></span></strong></span>
									<span style="font-family: %value; font-size: 15;">Es una gamba blanca, con un abdomen largo y bien desarrollado, con un tamaño superior a la cabeza. Vive en fondos de arena a una profundidad media entre 90 y 250 metros, aunque puede encontrarse hasta los 700 m. Su carne es muy apreciada, suele consumirse cocida o a la plancha con sal.</span></p>
									<p><span style="font-family: %value; font-size: 15;">Hay una gran variedad de gambas y de muchas calidades pero la de más alta calidad y valor gastronómico es la nuestra, la que se captura en la Costa de Huelva, de ahí su carácter gourmet del que goza.</span></p>
									<p><span style="font-family: %value; font-size: 15;">La Gamba de la Costa de Huelva se subasta a diario en las lonjas de las diferentes localidades de Huelva, como Ayamonte, Isla Cristina, Punta Umbría y Huelva capital.</span></p>
									<p><span style="font-family: %value; font-size: 15;">El precio de la Gamba de Huelva oscila según temporada, tamaño y volumen de captura.</span></p>
									<p><span style="font-family: %value; font-size: 15;">La principal diferencia de nuestra gamba con el resto de otras zonas es, sin lugar a dudas, su fino y gustoso sabor.</span></p>
									<p><span style="color: #336699; font-family: %value; background-color: #ffffff;"><strong><span style="background-position: 0% 0%; background-image: none; background-attachment: scroll; background-repeat: repeat; background-size: auto; background-origin: padding-box; background-clip: border-box;"><span style="font-size: 22;">Metodo de extracción<br></span></span></strong></span>
									<span style="font-family: %value; font-size: 15;">La Gamba de Huelva se pesca de forma tradicional, con barcos de arrastre de la zona. Pescan a diario por lo que su nivel de frescura es máximo. En el barco se clasifican por tamaño ya que según el mismo tiene diferente valor en la subasta.</span></p>
									<p><span style="font-family: %value; font-size: 15;">El buen hacer de nuestros marineros en la captura hacen posible que lleguen a puerto con la mejor presentación y viveza para su posterior subasta en Lonja.</span></p>
									<p><span style="color: #336699; font-family: %value; background-color: #ffffff;"><strong><span style="background-position: 0% 0%; background-image: none; background-attachment: scroll; background-repeat: repeat; background-size: auto; background-origin: padding-box; background-clip: border-box;"><span style="font-size: 22;">Elaboración y distribución<br></span></span></strong></span>
									<span style="font-family: %value; font-size: 15;">Los mariscos de la Costa de Huelva viene fresca de la mar.</span></p>
									<p><span style="font-family: %value; font-size: 15;">Al llegar a puerto se realiza una subasta informatizada y se puja por cada caja. En Mariscos PuertoHuelva compramos las de mayor viveza y calidad y seguidamente son transportadas a nuestra nave comercial, donde son nuevamente clasificadas en envases de poliexpan o madera. En este proceso realizamos un nuevo control de calidad para conseguir el nivel máximo de compromiso con el cliente.</span></p>
									<p><span style="font-family: %value; font-size: 15;">Las elaboramos generalmente en envases de 1 kilo, aunque siempre estamos a disposición del cliente para envasarlas con el peso que desee.</span></p>
									<p><span style="font-family: %value; font-size: 15;">En [NOMBRE DE LA EMPRESA] la distribuimos tanto frescas (5 dias de caducidad) como ya cocidas.</span></p>
									<p><span style="color: #336699; font-family: %value; background-color: #ffffff;"><strong><span style="background-position: 0% 0%; background-image: none; background-attachment: scroll; background-repeat: repeat; background-size: auto; background-origin: padding-box; background-clip: border-box;"><span style="font-size: 22;">Cualidades nutricionales<br></span></span></strong></span>
									<span style="font-family: %value; font-size: 15;">La Gamba Blanca es una fuente nutricional de primera categoría ya que es un alimento cargado de proteínas, sin grasas y con pocas calorías que la hacen fácil de digerir.</span></p>
									<span style="font-family: %value; font-size: 15;">Contenido proteico: 20,5 %</span>
									<p><span style="font-family: %value; font-size: 15;">Contenido en grasa: 1,3 %</span></p>
									<p><span style="color: #336699; font-family: %value; background-color: #ffffff;"><strong><span style="background-position: 0% 0%; background-image: none; background-attachment: scroll; background-repeat: repeat; background-size: auto; background-origin: padding-box; background-clip: border-box;"><span style="font-size: 22;">Metodos de perparación<br></span></span></strong></span>
									<span style="font-family: %value; font-size: 15;">Tiempo preparación: 5 min.</span></p>
									<p><span style="font-family: %value; font-size: 15;">La cantidad recomendada para 4 persona es 1Kg. Adicionalmetne necesitaras agua, hielo y sal.</span>
									<span style="font-family: %value; font-size: 15;">Preparación:</span></p>
									<span style="font-family: %value; font-size: 15;"><strong>ESTILO TRADICIONAL:</strong>Para que queden rectas, antes de cocerlas se introducen derechas en una canastilla rígida, bien apiladas y se dejan dos o tres gambas sueltas. Se hace una salmuera de agua y sal. Una parte se pone a hervir y la otra se pone en un recipiente con hielo. Cuando el agua está hirviendo, se echan las gambas y cuando empiecen a subir a flote las que están sueltas, se sacan todas y se introducen en el agua salada con hielo.</span>
									<p><span style="font-family: %value; font-size: 15;"><strong>ESTILO CASERO:</strong>Se lleva a ebullición una olla con abundante agua salada. Cuando arranca a hervir se incorporan las gambas, y se dejan un máximo de 45 segundos, se apartan del fuego poniéndose a enfriar inmediatamente en agua con hielo.</span></p>
									<p><span style="color: #336699; font-family: %value; background-color: #ffffff;"><strong><span style="background-position: 0% 0%; background-image: none; background-attachment: scroll; background-repeat: repeat; background-size: auto; background-origin: padding-box; background-clip: border-box;"><span style="font-size: 22;">Consejos y trucos<br></span></span></strong></span>
									<span style="font-family: %value; font-size: 15;">- Las gamba blanca generalmente es cocida. Se pueden hacer y te la pueden servir a la plancha.</span>
									<p><span style="font-family: %value; font-size: 15;">- Acompáñalas de una buena Cruzcampo (sabores de la tierra) o un buen vino afrutado del Condado de huelva</span>
									<p><span style="font-family: %value; font-size: 15;">- Si la gamba es buena, no te limpies las manos con servilletas, solo ponlas debajo del chorro de agua del grifo y no te olerán las manos. Como segunda opción, las toallitas de limón son un buen recurso.</span>



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
		</div>
	</body>
</html>
