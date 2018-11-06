$(document).ready(function() {   
  		
        $(window).resize(function(){
              var conocenos = $('.menu_infantil');
              conocenos.css({ 
                   'left': ($(window).width() / 2 - $(conocenos).width() / 2) + 'px'
              });
        });

       
  		  
        // Función que muestra las listas al hacer click en el botonLista
        $('.mostrar_menus, .cerrar').click(function(e){
	          $(window).resize();
	            	e.preventDefault();
	          if ( $('.menu_infantil').is(":visible") ) {
	        	  $('.menu_infantil').fadeOut('slow');
	          }else {
	        	  $('.menu_infantil').fadeIn('slow');
	          }
        });
});