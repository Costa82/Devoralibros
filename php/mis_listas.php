<div class="lista">
    <div class="crearlistas">        
        <h2>Crea tu lista</h2>
        <?php
            require_once '../inc/definesLista.inc.php';
            require_once '../inc/validacionesLista.inc.php';
            require_once "../clases/Lista.php";
            $lista=new Lista();
            $id=$_SESSION['datos']['id_usuario'];
            if(isset($_REQUEST['addLista'])){
                // Si hemos añadido el nombre de la lista y la descripción se añade la lista
               if(isset($_REQUEST['nombrelista']) AND ($_REQUEST['descripcion'])){
                    $nombrelista=$_REQUEST['nombrelista']; 
                    $descripcion=$_REQUEST['descripcion'];
                    $num=$lista->addLista($id_usuario,$nombrelista,$descripcion);
                    $resultado= validacionAddLista($num);
                    if ($num==-402){
                        echo "<h3 class='noerror'>".$resultado."</h3>";
                    }
                    elseif ($num==-400){
                        echo "<h3 class='error'>".$resultado."</h3>";
                    }
                    elseif ($num==-401) {
                        echo "<h3 class='error'>".$resultado."</h3>";
                    }
              }else{
                echo "<h3 class='error'>NO SE HA PODIDO CREAR LA LISTA</h3>"; 
              }
            }
        ?>
        <form  action="" method="post" id="formSubirNoticia">
            <p>Introduce el nombre de la nueva lista</p>
            <input type="text" name="nombrelista" size="40" required="required"/>
            <p>Descripción de la nueva lista</p>
            <textarea name="descripcion" rows="10" cols="40" required="required"></textarea>
            <div class="botones">
                <button type="submit" name="addLista" class="boton">Crear</button>
            </div>
        </form>
    </div>
    <div class="listas">
        <h2>Mis listas</h2>
        <?php
            $lista->mostrarListas($id);
        ?>
    </div>
</div>
<script>
function confirmar()
{
	if(confirm('¿Estás seguro de eliminarlo?'))
		return true;
	else
		return false;
}
</script>
