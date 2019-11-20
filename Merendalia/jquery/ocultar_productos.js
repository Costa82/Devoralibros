$(document).ready(function() {
	
        $('#select').change(function() {
        	$('.titulo_bebida')[ ($(this).val() == 'bebidas' || $(this).val() == 'refrescos' || $(this).val() == 'hielos' || $(this).val() == 'aguas' || $(this).val() == 'vinos' || $(this).val() == 'licores' || $(this).val() == 'todo') ? 'show' : 'hide' ]()
	        $('.refrescos')[ ($(this).val() == 'refrescos' || $(this).val() == 'todo' || $(this).val() == 'bebidas') ? 'show' : 'hide' ]()
	        $('.cervezas')[ ($(this).val() == 'cervezas' || $(this).val() == 'todo' || $(this).val() == 'bebidas') ? 'show' : 'hide' ]()
	        $('.vinos')[ ($(this).val() == 'vinos' || $(this).val() == 'todo' || $(this).val() == 'bebidas') ? 'show' : 'hide' ]()
			$('.hielos')[ ($(this).val() == 'hielos' || $(this).val() == 'todo' || $(this).val() == 'bebidas') ? 'show' : 'hide' ]()
			$('.aguas')[ ($(this).val() == 'aguas' || $(this).val() == 'todo' || $(this).val() == 'bebidas') ? 'show' : 'hide' ]()
			$('.licores')[ ($(this).val() == 'licores' || $(this).val() == 'todo' || $(this).val() == 'bebidas') ? 'show' : 'hide' ]()
	        $('.entrantes')[ ($(this).val() == 'entrantes' || $(this).val() == 'todo') ? 'show' : 'hide' ]()
			$('.titulo_entrante')[ ($(this).val() == 'entrantes' || $(this).val() == 'canapes' || $(this).val() == 'raciones' || $(this).val() == 'todo') ? 'show' : 'hide' ]()
			$('.canapes')[ ($(this).val() == 'canapes' || $(this).val() == 'entrantes' || $(this).val() == 'todo') ? 'show' : 'hide' ]()
			$('.raciones')[ ($(this).val() == 'raciones' || $(this).val() == 'entrantes' || $(this).val() == 'todo') ? 'show' : 'hide' ]()
			$('.ensaladas')[ ($(this).val() == 'ensaladas' || $(this).val() == 'todo') ? 'show' : 'hide' ]()
	        $('.guisos')[ ($(this).val() == 'guisos' || $(this).val() == 'todo') ? 'show' : 'hide' ]()
	        $('.merienda')[ ($(this).val() == 'merienda' || $(this).val() == 'todo') ? 'show' : 'hide' ]()
	        $('.postres')[ ($(this).val() == 'postres' || $(this).val() == 'todo') ? 'show' : 'hide' ]()
	        $('.menusCalentarListo')[ ($(this).val() == 'menusCalentarListo' || $(this).val() == 'todo') ? 'show' : 'hide' ]()
        });
});