$(function() {
	
	$('#mi-ancla').click(function(){
		 event.preventDefault();
		 var ir = jQuery(this).attr('href');
		 var new_position = jQuery('#'+ir).offset();
		 window.scrollTo(new_position.left,new_position.top);
		 return false;
		 });
});
