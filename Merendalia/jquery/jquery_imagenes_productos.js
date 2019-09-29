$(document).ready(function() { 
	
    $(window).resize(function(){
        var imagen = $('.imagen_producto_oculto');
        imagen.css({ 
            'left': ($(window).width() / 2 - $(imagen).width() / 2) + 'px', 
            'top': ($(window).height() / 2 - $(imagen).height() / 2) + ($(window).scrollTop()) + 'px'
        });
    });

	$('.icono_imagen').on('click',function(e) {
		$(window).resize();
        e.preventDefault();
        if ( $(this).siblings('.imagen_producto_oculto').is(":visible") ) {
        	$(this).siblings('.imagen_producto_oculto').fadeOut('slow');
        } else {
        	$(this).siblings('.imagen_producto_oculto').fadeIn('slow');
        }
	});
	
	$('.imagen_producto_oculto').on('click',function() {
		$('.imagen_producto_oculto').fadeOut('slow');
	});

});