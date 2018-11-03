<div class="formulario">

	<h2>Realiza tu reserva</h2>

	<form action="formulario_header.php" method="post"
		class="formularioRegistro" onSubmit="return validar();">
		<div class="form">
			<label>Nombre</label> <input type="text" name="nombre" class="nombre"
				placeholder="Nombre..." required="required" />
		</div>
		<div class="form">
			<label>Email</label> <input type="email" name="mail" class="mail"
				placeholder="Email..." required="required" />
		</div>
		<div class="form">
			<label>Telefono</label> <input type="tel" name="telefono"
				class="telefono" placeholder="Telefono..." />
		</div>
		<div class="form">
			<label>Día</label> <input type="date" name="dia" class="dia"
				placeholder="Día..." required="required" />
		</div>
		<div class="form">
			<label>Hora entrada</label> <input type="time" name="hora_entrada"
				class="hora_entrada" placeholder="Hora entrada..."
				required="required" />
		</div>
		<div class="form">
			<label>Hora salida</label> <input type="time" name="hora_salida"
				class="hora_salida" placeholder="Hora salida..." required="required" />
		</div>
		<div>
			<label>Comentarios</label>
			<textarea rows="4" cols="50" name="comentario" class="comentario"></textarea>
		</div>
		<div class="form condiciones">
			<input type="checkbox" name="condiciones" id="condiciones"><label>Acepta
				el <a href="avisoLegal.php" title="Aviso Legal"><i>Aviso Legal y la
						Política de Privacidad</i></a>
			</label>
		</div>
		<div class="form whatsapp">
			<input type="checkbox" name="whatsapp" id="whatsapp" value="1"><label>Quiero
				darme de alta en la lista de difusión por whatsapp </label>
		</div>
		<div class="boton">
			<button type="submit" name='enviar' class="btn">¡Enviar!</button>
		</div>
	</form>
</div>