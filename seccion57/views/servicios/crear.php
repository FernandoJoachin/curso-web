<h1 class="nombre-pagina">Crear un nuevo servicios</h1>
<p class="descripcion-pagina">Llena todos los campos para añadir un nuevo servicio</p>

<?php
    include_once __DIR__ . "/../template/barra.php";
    include_once __DIR__ . "/../template/alertas.php";
?>

<form class="formulario" method="POST">
    <?php
        include_once __DIR__ . "/formulario.php";
    ?>
    <input type="submit" class="boton" value="Guardar servicio">
</form>