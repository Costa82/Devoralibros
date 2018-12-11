<?php
// Menu principal para la pagina principal index.php
echo "<ul id='lista_principal_index'>
        <li id='inicio'><a href='../index.php' title='Inicio'><img src='../img/merendalia_logotipo_RGB-01.png' alt='Merendalia'/></a></li>";
        
            if (strpos($_SERVER['REQUEST_URI'], "galeria") !== false) {
                // galeria.php found
                echo "<li id='galeria'><a href='galeria.php' title='Galería' class='seleccionado'>Galería</a></li>";
            } else {
                echo "<li id='galeria'><a href='galeria.php' title='Galería'>Galería</a></li>";
            }

            if (strpos($_SERVER['REQUEST_URI'], "eventos") !== false) {
                // eventos.php found
                echo "<li id='eventos'><a href='eventos.php' title='Eventos' class='seleccionado'>Eventos</a></li>";
            } else {
                echo "<li id='eventos'><a href='eventos.php' title='Eventos'>Eventos</a></li>";
            }
            
            if (strpos($_SERVER['REQUEST_URI'], "reservas") !== false) {
                // reservas.php found
                echo "<li id='reservas'><a href='reservas.php' title='Reservas' class='seleccionado'>Reservas/Tarifas</a></li>";
            } else {
                echo "<li id='reservas'><a href='reservas.php' title='Reservas'>Reservas/Tarifas</a></li>";
            }
            
            if (strpos($_SERVER['REQUEST_URI'], "menus") !== false) {
                // menus.php found
                echo "<li id='menus'><a href='menus.php' title='Menús' class='seleccionado'>Menús privados</a></li>";
            } else {
                echo "<li id='menus'><a href='menus.php' title='Menús'>Menús privados</a></li>";
            }
            
//             if (strpos($_SERVER['REQUEST_URI'], "productos") !== false) {
//                 // productos.php found
//                 echo "<li id='productos'><a href='productos.php' title='Productos' class='seleccionado'>Productos</a></li>";
//             } else {
//                 echo "<li id='productos'><a href='productos.php' title='Productos'>Productos</a></li>";
//             }
            
            
            if (strpos($_SERVER['REQUEST_URI'], "contacto") !== false) {
                // contacto.php found
                echo "<li id='contacto'><a href='contacto.php' title='Contacto' class='seleccionado'>Contacto</a></li>";
            } else {
                echo "<li id='contacto'><a href='contacto.php' title='Contacto'>Contacto</a></li>";
            }
            
      echo "<li id='menu_moviles'><i class='fa fa-bars' aria-hidden='true'></i></a>
                <ul id='lista_movil'>
                    <li id='galeria2'><a href='galeria.php' title='Galería'>Galería</a></li>
                    <li id='eventos2'><a href='eventos.php' title='Eventos'>Eventos</a></li>
                    <li id='reservas2'><a href='reservas.php' title='Reservas'>Reservas/Tarifas</a></li>
                    <li id='menus2'><a href='menus.php' title='Menús'>Menús privados</a></li>
                    <li id='productos2'><a href='productos.php' title='Productos'>Productos</a></li>
                    <li id='contacto2'><a href='contacto.php' title='Contacto'>Contacto</a></li>
                </ul>
            </li>
        
        <ul>";
