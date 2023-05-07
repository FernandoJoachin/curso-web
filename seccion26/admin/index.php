<?php
    require "../includes/funciones.php";
    $auth = estaAutenticado();
    if(!$auth){
        header("Location: ./");
    } 
    //Importar la conexion
    require "../includes/config/database.php";
    $db = conectarDB();

    //Escribir
    $query = "SELECT * FROM propiedades";

    //Consultar la DB
    $consulta = mysqli_query($db, $query);

    //Muestra mensaje condicional
    $resultado = $_GET["resultado"] ?? null;

    //Hacer DELETE
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $id = $_POST["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){
            //Eliminar la imagen
            $query = "SELECT imagen FROM propiedades WHERE id=${id}";
            $resultado = mysqli_query($db,$query);
            $propiedad = mysqli_fetch_assoc($resultado);
            unlink("../imagenes/" . $propiedad["imagen"]);

            //Eliminar propiedad
            $query = "DELETE FROM propiedades WHERE id=${id}";
            $resultado = mysqli_query($db,$query);

            if($resultado) {
                header("Location: ./admin?resultado=3");
            }
        }
    }

    //Incluye un template
    incluirTemplate('header', false, true, "./");
?>
    <main class="contenedor seccion">
        <h1>Administrador de bienes raices</h1>
        <?php if(intval($resultado) === 1){ ?>
            <p class="alerta exito">Anuncio creado correctamente</p>
        <?php } else if(intval($resultado) === 2){ ?>    
            <p class="alerta exito">Anuncio actualizado correctamente</p>
        <?php } else if(intval($resultado) === 3){ ?>    
            <p class="alerta exito">Anuncio eliminado correctamente</p>
        <?php }; ?>

        <a href="./admin/propiedades/crear.php" class="boton boton-amarillo">Ir a Crear</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($propiedades =mysqli_fetch_assoc($consulta)){?>
                <tr>
                    <td><?php echo $propiedades["id"]; ?></td>
                    <td><?php echo $propiedades["titulo"]; ?></td>
                    <td><img class="img-tabla" src="./imagenes/<?php echo $propiedades["imagen"]; ?>" alt="imagen"></td>
                    <td>$<?php echo $propiedades["precio"]; ?></td>
                    <td>
                        <a class="boton-amarillo-block" href="./admin/propiedades/actualizar.php?id=<?php echo $propiedades["id"]; ?>">Actualizar</a>
                        <form class="w-100" method="POST">
                            <input type="hidden" name="id" value="<?php echo $propiedades["id"]; ?>">
                            <input type="submit" class="boton-rojo-block w-100" value="Eliminar" >
                        </form>
                    </td>
                </tr>
                <?php }; ?>
            </tbody>
        </table>
    </main>
<?php
    //Cerrar la conexion
    mysqli_close($db);
    incluirTemplate("footer", false, true, "./");
?>