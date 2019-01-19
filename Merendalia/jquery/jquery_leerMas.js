$(document).ready(function() { 

	$('.leerMas').on('click',function(){
	    $('.texto_leerMas').toggle("slow");
	    $('.leerMas').hide();
	    $('.leerMenos').show();
	});
	
	$('.leerMenos').on('click',function(){
	    $('.texto_leerMas').toggle("slow");
	    $('.leerMas').show();
	    $('.leerMenos').hide();
	});

});