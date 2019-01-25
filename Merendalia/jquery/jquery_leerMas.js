$(document).ready(function() { 

	$('.leerMas').on('click',function() {
		$(this).siblings( ".texto_leerMas" ).toggle("slow");
	    $(this).hide();
	    $(this).siblings('.leerMenos').show();
	});
	
	$('.leerMenos').on('click',function() {
		$(this).siblings( ".texto_leerMas" ).toggle("slow");
		$(this).siblings('.leerMas').show();
	    $(this).hide();
	});

});