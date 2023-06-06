<h1 class="nombre-pagina">Panel de administración</h1>
<p class="descripcion-pagina">Administra la siguiente información</p>

<?php
    include_once __DIR__ . "/../template/barra.php";
?>

<div class="busqueda">
    <h2>Buscar citas</h2>
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input type="date"  name="fecha" id="fecha">
        </div>
        <div class="campo">
            <label for="hora">Hora</label>
            <input type="time"  name="hora" id="hora">
        </div>
    </form>
</div>
<div id="citas-admin"></div>