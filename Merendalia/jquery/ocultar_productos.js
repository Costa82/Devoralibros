$(document).ready(function() {
	
        $('#select').change(function() {
	        $('.refrescos')[ ($(this).val() == 'refrescos' || $(this).val() == 'todo' || $(this).val() == 'bebidas') ? 'show' : 'hide' ]()
	        $('.cervezas')[ ($(this).val() == 'cervezas' || $(this).val() == 'todo' || $(this).val() == 'bebidas') ? 'show' : 'hide' ]()
	        $('.vinos')[ ($(this).val() == 'vinos' || $(this).val() == 'todo' || $(this).val() == 'bebidas') ? 'show' : 'hide' ]()
	        $('.titulo_bebida')[ ($(this).val() != 'comida' && $(this).val() != 'merienda') ? 'show' : 'hide' ]()
	        $('.comida')[ ($(this).val() == 'comida' || $(this).val() == 'todo') ? 'show' : 'hide' ]()
	        $('.merienda')[ ($(this).val() == 'merienda' || $(this).val() == 'todo') ? 'show' : 'hide' ]()
        });
});