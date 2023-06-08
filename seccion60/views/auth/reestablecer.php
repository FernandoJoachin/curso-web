<div class="contenedor reestablecer">
    <?php include_once __DIR__ . "/../template/nombre-sitio.php"; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Coloca tu nuevo password</p>
        <form class="formulario" method="POST">
            <div class="campo">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Tu Password">
            </div>
            <div class="campo">
                <label for="repetirPassword">Repetir Password</label>
                <input type="password" name="repetirPassword" id="repetirPassword" placeholder="Repite tu password">
            </div>
            <input type="submit" class="boton" value="Guardar password">
        </form>

        <div class="acciones">
            <a href="/crear">¿Aún no tienes tu cuenta? Crea una</a>
            <a href="/olvidar">¿Olvidaste tu password?</a>
        </div>
    </div>
</div>