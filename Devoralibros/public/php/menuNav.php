<?php

// Menú principal para todas las páginas de perfil
echo "<ul id='lista_principal'>
                <li id='inicio'><a href='../Inicio' title='Inicio'><img src='../img/DEVORALIBROS_8_72ppi.png' alt='Devoralibros'/></a></li>
                <li id='perfil1'><a href='../FormularioEditarUsuario/' title='Modifica tus datos'>";
if ($foto != null) {
    echo "<img src='../fotos/" . $foto . "' alt='Foto de perfil'>";
}
echo "<span> ¡Hola " . $nick . "!</span></a></li>
                <li id='cerrar_sesion'><a href='../php/cerrarSesion.php' title='Cerrar sesión'><i class='fa fa-unlock-alt' aria-hidden='true'></i><span>Cerrar Sesion</span></a></li>
                <li id='darme_baja'><a href='../php/eliminar_usuario_header.php?id=" . $id_usuario . "' title='Darme de baja' onclick='return confirmarBaja()'><i class='fa fa-user-times'></i><span>Darme de baja</span></a></li>
      </ul>";

