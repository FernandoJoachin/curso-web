<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo;?></h2>
    <p class="auth__texto">Recupera tu acceso a DevWebcamp</p>

    <form class="formulario">
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>
            <input type="email" class="formulario_input" name="email" id="email" placeholder="Tu Email">
        </div>

        <input type="submit" class="formulario__submit" value="Enviar instrucciones">
    </form>
    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes una cuesta? Inicia sesión</a>
        <a href="/registro" class="acciones__enlace">¿Aún no tiene una cuesta? Crea una</a>
    </div>
</main>