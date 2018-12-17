$(document).ready(function() {    
        // Al hacer un mousedown en cualquier textArea se borra lo que hay dentro
        $('textarea').mousedown(function(){
            $(this).text('');
        });
        
});

