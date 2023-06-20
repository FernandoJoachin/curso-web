<h2 class="dashboard__heading"><?php echo $titulo;?></h2>
<div class="dashboard__contenedor-boton">
    <a href="/admin/ponentes" class="dashboard__boton">
        <li class="fa-solid fa-circle-arrow-left"></li>
        Volver
    </a>
</div>

<div class="dashboard__formulario">
    <?php include_once __DIR__ . "/../../template/alertas.php";?>
    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include_once __DIR__ . "/formulario.php";?>
        <input type="submit" class="formulario__submit formulario__submit--registrar" value="Registrar Ponente">
    </form>
</div>