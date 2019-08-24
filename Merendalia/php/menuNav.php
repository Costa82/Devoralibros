<?php

    // Menu principal para la pagina principal index.php
    echo "<ul id='lista_principal_index'>
            <li id='inicio'><a href='../inicio' title='Inicio'><img src='../img/merendalia_logotipo_RGB-01.png' alt='Merendalia'/></a></li>";
    
    if (strpos($_SERVER['REQUEST_URI'], "galeria") !== false) {
        // galeria.php found
        echo "<li id='galeria'><a href='../galeria/' title='Galería' class='seleccionado'>Galería</a></li>";
    } else {
        echo "<li id='galeria'><a href='../galeria/' title='Galería'>Galería</a></li>";
    }
    
    if (strpos($_SERVER['REQUEST_URI'], "eventos") !== false) {
        // eventos.php found
        echo "<li id='eventos'><a href='../eventos/' title='Eventos' class='seleccionado'>Eventos</a></li>";
    } else {
        echo "<li id='eventos'><a href='../eventos/' title='Eventos'>Eventos</a></li>";
    }
    
    if (strpos($_SERVER['REQUEST_URI'], "espacio") !== false) {
        // reservas.php found
        echo "<li id='espacio'><a href='../espacio/' title='Espacio' class='seleccionado'>Espacio</a></li>";
    } else {
        echo "<li id='espacio'><a href='../espacio/' title='Espacio'>Espacio</a></li>";
    }
    
    if (strpos($_SERVER['REQUEST_URI'], "catering") !== false) {
        // menus.php found
        echo "<li id='menus'><a href='../catering/' title='Catering' class='seleccionado'>Catering</a></li>";
    } else {
        echo "<li id='menus'><a href='../catering/' title='Catering'>Catering</a></li>";
    }
    
    if (strpos($_SERVER['REQUEST_URI'], "blog") !== false) {
        // blog.php found
        echo "<li id='menus'><a href='../blog-merendalia/' title='Blog Merendalia' class='seleccionado'>Blog</a></li>";
    } else {
        echo "<li id='menus'><a href='../blog-merendalia/' title='Blog Merendalia'>Blog</a></li>";
    }
    
    if (strpos($_SERVER['REQUEST_URI'], "contacto") !== false) {
        // contacto.php found
        echo "<li id='contacto'><a href='../contacto/' title='Contacto' class='seleccionado'>Contacto</a></li>";
    } else {
        echo "<li id='contacto'><a href='../contacto/' title='Contacto'>Contacto</a></li>";
    }
    
    echo "<li id='menu_moviles'><i class='fa fa-bars' aria-hidden='true'></i></a>
                    <ul id='lista_movil'>
                        <li id='galeria2'><a href='../galeria/' title='Galería'>Galería</a></li>
                        <li id='eventos2'><a href='../eventos/' title='Eventos'>Eventos</a></li>
                        <li id='espacio2'><a href='../espacio/' title='Espacio'>Espacio</a></li>
                        <li id='menus2'><a href='../catering/' title='Menús'>Catering</a></li>
                        <li id='blogMerendalia2'><a href='../blog-merendalia/' title='Blog Merendalia'>Blog</a></li>
                        <li id='contacto2'><a href='../contacto/' title='Contacto'>Contacto</a></li>
                    </ul>
                </li>
        
            <ul>";