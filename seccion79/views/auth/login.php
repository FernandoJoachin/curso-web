<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo;?></h2>
    <p class="auth__texto">Inicia sesión en DevWebcamp</p>

    <?php include_once __DIR__ . "/../template/alertas.php";?>

    <form class="formulario" method="POST" action="/login">
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>
            <input type="email" class="formulario__input" name="email" id="email" placeholder="Tu Email" value="<?php echo $usuario->email;?>">
        </div>
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Password</label>
            <input type="password" class="formulario__input" name="password" id="password" placeholder="Tu Password">
        </div>

        <input type="submit" class="formulario__submit" value="Iniciar sesión">
    </form>
    <div class="acciones">
        <a href="/registro" class="acciones__enlace">¿Aún no tiene una cuesta? Crea una</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu password?</a>
    </div>
</main>