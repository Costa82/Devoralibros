<div class="footerPrincipal">

	<div class="logo_footer">
		<ul>
            <?php
            if (strpos($_SERVER['REQUEST_URI'], "index") !== false) {
                
                // index.php found
                echo '<li><img class="logo_hamburguesa" src="img/sandwich con bolas blancas.png" alt="Merendalia"/></li>';
            } else if (strpos($_SERVER['REQUEST_URI'], "galeria") !== false || strpos($_SERVER['REQUEST_URI'], "eventos") !== false || strpos($_SERVER['REQUEST_URI'], "espacio") !== false || strpos($_SERVER['REQUEST_URI'], "catering") !== false || strpos($_SERVER['REQUEST_URI'], "contacto") != false || strpos($_SERVER['REQUEST_URI'], "legal") !== false || strpos($_SERVER['REQUEST_URI'], "blog") !== false || strpos($_SERVER['REQUEST_URI'], "envio") !== false || strpos($_SERVER['REQUEST_URI'], "cookies") !== false) {
                
                // Está en alguna página que no es la principal
                echo '<li><img class="logo_hamburguesa" src="../img/sandwich con bolas blancas.png" alt="Merendalia"/></li>';
            } else {
                echo '<li><img class="logo_hamburguesa" src="img/sandwich con bolas blancas.png" alt="Merendalia"/></li>';
            }
            ?>
                <li class="espacio oculto_movil_footer">Merendalia, el
				ocio a tu manera. Organiza tu evento, o ven a uno preparado por
				nosotros.</li>
			<li class="espacio oculto_movil">Calle Paraiso, 2 bajo. Pasaje del
				Alarcón.</li>
			<li class="espacio oculto_movil">47003 Valladolid</li>
		</ul>
	</div>

	<div class="informacion">

		<h3>Información</h3>

		<ul>
            
            <?php
            if (strpos($_SERVER['REQUEST_URI'], "galeria") !== false || strpos($_SERVER['REQUEST_URI'], "eventos") !== false || strpos($_SERVER['REQUEST_URI'], "reservas") !== false || strpos($_SERVER['REQUEST_URI'], "menus") !== false || strpos($_SERVER['REQUEST_URI'], "contacto") != false || strpos($_SERVER['REQUEST_URI'], "legal") !== false || strpos($_SERVER['REQUEST_URI'], "cookies") !== false || strpos($_SERVER['REQUEST_URI'], "blog") !== false) {
                
                // Estamos en alguna pagina que no sea la principal (Galeria, eventos, reservas, etc...)
                echo '<li id="galeria"><a href="../galeria/" title="Galería">Galería</a></li>
                    <li id="eventos"><a href="../eventos/" title="Eventos">Eventos</a></li>
                    <li id="espacio"><a href="../espacio/" title="Espacio">Espacio</a></li>
                    <li id="menus"><a href="../catering/" title="Catering">Catering</a></li>
                    <li id="blogMerendalia"><a href="../blog-merendalia/" title="Blog Merendalia">Blog</a></li>
                    <li id="contacto"><a href="../contacto/" title="Contacto">Contacto</a></li>
                    <li id="legal"><a href="../aviso-legal-y-politica-de-privacidad/" title="Aviso Legal y política de privacidad">Aviso Legal y política de privacidad</a></li>';
            } else {
                
                // Estamos en la pagina principal (index)
                echo '<li id="galeria"><a href="galeria/" title="Galería">Galería</a></li>
                    <li id="eventos"><a href="eventos/" title="Eventos">Eventos</a></li>
                    <li id="espacio"><a href="espacio/" title="Espacio">Espacio</a></li>
                    <li id="menus"><a href="catering/" title="Catering">Catering</a></li>
                    <li id="blogMerendalia"><a href="blog-merendalia/" title="Blog Merendalia">Blog</a></li>
                    <li id="contacto"><a href="contacto/" title="Contacto">Contacto</a></li>
                    <li id="legal"><a href="aviso-legal-y-politica-de-privacidad/" title="Aviso Legal y política de privacidad">Aviso Legal y política de privacidad</a></li>';
            }
            ?>
            
            </ul>
	
	</div>

	<div class="redes">
		<h3>Síguenos</h3>
		<a href="https://m.facebook.com/merendalia" title="Facebook"
			target="_blank"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
		<a href="https://www.twitter.com/merendalia?lang=es" title="Twitter"
			target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
		<a href="https://www.instagram.com/merendalia/" title="Instagram"
			target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
	</div>

</div>

<div class="avisoLegal_movil">
    	<?php
            if (strpos($_SERVER['REQUEST_URI'], "galeria") !== false || strpos($_SERVER['REQUEST_URI'], "eventos") !== false || strpos($_SERVER['REQUEST_URI'], "reservas") !== false || strpos($_SERVER['REQUEST_URI'], "menus") !== false || strpos($_SERVER['REQUEST_URI'], "contacto") != false || strpos($_SERVER['REQUEST_URI'], "legal") !== false || strpos($_SERVER['REQUEST_URI'], "cookies") !== false || strpos($_SERVER['REQUEST_URI'], "blog") !== false) {
                
                echo '<a class="enlace_legal" href="../aviso-legal-y-politica-de-privacidad/" title="Aviso Legal y política de privacidad">Aviso Legal y política de privacidad</a>';
            } else {
                echo '<a class="enlace_legal" href="aviso-legal-y-politica-de-privacidad/" title="Aviso Legal y política de privacidad">Aviso Legal y política de privacidad</a>';
            }
        ?>
</div>
