<div class="footerPrincipal">

        <div class="logo_footer">
            <ul>
            <?php
            if (strpos($_SERVER['REQUEST_URI'], "index") !== false) {
                // index.php found
                echo '<li><img class="logo_hamburguesa" src="img/sandwich con bolas blancas.png" alt="Merendalia"/></li>';
            } else {
                echo '<li><img class="logo_hamburguesa" src="../img/sandwich con bolas blancas.png" alt="Merendalia"/></li>';
            }
            ?>
                <li class="espacio oculto_movil_footer">Merendalia, el ocio a tu manera. Organiza tu evento, o ven a uno preparado por nosotros.</li>
                <li class="espacio oculto_movil">Calle Paraiso, 2 bajo. Pasaje del Alarcón.</li>
                <li class="espacio oculto_movil">47003 Valladolid</li>
            </ul>
        </div>
        <div class="informacion">
        	<h3>Información</h3>
            <ul>
            
            <?php
            if ( strpos($_SERVER['REQUEST_URI'], "galeria") !== false || strpos($_SERVER['REQUEST_URI'], "eventos") !== false || strpos($_SERVER['REQUEST_URI'], "reservas") !== false || strpos($_SERVER['REQUEST_URI'], "menus") !== false || strpos($_SERVER['REQUEST_URI'], "contacto") !== false ) {
                
                // Estamos en alguna pagina que no sea la principal
                echo '<li id="galeria"><a href="galeria.php" title="Galería">Galería</a></li>
                    <li id="eventos"><a href="eventos.php" title="Eventos">Eventos</a></li>
                    <li id="reservas"><a href="reservas.php" title="Reservas">Reservas/Tarifas</a></li>
                    <li id="menus"><a href="menus.php" title="Menús">Menús</a></li>
                    <!-- <li id="productos"><a href="productos.php" title="Productos">Productos</a></li> -->
                    <li id="contacto"><a href="contacto.php" title="Contacto">Contacto</a></li>';

            } else {

                // Estamos en la pagina principal
                echo '<li id="galeria"><a href="php/galeria.php" title="Galería">Galería</a></li>
                    <li id="eventos"><a href="php/eventos.php" title="Eventos">Eventos</a></li>
                    <li id="reservas"><a href="php/reservas.php" title="Reservas">Reservas/Tarifas</a></li>
                    <li id="menus"><a href="php/menus.php" title="Menús">Menús</a></li>
                    <!-- <li id="productos"><a href="php/productos.php" title="Productos">Productos</a></li> -->
                    <li id="contacto"><a href="php/contacto.php" title="Contacto">Contacto</a></li>';
            }
            ?>
            
            <ul>
        </div>
        <div class="redes">
            <h3>Síguenos</h3>
            <a href="https://m.facebook.com/merendalia" title="Facebook" target="_blank"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
            <a href="https://www.twitter.com/merendalia?lang=es" title="Twitter" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            <a href="https://www.instagram.com/merendalia/" title="Instagram" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        </div>
      </div>