$(document).ready(function() {   
  
        // Función que muestra las listas al hacer click en el botonLista
        $('.botonLista').click(function(e){
            e.preventDefault();
            $('.addLista').fadeIn('slow');
        });
        
        $('#conocenos ul li a').click(function(e){
            var nombre=e.target.className;
            if($('.infografia'+nombre).is(':visible')){
                $('.infografia'+nombre).fadeOut('slow');
            }else{
                $('.foto'+nombre).fadeIn('slow');
                setTimeout(function() {
                    $('.foto'+nombre).fadeOut('slow');
                },2000);  
                setTimeout(function() {
                    $('.infografia'+nombre).fadeIn('slow');
                },2000);
            }
                e.preventDefault();
                $('.infografia').not('.infografia'+nombre).fadeOut('fast');
        });
        
        // Función que cierra las fotos al pulsar sobre ellas
        $(".infografia").click(function(){
            $(this).fadeOut('slow');
        });
  
  		 
               
});
