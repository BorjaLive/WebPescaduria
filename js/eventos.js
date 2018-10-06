function boton_mostrarLogin(){
	document.getElementById("login_pop").style.display="block";
}
function boton_cerrarLogin(){
	document.getElementById("login_pop").style.display="none";
}

var carrusel = 1;
function alternador() {
	switch (carrusel){
		case 1:
			document.getElementById("carrusel1").style.display="block";
			document.getElementById("carrusel2").style.display="block";
			document.getElementById("carrusel3").style.display="none";
			document.getElementById("carrusel2").style.opacity=0;
			alternador_fusion("carrusel1","carrusel2",0);
			carrusel = 2;
		break;
		case 2:
			document.getElementById("carrusel1").style.display="none";
			document.getElementById("carrusel2").style.display="block";
			document.getElementById("carrusel3").style.display="block";
			document.getElementById("carrusel3").style.opacity=0;
			alternador_fusion("carrusel1","carrusel2",0);
			carrusel = 3;
		break;
		case 3:
			document.getElementById("carrusel1").style.display="block";
			document.getElementById("carrusel2").style.display="none";
			document.getElementById("carrusel3").style.display="block";
			document.getElementById("carrusel1").style.opacity=0;
			alternador_fusion("carrusel3","carrusel1",0);
			carrusel = 1;
		break;
	}
	setTimeout(function(){
		alternador();
	}, 5000);
}

function alternador_fusion(entrada, salida, nivel){
	document.getElementById(entrada).style.opacity=1-nivel;
	document.getElementById(salida).style.opacity=nivel;
	if(nivel < 1){
		setTimeout(function(){
			alternador_fusion(entrada, salida, nivel+0.01);
		}, 10);
	}
	
}