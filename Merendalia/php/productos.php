<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Productos</title>
<link type="text/css" rel="stylesheet" href="../css/font-awesome.css" />

<script>
    var rutacss1 = "../css/main.css?" + Math.random();
    document.write('<link rel="stylesheet" href="' + rutacss1 + '" type="text/css" media="screen" />'); 
</script>

<link href='https://fonts.googleapis.com/css?family=Pathway+Gothic+One'
	rel='stylesheet' type='text/css' />
<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah"
	rel="stylesheet">

<link href="../apple-touch-icon.png" rel="apple-touch-icon" />
<link href="../apple-touch-icon-152x152.png" rel="apple-touch-icon"
	sizes="152x152" />
<link href="../apple-touch-icon-167x167.png" rel="apple-touch-icon"
	sizes="167x167" />
<link href="../apple-touch-icon-180x180.png" rel="apple-touch-icon"
	sizes="180x180" />
<link href="../icon-hires.png" rel="icon" sizes="192x192" />
<link href="../icon-normal.png" rel="icon" sizes="128x128" />

<script src="../jquery/jquery-3.1.1.min.js"></script>
<script src="../jquery/ocultar_productos.js"></script>
<script src="../jquery/jquery_menuMoviles_desplegable.js"></script>

</head>
<body>
	<header>

<!-- 		<div class="titulo_movil"> -->
<!-- 			<a href='../index.php' title='Inicio'><img -->
<!-- 				src='../img/merendalia_logotipo_RGB-01.png' alt='Merendalia' /></a> -->
<!-- 		</div> -->

		<nav>
          <?php include_once("menuNav.php");?>		
      	</nav>

	</header>
	
	<div class="contenedor_productos">

		<p>
			En esta sección podrás ver todos los productos que tenemos preparados
			para aderezar tus reuniones y fiestas en Merendalia. Si no tienes
			tiempo para preparar nada, cuando reserves el espacio, podrás
			contratarnos productos de esta sección y ¡ser el anfitrión que
			querías ser sin necesidad de mover un dedo! </br> </br> De todas
			formas, como seguro que tienes alguna idea que no está en esta
			sección, ¡no dudes en llamarnos para ver si podemos incluirla!
			Queremos que disfrutes y estés a gusto.
		</p>
		
		<div class="select_productos">
	
			<strong>Selecciona el tipo de producto </strong>
    		<select id="select" name="select">
              	<option value="todo" select>Ver todo</option> 
              	<option value="bebidas">Bebidas</option> 
              	<option value="refrescos">&nbsp;&nbsp;&nbsp;Refrescos</option>
              	<option value="cervezas">&nbsp;&nbsp;&nbsp;Cervezas</option>
              	<option value="vinos">&nbsp;&nbsp;&nbsp;Vinos</option>
              	<option value="comida">Comida</option>
            </select>
    	
    	</div>
    	
   		<h3 class="titulo_bebida">BEBIDA</h3>

		<ul class="lista_productos">
		
        	<li class="cervezas">
        	
        		<div class="img_producto">
        			<img src='../img/Cerveza mahou cinco estrellas.jpg'
        				title='Cerveza mahou cinco estrellas'/>
        		</div>
        		<div class="texto_producto">
        			<p>CERVEZA MAHOU CINCO ESTRELLAS, Pack de 6</p>
        		</div>
        		<div class="precio_producto">
        			<p>
        				<strong>6,5 €</strong>
        			</p>
        		</div>
        	</li>
        
        	<li class="cervezas">
        		<div class="img_producto">
        			<img src='../img/Cerveza mahou clásica.jpg'
        				title='Cerveza mahou clásica'/>
        		</div>
        		<div class="texto_producto">
        			<p>CERVEZA MAHOU CLÁSICA, Pack de 6</p>
        		</div>
        		<div class="precio_producto">
        			<p>
        				<strong>5,9 €</strong>
        			</p>
        		</div>
        	</li>
    
        	<li class="refrescos">
        	
        		<div class="img_producto">
        			<img src='../img/COCA COLA.jpg' title='COCA COLA'/>
        		</div>
        		<div class="texto_producto">
        			<p>COCA-COLA NORMAL</p>
        		</div>
        		<div class="precio_producto">
        			<p>
        				<strong>1,2 €</strong>
        			</p>
        		</div>
        	</li>
        
        	<li class="refrescos">
        		<div class="img_producto">
        			<img src='../img/COCA COLAS ZERO.jpg' title='COCA-COLA ZERO'/>
        		</div>
        		<div class="texto_producto">
        			<p>COCA-COLA ZERO</p>
        		</div>
        		<div class="precio_producto">
        			<p>
        				<strong>1,2 €</strong>
        			</p>
        		</div>
        	</li>
        
        	<li class="refrescos">
        		<div class="img_producto">
        			<img src='../img/COCA COLAS LIGHT.jpg' title='COCA COLAS LIGHT'/>
        		</div>
        		<div class="texto_producto">
        			<p>COCA COLAS LIGHT</p>
        		</div>
        		<div class="precio_producto">
        			<p>
        				<strong>1,2 €</strong>
        			</p>
        		</div>
        	</li>
        
        	<li class="refrescos">
        		<div class="img_producto">
        			<img src='../img/FANTA NARANJA.jpg' title='FANTA NARANJA'/>
        		</div>
        		<div class="texto_producto">
        			<p>FANTA NARANJA</p>
        		</div>
        		<div class="precio_producto">
        			<p>
        				<strong>1,2 €</strong>
        			</p>
        		</div>
        	</li>
        
        	<li class="refrescos">
        		<div class="img_producto">
        			<img src='../img/FANTA LIMÓN.jpg' title='FANTA LIMÓN'/>
        		</div>
        		<div class="texto_producto">
        			<p>FANTA LIMÓN</p>
        		</div>
        		<div class="precio_producto">
        			<p>
        				<strong>1,2 €</strong>
        			</p>
        		</div>
        	</li>
        
        	<li class="refrescos">
        		<div class="img_producto">
        			<img src='../img/SEVEN UP.jpg' title='SEVEN`UP'/>
        		</div>
        		<div class="texto_producto">
        			<p>SEVEN`UP</p>
        		</div>
        		<div class="precio_producto">
        			<p>
        				<strong>1,4 €</strong>
        			</p>
        		</div>
        	</li>
        
        	<li class="refrescos">
        		<div class="img_producto">
        			<img src='../img/AGUA SOLAN DE CABRAS PEQUEÑA.png'
        				title='AGUA SOLAN DE CABRAS PEQUEÑA'/>
        		</div>
        		<div class="texto_producto">
        			<p>AGUA SOLAN DE CABRAS PEQUEÑA</p>
        		</div>
        		<div class="precio_producto">
        			<p>
        				<strong>1,2 €</strong>
        			</p>
        		</div>
        	</li>
        
        	<li class="refrescos">
        		<div class="img_producto">
        			<img src='../img/AGUA SOLAN DE CABRAS GRANDE.jpg'
        				title='AGUA SOLAN DE CABRAS GRANDE'/>
        		</div>
        		<div class="texto_producto">
        			<p>AGUA SOLAN DE CABRAS GRANDE</p>
        		</div>
        		<div class="precio_producto">
        			<p>
        				<strong>1,8 €</strong>
        			</p>
        		</div>
        	</li>
        	
        	<li class="vinos">
        	
        		<div class="img_producto">
        			<img src='../img/CARRAMIMBRE VINO.png'
        				title='VINO TINTO D.O. RIBERA CARRAMIMBRE'/>
        		</div>
        		<div class="texto_producto">
        			<p>VINO TINTO D.O. RIBERA CARRAMIMBRE</p>
        		</div>
        		<div class="precio_producto">
        			<p>
        				<strong>9,5 €</strong>
        			</p>
        		</div>
        	</li>
        
        	<li class="vinos">
        		<div class="img_producto">
        			<img src='../img/PINNA FIDELIS VINO.jpg'
        				title='VINO TINTO D.O. RIBERA PINNA FIDELIS'/>
        		</div>
        		<div class="texto_producto">
        			<p>VINO TINTO D.O. RIBERA PINNA FIDELIS</p>
        		</div>
        		<div class="precio_producto">
        			<p>
        				<strong>10 €</strong>
        			</p>
        		</div>
        	</li>
        
        	<li class="vinos">
        		<div class="img_producto">
        			<img src='../img/monasterio-de-palazuelos-verdejo.jpg'
        				title='VINO BLANCO D.O. RUEDA MONASTERIO DE PALAZUELOS'/>
        		</div>
        		<div class="texto_producto">
        			<p>VINO BLANCO D.O. RUEDA MONASTERIO DE PALAZUELOS</p>
        		</div>
        		<div class="precio_producto">
        			<p>
        				<strong>8 €</strong>
        			</p>
        		</div>
        	</li>
        
        	<li class="vinos">
        		<div class="img_producto">
        			<img src='../img/FINCA VALDEMOYA FRIZZANTE VERDEJO.jpg'
        				title='FINCA VALDEMOYA FRIZZANTE VERDEJO'/>
        		</div>
        		<div class="texto_producto">
        			<p>FINCA VALDEMOYA FRIZZANTE VERDEJO</p>
        		</div>
        		<div class="precio_producto">
        			<p>
        				<strong>9 €</strong>
        			</p>
        		</div>
        	</li>
        
        	<li class="vinos">
        		<div class="img_producto">
        			<img src='../img/VIÑA PICOTA VINO ROSADO D.O. CIGALES.jpg'
        				title='VIÑA PICOTA ROSADO D.O. CIGALES'/>
        		</div>
        		<div class="texto_producto">
        			<p>VIÑA PICOTA ROSADO D.O. CIGALES</p>
        		</div>
        		<div class="precio_producto">
        			<p>
        				<strong>8 €</strong>
        			</p>
        		</div>
        	</li>
        		
		</ul>
		
		<div class="comida">

    		<h3>COMIDA</h3>
    
    		<p>Toda esta sección se compone de platos realizados por nuestro
    			catering, caseros y con mucho amor, échala de vez en cuando un
    			vistazo porque vamos añadiendo nuevos platos ¡esperamos que te
    			gusten!</p>
    
    		<ul class="lista_productos_comida">
    
    			<li>
    				<div class="img_producto_comida">
    					<img src='../img/Empanada2.jpg' title='EMPANADA DE ATÚN'
    						/>
    				</div>
    				<div class="texto_producto_comida">
    					<p>EMPANADA DE ATÚN (2kgs aprox.)</p>
    				</div>
    				<div class="precio_producto_comida">
    					<p>
    						<strong>17 €</strong>
    					</p>
    				</div>
    			</li>
    
    			<li>
    				<div class="img_producto_comida">
    					<img src='../img/Empanada2.jpg' title='EMPANADA DE CARNE'
    						/>
    				</div>
    				<div class="texto_producto_comida">
    					<p>EMPANADA DE CARNE (2kgs aprox.)</p>
    				</div>
    				<div class="precio_producto_comida">
    					<p>
    						<strong>17 €</strong>
    					</p>
    				</div>
    			</li>
    
    			<li>
    				<div class="img_producto_comida">
    					<img src='../img/Huevos rellenos.jpg' title='HUEVOS RELLENOS'
    						/>
    				</div>
    				<div class="texto_producto_comida">
    					<p>HUEVOS RELLENOS (Ración de 10 medios huevos)</p>
    				</div>
    				<div class="precio_producto_comida">
    					<p>
    						<strong>8,5 €</strong>
    					</p>
    				</div>
    			</li>
    
    			<li>
    				<div class="img_producto_comida">
    					<img src='../img/gildas.jpg' title='GILDAS'
    						/>
    				</div>
    				<div class="texto_producto_comida">
    					<p>GILDAS (por unidades)</p>
    				</div>
    				<div class="precio_producto_comida">
    					<p>
    						<strong>1 €</strong>
    					</p>
    				</div>
    			</li>
    
    			<li>
    				<div class="img_producto_comida">
    					<img src='../img/guacamole aguacate nachos.jpg'
    						title='NACHOS CON GUACAMOLE' />
    				</div>
    				<div class="texto_producto_comida">
    					<p>NACHOS CON GUACAMOLE</p>
    				</div>
    				<div class="precio_producto_comida">
    					<p>
    						<strong>9 €</strong>
    					</p>
    				</div>
    			</li>
    
    			<li>
    				<div class="img_producto_comida">
    					<img src='../img/tortilla de patata.jpg' title='TORTILLA DE PATATA'
    						 />
    				</div>
    				<div class="texto_producto_comida">
    					<p>
    						TORTILLA DE PATATA (con o sin cebolla)* </br> </br> *Se puede
    						hacer de más cosas, consultar ingredientes y precios.
    					</p>
    				</div>
    				<div class="precio_producto_comida">
    					<p>
    						<strong>8 €</strong>
    					</p>
    				</div>
    			</li>
    
    			<li>
    				<div class="img_producto_comida">
    					<img src='../img/patatas ali oli.jpg' title='PATATAS ALI-OLI' />
    				</div>
    				<div class="texto_producto_comida">
    					<p>PATATAS ALI-OLI</p>
    				</div>
    				<div class="precio_producto_comida">
    					<p>
    						<strong>3,5 €</strong>
    					</p>
    				</div>
    			</li>
    
    			<li>
    				<div class="img_producto_comida">
    					<img src='../img/queso grande (1 cuña).jpg'
    						title='RACIÓN DE QUESO CURADO DE OVEJA' class="queso" />
    				</div>
    				<div class="texto_producto_comida">
    					<p>RACIÓN DE QUESO CURADO DE OVEJA (2 tipos)</p>
    				</div>
    				<div class="precio_producto_comida">
    					<p>
    						<strong>9 €</strong>
    					</p>
    				</div>
    			</li>
    
    		</ul>
    		
    	</div>

	</div>

	<footer>
        <?php include_once("footer.php");?>        
    </footer>

</body>
</html>