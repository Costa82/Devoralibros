$(document).ready(function() {
	// Función que abre y cierra, al hacer click, lentamente el menú principal
	// de los dispositivos móviles.
	$('#menu_moviles').click(function(e) {
		e.stopPropagation();
		if ($("#lista_movil").is(":hidden")) {
			$("#lista_movil").slideDown("slow");
		} else {
			$("#lista_movil").slideUp("slow");
		}
	});

	$('#autores').click(function(e) {
		e.stopPropagation();
		$("#listaTitulos").slideUp("slow");
		if ($("#listaAutores").is(":hidden")) {
			$("#listaAutores").slideDown("slow");
		} else {
			$("#listaAutores").slideUp("slow");
		}
	});

	$('#titulos').click(function(e) {
		e.stopPropagation();
		$("#listaAutores").slideUp("slow");
		if ($("#listaTitulos").is(":hidden")) {
			$("#listaTitulos").slideDown("slow");
		} else {
			$("#listaTitulos").slideUp("slow");
		}
	});

	$('html').click(function() {
		$("#listaTitulos").slideUp("slow");
		$("#listaAutores").slideUp("slow");
		$("#lista_movil").slideUp("slow");
	});
});