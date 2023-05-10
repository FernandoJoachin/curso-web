<?php
    require "includes/app.php";
    incluirTemplate("header");
?>
    <main class="contenedor seccion">
        <h1>Casas y Departamentos en Venta</h1>
        <?php
            $limite = 9;
            include "includes/template/anuncio.php";
        ?>
    </main>
<?php
    incluirTemplate("footer");
?>