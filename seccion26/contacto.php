<?php
    require "includes/app.php";
    incluirTemplate("header");
?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Contacto</h1>
        <picture>
            <source srcset="/build/img/destacada3.webp" type="image/webp">
            <img loading="lazy" width="200" height="300" src="build/img/destacada3.jpg" alt="Imagen Contacto">
        </picture>
        <h2>Llene el formulario de contacto</h2>
        <form class="formulario">
            <fieldset>
                <legend>Información Personal</legend>
                <label for="nombre">Nombre</label>
                <input id="nombre" type="text" placeholder="Tu Nombre">

                <label for="email">E-mail</label>
                <input id="email" type="email" placeholder="Tu Email">

                <label for="telefono">Teléfono</label>
                <input id="telefono" type="tel" placeholder="Tu Teléfono">

                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje"></textarea>
            </fieldset>
            <fieldset>
                <legend>Información sobre la propiedad</legend>
                <label for="opciones">Compra o Vende</label>
                <select id="opciones">
                    <option value="" disabled selected>--Seleccione--</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>

                <label for="presupuesto">Presupuesto o Precio</label>
                <input id="presupuesto" type="numbe" placeholder="Tu Presupuesto o Precio">
            </fieldset>
            <fieldset>
                <legend>Contacto</legend>

                <p>Como desea ser contactado</p>
                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input type="radio" name="contacto" value="teléfono" id="contactar-telefono">
                    <label for="contactar-email">E-mail</label>
                    <input type="radio" name="contacto" value="email" id="contactar-email">
                </div>

                <p>Si eligió teléfono, elija la fecha y la hora</p>
                <label for="fecha">Fecha:</label>
                <input id="fecha" type="date">
                <label for="hora">Hora:</label>
                <input id="hora" type="time" min="10:00" max="19:00">

            </fieldset>
            <input class="boton-verde" type="submit" value="Enviar">
        </form>
    </main>
<?php
    incluirTemplate("footer");
?>