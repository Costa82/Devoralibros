$(document).ready(function() {   
  		
        $(window).resize(function(){
                  var conocenos = $('.conocenos');
                  conocenos.css({ 
                      'left': ($(window).width() / 2 - $(conocenos).width() / 2) + 'px', 
                      'top': ($(window).height() / 2 - $(conocenos).height() / 2) + ($(window).scrollTop()) + 'px'
                  });
                });

       
  		  
        // Función que muestra las listas al hacer click en el botonLista
        $('li#conocenosMenu a, li#conocenosMenu2 a, .conocenos').click(function(e){
           $(window).resize();
            e.preventDefault();
          if ( $('.conocenos').is(":visible") ) {
            $('.conocenos').fadeOut('slow');
          }else {
            $('.conocenos').fadeIn('slow');
          }
        });
});