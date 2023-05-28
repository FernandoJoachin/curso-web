<main class="contenedor seccion contenido-centrado">
    <h1>Contacto</h1>

    <picture>
        <source srcset="/public/build/img/destacada3.webp" type="image/webp">
        <img loading="lazy" width="200" height="300" src="/public/build/img/destacada3.jpg" alt="Imagen Contacto">
    </picture>

    <?php
        if($mensajeResultado){ ?>
            <p class="alerta exito"> <?php echo $mensajeResultado; ?>
    <?php        
        }
    ?>
    <h2>Llene el formulario de contacto</h2>
    <form class="formulario" method="POST">
        <fieldset>
            <legend>Información Personal</legend>
            <label for="nombre">Nombre</label>
            <input id="nombre" name="contacto[nombre]" type="text" placeholder="Tu Nombre" required>

            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje" name="contacto[mensaje]" required></textarea>
        </fieldset>
        <fieldset>
            <legend>Información sobre la propiedad</legend>
            <label for="opciones">Compra o Vende</label>
            <select id="opciones" name="contacto[tipo]" required>
                <option value="" disabled selected>--Seleccione--</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>

            <label for="presupuesto">Presupuesto o Precio</label>
            <input id="presupuesto" name="contacto[precio]" type="numbe" placeholder="Tu Presupuesto o Precio" required>
        </fieldset>
        <fieldset>
            <legend>Contacto</legend>

            <p>Como desea ser contactado</p>
            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input type="radio" name="contacto[contacto]" value="teléfono" id="contactar-telefono" required>
                <label for="contactar-email">E-mail</label>
                <input type="radio" name="contacto[contacto]" value="email" id="contactar-email" required>
            </div>

            <div id="contacto"></div>

        </fieldset>
        <input class="boton-verde" type="submit" value="Enviar">
    </form>
</main>