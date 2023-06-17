<?php include_once __DIR__ . "/header-dashboard.php"; ?>

<div class="contenedor-sm">
    <?php include_once __DIR__ . "/../template/alertas.php" ;?>
    <a class="enlace" href="/perfil">Volver a perfil</a>

    <form class="formulario" method="POST">
        <div class="campo">
            <label for="password_actual">Password actual</label>
            <input type="password" name="password_actual" placeholder="Tu password actual">
        </div>
        <div class="campo">
            <label for="password_nuevo">Nuevo password</label>
            <input type="password" name="password_nuevo" placeholder="Tu nuevo password">
        </div>
        <div class="campo">
            <label for="repetirPassword">Repetir Nuevo Password</label>
            <input type="password" name="repetirPassword" placeholder="Repite tu nuevo password">
        </div>

        <input class="submit-perfil" type="submit" value="Guardar cambios">
    </form>
</div>

<?php include_once __DIR__ . "/footer-dashboard.php"; ?>