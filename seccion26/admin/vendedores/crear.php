<?php
    require "../../includes/app.php";
    use App\Vendedor;
    estaAutenticado();

    $vendedor = new Vendedor();

    //Arreglo con mensajes de errores
    $errores = Vendedor::getErrores();

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        //Crear una nueva instancia de vendedor
        $vendedor = new Vendedor($_POST["vendedor"]);
        $errores = $vendedor->validar();
        if(empty($errores)) {
            $vendedor->guardar();
        }
    }

    incluirTemplate("header");
?>    

<main class="contenedor seccion">
    <h1>Crear Vendedor(a)</h1>
    
    <?php foreach($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error;?>
    </div>
    <?php endforeach?>
    <form class="formulario" method="POST" action="/admin/vendedores/crear.php">
        <?php include "../../includes/template/form__vendedores.php"?>
        <input type="submit" value="Crear Vendedor(a)" class="boton boton-verde">
    </form>
    <a href="/admin" class="boton boton-amarillo">Volver</a>
    
</main>

<?php
    incluirTemplate("footer");
?>
