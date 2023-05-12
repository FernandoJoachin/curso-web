<?php
    require "../includes/app.php";
    estaAutenticado();
    Use App\Propiedad;

    //Metodos para obtener todas las propiedades
    $propiedades = Propiedad::all();

    //Muestra mensaje condicional
    $resultado = $_GET["resultado"] ?? null;

    //Hacer DELETE
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $id = $_POST["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){
            //Consultar para obtener los propiedades
            $propiedad = Propiedad::find($id);
            $propiedad->eliminar();
        }
    }

    //Incluye un template
    incluirTemplate("header");
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

        <a href="/admin/propiedades/crear.php" class="boton boton-amarillo">Ir a Crear</a>

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
                <?php foreach($propiedades as $propiedad){?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td><img class="img-tabla" src="./imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen"></td>
                    <td>$<?php echo $propiedad->precio; ?></td>
                    <td>
                        <a class="boton-amarillo-block" href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>">Actualizar</a>
                        <form class="w-100" method="POST">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
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
    incluirTemplate("footer");
?>