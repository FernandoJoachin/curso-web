<?php include_once __DIR__ . "/header-dashboard.php"; ?>
    <div class="contenedor-sm">
        <?php include_once __DIR__ . "/../template/alertas.php"; ?>
        <form class="formulario" method="POST">
            <?php include_once __DIR__ . "/form-proyecto.php"; ?>
            <input class="submit-crear-proyecto" type="submit" value="Crear proyecto">
        </form>
    </div>
<?php include_once __DIR__ . "/footer-dashboard.php"; ?>