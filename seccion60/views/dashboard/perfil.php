<?php include_once __DIR__ . "/header-dashboard.php"; ?>

<div class="contenedor-sm">
    <?php include_once __DIR__ . "/../template/alertas.php" ;?>
    <a class="enlace" href="/cambiar-password">Cambiar password</a>

    <form class="formulario" method="POST">
        <div class="campo">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" placeholder="Tu Nombre" value="<?php echo $usuario->nombre;?>">
        </div>
        <div class="campo">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Tu Email" value="<?php echo $usuario->email;?>">
        </div>

        <input class="submit-perfil" type="submit" value="Guardar cambios">
    </form>
</div>

<?php include_once __DIR__ . "/footer-dashboard.php"; ?>