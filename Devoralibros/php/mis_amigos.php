<div class='amistad'>
	<div class='amigos'>
		<h2>Amigos</h2>
    
    <?php
    if (isset($_REQUEST['error'])) {
        echo '<p style="color:red">' . $error . "</p>";
    }
    
    require_once '../inc/funciones.php';
    require_once '../inc/validaciones.inc.php';
    require_once '../clases/Connection.php';
    include_once ('../clases/Usuario.php');
    $bd = Connection::dameInstancia();
    $c = $bd->dameConexion();
    $usuario = new Usuario();
    $nick = $_SESSION['datos']['nick'];
    $id_usuario = $_SESSION['datos']['id_usuario'];
    $tipo_usuario = $_SESSION['datos']['tipo_usuario'];
    
    // Muestra todos los amigos de un usuario
    $sql = "SELECT A.id_usuario2 FROM usuarios_amigos A, usuarios B WHERE A.id_usuario1=B.id_usuario AND A.estado=2 AND A.id_usuario1='" . $id_usuario . "'";
    
    if ($c->real_query($sql)) {
        
        if ($resul = $c->store_result()) {
            
            if ($resul->num_rows > 0) {
                echo '<ul>';
                
                while ($mostrar = $resul->fetch_assoc()) {
                    $id2 = $mostrar["id_usuario2"];
                    $estadoId2 = $usuario->getEstado($id2);
                    
                    if ( $estadoId2 == 'ALTA' ) {
                        $nickAmigo = $usuario->getNick($id2);
                        echo "<li><a href='../php/eliminar_amigo_header.php?id1=" . $id_usuario . "&id2=" . $id2 . "' onclick='return confirmar()'> <i class='fa fa-trash-o' aria-hidden='true' title='borrar amigo'></i></a><a href='../Amigo/?nickAmigo=" . md5($nickAmigo) . "&tipo_usuario=" . $tipo_usuario . "&id1=" . $id_usuario . "'>" . $nickAmigo . " </a></li>";
                    }
                }
                echo '</li></ul>';
            } else {
                $resul->free_result();
            }
        }
    } else {
        echo $c->errno . " -> " . $c->error;
    }
    
    ?>
    </div>
	<div class="buscadorAmigos">
		<h2>Buscador</h2>
        <?php
        if (isset($_REQUEST['error'])) {
            echo '<p style="color:red">' . $error . "</p>";
        }
        ?>
        <form accept-charset="utf-8" method="POST">
			<label>Introduce el Nick </label><input type="text" name="busqueda"
				id="busqueda" value="" placeholder="Nick..." maxlength="30"
				autocomplete="off" onKeyUp="buscar();" />
		</form>
		<div id="resultadoBusqueda"></div>
	</div>
	<div class="solicitudes">
		<h2>Solicitudes</h2>
        <?php
        $bd = Connection::dameInstancia();
        $c = $bd->dameConexion();
        $usuario = new Usuario();
        $sql = "SELECT A.id_usuario2 FROM usuarios_amigos A, usuarios B WHERE A.id_usuario1=B.id_usuario AND A.estado=1 AND A.id_usuario1='" . $id_usuario . "'";
        
        if ($c->real_query($sql)) {
            
            if ($resul = $c->store_result()) {
                
                if ($resul->num_rows > 0) {
                    echo '<ul>';
                   
                    while ($mostrar = $resul->fetch_assoc()) {
                        $id = $mostrar["id_usuario2"];
                        $estadoId = $usuario->getEstado($id);
                        
                        if ( $estadoId == 'ALTA' ) {
                            $nick = $usuario->getNick($id);
                            echo "<li><i class='fa fa-spinner fa-pulse fa-3x fa-fw' title='solicitud pendiente de aprobación'></i>" . $nick . "...</li>";
                        }
                    }
                    echo '</li></ul>';
                } else {
                    $resul->free_result();
                }
            }
        } else {
            echo $c->errno . " -> " . $c->error;
        }
        
        $sql = "SELECT A.id_usuario1,A.id_usuario2 FROM usuarios_amigos A, usuarios B WHERE A.id_usuario1=B.id_usuario AND A.estado=1 AND A.id_usuario2='" . $id_usuario . "'";
        if ($c->real_query($sql)) {
            if ($resul = $c->store_result()) {
                if ($resul->num_rows > 0) {
                    echo '<ul>';
                    
                    while ($mostrar = $resul->fetch_assoc()) {
                        $id1 = $mostrar["id_usuario1"];
                        $id2 = $mostrar["id_usuario2"];
                        
                        $estadoId1 = $usuario->getEstado($id1);
                        $estadoId2 = $usuario->getEstado($id2);
                        
                        if ( $estadoId1 == 'ALTA' && $estadoId1 == 'ALTA' ) {
                            $nick = $usuario->getNick($id1);
                            echo "<li><a href='../php/mis_amigos_header.php?id1=" . $id1 . "&id2=" . $id2 . "'><i class='fa fa-check-circle' title='aceptar solicitud'></i></a>" . $nick . "...</li>";
                        }
                        
                    }
                    echo '</li></ul>';
                } else {
                    $resul->free_result();
                }
            }
        } else {
            echo $c->errno . " -> " . $c->error;
        }
        ?>
    </div>
</div>

<script>
$(document).ready(function(){
    $("#resultadoBusqueda").html('<p>No hay resultados</p>');
});

function buscar() {
    var textoBusqueda = $("input#busqueda").val();
    var valorBusqueda = textoBusqueda;
    var id1="<?=$id_usuario?>";
     if (textoBusqueda != "") {
        $.post("../php/buscadorAmigo.php", {valorBusqueda,id1}, function(mensaje) {
            $("#resultadoBusqueda").html(mensaje);
         }); 
     } else { 
        $("#resultadoBusqueda").html('<p>No hay resultados</p>');
        };
};

function confirmar()
{
	if(confirm('¿Estás seguro de eliminar a este amigo?'))
		return true;
	else
		return false;
}
</script>