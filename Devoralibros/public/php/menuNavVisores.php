<?php

require_once '../inc/funciones.php';
require_once '../inc/validaciones.inc.php';
include_once ("../clases/Relato.php");
include_once ('../clases/Usuario.php');

$relato = new Relato();

// Menú principal para todas las páginas de visor de libros, noticias, librerías, etc.
echo "<ul id='lista_principal'>
		<li id='inicio'><a href='../Inicio' title='Inicio'><img src='../img/DEVORALIBROS_8_72ppi.png' alt='Devoralibros'/></a></li>";

        if (strpos($_SERVER['REQUEST_URI'], "Relatos") !== false) {
            // Relatos found
            echo "<li id='autores'><a href='#' title='Autores'><i class='fa fa-edit'></i>Autores</a>";
                    
            $relato->mostrarAutores();
        
            echo "</li>";
            
            echo "<li id='titulos'><a href='#' title='Titulos'><i class='fa fa-bookmark'></i>Títulos</a>";
            
            $relato->mostrarTitulos();
            
            echo "</li>";
        }

        echo "<li id='registrarte'>";
            if (isset($_SESSION['id_usuario'])) {
                echo "<a href='../php/cerrarSesion.php' title='Cerrar sesión'><i class='fa fa-unlock-alt' aria-hidden='true'></i>Cerrar Sesión</a>";
            } else {
                echo "<a href='../FormularioRegistro/' title='Regístrate'><i class='fa fa-unlock-alt' aria-hidden='true'></i>Regístrate</a>";
            }
        echo "</li>
              <li id='ini_sesion'>";
        if (isset($_SESSION['id_usuario'])) {
            $tipo_usuario = $_SESSION['datos']['tipo_usuario'];
            switch ($tipo_usuario) {
                case 1:
                    $destino = "../Usuario/";
                    break;
                case 2:
                    $destino = "../Administrador/";
                    break;
                
                default:
                    $num = - 201;
                    $destino = "../FormularioInicioSesion/?num=$num";
                    break;
            }
    
            echo "<a href='" . $destino . "' title='" . $_SESSION['datos']['nick'] . "'>";
                if ($foto != null) {
                    echo "<img src='../fotos/" . $foto . "' alt='Foto de perfil'>";
                }
            echo "</a>";
        } else {
        echo "<a href='../FormularioInicioSesion/' title='Inicia sesión'><i class='fa fa-user' aria-hidden='true'></i>Inicia Sesión</a>";
    }

    echo "</li>
          <li id='menu_moviles'><i class='fa fa-bars' aria-hidden='true'></i></a>
          <ul id='lista_movil'>
    	       <li id='registrarte2'>";
    
                if (isset($_SESSION['id_usuario'])) {
                    $tipo_usuario = $_SESSION['datos']['tipo_usuario'];
                    echo "<a href='../php/cerrarSesion.php' title='Cerrar sesión'>Cerrar Sesion</a>";
                } else {
                    echo "<a href='../FormularioRegistro/' title='Regístrate'>Regístrate</a>";
                }
                
                echo "</li>
                	  <li id='ini_sesion2'>";
    
                if (isset($_SESSION['id_usuario'])) {
                    $tipo_usuario = $_SESSION['datos']['tipo_usuario'];
                    switch ($tipo_usuario) {
                        case 1:
                            $destino = "../Usuario/";
                            break;
                        case 2:
                            $destino = "../Administrador/";
                            break;
                        
                        default:
                            $num = - 201;
                            $destino = "../FormularioInicioSesion/?num=$num";
                            break;
                    }
                    echo "<a href='" . $destino . "' title='" . $_SESSION['datos']['nick'] . "'>" . $_SESSION['datos']['nick'] . "</a>";
                } else {
                    echo "<a href='../FormularioInicioSesion/' title='Inicia sesión'>Inicia Sesión</a>";
                }
                echo "</li>";
                    
                if (strpos($_SERVER['REQUEST_URI'], "Relatos") !== false) {
                    // Relatos found
                    echo "<li id='autores2'><a href='#' title='Autores'>Autores</a>";
                    
                    $relato->mostrarAutores();
                    
                    echo "</li>";
                    
                    echo "<li id='titulos2'><a href='#' title='Titulos'>Títulos</a>";
                    
                    $relato->mostrarTitulos();
                    
                    echo "</li>";
                }
                      
                echo  "</ul>
                   </li>
                </ul>";

