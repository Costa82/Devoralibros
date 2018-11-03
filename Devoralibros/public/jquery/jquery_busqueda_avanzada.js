$(document).ready(function() {    
    // Función para centrar verticalmente el buscador avanzado
    $(window).resize(function(){ 
        // Aquí le pasamos la clase o id de nuestro div a centrar
        $('.busqueda_avanzada').css({
            position:'fixed',
            top: ($(window).height() - $('.busqueda_avanzada').outerHeight())/2
        });
      	$('.devoralibros_mensual').css({
            position:'fixed',
            top: ($(window).height() - $('.devoralibros_mensual').outerHeight())/2
        });
    }); 
    // Ejecutamos la función
    $(window).resize();
    
    // Función para animar el buscador avanzado y dar el efecto de ocultarse y mostrarse
    // al pasar por encima de él con el ratón
    $('.busqueda_avanzada').hover(function() {
        $(this).stop(true).animate( { marginRight:"270px" }, 600 );
    },
    function() {
        $(this).stop(true).animate( { marginRight:"0" }, 600 );
    });
  
    $('.devoralibros_mensual').hover(function() {
        $(this).stop(true).animate( { marginLeft:"270px" }, 600 );
    },
    function() {
        $(this).stop(true).animate( { marginLeft:"0" }, 600 );
    });
});

