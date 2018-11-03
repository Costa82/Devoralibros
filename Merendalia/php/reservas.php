<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Reservas</title>
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

<script>
    function validar(){
        if (document.getElementById('condiciones').checked){
        	return true;
        }
        else
        {
            alert("El formulario no puede ser enviado si no acepta el Aviso Legal y la Política de Privacidad");
            return false;
        }
    }
</script>

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

	<div class="contenedor_reservas">
		<div class="tarifas">
			<!-- <img src='../img/tarifas.png' alt='Tarifa' /> -->
			<h3>Tarifas</h3>

            <table border="1">
            
            	<tr>
            		<td class = "titulo_verde">
            			<p>
            				<strong>Día </strong>
            				<sup>(1)</sup>
            			</p>
            		</td>
            		<td class = "titulo_verde">
            			<p>
            				<strong>Horario </strong>
            				<sup>(2)</sup>
            			</p>
            		</td>
            		<td class = "titulo_verde">
            			<p>
            				<strong>Precio por hora</strong>
            			</p>
            			<p class = "subtitulo">(3 primeras horas)</p>
            		</td>
            		<td class = "titulo_verde">
            			<p>
            				<strong>Precio por hora</strong>
            			</p>
            			<p class = "subtitulo">(Cuarta hora y sucesivas)</p>
            		</td>
            	</tr>
            
            	<tr>
            		<td rowspan="2" class = "titulo_amarillo">
            			<p>
            				<strong>LUNES a JUEVES</strong>
            			</p>
            		</td>
            		<td><p>09:00 a 18:00</p></td>
            		<td><p>30€</p></td>
            		<td><p>26€</p></td>
            	</tr>
            	<tr>
            		<td><p>18:00 a 00:30</p></td>
            		<td><p>30€</p></td>
            		<td><p>26€</p></td>
            	</tr>
            	
            	<tr>
            		<td rowspan="2" class = "titulo_amarillo">
            			<p>
            				<strong>VIERNES</strong>
            			</p>
            		</td>
            		<td><p>09:00 a 18:00</p></td>
            		<td><p>30€</p></td>
            		<td><p>26€</p></td>
            	</tr>
            	<tr>
            		<td><p>18:00 a 01:30</p></td>
            		<td><p>42€</p></td>
            		<td><p>38€</p></td>
            	</tr>
            
            	<tr>
            		<td rowspan="2" class = "titulo_amarillo">
            			<p>
            				<strong>SÁBADO</strong>
            			</p>
            		</td>
            		<td><p>09:00 a 18:30</p></td>
            		<td><p>49€</p></td>
            		<td><p>44€</p></td>
            	</tr>
            	<tr>
            		<td><p>18:30 a 02:00</p></td>
            		<td><p>49€</p></td>
            		<td><p>44€</p></td>
            	</tr>
            
            	<tr>
            		<td rowspan="2" class = "titulo_amarillo">
            			<p>
            				<strong>DOMINGOS Y FESTIVOS</strong>
            				<sup>(3)</sup>
            			</p>
            		</td>
            		<td><p>09:00 a 18:30</p></td>
            		<td><p>45€</p></td>
            		<td><p>40€</p></td>
            	</tr>
            	<tr>
            		<td><p>18:30 a 00:30</p></td>
            		<td><p>45€</p></td>
            		<td><p>40€</p></td>
            	</tr>
            
            	<tr>
            		<td rowspan="2" class = "titulo_amarillo">
            			<p>
            				<strong>VÍSPERA FESTIVO</strong>
            				<sup>(4)</sup>
            			</p>
            		</td>
            		<td><p>09:00 a 18:00</p></td>
            		<td><p>30€</p></td>
            		<td><p>26€</p></td>
            	</tr>
            	<tr>
            		<td><p>18:00 a 01:30</p></td>
            		<td><p>42€</p></td>
            		<td><p>38€</p></td>
            	</tr>
            
            </table>
            
            <div class = "explicacion_tarifas">
            
            	<p><sup>(1)</sup> Para las reservas comprendidas en los siguientes períodos consultar tarifas pues se consideran fechas especiales y pueden sufrir algún cambio:</p>
            	
            	</br>
            	<ul>
                	<li>Navidades: del 21 de diciembre al 6 de enero.</li>
                	<li>Ferias de Valladolid</li>
                </ul>
            	
            	</br>
            	<p><sup>(2)</sup> La reserva del espacio deberá realizarse por un mínimo de 3 horas.</p>
            	
            	</br>
            	<p><sup>(3)</sup> A los festivos en sábado se les aplicará la tarifa de sábado.</p>
            	
            	</br>
            	<p><sup>(4)</sup> Se considerará víspera de festivo un día laborable (de lunes a viernes) que vaya anterior a un festivo.</p>
            
            </div>
        
		</div>

		<div class="calendario ordenador">
			
			<h3>Calendario</h3>
			
			<iframe
				src="https://calendar.google.com/calendar/embed?showPrint=0&amp;showTz=0&amp;height=600&amp;wkst=2&amp;bgcolor=%23ffffff&amp;src=merenderosurbanos%40gmail.com&amp;color=%23711616&amp;ctz=Europe%2FMadrid"
				style="border-width: 0" frameborder="0" scrolling="no"></iframe>

		</div>

		<div class="calendario movil">
		
			<h3>Calendario</h3>

			<iframe
				src="https://calendar.google.com/calendar/embed?showPrint=0&amp;showTabs=0&amp;showTz=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=merenderosurbanos%40gmail.com&amp;color=%23711616&amp;ctz=Europe%2FMadrid"
				style="border-width: 0" frameborder="0" scrolling="no"></iframe>

		</div>

	</div>

	<div class="contenedor_formulario">
    	<?php include_once("formulario.php");?>	
	</div>

	<footer>
        <?php include_once("footer.php");?>        
    </footer>

</body>
</html>