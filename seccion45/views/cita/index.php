<h1 class="nombre-pagina">Crear nueva cita</h1>
<p class="descripcion-pagina">Elije tus servicios y coloca tus datos</p>

<div id="app">
    <nav class="tabs">
        <button type="button" data-paso="1">Servicios</button> <!-- "data-" - Crea tus propios atributos en HTML -->
        <button type="button" data-paso="2">Tus datos y cita</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>

    <div id="paso-1" class="seccion">
        <h2>Servicios</h2>
        <p class="text-center">Elije tus servicios a continuación</p>
        <div class="listado-servicios" id="servicios"></div>
    </div>
    <div id="paso-2" class="seccion">
        <h2>Tus datos y cita</h2>
        <p class="text-center">Coloca tus datos y la fecha de tu cita</p>
        <div class="listado-servicios" id="servicios"></div>

        <form class="formulario" method="POST" >
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text"  name="nombre" id="nombre" placeholder="Tu Nombre" value="<?php echo $nombre;?>" disabled>
            </div>
            <div class="campo">
                <label for="fecha">Fecha</label>
                <input type="date"  name="fecha" id="fecha">
            </div>
            <div class="campo">
                <label for="hora">Hora</label>
                <input type="time"  name="hora" id="hora">
            </div>

            <input type="submit" class="boton" value="Crear cuenta">
        </form>
    </div>
    <div id="paso-3" class="seccion">
        <h2>Resumen</h2>
        <p>Verifica que la información sea correcta</p>
        <div class="listado-servicios" id="servicios"></div>
    </div>

    <div class="paginacion">
        <button class="boton" id="anterior">&laquo; Anterior</button>
        <button class="boton" id="siguiente">Siguiente &raquo;</button>
    </div>
</div>
<?php
    $script = "<script src='/build/js/app.js'></script>"
?>