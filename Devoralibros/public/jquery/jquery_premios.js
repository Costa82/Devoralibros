$(document).ready(function() {    
    
    $('li.animated a').hover(onHover, onLeave);

	function onHover() {
              $(this).text($(this).attr('on-hover'));
        }
        function onLeave() {
              $(this).text($(this).attr('on-leave'));
        }
});