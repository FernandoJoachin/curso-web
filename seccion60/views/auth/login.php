<div class="contenedor login">
    <?php include_once __DIR__ . "/../template/nombre-sitio.php"; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Iniciar sesión de tu cuenta de UpTask</p>
        <form class="formulario" method="POST">
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Tu Email">
            </div>
            <div class="campo">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Tu Password">
            </div>
            <input type="submit" class="boton" value="Inicar Sesión">
        </form>

        <div class="acciones">
            <a href="/crear">¿Aún no tienes tu cuenta? Crea una</a>
            <a href="/olvidar">¿Olvidaste tu password?</a>
        </div>
    </div>
</div>