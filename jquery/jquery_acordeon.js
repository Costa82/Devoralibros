$(document).ready(function(){
  // Función que muestra y oculta la descripción y libros de cada lista al hacer
  // click en el icono del ojo.
    $(".fa-eye").click(function() {
        if($(this).siblings(".librosLista").is(":visible")){
            $(this).siblings(".librosLista").fadeOut("slow");  
        }else{
          $(this).siblings(".librosLista").fadeIn("slow");
        }
    });
  $("#accordion div").hide();
  // Función que hace el efecto acordeón.
    $("#accordion h4").click(function() {
        if($(this).next().is(":visible")){
            $(this).next().slideUp("slow");  
        }else{
          $(this).next().slideDown("slow");
        }
    });

    /**
	 * store the value of and then remove the title attributes from the
	 * abbreviations (thus removing the default tooltip functionality of
         * the abbreviations)
	 */
	$('label .fa').each(function(){		
		
		$(this).data('title',$(this).attr('title'));
		$(this).removeAttr('title');
	
	});

        /**
	 * when abbreviations are mouseover-ed show a tooltip with the data from the title attribute
	 */	
	$('label .fa').mouseover(function() {		
		
		// first remove all existing abbreviation tooltips
		$('label .fa').next('.tooltip').remove();
		
		// create the tooltip
		$(this).after('<span class="tooltip">' + $(this).data('title') + '</span>');
		
		// position the tooltip 4 pixels above and 4 pixels to the left of the abbreviation
		var left = $(this).position().left + $(this).width() + 4;
		var top = $(this).position().top - 4;
		$(this).next().css('left',left);
		$(this).next().css('top',top);				
		
	});
	
	/**
	 * when abbreviations are clicked trigger their mouseover event then fade the tooltip
	 * (this is friendly to touch interfaces)
	 */
	$('label .fa').click(function(){
		
		$(this).mouseover();
		
		// after a slight 2 second fade, fade out the tooltip for 1 second
		$(this).next().animate({opacity: 0.9},{duration: 10000, complete: function(){
			$(this).fadeOut(1000);
		}});
		
	});
	
	/**
	 * Remove the tooltip on abbreviation mouseout
	 */
	$('label .fa').mouseout(function(){
			
		$(this).next('.tooltip').remove();				

	});
});
