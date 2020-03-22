<?php

// Footer
echo '<div class="footerPrincipal">
        <div id="conocenos">
            <h3>Conócenos</h3>
            <ul>
                <li><a href="#" class="Beatriz" title="Beatriz">Beatriz</a></li>
                <li><a href="#" class="Belen" title="BelÃ©n">Belén</a></li>
                <li><a href="#" class="Esther" title="Esther">Esther</a></li>
                <li><a href="#" class="Miguel" title="Miguel">Miguel</a></li>
            </ul>
        </div>
        <div class="logo">
            <h2>DevoraLibros</h2>
        </div>
        <div class="redes">
            <h3>Síguenos</h3>
            <a href="https://www.facebook.com/devoralibrosvalladolid" title="Facebook" target="_blank"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
            <a href="https://www.twitter.com/Devoralibrosval?lang=es" title="Twitter" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            <a href="https://www.youtube.com/channel/UChiUihBCdebIURbXkxLL7YQ" title="YouTube" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a>
            <a href="https://www.instagram.com/devoralibrosvalladolid/" title="Instagram" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        </div>
      </div>
      <div class="footer-final">
        <div class="contactar">
            <a href="mailto:administrador@devoralibros.es" title="Contactar">Contactar</a>
        </div>';

if (strpos($_SERVER['REQUEST_URI'], "Inicio") !== false) {
    // index.php found
    echo '<div class="preguntas">
    		<a href="Preguntas/1" title="Preguntas frecuentes">FAQs</a>
          </div>';
} else if (strpos($_SERVER['REQUEST_URI'], "Usuario") !== false) {
    echo '<div class="preguntas">
    		<a href="../Preguntas/2" title="Preguntas frecuentes">FAQs</a>
          </div>';
} else if (strpos($_SERVER['REQUEST_URI'], "Administrador") !== false) {
    echo '<div class="preguntas">
    		<a href="../Preguntas/3" title="Preguntas frecuentes">FAQs</a>
          </div>';
} else {
    echo '<div class="preguntas">
    		<a href="../Preguntas/1" title="Preguntas frecuentes">FAQs</a>
          </div>';
}

if (strpos($_SERVER['REQUEST_URI'], "Inicio") !== false) {
    // index.php found
    echo '<div class="copyright">
    		<a href="AvisoLegal/1" title="Aviso Legal">Aviso Legal</a>
          </div>';
} else if (strpos($_SERVER['REQUEST_URI'], "Usuario") !== false) {
    echo '<div class="copyright">
    		<a href="../AvisoLegal/2" title="Aviso Legal">Aviso Legal</a>
          </div>';
} else if (strpos($_SERVER['REQUEST_URI'], "Administrador") !== false) {
    echo '<div class="copyright">
    		<a href="../AvisoLegal/3" title="Aviso Legal">Aviso Legal</a>
          </div>';
} else {
    echo '<div class="copyright">
    		<a href="../AvisoLegal/1" title="Aviso Legal">Aviso Legal</a>
          </div>';
}

echo '<div class="copyright">
                <p><i class="fa fa-copyright" aria-hidden="true"></i> 2019 Miguel Costa Jiménez</p>
      </div>
    
      </div>';

