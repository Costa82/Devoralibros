<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Menús</title>
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
<script src="../jquery/jquery_menuMoviles_desplegable.js"></script>

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

	<div class="explicacion_galeria">
		<p>En esta sección podrás ir viendo los menús que en Merendalia hemos
			diseñado para ti y los tuyos. Cualquiera de estos menús se pueden
			solicitar para tener un encuentro privado en Merendalia, por grupos
			de mínimo, 12 personas.</p>
		<p>El importe del evento será, el precio del menú por las personas que
			seáis, más un incremento por la privacidad, de 50€ por grupo.</p>
		<p>Os aseguráis con esto las ventajas de tener un local privado solo
			para vosotros y las de un restaurante, ser atendidos de manera
			privada y no preocuparos de nada más.</p>
		<p>La duración del evento privado con uno de estos menús será de 3
			horas.</p>
	</div>

	<div class="contenedor_menus">

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

	</div>

	<footer>
        <?php include_once("footer.php");?>        
    </footer>

</body>
</html>