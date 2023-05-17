<?php
    require "../../includes/app.php";
    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;
    $propiedad = new Propiedad();
    
    estaAutenticado();

    // Consultar para obtener los vendedores
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

        /**Sanitizar con mysql
         *  $titulo = mysqli_real_escape_string($db,$_POST["titulo"]);
        */

        //Crea una nueva instancia
        $propiedad = new  Propiedad($_POST["propiedad"]);

        /*Subida de archvios */
        //Generar un nombre único
        $nombreImg = md5(uniqid(rand(), true)) . ".jpg";

        //Realiza un resize a la imagen con Intervention - Código sacado de Intervention
        if($_FILES["propiedad"]["tmp_name"]["img"]){
            $img = Image::make($_FILES["propiedad"]["tmp_name"]["img"])->fit(800, 600);
            $propiedad->setImagen($nombreImg);
        }

        //Validar
        $errores = $propiedad->validar();


        //Insertar en la base de datos
        if(empty($errores)){
            //Subir la imagen
            //move_uploaded_file($img["tmp_name"], $carpetaImg . $nombreImg);

            //Crear carpeta
            $carpetaImg = "../../imagenes/";
            if(!is_dir(CARPETA_IMG)){
                mkdir(CARPETA_IMG);
            }
            //Guardar imagen en el servidor
            $img->save(CARPETA_IMG . $nombreImg);

            //Guardar en la DB
            $propiedad->guardar();
        }
    }

    incluirTemplate("header");
?>
    <main class="contenedor seccion">
        <h1>Crear Propiedad</h1>
        
        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error;?>
        </div>
        <?php endforeach?>
        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
            <?php include "../../includes/template/form__propiedades.php"?>
            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
        <a href="/admin" class="boton boton-amarillo">Volver</a>
        
    </main>
<?php
    incluirTemplate("footer");
?>