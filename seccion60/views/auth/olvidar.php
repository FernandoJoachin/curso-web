<div class="contenedor olvidar">
    <?php include_once __DIR__ . "/../template/nombre-sitio.php"; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Reestablece tu password de tu cuenta en UpTask</p>

        <?php include_once __DIR__ . "/../template/alertas.php"; ?>
        <form class="formulario" method="POST" novalidate>
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Tu Email">
            </div>
            <input type="submit" class="boton" value="Enviar instrucciones">
        </form>

        <div class="acciones">
            <a href="/">¿Ya tienes cuenta? Iniciar Sesión</a>
            <a href="/crear">¿Aún no tienes tu cuenta? Crea una</a>
        </div>
    </div>
</div>