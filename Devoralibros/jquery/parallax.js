$(document).ready(function(){
    //Efecto parallax para la imagen del fondo de las páginas de perfil
    $(window).scroll(function(){
            var barra = $(window).scrollTop();
            var posicion = (barra * 0.20) ; //Valor de retardo.

            $('#slider').css({
                    'background-position' : '0  -' + posicion + 'px'
            });

    });

});
