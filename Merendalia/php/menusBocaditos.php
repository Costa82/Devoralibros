<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Menús bocaditos</title>
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
	
	
	<?php include_once("menusInfantiles.php");?>

	<!-- EXPLICACIÓN -->

	<div class="explicacion">
		<p>
			En esta sección podréis ir viendo los menús que hemos diseñado para
			vosotros. Cualquiera de ellos se pueden solicitar para tener un
			encuentro privado en <strong>merendalia.</strong> Se establece un
			mínimo de 12 personas (menús) para poder organizar un menú privado.</br>
			</br>Os aseguráis con esto las ventajas de disponer de un local
			privado y las de un restaurante, ser atendidos en exclusiva y no
			preocuparos de nada más. Los niños* podrán disfrutar del parque de
			bolas mientras los mayores comen o disfrutan de la sobremesa.</br> </br>La
			duración del evento con uno de estos menús es de 3 horas.</br> </br>*
			Existe la posibilidad de pedir menú infantil. Puedes verlos <a
				href='' class='mostrar_menus'><strong><i>aquí</i></strong></a>.
		</p>
	</div>
	
	<!-- FIN EXPLICACIÓN -->
	
	<!-- CONTENEDOR PARA MENÚSN -->
	
	<div class="contenedor_menus lista_menus">

		<h3>NUESTROS MENÚS</h3>

		<div class="menu">

			<div class="texto_menu">

				<p>Ven a disfrutar en Merendalia de tus cenas y comidas privadas en cualquier momento del año y cuando mejor os venga,
				 Estos son los menús que os hemos preparado para que
					disfrutéis como nunca de vuestros encuentros con vuestros amigos, familiares... ¡esperamos
					que os gusten! y estad atentos, ya que iremos subiendo menús nuevos ¡para que sigáis disfrutando!.</p>
					<p>En merendalia, ¡no nos gusta la rutina!.</p>
					<p>No os podéis perder los dos NUEVOS MENÚS que os traemos. Con el <strong>Menú Japonés</strong> disfrutaréis de la sana y rica gastronomía JAPONESA, y con
					el <strong>Menú Cocido</strong> podréis calentar estos fríos días de invierno que tanto nos gustan en Valladolid.
					</br>
					 ¡Aquí os los dejamos!</p>

			</div>
			
			<div class="img_menu img_lista_menus">
				<img src="../img/Menú_Cocido.jpg" alt="Menú Cocido"
					title="Menú Cocido" />
			</div>
			
			<div class="img_menu img_lista_menus">
				<img src="../img/Menú_Japonés.jpg" alt="Menú Japonés"
					title="Menú Japonés" />
			</div>

			<div class="img_menu img_lista_menus">
				<img src="../img/Menú_senderista.jpg" alt="Menú del senderista"
					title="Menú del senderista" />
			</div>

			<div class="img_menu img_lista_menus">
				<img src="../img/Menú_Fabada_asturiana_alubias.jpg" alt="Menú Fabada"
					title="Menú Fabada" />
			</div>

			<div class="img_menu img_lista_menus">
				<img src="../img/Menú_Oktoberfest_salchichas.jpg" alt="Menú Oktoberfest"
					title="Menú Oktoberfest" />
			</div>
			
			<div class="img_menu img_lista_menus">
				<img src="../img/Menú_Sidrería.jpg" alt="Menú Sidrería"
					title="Menú Sidrería" />
			</div>

		</div>

	</div> 
	
	<!-- FIN CONTENEDOR PARA MENÚS -->    

	<!-- CONTENEDOR PARA MENÚS CON DESCRIPCION -->
	
	<!-- <div class="contenedor_menus">

		<h3>MENÚ FABADA</h3>

		<div class="menu">

			<div class="texto_menu">

				<p>Preparado para cuando el frío aprieta y el hambre
					también...tenemos ¡el Menú Fabada!, ¡listo para haceros entrar en
					calor y comer bien!</p>
				</br>

			</div>

			<div class="img_menu">
				<img src="../img/Menú_Fabada.jpg" alt="Menú Fabada"
					title="Menú Fabada" />
			</div>

		</div>

		<h3>MENÚ TIEMPO DE VENDIMIA</h3>

		<div class="menu">

			<div class="texto_menu">

				<p>Este menú nos acerca de lleno a los vinos de la provincia de
					Valladolid. Va dirigido a las personas que os gusta el buen vino y
					que disfrutáis con elaboraciones un tanto exquisitas. También para
					personas que venís de fuera de la provincia de Valladolid o de la
					Comunidad de Castilla y León y queréis disfrutar de parte de
					nuestros productos, esencialmente los vinos de nuestra tierra.</p>
				</br>
				<p>Si finalmente os decantáis por este menú, no os defraudará.</p>

			</div>

			<div class="img_menu">
				<img src="../img/Menú_Vendimia.png" alt="Menú Vendimia"
					title="Menú Vendimia" />
			</div>

		</div>

		<h3>MENÚ OKTOBERFEST</h3>

		<div class="menu">

			<div class="texto_menu">

				<p>Este menú ha sido diseñado en base a la gastronomía alemana y en
					homenaje a esta fiesta tan importante, nacida en Múnich. Todos los
					productos son hechos caseros en Merendalia, desde el pan alemán,
					Bretzel, hasta el Strudel de Manzana. Va dirigido a las personas
					que tengan ganas de comer contundente y que les guste la cerveza,
					ya que el menú va aderezado con ricas cervezas Bávaras. Diseñamos
					también en su momento, un menú Oktoberfest infantil, compuesto por
					una degustación de salchichas alemanas y una hamburguesa montada
					como siempre, para que los niños se sientan “como en casa”, con su
					pan de hamburguesa, lechuga, tomate, queso…</p>
				</br>
				<p>Si queréis pasar una jornada divertida y distendida incluyendo a
					los peques, ¡este es vuestro menú!</p>

			</div>

			<div class="img_menu">
				<img src="../img/Menú_Oktoberfest.png" alt="Menú_Oktoberfest"
					title="Menú_Oktoberfest" />
			</div>

		</div>

		<h3>MENÚ SIDRERÍA</h3>

		<div class="menu">

			<div class="texto_menu">

				<p>Este menú ha sido diseñado en homenaje a las sidrerías vascas y
					su gran gastronomía. Es un menú en el que el principal protagonista
					es el producto, en cada uno de sus platos hemos intentado dar toda
					la importancia al mismo. Si lo que queréis es juntaros con los
					vuestros a disfrutar de buenos productos y tener una jornada
					divertida y festiva, este es vuestro menú, irá aderezado con rica
					sidra que podréis escanciar de manera divertida con nuestros
					isidrines.</p>
				</br>
				<p>¡Os esperamos!</p>

			</div>

			<div class="img_menu">
				<img src="../img/Menú_Sidrería.png" alt="Menú_Sidrería"
					title="Menú_Sidrería" />
			</div>

		</div>

	</div> -->
	
    <!-- FIN CONTENEDOR PARA MENÚS CON DESCRIPCION -->    
 
	<footer>
        <?php include_once("footer.php");?>        
    </footer>

</body>
</html>