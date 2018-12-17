<?php

// Menu principal para la pagina principal index.php
echo "<ul id='lista_principal_index'>
		<li id='inicio'><a href='Inicio' title='Inicio'><img src='img/DEVORALIBROS_8_72ppi.png' alt='Devoralibros'/></a></li>
        <li id='facebook'><a href='https://www.facebook.com/devoralibrosvalladolid' title='Facebook' target='_blank'><i class='fa fa-facebook-official' aria-hidden='true'></i></a></li>
        <li id='twitter'><a href='https://www.twitter.com/Devoralibrosval?lang=es' title='Twitter' target='_blank'><i class='fa fa-twitter' aria-hidden='true'></i></a></li>
        <li id='youtube'><a href='https://www.youtube.com/channel/UChiUihBCdebIURbXkxLL7YQ' title='YouTube' target='_blank'><i class='fa fa-youtube' aria-hidden='true'></i></a></li>
        <li id='instagram'><a href='https://www.instagram.com/devoralibrosvalladolid/' title='Instagram' target='_blank'><i class='fa fa-instagram' aria-hidden='true'></i></a></li>
        <li id='conocenosMenu'><a href='#' title='Conocenos'><i class='fa fa-users' aria-hidden='true'></i>Conócenos</a></li>
        <li id='registrarte'>";

if (isset($_SESSION['id_usuario'])) {
    echo "<a href='./php/cerrarSesion.php' title='Cerrar sesion'><i class='fa fa-unlock-alt' aria-hidden='true'></i>Cerrar Sesión</a>";
} else {
    session_destroy();
    echo "<a href='./FormularioRegistro/' title='Registrate'><i class='fa fa-unlock-alt' aria-hidden='true'></i>Regístrate</a>";
}

echo "</li>
         <li id='ini_sesion'>";

if (isset($_SESSION['id_usuario'])) {
    $tipo_usuario = $_SESSION['datos']['tipo_usuario'];
    switch ($tipo_usuario) {
        case 1:
            $destino = "Usuario/";
            break;
        case 2:
            $destino = "Administrador/";
            break;
            
        default:
            $num = - 201;
            $destino = "./FormularioInicioSesion/?num=$num";
            break;
    }
    
    echo "<a href='" . $destino . "' title='" . $_SESSION['datos']['nick'] . "'>";
    if ($foto != null) {
        echo "<img src='fotos/" . $foto . "' alt='Foto de perfil'>";
    }
    
    echo "</a>";
} else {
    echo "<a href='./FormularioInicioSesion/' title='Inicia Sesion'><i class='fa fa-user' aria-hidden='true'></i>Inicia Sesión</a>";
}
echo "</li>
		<li id='menu_moviles'><i class='fa fa-bars' aria-hidden='rue'></i></a>
                    <ul id='lista_movil'>
			<li id='registrarte2'>";

if (isset($_SESSION['id_usuario'])) {
    $tipo_usuario = $_SESSION['datos']['tipo_usuario'];
    echo "<a href='./php/cerrarSesion.php' title='Cerrar Sesion'>Cerrar Sesión</a>";
} else {
    echo "<a href='./FormularioRegistro/' title='Registrate'>Regístrate</a>";
}

echo "</li>
			<li id='ini_sesion2'>";

if (isset($_SESSION['id_usuario'])) {
    $tipo_usuario = $_SESSION['datos']['tipo_usuario'];
    switch ($tipo_usuario) {
        case 1:
            $destino = "Usuario/";
            break;
        case 2:
            $destino = "Administrador/";
            break;
            
        default:
            $num = - 201;
            $destino = "./FormularioInicioSesion/?num=$num";
            break;
    }
    
    echo "<a href='" . $destino . "'>" . $_SESSION['datos']['nick'] . "</a>";
} else {
    echo "<a href='./FormularioInicioSesion/' title='Inicia Sesion'>Inicia Sesión</a>";
}

echo "</li>
            	  <li id='conocenosMenu2'><a href='#' title='Conocenos'>Conócenos</a></li>
                  <li id='facebook2'><a href='https://www.facebook.com/devoralibrosvalladolid' title='Facebook' target='_blank'>Facebook</a></li>
        		  <li id='youtube2'><a href='https://www.youtube.com/channel/UChiUihBCdebIURbXkxLL7YQ' title='YouTube' target='_blank'>YouTube</a></li>
                  <li id='instagram2'><a href='https://www.instagram.com/devoralibrosvalladolid/' title='Instagram' target='_blank'>Instagram</a></li>
                  <li id='twitter2'><a href='https://www.twitter.com/Devoralibrosval?lang=es' title='Twitter' target='_blank'>Twitter</a></li>
                 </ul>
               </li>
            </ul>";


