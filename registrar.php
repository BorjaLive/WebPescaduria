<?php
	include "funcs/_conn.php";
	include "funcs/_loggin.php";
	include "funcs/_cesta.php";
	include "funcs/_registro.php";
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
		
	</head>
	<body style="position: relative; min-height: 100%; top: 0px;">
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
										<h3><span><span>Iniciar sesión</span></span></h3>
										<div class="boxIndent">
											<div class="wrapper2">
												<form action="/index.php?mod=true" method="post" id="login-form">
													<p id="form-login-username">
														<label for="modlgn-username">Usuario</label>
														<input id="modlgn-username" style="height: 35px;" type="text" name="email" class="inputbox" size="18" value="" onblur="" onfocus="">
													</p>
													<p id="form-login-password">
														<label for="modlgn-passwd">Contraseña</label>
														<input id="modlgn-passwd" style="height: 35px;" type="password" name="hash" class="inputbox" size="18" value="" onblur="" onfocus="">
													</p>
													<div class="wrapper2">
														<input type="submit" name="Submit" class="button" value="Iniciar sesión">
														<p id="form-login-remember">
															<input id="modlgn-remember" type="checkbox" name="recordar" class="inputbox" value="yes">
															<label for="modlgn-remember">Recordarme</label>
														</p>
														<input type="hidden" name="cfbede3592a57b1daf67b21053bd3404" value="1"> 
														<div class="clear"></div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div id="container-box" class="container span9">
						<h3 id="error" style="color:red;display:<?php echo empty($_GET["error"])?"none":"block";?>;">Necesitas una cuenta para hacer compras</h3>
						<?php
							if(!empty($_GET["fallo"])){
								echo '<h3 id="error" style="color:red;display:block;">';
								switch($_GET["fallo"]){
									case 1: echo 'Falta el email'; break;
									case 2: echo 'Email ya registrado'; break;
									case 3: echo 'Falta el nombre'; break;
									case 4: echo 'Falta el apellido'; break;
									case 5: echo 'Tienes que escribir la contraseña dos veces'; break;
									case 6: echo 'Tienes que repetir la contraseña'; break;
									case 7: echo 'Las contraseñas no coinciden'; break;
									case 8: echo 'Debes incluir el nombre de la empresa'; break;
									case 9: echo 'Falta la provincia'; break;
									case 10: echo 'Falta la localidad'; break;
									case 11: echo 'Falta el codigo postal'; break;
									case 12: echo 'Falta la dirección 1'; break;
									case 13: echo 'Falta la dirección 2'; break;
									case 14: echo 'Falta el telefono'; break;
									case 15: echo 'Falta el DNI'; break;
									case 16: echo 'El DNI no es correcto'; break;
								}
								echo '</h3>';
							}
						?>
							<div class="content-indent">
								<div class="cart-view">
									<h3>Formulario de registro</h3>
									<div class="billing-box">
										<form method="post" id="adminForm" name="userForm" action="/registrar.php?create=true" class="form-validate">
											<fieldset>
												<span class="userfields_info">Información del comprador</span>
											</fieldset>
											<table class="adminForm user-details">
												<tbody>
													<tr>
														<td class="key" title="">
															<label class="email" for="email_field">E-Mail</label>
														</td>
														<td>
															<input type="text" id="email_field" name="email" size="30" value="<?php echo empty($_GET["email"])?"":$_GET["email"];?>" class="required" maxlength="100" aria-required="true" required="required">
														</td>
													</tr>
													<tr>
														<td class="key" title="">
															<label class="username" for="username_field" aria-invalid="false">Nombre</label>
														</td>
														<td>
															<input type="text" id="username_field" name="nombre" size="30" value="<?php echo empty($_GET["nombre"])?"":$_GET["nombre"];?>" maxlength="25" class="" aria-invalid="false" required="required">
														</td>
													</tr>
													<tr>
														<td class="key" title="">
															<label class="username" for="surname_field" aria-invalid="false">Apellidos</label>
														</td>
														<td>
															<input type="text" id="surname_field" name="apellido" size="30" value="<?php echo empty($_GET["apellido"])?"":$_GET["apellido"];?>" maxlength="25" class="" aria-invalid="false" required="required">
														</td>
													</tr>
													<tr>
														<td class="key" title="">
															<label class="password" for="password_field" aria-invalid="false">Contraseña</label>
														</td>
														<td>
															<input type="password" id="password_field" name="hash1" size="30" class="inputbox" aria-invalid="false" required="required">
														</td>
													</tr>
													<tr>
														<td class="key" title="">
															<label class="password2" for="password2_field">Confirmar contraseña</label>
														</td>
														<td>
															<input type="password" id="password2_field" name="hash2" size="30" class="inputbox" required="required">
														</td>
													</tr>
												</tbody>
											</table>
										<fieldset>
											<span class="userfields_info">Información de facturación</span>
											<table class="adminForm user-details">
												<tbody>
													<tr>
														<td class="key" title="">
															<label class="title" for="title_field">Tipo de cliente</label>
														</td>
														<td>
															<select id="tipoEmpresa" onchange="cambiarEmpresa()" name="tipoEmpresa" class="vm-chzn-select">
																<option value="1">Empresa</option>
																<option value="2">Particular</option>
															</select>
														</td>
													</tr>
													<tr id="nombreEmpresa">
														<td class="key" title="">
															<label class="company" for="company_field">Nombre de la empresa</label>
														</td>
														<td>
															<input type="text" id="company_field" name="nombreEmpresa" size="30" value="<?php echo empty($_GET["nombreEmpresa"])?"":$_GET["nombreEmpresa"];?>" maxlength="64">
														</td>
													</tr>
													<tr>
														<td class="key" title="">
															<label class="virtuemart_country_id" for="virtuemart_country_id_field">País</label>
														</td>
														<td>
															<select id="pais" name="pais" class="vm-chzn-select required" aria-required="true" required="required">
																<option selected value="España">España</option>
																<option value="Portugal">Portugal</option>
															</select>
														</td>
													</tr>
													<tr>
														<td class="key" title="">
															<label class="address_1" for="address_1_field">Provincia</label>
														</td>
														<td>
															<input type="text" id="address_1_field" name="provincia" size="30" value="<?php echo empty($_GET["provincia"])?"":$_GET["provincia"];?>" class="required" maxlength="64" aria-required="true" required="required">
														</td>
													</tr>
													<tr>
														<td class="key" title="">
															<label class="address_2" for="address_2_field">Localidad</label>
														</td>
														<td>
															<input type="text" id="address_2_field" name="localidad" size="30" value="<?php echo empty($_GET["localidad"])?"":$_GET["localidad"];?>" maxlength="64" required="required">
														</td>
													</tr>
													<tr>
														<td class="key" title="">
															<label class="zip" for="zip_field">Código postal</label>
														</td>
														<td>
															<input type="text" id="zip_field" name="cp" size="30" value="<?php echo empty($_GET["cp"])?"":$_GET["cp"];?>" class="required" maxlength="32" aria-required="true" required="required">
														</td>
													</tr>
													<tr>
														<td class="key" title="">
															<label class="city" for="city_field">Dirección 1</label>
														</td>
														<td>
															<input type="text" id="city_field" name="direccion1" size="30" value="<?php echo empty($_GET["direccion1"])?"":$_GET["direccion1"];?>" class="required" maxlength="32" aria-required="true" required="required" placeholder="Calle. Nombre">
														</td>
													</tr>
													<tr>
														<td class="key" title="">
															<label class="phone_1" for="phone_1_field">Dirección 2</label>
														</td>
														<td>
															<input type="text" id="phone_1_field" name="direccion2" size="30" value="<?php echo empty($_GET["direccion2"])?"":$_GET["direccion2"];?>" maxlength="32" placeholder="Piso, planta, puerta, escalera" required="required">
														</td>
													</tr>
													<tr>
														<td class="key" title="">
															<label class="phone_2" for="phone_2_field">Teléfono</label>
														</td>
														<td>
															<input type="text" id="phone_2_field" name="telefono" size="30" value="<?php echo empty($_GET["telefono"])?"":$_GET["telefono"];?>" maxlength="32" required="required">
														</td>
													</tr>
													<tr>
														<td class="key" title="">
															<label class="phone_2" for="phone_2_field">DNI</label>
														</td>
														<td>
															<input type="text" id="dni_field" name="dni" size="30" value="<?php echo empty($_GET["dni"])?"":$_GET["dni"];?>" maxlength="32" required="required">
														</td>
													</tr>
												</tbody>
											</table>
										</fieldset>
										<div class="buttonBar-right">
											<button class="button" type="submit">Registrar</button>
										</div>
										<input type="hidden" name="task" value="saveUser">
									</form>
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
				<?php
					$nombre_paises = array('España' => '0', 'Portugal' => '1');
					if(!empty($_GET["tipoEmpresa"])){
						echo 'document.getElementById("tipoEmpresa").selectedIndex = '.($_GET["tipoEmpresa"]-1).";";
					}
					if(!empty($_GET["pais"])){
						echo 'document.getElementById("pais").selectedIndex = '.$nombre_paises[$_GET["pais"]].";";
					}
				?>
				cambiarEmpresa();
				function cambiarEmpresa(){
					if(document.getElementById("tipoEmpresa").value == 1){
						document.getElementById("nombreEmpresa").style.display="table-row";
					}else{
						document.getElementById("nombreEmpresa").style.display="none";
					}
				}
			</script>
		</div>
	</body>
</html>