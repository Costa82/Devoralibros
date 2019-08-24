<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Catering</title>
<link type="text/css" rel="stylesheet" href="../css/font-awesome.css" />

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

<!-- Metemos un aleatorio para la recarga automática del css y el js -->
<script>

    var rutacss1 = "../css/main.css?" + Math.random();
    var rutacss2 = "../jquery/jquery_menuMoviles_desplegable.js?" + Math.random();
    var rutacss3 = "../jquery/mostrar_menus_infantiles.js?" + Math.random();
    var script = "script";
    
    document.write('<link rel="stylesheet" href="' + rutacss1 + '" type="text/css" media="screen" />');
    document.write('<script src="' + rutacss2 + '"></' + script + '>');
    document.write('<script src="' + rutacss3 + '"></' + script + '>');
	
</script>

</head>
<body>
	<header>

		<div class="titulo_movil">
			<a href='../index.php' title='Inicio'><img
				src='../img/merendalia_logotipo_RGB-01.png' alt='Merendalia' /></a>
		</div>

		<nav>
          <?php include_once("menuNav.php");?>		
      	</nav>
	</header>

<div class="explicacion productos">

		<h3>Catering</h3>

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

	</div>

	<div class="contenedor_productos">

		<div class="select_productos">

			<strong>Selecciona el tipo de producto </strong> <select id="select"
				name="select">

				<option value="todo" select>Ver todo</option>
				<option value="entrantes">Entrantes</option>
				<option value="raciones">&nbsp;&nbsp;&nbsp;Raciones</option>
				<option value="canapes">&nbsp;&nbsp;&nbsp;Canapés</option>
				<option value="ensaladas">Ensaladas</option>
				<option value="guisos">Guisos</option>
				<option value="postres">Postres</option>
				<option value="menusCalentarListo">Menús calentar y listo</option>
				<option value="merienda">Merienda infantil</option>
				<option value="bebidas">Bebidas</option>
				<option value="refrescos">&nbsp;&nbsp;&nbsp;Refrescos</option>
				<option value="aguas">&nbsp;&nbsp;&nbsp;Aguas</option>
				<option value="cervezas">&nbsp;&nbsp;&nbsp;Cervezas</option>
				<option value="vinos">&nbsp;&nbsp;&nbsp;Vinos</option>
				<option value="licores">&nbsp;&nbsp;&nbsp;Licores</option>
				<option value="hielos">&nbsp;&nbsp;&nbsp;Hielos</option>

			</select>

		</div>

		<h3 class="titulo_entrante">ENTRANTES</h3>

		<ul class="lista_productos_comida">

			<li class="raciones">
				<div class="texto_producto_comida">
					<p>
						<u><strong>Raciones</strong></u>
					</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong></strong>
					</p>
				</div>
			</li>

			<li class="raciones">
				<div class="texto_producto_comida">
					<p>Nachos con guacamole casero</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>9 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!-- 					<p> -->
<!-- 						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!-- 							title="recogida en local"> -->
<!-- 					</p> -->
<!-- 				</div> -->
			</li>

			<li class="raciones">
				<div class="texto_producto_comida">
					<p>Croquetas de jamón (6 ud.)</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>9 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!-- 					<p> -->
<!-- 						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!-- 							title="recogida en local"> -->
<!-- 					</p> -->
<!-- 				</div> -->
			</li>

			<li class="raciones">
				<div class="texto_producto_comida">
					<p>Croquetas de bacalao (6 ud.)</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>9 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!-- 					<p> -->
<!-- 						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!-- 							title="recogida en local"> -->
<!-- 					</p> -->
<!-- 				</div> -->
			</li>
			
			<li class="raciones">
				<div class="texto_producto_comida">
					<p>Tortilla de patatas</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>9 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!-- 					<p> -->
<!-- 						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!-- 							title="recogida en local"> -->
<!-- 					</p> -->
<!-- 				</div> -->
			</li>

			<li class="raciones">
				<div class="texto_producto_comida">
					<p>Ración de queso curado de oveja</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>9 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!-- 					<p> -->
<!-- 						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!-- 							title="recogida en local"> -->
<!-- 					</p> -->
<!-- 				</div> -->
			</li>

			<li class="raciones">
				<div class="texto_producto_comida">
					<p>Ración de cecina</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>9 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!-- 					<p> -->
<!-- 						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!-- 							title="recogida en local"> -->
<!-- 					</p> -->
<!-- 				</div> -->
			</li>

			<li class="raciones">
				<div class="texto_producto_comida">
					<p>Ración de jamón ibérico</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>15 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!-- 					<p> -->
<!-- 						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!-- 							title="recogida en local"> -->
<!-- 					</p> -->
<!-- 				</div> -->
			</li>

			<li class="raciones">
				<div class="texto_producto_comida">
					<p>Ración grande de ibericos (jamón, lomo, chorizo y salchichón) y
						cecina.</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>25 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!-- 					<p> -->
<!-- 						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!-- 							title="recogida en local"> -->
<!-- 					</p> -->
<!-- 				</div> -->
			</li>

			<li class="raciones">
				<div class="texto_producto_comida">
					<p>Empanada de carne/atún (2 kg)</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>7,5 €/Kg</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!-- 					<p> -->
<!-- 						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!-- 							title="recogida en local"> -->
<!-- 					</p> -->
<!-- 				</div> -->
			</li>

			<li class="canapes">
				<div class="texto_producto_comida">
					<p>
						<u><strong>Canapés</strong></u>
					</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong></strong>
					</p>
				</div>
			</li>

			<li class="canapes">
				<div class="texto_producto_comida">
					<p>
						<i>&nbsp;&nbsp;<u>Por tipos:</u></i>
					</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong></strong>
					</p>
				</div>
			</li>

			<li class="canapes">
				<div class="texto_producto_comida">
					<p>Gildas (12 uds.)</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>12 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!-- 					<p> -->
<!-- 						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!-- 							title="recogida en local"> -->
<!-- 					</p> -->
<!-- 				</div> -->
			</li>

			<li class="canapes">
				<div class="texto_producto_comida">
					<p>Bombones de Foie (ud.)</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>2 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!-- 					<p> -->
<!-- 						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!-- 							title="recogida en local"> -->
<!-- 					</p> -->
<!-- 				</div> -->
			</li>

			<li class="canapes">
				<div class="texto_producto_comida">
					<p>Tartaletas de cabrales con nueces (12 uds.)</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>9,5 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!-- 					<p> -->
<!-- 						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!-- 							title="recogida en local"> -->
<!-- 					</p> -->
<!-- 				</div> -->
			</li>
			
			<li class="canapes">
				<div class="texto_producto_comida">
					<p>Mini Conos de tomate con brandada de bacalao (12 uds.)</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>10,5 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!-- 					<p> -->
<!-- 						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!-- 							title="recogida en local"> -->
<!-- 					</p> -->
<!-- 				</div> -->
			</li>

			<li class="canapes">
				<div class="texto_producto_comida">
					<p>
						<i>&nbsp;&nbsp;<u>Por bandejas:</u></i>
					</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong></strong>
					</p>
				</div>
			</li>

		</ul>

		<div class="canapes">

			<div class="menus_opciones">

				<p>
					<strong>Bandeja de 40 ud. variadas.</strong>
				</p>
				<p>
					<strong>Base de miga de pan y volován</strong>
				</p>
				<p>
					<strong>20 €</strong>
				</p>
				</br>
				<p>Canapé de salmón ahumado</p>
				</br>
				<p>Canapé de jamón serrano con aceitunas negras</p>
				</br>
				<p>Canapé de esparragos trigueros a la plancha</p>
				</br>
				<p>Volován de sobrasada con azucar de caña</p>
				</br>
				<p>Volován de aguacate con langostino y huevas</p>
				</br>

			</div>

			<div class="menus_opciones">

				<p>
					<strong>Bandeja de 40 ud. variadas.</strong>
				</p>
				<p>
					<strong>Tosta, tartaleta, crujiente, bolita y corneto</strong>
				</p>
				<p>
					<strong>35 €</strong>
				</p>
				</br>
				<p>Bolitas de queso con pistacho</p>
				</br>
				<p>Tosta de ventresca de atún y reducción de vinagreta</p>
				</br>
				<p>Tartaletas de cabrales con nueces</p>
				</br>
				<p>Corneto de foie con mango y polvo de pistacho</p>
				</br>
				<p>Pergamino crujiente de morcilla con manzana</p>

			</div>

		</div>


		<div class="ensaladas">

			<h3>ENSALADAS (para 4 personas)</h3>

			<ul class="lista_productos_comida">

				<li>
					<div class="texto_producto_comida">
						<p>Ensalada mixta</p>
					</div>
					<div class="precio_producto_comida">
						<p>
							<strong>6 €</strong>
						</p>
					</div>
<!-- 					<div class="recogida_producto_comida"> -->
<!--     					<p> -->
<!--     						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     							title="recogida en local"> -->
<!--     					</p> -->
<!--     				</div> -->
				</li>

				<li>
					<div class="texto_producto_comida">
						<p>Ensalada de ventresca aliñada con cocción de vinagreta</p>
					</div>
					<div class="precio_producto_comida">
						<p>
							<strong>12 €</strong>
						</p>
					</div>
<!-- 					<div class="recogida_producto_comida"> -->
<!--     					<p> -->
<!--     						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     							title="recogida en local"> -->
<!--     					</p> -->
<!--     				</div> -->
				</li>

				<li>
					<div class="texto_producto_comida">
						<p>Ensalada de tomate, aguacate, albahaca y sardina ahumada</p>
					</div>
					<div class="precio_producto_comida">
						<p>
							<strong>12 €</strong>
						</p>
					</div>
<!-- 					<div class="recogida_producto_comida"> -->
<!--     					<p> -->
<!--     						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     							title="recogida en local"> -->
<!--     					</p> -->
<!--     				</div> -->
				</li>
				<li>
					<div class="texto_producto_comida">
						<p>Ensalada suprema (cecina, cebolla caramelizada, paté, piñones,
							berberechos)</p>
					</div>
					<div class="precio_producto_comida">
						<p>
							<strong>14 €</strong>
						</p>
					</div>
<!-- 					<div class="recogida_producto_comida"> -->
<!--     					<p> -->
<!--     						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     							title="recogida en local"> -->
<!--     					</p> -->
<!--     				</div> -->
				</li>

			</ul>

		</div>

		<div class="guisos">

			<h3>GUISOS (mínimo 6 personas, precio por persona)</h3>

			<ul class="lista_productos_comida">

				<li><i>De la tierra</i></li>

				<li>
					<div class="texto_producto_comida">
						<p>“Goulash Soap”(ternera con patatas)</p>
					</div>
					<div class="precio_producto_comida">
						<p>
							<strong>5,5 €</strong>
						</p>
					</div>
<!-- 					<div class="recogida_producto_comida"> -->
<!--     					<p> -->
<!--     						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     							title="recogida en local"> -->
<!--     					</p> -->
<!--     				</div> -->
				</li>

				<li>
					<div class="texto_producto_comida">
						<p>Callos con garbanzos</p>
					</div>
					<div class="precio_producto_comida">
						<p>
							<strong>5 €</strong>
						</p>
					</div>
<!-- 					<div class="recogida_producto_comida"> -->
<!--     					<p> -->
<!--     						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     							title="recogida en local"> -->
<!--     					</p> -->
<!--     				</div> -->
				</li>

				<li>
					<div class="texto_producto_comida">
						<p>Redondo de ternera</p>
					</div>
					<div class="precio_producto_comida">
						<p>
							<strong>5,3 €</strong>
						</p>
					</div>
<!-- 					<div class="recogida_producto_comida"> -->
<!--     					<p> -->
<!--     						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     							title="recogida en local"> -->
<!--     					</p> -->
<!--     				</div> -->
				</li>

				<li>
					<div class="texto_producto_comida">
						<p>Caldereta de cordero</p>
					</div>
					<div class="precio_producto_comida">
						<p>
							<strong>6 €</strong>
						</p>
					</div>
<!-- 					<div class="recogida_producto_comida"> -->
<!--     					<p> -->
<!--     						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     							title="recogida en local"> -->
<!--     					</p> -->
<!--     				</div> -->
				</li>

				<li>
					<div class="texto_producto_comida">
						<p>Lasaña de carne</p>
					</div>
					<div class="precio_producto_comida">
						<p>
							<strong>5,5 €</strong>
						</p>
					</div>
<!-- 					<div class="recogida_producto_comida"> -->
<!--     					<p> -->
<!--     						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     							title="recogida en local"> -->
<!--     					</p> -->
<!--     				</div> -->
				</li>

				<li>
					<div class="texto_producto_comida">
						<p>Carrilleras de cerdo</p>
					</div>
					<div class="precio_producto_comida">
						<p>
							<strong>5,5 €</strong>
						</p>
					</div>
<!-- 					<div class="recogida_producto_comida"> -->
<!--     					<p> -->
<!--     						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     							title="recogida en local"> -->
<!--     					</p> -->
<!--     				</div> -->
				</li>

				<li><i>De la mar</i></li>

				<li>
					<div class="texto_producto_comida">
						<p>Bacalao a la vizcaína</p>
					</div>
					<div class="precio_producto_comida">
						<p>
							<strong>5,5 €</strong>
						</p>
					</div>
<!-- 					<div class="recogida_producto_comida"> -->
<!--     					<p> -->
<!--     						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     							title="recogida en local"> -->
<!--     					</p> -->
<!--     				</div> -->
				</li>

				<li>
					<div class="texto_producto_comida">
						<p>Patatas con almejas</p>
					</div>
					<div class="precio_producto_comida">
						<p>
							<strong>6,3 €</strong>
						</p>
					</div>
<!-- 					<div class="recogida_producto_comida"> -->
<!--     					<p> -->
<!--     						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     							title="recogida en local"> -->
<!--     					</p> -->
<!--     				</div> -->
				</li>

				<li>
					<div class="texto_producto_comida">
						<p>Merluza en salsa verde</p>
					</div>
					<div class="precio_producto_comida">
						<p>
							<strong>5,5 €</strong>
						</p>
					</div>
<!-- 					<div class="recogida_producto_comida"> -->
<!--     					<p> -->
<!--     						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     							title="recogida en local"> -->
<!--     					</p> -->
<!--     				</div> -->
				</li>

				<li>
					<div class="texto_producto_comida">
						<p>Marmitako</p>
					</div>
					<div class="precio_producto_comida">
						<p>
							<strong>6,5 €</strong>
						</p>
					</div>
<!-- 					<div class="recogida_producto_comida"> -->
<!--     					<p> -->
<!--     						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     							title="recogida en local"> -->
<!--     					</p> -->
<!--     				</div> -->
				</li>

				<li>
					<div class="texto_producto_comida">
						<p>Bonito con tomate</p>
					</div>
					<div class="precio_producto_comida">
						<p>
							<strong>6,5 €</strong>
						</p>
					</div>
<!-- 					<div class="recogida_producto_comida"> -->
<!--     					<p> -->
<!--     						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     							title="recogida en local"> -->
<!--     					</p> -->
<!--     				</div> -->
				</li>

			</ul>

		</div>

		<div class="postres">

			<h3>POSTRES (12 raciones de cada tarta)</h3>

			<ul class="lista_productos_comida">

				<li>
					<div class="texto_producto_comida">
						<p>Tarta de queso</p>
					</div>
					<div class="precio_producto_comida">
						<p>
							<strong>15 €</strong>
						</p>
					</div>
<!-- 					<div class="recogida_producto_comida"> -->
<!--     					<p> -->
<!--     						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     							title="recogida en local"> -->
<!--     					</p> -->
<!--     				</div> -->
				</li>

				<li>
					<div class="texto_producto_comida">
						<p>Tarta de manzana</p>
					</div>
					<div class="precio_producto_comida">
						<p>
							<strong>13,5 €</strong>
						</p>
					</div>
<!-- 					<div class="recogida_producto_comida"> -->
<!--     					<p> -->
<!--     						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     							title="recogida en local"> -->
<!--     					</p> -->
<!--     				</div> -->
				</li>

				<li>
					<div class="texto_producto_comida">
						<p>Tarta tres chocolates y bizcocho</p>
					</div>
					<div class="precio_producto_comida">
						<p>
							<strong>15 €</strong>
						</p>
					</div>
<!-- 					<div class="recogida_producto_comida"> -->
<!--     					<p> -->
<!--     						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     							title="recogida en local"> -->
<!--     					</p> -->
<!--     				</div> -->
				</li>

				<li>
					<div class="texto_producto_comida">
						<p>Tarta semifría de limón</p>
					</div>
					<div class="precio_producto_comida">
						<p>
							<strong>15 €</strong>
						</p>
					</div>
<!-- 					<div class="recogida_producto_comida"> -->
<!--     					<p> -->
<!--     						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     							title="recogida en local"> -->
<!--     					</p> -->
<!--     				</div> -->
				</li>

				<li>
					<div class="texto_producto_comida">
						<p>Tiramisú</p>
					</div>
					<div class="precio_producto_comida">
						<p>
							<strong>15 €</strong>
						</p>
					</div>
<!-- 					<div class="recogida_producto_comida"> -->
<!--     					<p> -->
<!--     						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     							title="recogida en local"> -->
<!--     					</p> -->
<!--     				</div> -->
				</li>

				<li>
					<div class="texto_producto_comida">
						<p>Tarta de zanahoria</p>
					</div>
					<div class="precio_producto_comida">
						<p>
							<strong>15 €</strong>
						</p>
					</div>
<!-- 					<div class="recogida_producto_comida"> -->
<!--     					<p> -->
<!--     						<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     							title="recogida en local"> -->
<!--     					</p> -->
<!--     				</div> -->
				</li>

			</ul>

		</div>

		<div class="menusCalentarListo">

			<h3>MENÚS CALENTAR Y LISTO</h3>

			<div class="menus_opciones">

				<p>
					<strong>Opción 1.</strong>
				</p>
				<p>
					<strong>21 € por persona</strong>
				</p>
				</br>
				<p>
					<i>Entrantes a compartir</i>
				</p>
				<p>Gildas</p>
				<p>Rollitos de cecina con paté de hígado de pato</p>
				<p>Calabacín relleno</p>
				</br>
				<p>
					<i>Primero</i>
				</p>
				<p>Ensalada de ventresca</p>
				</br>
				<p>
					<i>Segundo</i>
				</p>
				<p>A elegir un guiso de la sección "guisos", común para todo el
					grupo</p>
				</br>
				<p>
					<i>Postre</i>
				</p>
				<p>A elegir un postre de los de la sección "postres"</p>
				</br>
				<p>
					<i>Bebidas</i>
				</p>
				<p>Una botella de vino para tres personas a elegir Verdejo o Ribera,
					o un tercio de cerveza por persona, o un refresco o un agua.</p>
				</br>
				<p>Pan, café y chupitos incluido</p>

			</div>

			<div class="menus_opciones">

				<p>
					<strong>Opción 2.</strong>
				</p>
				<p>
					<strong>23 € por persona</strong>
				</p>
				</br>
				<p>
					<i>Entrantes</i>
				</p>
				<p>Vasito de aguacate y langostino</p>
				<p>Tartaleta de cabrales con nueces</p>
				<p>Bombón de foie</p>
				</br>
				<p>
					<i>Primero</i>
				</p>
				<p>Cóctel de marisco</p>
				</br>
				<p>
					<i>Segundo</i>
				</p>
				<p>A elegir un guiso de los de la lista, común para todo el grupo</p>
				</br>
				<p>
					<i>Postre</i>
				</p>
				<p>Tarta de tres chocolates</p>
				</br>
				<p>
					<i>Bebidas</i>
				</p>
				<p>Una botella de vino para tres personas a elegir Verdejo o Ribera,
					o una cerveza o un refresco o un agua.</p>
				</br>
				<p>Pan, café y chupitos incluido</p>

			</div>

		</div>

		<div class="merienda">

			<h3>MERIENDAS INFANTILES</h3>

			<div class="menus_opciones">

				<p>
					<strong>MENÚ CUMPLEAÑOS INFANTIL</strong>
				</p>
				<p>
					<strong>5,5 €</strong>
				</p>
				</br>
				<p>
					<i>Snacks variados</i>
				</p>
				</br>
				<p>
					<i>Bocaditos variados</i>
				</p>
				<p>Croissant vegetal</p>
				<p>Sandwich mixto</p>
				<p>Pollo con lechuga</p>
				<p>Atún con tomate</p>
				</br>
				<p>
					<i>Refrescos y agua</i>
				</p>
				</br>
				<p>
					<i>Postre: Brocheta de frutas con chocolate.</i>
				</p>
			</div>

			<div class="menus_opciones">
				<p>
					<strong>MERIENDA CUMPLEAÑOS INFANTIL</strong>
				</p>
				<p>
					<strong>2 €</strong>
				</p>
				</br>
				<p>
					<i>Snacks variados</i>
				</p>
				</br>
				<p>
					<i>Sandwich jamón y queso</i>
				</p>
				</br>
				<p>
					<i>Zumo y agua</i>
				</p>
			</div>

		</div>

		<h3 class="titulo_bebida">BEBIDA</h3>

		<ul class="lista_productos_comida">

			<li class="refrescos">
				<div class="texto_producto_comida">
					<p>
						<u><strong>Refrescos</strong></u>
					</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong></strong>
					</p>
				</div>
			</li>

			<li class="refrescos">
				<div class="texto_producto_comida">
					<p>Coca-cola normal</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>1 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!--     				<p> -->
<!--     					<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     						title="recogida en local"> -->
<!--     				</p> -->
<!--     			</div> -->
			</li>

			<li class="refrescos">
				<div class="texto_producto_comida">
					<p>Fanta naranja</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>1 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!--     				<p> -->
<!--     					<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     						title="recogida en local"> -->
<!--     				</p> -->
<!--     			</div> -->
			</li>

			<li class="refrescos">
				<div class="texto_producto_comida">
					<p>Fanta limón</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>1 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!--     				<p> -->
<!--     					<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     						title="recogida en local"> -->
<!--     				</p> -->
<!--     			</div> -->
			</li>

			<li class="refrescos">
				<div class="texto_producto_comida">
					<p>Tónica Schweppes</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>1 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!--     				<p> -->
<!--     					<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     						title="recogida en local"> -->
<!--     				</p> -->
<!--     			</div> -->
			</li>

			<li class="aguas">
				<div class="texto_producto_comida">
					<p>
						<u><strong>Aguas</strong></u>
					</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong></strong>
					</p>
				</div>
			</li>

			<li class="aguas">
				<div class="texto_producto_comida">
					<p>Agua Solán de Cabras pequeña</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>1 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!--     				<p> -->
<!--     					<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     						title="recogida en local"> -->
<!--     				</p> -->
<!--     			</div> -->
			</li>

			<li class="aguas">
				<div class="texto_producto_comida">
					<p>Agua Solán de Cabras grande</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>1,5 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!--     				<p> -->
<!--     					<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     						title="recogida en local"> -->
<!--     				</p> -->
<!--     			</div> -->
			</li>

			<li class="cervezas">
				<div class="texto_producto_comida">
					<p>
						<u><strong>Cervezas</strong></u>
					</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong></strong>
					</p>
				</div>
			</li>
			<li class="cervezas">

				<div class="texto_producto_comida">
					<p>Cerveza Mahou</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>1 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!--     				<p> -->
<!--     					<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     						title="recogida en local"> -->
<!--     				</p> -->
<!--     			</div> -->
			</li>

			<li class="cervezas">
				<div class="texto_producto_comida">
					<p>Cerveza Mahou Sin</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>1 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!--     				<p> -->
<!--     					<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     						title="recogida en local"> -->
<!--     				</p> -->
<!--     			</div> -->
			</li>

			<li class="cervezas">
				<div class="texto_producto_comida">
					<p>Cerveza Mahou 0,0 Tostada</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>1 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!--     				<p> -->
<!--     					<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     						title="recogida en local"> -->
<!--     				</p> -->
<!--     			</div> -->
			</li>
			
			<li class="vinos">
				<div class="texto_producto_comida">
					<p>
						<u><strong>Vinos</strong></u>
					</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong></strong>
					</p>
				</div>
			</li>

			<li class="vinos">
				<div class="texto_producto_comida">
					<p>Vino tinto D.O. Ribera Pinna Fidelis</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>10 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!--     				<p> -->
<!--     					<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     						title="recogida en local"> -->
<!--     				</p> -->
<!--     			</div> -->
			</li>
			
			<li class="vinos">
				<div class="texto_producto_comida">
					<p>Vino tinto D.O. Ribera Carramimbre</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>9,5 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!--     				<p> -->
<!--     					<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     						title="recogida en local"> -->
<!--     				</p> -->
<!--     			</div> -->
			</li>

			<li class="vinos">
				<div class="texto_producto_comida">
					<p>Vino tinto D.O. Ribera Viña Mayor</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>9,5 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!--     				<p> -->
<!--     					<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     						title="recogida en local"> -->
<!--     				</p> -->
<!--     			</div> -->
			</li>
			
			<li class="vinos">
				<div class="texto_producto_comida">
					<p>Vino tinto D.O. Cigales Félix Salas</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>7 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!--     				<p> -->
<!--     					<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     						title="recogida en local"> -->
<!--     				</p> -->
<!--     			</div> -->
			</li>
			
			<li class="vinos">
				<div class="texto_producto_comida">
					<p>Vino blanco D.O. Ruedo Monasterio de Palazuelos</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>9 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!--     				<p> -->
<!--     					<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     						title="recogida en local"> -->
<!--     				</p> -->
<!--     			</div> -->
			</li>

			<li class="vinos">
				<div class="texto_producto_comida">
					<p>Finca Valdemoya Frizzante Verdejo</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>9 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!--     				<p> -->
<!--     					<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     						title="recogida en local"> -->
<!--     				</p> -->
<!--     			</div> -->
			</li>
			
			<li class="vinos">
				<div class="texto_producto_comida">
					<p>Vino Blanco Verdejo "Campos de Delibes"</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>7 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!--     				<p> -->
<!--     					<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     						title="recogida en local"> -->
<!--     				</p> -->
<!--     			</div> -->
			</li>

			<li class="vinos">
				<div class="texto_producto_comida">
					<p>Vino Rosado D.O. Cigales Sinfo</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>8 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!--     				<p> -->
<!--     					<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     						title="recogida en local"> -->
<!--     				</p> -->
<!--     			</div> -->
			</li>

			<li class="licores">
				<div class="texto_producto_comida">
					<p>
						<u><strong>Licores</strong></u>
					</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong></strong>
					</p>
				</div>
			</li>

			<li class="licores">
				<div class="texto_producto_comida">
					<p>Ginebra Seagram´s 70 cl</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>19 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!--     				<p> -->
<!--     					<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     						title="recogida en local"> -->
<!--     				</p> -->
<!--     			</div> -->
			</li>

			<li class="licores">
				<div class="texto_producto_comida">
					<p>Whisky Ballantines 70cl</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>16,5 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!--     				<p> -->
<!--     					<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     						title="recogida en local"> -->
<!--     				</p> -->
<!--     			</div> -->
			</li>

			<li class="licores">
				<div class="texto_producto_comida">
					<p>Ron Brugal 70cl</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>16,5 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!--     				<p> -->
<!--     					<img alt="recogida en local" src="../img/icono_para_llevar.png" -->
<!--     						title="recogida en local"> -->
<!--     				</p> -->
<!--     			</div> -->
			</li>

			<li class="licores">
				<div class="texto_producto_comida">
					<p>Vodka Absolut 70cl</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>16,5 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!--     				<p> -->
<!--     					<img alt="no recogida en local" src="../img/no_icono_para_llevar.png" -->
<!--     						title="no recogida en local"> -->
<!--     				</p> -->
<!--     			</div> -->
			</li>

			<li class="hielos">
				<div class="texto_producto_comida">
					<p>
						<u><strong>Hielos</strong></u>
					</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong></strong>
					</p>
				</div>
			</li>
			<li class="hielos">
				<div class="texto_producto_comida">
					<p>Bolsa de hielo</p>
				</div>
				<div class="precio_producto_comida">
					<p>
						<strong>1,5 €</strong>
					</p>
				</div>
<!-- 				<div class="recogida_producto_comida"> -->
<!--     				<p> -->
<!--     					<img alt="no recogida en local" src="../img/no_icono_para_llevar.png" -->
<!--     						title="no recogida en local"> -->
<!--     				</p> -->
<!--     			</div> -->
			</li>

		</ul>

	</div>

	<footer>
        <?php include_once("footer.php");?>        
    </footer>

</body>
</html>