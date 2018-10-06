<?php
if(!empty($_GET["create"])){
	$link = conn();
	if(empty($_POST["email"])){
		malosDatos(1);
	}else{
		$result = $link->query("SELECT * FROM `usuarios` WHERE `email`='".$_POST["email"]."'");
		$rep = false;
		while($row = $result->fetch_assoc()){
			$rep = true;
		}
		if($rep){
			malosDatos(2);
		}else{
			if(empty($_POST["nombre"])){
				malosDatos(3);
			}else{
				if(empty($_POST["apellido"])){
					malosDatos(4);
				}else{
					if(empty($_POST["hash1"])){
						malosDatos(5);
					}else{
						if(empty($_POST["hash2"])){
							malosDatos(6);
						}else{
							if($_POST["hash1"] != $_POST["hash2"]){
								malosDatos(7);
							}else{
								if($_POST["tipoEmpresa"] == 1 and empty($_POST["nombreEmpresa"])){
									malosDatos(8);
								}else{
									if(empty($_POST["provincia"])){
										malosDatos(9);
									}else{
										if(empty($_POST["localidad"])){
											malosDatos(10);
										}else{
											if(empty($_POST["cp"])){
												malosDatos(11);
											}else{
												if(empty($_POST["direccion1"])){
													malosDatos(12);
												}else{
													if(empty($_POST["direccion2"])){
														malosDatos(13);
													}else{
														if(empty($_POST["telefono"])){
															malosDatos(14);
														}else{
															if(empty($_POST["dni"])){
																malosDatos(15);
															}else{
																if(!validarDNI($_POST["dni"])){
																	malosDatos(16);
																}else{
																	$id = "U".getTCode();
																	$link->query("INSERT INTO `usuarios` (`ID`,`nombre`,`apellido`,`email`,`hash`,`empresa`,`direccion`,`cesta`,`telefono`,`dni`,`estado`) VALUES ('".$id."','".$_POST["nombre"]."','".$_POST["apellido"]."','".$_POST["email"]."','".md5($_POST["hash1"])."','".($_POST["tipoEmpresa"]==1?$_POST["nombreEmpresa"]:"NAN")."','".$_POST["pais"]."|".$_POST["provincia"]."|".$_POST["localidad"]."|".$_POST["cp"]."|".$_POST["direccion1"]."|".$_POST["direccion2"]."','','".$_POST["telefono"]."','".$_POST["dni"]."','1');");
																	$link->close();
																	
																	$array_remplazo = array('ID' => $id, 'NOMBRE' => $_POST["nombre"]);
																	sendMail($_POST["email"],"","","activacion",$array_remplazo,"Activacion [NOMBRE DE EMPRESA]","");
																	
																	header("Location: index.php");
																	die();
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
}
function malosDatos($error){
	header("Location: registrar.php?fallo=".$error."&email=".$_POST["email"]."&nombre=".$_POST["nombre"]."&apellido=".$_POST["apellido"]."&tipoEmpresa=".$_POST["tipoEmpresa"]."&nombreEmpresa=".$_POST["nombreEmpresa"]."&pais=".$_POST["pais"]."&provincia=".$_POST["provincia"]."&localidad=".$_POST["localidad"]."&cp=".$_POST["cp"]."&direccion1=".$_POST["direccion1"]."&direccion2=".$_POST["direccion2"]."&telefono=".$_POST["telefono"]."&dni=".$_POST["dni"]);
	die();
}
function validarDNI($dni){
	$letra = substr($dni, -1);
	$numeros = substr($dni, 0, -1);
	if ( substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) == $letra && strlen($letra) == 1 && strlen ($numeros) == 8 ){
		return true;
	}else{
		return false;
	}
}
?>