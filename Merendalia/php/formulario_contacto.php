<div class="formulario">

	<h2>Realiza tu consulta</h2>

	<form action="../php/formulario_contacto_header.php" method="post"
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
		<div>
			<label>Consulta</label>
			<textarea rows="4" cols="50" name="consulta" class="consulta" required="required"></textarea>
		</div>
		<div class="form condiciones">
			<input type="checkbox" name="condiciones" id="condiciones"><label>Acepta
				el <a href="../aviso-legal-y-politica-de-privacidad/" title="Aviso Legal"><i>Aviso Legal y la
						Política de Privacidad</i></a>
			</label>
		</div>
		<div class="form whatsapp">
			<input type="checkbox" name="whatsapp" id="whatsapp" value="1"><label>Quiero
				darme de alta en la lista de difusión por whatsapp </label>
		</div>

		<div class="captcha">
			<div class="g-recaptcha" data-sitekey="6LcmPMQUAAAAAA9QaIlWk0YnX6gPYSZuzBjwxQcW"></div>
		</div>
		
		<div class="boton">
			<button type="submit" name='enviar' class="btn">¡Enviar!</button>
		</div>
	</form>
</div>