<?php
    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;

    require "../../includes/app.php";
    estaAutenticado();

    //Validar la URL por un ID válido
    $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id) {
        header("Location: /admin");
    }

    //Consultar para obtener los propiedades
    $propiedad = Propiedad::find($id);
    

    //Consultar para obtener los vendedores
    $vendedores = Vendedor::all();

    //Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();

    //Ejecutar el código después de que el usuario envia el formulario
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        // //Ejemplo de sanizitar y validar
        // $valor1 = "correo@correo.com";
        // $valor2 = "hola";
        // //Sanizitar
        // $resultado = filter_var($valor1, FILTER_SANITIZE_EMAIL);
        // //Validar
        // $resultado = filter_var($valor1, FILTER_VALIDATE_EMAIL);
        // var_dump($resultado);

        $args = $_POST["propiedad"];
        $propiedad->sincronizar($args);

        /*Subida de archvios */
        //Generar un nombre único
        $nombreImg = md5(uniqid(rand(), true)) . ".jpg";

        //Realiza un resize a la imagen con Intervention - Código sacado de Intervention
        if($_FILES["propiedad"]["tmp_name"]["img"]){
            $img = Image::make($_FILES["propiedad"]["tmp_name"]["img"])->fit(800, 600);
            $propiedad->setImagen($nombreImg);
        }

        $errores = $propiedad->validar();       
        //Actualizar en la base de datos
        if(empty($errores)){
            if($_FILES["propiedad"]["tmp_name"]["img"]){
                $img->save(CARPETA_IMG . $nombreImg);
            }
            $propiedad->guardar();
        }
    }

    incluirTemplate("header");
?>
    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error;?>
        </div>
        <?php endforeach?>
        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include "../../includes/template/form__propiedades.php"?>
            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>
        <a href="/admin" class="boton boton-amarillo">Volver</a>
        
    </main>
<?php
    incluirTemplate("footer");
?>