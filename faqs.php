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
						<div id="container-box" class="container span12"> 
							<div class="content-indent">
								<div class="item-page">
									<h2>Preguntas frecuentes</h2>
									<p><span style="color: #336699; font-family: %value; background-color: #ffffff;"><strong><span style="background-position: 0% 0%; background-image: none; background-attachment: scroll; background-repeat: repeat; background-size: auto; background-origin: padding-box; background-clip: border-box;"><span style="font-size: 22;">¿A DONDE ENVIAMOS?<br></span></span></strong></span>
									<p><span style="font-family: %value; font-size: 18;">Se harán envíos a la península, Baleares, Canarias y Portugal; para otra parte del mundo consultar por teléfono.</span></p>
									<p><span style="color: #336699; font-family: %value; background-color: #ffffff;"><strong><span style="background-position: 0% 0%; background-image: none; background-attachment: scroll; background-repeat: repeat; background-size: auto; background-origin: padding-box; background-clip: border-box;"><span style="font-size: 22;">¿DONDE COMPRAMOS EL MARISCO?<br></span></span></strong></span>
									<p><span style="font-family: %value; font-size: 18;">Compramos el marisco diariamente en las principales lonjas de Huelva que es donde tienen lugar las subastas del marisco fresco de nuestra Costa. Disponemos de justificantes de compras de la Junta de Andalucía para confirmar el origen de los mismos.</span></p>
									<p><span style="color: #336699; font-family: %value; background-color: #ffffff;"><strong><span style="background-position: 0% 0%; background-image: none; background-attachment: scroll; background-repeat: repeat; background-size: auto; background-origin: padding-box; background-clip: border-box;"><span style="font-size: 22;">¿CÓMO PREPARAMOS Y ENVIAMOS LOS PEDIDOS?<br></span></span></strong></span>
									<p><span style="font-family: %value; font-size: 18;">Una vez que recibamos el pedido y la confirmación del pago preparamos tu pedido según nos lo haya solicitado y será enviado por la empresa MRW hasta tu casa. El proceso de empaquetado se realiza cuidadosamente y se cierra adecuadamente en cajas de poliespán protegidos para que no sufran ningún daño durante el transporte.</span></p>
									<p><span style="font-family: %value; font-size: 18;">Cuando tu pedido sea enviado, recibirás un correo electrónico confirmándote en envío y recibirás además las instrucciones necesarias para hacer el seguimiento de tu envío y conocer su estado en todo momento.</span></p>
									<p><span style="color: #336699; font-family: %value; background-color: #ffffff;"><strong><span style="background-position: 0% 0%; background-image: none; background-attachment: scroll; background-repeat: repeat; background-size: auto; background-origin: padding-box; background-clip: border-box;"><span style="font-size: 22;">¿CUÁNTO TARDARÉ EN RECIBIR MI PEDIDO?<br></span></span></strong></span>
									<p><span style="font-family: %value; font-size: 18;">El pedido lo recibirán según cuadro adjunto. Si tiene necesidades específicas, contacten con nosotros para concretar la entrega.</span></p>
									<p><span style="font-family: %value; font-size: 18;">Puesto que el pago del pedido se realiza por transferencia bancaria, éste no llegará a su destino hasta que dicha transferencia quede reflejada en cuenta. Esta demora suele ser de 24/48 horas.</span></p>
									<p><span style="color: #336699; font-family: %value; background-color: #ffffff;"><strong><span style="background-position: 0% 0%; background-image: none; background-attachment: scroll; background-repeat: repeat; background-size: auto; background-origin: padding-box; background-clip: border-box;"><span style="font-size: 22;">¿CUÁNTO TIEMPO PUEDO TENER EL MARISCO FRESCO EN REFRIGERACIÓN?<br></span></span></strong></span>
									<p><span style="font-family: %value; font-size: 18;">En el caso que quiera mantener el marisco fresco en su frigorífico le recomendamos no tenerlo más de tres días, así no perderá sus propiedades.</span></p>
									<p><span style="color: #336699; font-family: %value; background-color: #ffffff;"><strong><span style="background-position: 0% 0%; background-image: none; background-attachment: scroll; background-repeat: repeat; background-size: auto; background-origin: padding-box; background-clip: border-box;"><span style="font-size: 22;">¿CÓMO PUEDO HACER EL PEDIDO?<br></span></span></strong></span>
									<p><span style="font-family: %value; font-size: 18;">El pedido lo puede hacer por tres métodos: por la página web, por correo electrónico o por teléfono. Aconsejamos el primer método, por su velocidad y simpleza.</span></p>
									<p><span style="color: #336699; font-family: %value; background-color: #ffffff;"><strong><span style="background-position: 0% 0%; background-image: none; background-attachment: scroll; background-repeat: repeat; background-size: auto; background-origin: padding-box; background-clip: border-box;"><span style="font-size: 22;">¿CUÁNTO ME COSTARÁ EL ENVÍO?<br></span></span></strong></span>
									<p><span style="font-family: %value; font-size: 18;">El Coste del envío para la península suele rondar los 15€ independientemente del peso de la compra realizada. Si tu compra es superior a 10Kg el porte será GRATUITO.</span></p>
									<p><span style="font-family: %value; font-size: 18;">La tarifa del transporte tiene IVA incluido.</span></p>
									<p><span style="color: #336699; font-family: %value; background-color: #ffffff;"><strong><span style="background-position: 0% 0%; background-image: none; background-attachment: scroll; background-repeat: repeat; background-size: auto; background-origin: padding-box; background-clip: border-box;"><span style="font-size: 22;">¿QUÉ PASA SI NO ESTOY EN CASA CUANDO LLEGUE MI PEDIDO?<br></span></span></strong></span>
									<p><span style="font-family: %value; font-size: 18;">Si no estás en casa cuando llegue tu pedido, el transportista te dejará un aviso indicándote las instrucciones para recibir tu pedido.</span></p>
									<p><span style="color: #336699; font-family: %value; background-color: #ffffff;"><strong><span style="background-position: 0% 0%; background-image: none; background-attachment: scroll; background-repeat: repeat; background-size: auto; background-origin: padding-box; background-clip: border-box;"><span style="font-size: 22;">¿QUÉ PASA SI EL PEDIDO ES UN REGALO PARA OTRA PERSONA?<br></span></span></strong></span>
									<p><span style="font-family: %value; font-size: 18;">Tal circunstancia lo tendrías que reflejar en el pedido, y la persona a la que hagas el regalo no recibirá en ningún momento la factura con el importe. Junto con el paquete, se adjuntará únicamente un albarán con el contenido del pedido y la factura se envía siempre a tu dirección de correo.</span></p>
									<p><span style="color: #336699; font-family: %value; background-color: #ffffff;"><strong><span style="background-position: 0% 0%; background-image: none; background-attachment: scroll; background-repeat: repeat; background-size: auto; background-origin: padding-box; background-clip: border-box;"><span style="font-size: 22;">¿QUÉ PASA SI ALGO LLEGA DETERIORADO O NO ES LO QUE PEDÍ?<br></span></span></strong></span>
									<p><span style="font-family: %value; font-size: 18;">En caso de que por error te enviemos algo equivocado, indícanoslo y te haremos llegar la mercancía que falte y recogeremos o te regalaremos la mercancía equivocada.</span></p>
									<p><span style="font-family: %value; font-size: 18;">Cuando recibas tu pedido, si ves que la caja tiene golpes o está deteriorada, ábrela delante del repartidor para comprobar que los productos no han sido dañados. Si fuera así, indícaselo al transportista y envíanos un correo electrónico con una foto para que podamos enviarte el producto de nuevo de forma gratuita.</span></p>
									<h2 id="contacto">Contacto</h2>
									<p><span style="color: #336699; font-family: %value; background-color: #ffffff;"><strong><span style="background-position: 0% 0%; background-image: none; background-attachment: scroll; background-repeat: repeat; background-size: auto; background-origin: padding-box; background-clip: border-box;"><span style="font-size: 22;">Teléfono<br></span></span></strong></span>
									<p><span style="font-family: %value; font-size: 18;">Teléfono movil: </span></p>
									<p><span style="font-family: %value; font-size: 18;">Teléfono fijo: </span></p>
									<p><span style="color: #336699; font-family: %value; background-color: #ffffff;"><strong><span style="background-position: 0% 0%; background-image: none; background-attachment: scroll; background-repeat: repeat; background-size: auto; background-origin: padding-box; background-clip: border-box;"><span style="font-size: 22;">Correo electrónico<br></span></span></strong></span>
									<p><span style="font-family: %value; font-size: 18;">Dirección email: </span></p>
									<h2 id="pagos">Pagos</h2>
									<p><span style="color: #336699; font-family: %value; background-color: #ffffff;"><strong><span style="background-position: 0% 0%; background-image: none; background-attachment: scroll; background-repeat: repeat; background-size: auto; background-origin: padding-box; background-clip: border-box;"><span style="font-size: 22;">Transferencia bancaria<br></span></span></strong></span>
									<p><span style="font-family: %value; font-size: 18;">Una vez tu pedido haya sido aceptado, se te pedira que realices la transferencia usando los siguientes datos</span></p>
									<p><span style="font-family: %value; font-size: 18;">IBAN: </span></p>
									<p><span style="font-family: %value; font-size: 18;">otras cosas que puedan ser necesarias</span></p>
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