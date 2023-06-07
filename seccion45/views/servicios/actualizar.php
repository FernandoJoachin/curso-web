<h1 class="nombre-pagina">Actualizar un servicios</h1>
<p class="descripcion-pagina">Llena todos los campos para actualizar un servicio</p>

<?php
    include_once __DIR__ . "/../template/barra.php";
?>

<form class="formulario" method="POST">
    <?php
        include_once __DIR__ . "/formulario.php";
    ?>
    <input type="submit" class="boton" value="Actualizar servicio">
</form>