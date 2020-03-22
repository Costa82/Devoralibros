<?php

function sesion() {
    session_cache_limiter('nocache');
    session_name('misLibros');
    
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}

?>
