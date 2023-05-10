<?php
    require "../../includes/app.php";
    use App\Propiedad;
    use Intervention\Image\ImageManagerStatic as Image;
    $propiedad = new Propiedad();
    

    estaAutenticado();
    // if(!$auth){
    //     header("Location: /");
    // } 

    $db = conectarDB();

    // Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db,$consulta);

    //Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();

    $titulo = "";
    $precio = "";
    $descripcion = "";
    $habitaciones = "";
    $wc = "";
    $estacionamiento = "";
    $vendedorID = "";
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
        $propiedad = new  Propiedad($_POST);

        /*Subida de archvios */
        //Generar un nombre único
        $nombreImg = md5(uniqid(rand(), true)) . ".jpg";

        //Realiza un resize a la imagen con Intervention - Código sacado de Intervention
        if($_FILES["img"]["tmp_name"]){
            $img = Image::make($_FILES["img"]["tmp_name"])->fit(800, 600);
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
            $resultado = $propiedad->crear();

            if($resultado){
                //Redireccionar al usuario;
                header("Location: /admin?resultado=1");
            }
        }
    }

    incluirTemplate("header");
?>
    <main class="contenedor seccion">
        <h1>Crear</h1>
        
        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error;?>
        </div>
        <?php endforeach?>
        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
            <fieldset>
                <legend>Información General</legend>
                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo de la propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de la propiedad" value="<?php echo $precio; ?>">

                <label for="img">Imagen:</label>
                <input type="file" id="img" name="img" accept="image/jpeg, image/png">

                <label for="descripcion">Descripcion</label>
                <textarea id="descripcion" name="descripcion" cols="30" rows="10"><?php echo $descripcion; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion de la Propiedad</legend>
                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento; ?>">

            </fieldset>

            <fieldset>
                <legend>Vendedores</legend>
                <select name="vendedores_id">
                    <option value="" disabled selected>--Seleccione--</option>
                    <?php while($row = mysqli_fetch_assoc($resultado)){ ?>
                        <option <?php echo $vendedorID === $row["id"] ? "selected" : ""; ?> value="<?php echo $row["id"]; ?>">
                            <?php echo $row["nombre"] . " " . $row["apellido"]; ?>
                        </option>
                    <?php } ?>    
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
        <a href="/admin" class="boton boton-amarillo">Volver</a>
        
    </main>
<?php
    incluirTemplate("footer");
?>