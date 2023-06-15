<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo;?></h2>
    <p class="auth__texto">Registrate en DevWebcamp</p>

    <form class="formulario">
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input type="text" class="formulario_input" name="nombre" id="nombre" placeholder="Tu Nombre">
        </div>
        <div class="formulario__campo">
            <label for="apellido" class="formulario__label">Apellido</label>
            <input type="text" class="formulario_input" name="apellido" id="apellido" placeholder="Tu Apellido">
        </div>
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>
            <input type="email" class="formulario_input" name="email" id="email" placeholder="Tu Email">
        </div>
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Password</label>
            <input type="password" class="formulario_input" name="password" id="password" placeholder="Tu Password">
        </div>
        <div class="formulario__campo">
            <label for="repetirPassword" class="formulario__label">Repetir Password</label>
            <input type="password" class="formulario_input" name="repetirPassword" id="repetirPassword" placeholder="Repite tu Password">
        </div>

        <input type="submit" class="formulario__submit" value="Crear cuenta">
    </form>
    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes una cuesta? Inicia sesión</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu password?</a>
    </div>
</main>