<?php

// Formulario del buscador avanzado en todas las páginas menos en la principal index.php
echo '<div class="formulario_avanzada">
          <form action="BuscadorAvanzado/" method="POST">
              <p><label class="titulo">Título</label><input type="text" name="titulo" placeholder="Título..."></p>
              <p><label class="autor">Autor</label><input type="text" name="autor" placeholder="Autor..."></p>
              <p><label class="genero">Género </label>
              <select name="genero">
                  <option value="cualquiera" selected></option>
                  <option value="Autoayuda">Autoayuda</option>
                  <option value="Aventuras">Aventuras</option>
                  <option value="Bélico">Bélico</option>
                  <option value="Biográfico">Biográfico</option>
                  <option value="Ciencia Ficción">Ciencia Ficción</option>
                  <option value="Comedia">Comedia</option>
                  <option value="Cómic">Cómic</option>
                  <option value="Drama">Drama</option>
                  <option value="Ensayo">Ensayo</option>
                  <option value="Erótico">Erótico</option>
                  <option value="Espionaje">Espionaje</option>
                  <option value="Fantástico">Fantástico</option>
                  <option value="Filosófico">Filosófico</option>
                  <option value="Histórico">Histórico</option>
                  <option value="Infantil">Infantil</option>
                  <option value="Juvenil">Juvenil</option>
                  <option value="Misterio">Misterio</option>
                  <option value="Narrativa">Narrativa</option>
                  <option value="Novela">Novela</option>
                  <option value="Poesía">Poesía</option>
                  <option value="Policíaco">Policíaco</option>
                  <option value="Romántico">Romántico</option>
                  <option value="Satírico">Satírico</option>
                  <option value="Suspense">Suspense</option>
                  <option value="Teatro">Teatro</option>
                  <option value="Terror">Terror</option>
                  <option value="Utópico">Utópico</option>
              </select>
              </p>
              <div class="botones">
                  <button type="submit" name="buscar" class="boton-avanzada">Buscar</button>
                  <button type="submit" name="mostrarTodos" class="boton-avanzada">Mostrar todos</button>
              </div>
          </form>
       </div>';

