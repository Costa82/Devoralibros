<?php
// Menú principal para todas las páginas de visor de libros, noticias, librerías, etc.
echo "<ul id='lista_principal'>
        <li id='inicio'><a href='../Inicio' title='Inicio'><img src='../img/DEVORALIBROS_8_72ppi.png' alt='Devoralibros'/></a></li>
		<li id='registrarte'>";
			if(isset($_SESSION['id_usuario'])){
                            echo "<a href='../php/cerrarSesion.php' title='Cerrar sesión'><i class='fa fa-unlock-alt' aria-hidden='true'></i>Cerrar Sesión</a>";
                        } else {
                            echo "<a href='../FormularioRegistro/' title='Regístrate'><i class='fa fa-unlock-alt' aria-hidden='true'></i>Regístrate</a>";
			}
                echo "</li>
                <li id='ini_sesion'>";
			if(isset($_SESSION['id_usuario'])){
                            $tipo_usuario=$_SESSION['datos']['tipo_usuario'];
                            switch ($tipo_usuario){
                            case 1:
                                $destino="../Usuario/";
                            break;
                            case 2:
                                $destino="../Administrador/";
                            break;
                            
                            default:
                                $num=-201;
                                $destino="../FormularioInicioSesion/?num=$num";
                            break;
                        }
			echo "<a href='".$destino."' title='".$_SESSION['datos']['nick']."'>";
                  if ($foto!=null) {
                       echo "<img src='../fotos/".$foto."' alt='Foto de perfil'>";
                  }
                  echo "</a>";
              
			} else {
                            echo "<a href='../FormularioInicioSesion/' title='Inicia sesión'><i class='fa fa-user' aria-hidden='true'></i>Inicia Sesión</a>" ;
			}
                echo "</li>
		<li id='menu_moviles'><i class='fa fa-bars' aria-hidden='true'></i></a>
                    <ul id='lista_movil'>
			<li id='registrarte2'>";
                            if(isset($_SESSION['id_usuario'])){
				$tipo_usuario=$_SESSION['datos']['tipo_usuario'];
                                echo "<a href='cerrarSesion.php' title='Cerrar sesión'>Cerrar Sesion</a>";
				} else {
                                    echo "<a href='../FormularioRegistro/' title='Regístrate'>Regístrate</a>";
				}
			echo "</li>
			<li id='ini_sesion2'>";
                            if(isset($_SESSION['id_usuario'])){
				$tipo_usuario=$_SESSION['datos']['tipo_usuario'];
		            switch ($tipo_usuario){
		                case 1:
                                    $destino="../Usuario/";
		                break;
		                case 2:
		                    $destino="../Administrador/";
		                break;
		                
		                default:
		                    $num=-201;
		                    $destino="../FormularioInicioSesion/?num=$num";
		                break;
		            }
                            echo "<a href='".$destino."' title='".$_SESSION['datos']['nick']."'>".$_SESSION['datos']['nick']."</a>";
                            } else {
				echo "<a href='../FormularioInicioSesion/' title='Inicia sesión'>Inicia Sesión</a>" ;
                            }
			echo "</li>
                    </ul>
                </li>
            </ul>";

