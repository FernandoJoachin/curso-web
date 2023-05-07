<?php
    require "../../includes/funciones.php";
    $auth = estaAutenticado();
    if(!$auth){
        header("Location: ../../");
    } 

    require "../../includes/config/database.php";
    $db = conectarDB();

    // Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db,$consulta);

    //Arreglo con mensajes de errores
    $errores = [];

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

        $titulo = mysqli_real_escape_string($db,$_POST["titulo"]);
        $precio = mysqli_real_escape_string($db,$_POST["precio"]);
        $descripcion = mysqli_real_escape_string($db, $_POST["descripcion"]);
        $habitaciones = mysqli_real_escape_string($db, $_POST["habitaciones"]);
        $wc = mysqli_real_escape_string($db, $_POST["wc"]);
        $estacionamiento = mysqli_real_escape_string($db, $_POST["estacionamiento"]);
        $vendedorID = mysqli_real_escape_string($db, $_POST["vendedor"]);
        $creado = date("Y/m/d");
        //Asignar un archivo a una variable
        $img = $_FILES["img"];

        if(!$titulo) {
            $errores[] = "Debes añadir un titulo";
        }

        if(!$precio) {
            $errores[] = "El precio es obligatorio";
        }

        if( strlen( $descripcion ) < 50 ) {
            $errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
        }

        if(!$habitaciones) {
            $errores[] = "El número de habitaciones es obligatorio";
        }
        
        if(!$wc) {
            $errores[] = "El número de baños es obligatorio";
        }

        if(!$estacionamiento) {
            $errores[] = "El número de lugares de estacionamiento es obligatorio";
        }
        
        if(!$vendedorID) {
            $errores[] = 'Elige un vendedor';
        }

        if(!$img["name"] || $img["error"] ){
            $errores[] = "La imagen es obligatoria";
        }

        // Validar por tamaño (1mb máximo)
        $medida = 1000 * 1000;
        if($img["size"] > $medida ) {
            $errores[] = "La imagen es muy pesada";
        }


        //Insertar en la base de datos
        if(empty($errores)){
            /*Subida de archvios */
            //Crear carpeta
            $carpetaImg = "../../imagenes/";
            if(!is_dir($carpetaImg)){
                mkdir($carpetaImg);
            }
            //Generar un nombre único
            $nombreImg = md5(uniqid(rand(), true)) . ".jpg";
            //Subir la imagen
            move_uploaded_file($img["tmp_name"], $carpetaImg . $nombreImg);

            $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedores_id) 
            VALUES ('$titulo', '$precio', '$nombreImg', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedorID')";
    
            $resultado = mysqli_query($db,$query);
            if($resultado){
                //Redireccionar al usuario;
                header("Location: ../../admin?resultado=1");
            }
        }
    }

    incluirTemplate("header", false, true, "../../");
?>
    <main class="contenedor seccion">
        <h1>Crear</h1>
        
        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error;?>
        </div>
        <?php endforeach?>
        <form class="formulario" method="POST" action="./crear.php" enctype="multipart/form-data">
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
                <select name="vendedor">
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
        <a href="../../admin" class="boton boton-amarillo">Volver</a>
        
    </main>
<?php
    incluirTemplate("footer", false, true, "../../");
?>