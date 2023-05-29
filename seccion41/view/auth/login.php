<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar sesion</h1>
    <?php foreach($errores as $error){?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php } ?>
    
    <form class="formulario" method="POST">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-mail</label>
            <input id="email" type="email" name="email" placeholder="Tu Email">

            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="Tu Password">
        </fieldset>
        <input class="boton boton-verde" type="submit" value="Iniciar Sesion">
    </form>
</main>