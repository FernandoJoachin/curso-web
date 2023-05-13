<?php
    require "../../includes/app.php";
    use App\Vendedor;
    estaAutenticado();

    //Validar la URL por un ID válido
    $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id) {
        header("Location: /admin");
    }

    //Consultar para obtener los vendedores
    $vendedor = Vendedor::find($id);

    //Arreglo con mensajes de errores
    $errores = Vendedor::getErrores();

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        //Asignar los valores
        $args = $_POST["vendedor"];
        //Sincronizar el objeto con los cambios realizados
        $vendedor->sincronizar($args);
        //Validación
        $errores = $vendedor->validar();       
        //Actualizar en la base de datos
        if(empty($errores)){
            $vendedor->guardar();
        }
    }

    incluirTemplate("header");
?>    

<main class="contenedor seccion">
    <h1>Actualizar Vendedor(a)</h1>
    
    <?php foreach($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error;?>
    </div>
    <?php endforeach?>
    <form class="formulario" method="POST">
        <?php include "../../includes/template/form__vendedores.php"?>
        <input type="submit" value="Actualizar Vendedor(a)" class="boton boton-verde">
    </form>
    <a href="/admin" class="boton boton-amarillo">Volver</a>
    
</main>

<?php
    incluirTemplate("footer");
?>
