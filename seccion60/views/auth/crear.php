<div class="contenedor crear">
    <?php include_once __DIR__ . "/../template/nombre-sitio.php"; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Crea tu cuenta en UpTask</p>

        <?php include_once __DIR__ . "/../template/alertas.php"; ?>
        <form class="formulario" method="POST">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Tu Nombre" value="<?php echo $usuario->nombre;?>">
            </div>
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Tu Email" value="<?php echo $usuario->email;?>">
            </div>
            <div class="campo">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Tu Password">
            </div>
            <div class="campo">
                <label for="repetirPassword">Repetir Password</label>
                <input type="password" name="repetirPassword" id="repetirPassword" placeholder="Repite tu password">
            </div>
            <input type="submit" class="boton" value="Crear cuenta">
        </form>

        <div class="acciones">
            <a href="/">¿Ya tienes cuenta? Iniciar Sesión</a>
            <a href="/olvidar">¿Olvidaste tu password?</a>
        </div>
    </div>
</div>