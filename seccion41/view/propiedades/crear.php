<main class="contenedor seccion">
    <h1>Crear Propiedad</h1>
    <?php foreach($errores as $error){ ?>
        <div class="alerta error">
            <?php echo $error;?>
        </div>
    <?php }?>
    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . "/form.php" ?>
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
    <a href="/admin" class="boton boton-amarillo">Volver</a>
</main>