<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo;?></h2>
    <p class="auth__texto">Coloca tu nuevo password</p>

    <?php include_once __DIR__ . "/../template/alertas.php";?>

    <?php if($token_valido){?>
        <form class="formulario" method="POST">
            <div class="formulario__campo">
                <label for="password" class="formulario__label">Nuevo password</label>
                <input type="password" class="formulario_input" name="password" id="password" placeholder="Tu Nuevo Password">
            </div>

            <input type="submit" class="formulario__submit" value="Guardar password">
        </form>
    <?php };?>    
    
    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes una cuesta? Inicia sesión</a>
        <a href="/registro" class="acciones__enlace">¿Aún no tiene una cuesta? Crea una</a>
    </div>
</main>