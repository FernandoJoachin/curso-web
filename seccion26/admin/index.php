<?php
    require "../includes/app.php";
    estaAutenticado();
    Use App\Propiedad;
    Use App\Vendedor;

    //Metodos para obtener todas las propiedades
    $propiedades = Propiedad::all();
    $vendedores = Vendedor::all();

    //Muestra mensaje condicional
    $resultado = $_GET["resultado"] ?? null;

    //Hacer DELETE
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $id = $_POST["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if($id){
            $tipo = $_POST["tipo"];
            if(validarTipoContenido($tipo)){
                if($tipo === "propiedad"){
                    //Consultar para obtener los propiedades
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar($tipo);
                }else if($tipo === "vendedor"){
                    //Consultar para obtener los vendedores
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        }
    }

    //Incluye un template
    incluirTemplate("header");
?>
    <main class="contenedor seccion">
        <h1>Administrador de bienes raices</h1>

        <?php
            $mensaje = mostrarNotificacion(intval($resultado));
            if($mensaje) { ?>
                <p class="alerta exito"><?php echo SanitizarHTML($mensaje); ?></p>
            <?php }; ?>

        <a href="/admin/propiedades/crear.php" class="boton boton-amarillo">Ir a Crear Propiedad</a>
        <a href="/admin/vendedores/crear.php" class="boton boton-amarillo">Ir a Crear Vendedor(a)</a>
        
        <h2>Propiedades</h2>
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
                    <td><img class="img-tabla" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen"></td>
                    <td>$<?php echo $propiedad->precio; ?></td>
                    <td>
                        <a class="boton-amarillo-block" href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>">Actualizar</a>
                        <form class="w-100" method="POST">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block w-100" value="Eliminar" >
                        </form>
                    </td>
                </tr>
                <?php }; ?>
            </tbody>
        </table>

        <h2>Vendedores</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($vendedores as $vendedor){?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido ; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <a class="boton-amarillo-block" href="/admin/vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>">Actualizar</a>
                        <form class="w-100" method="POST">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
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
    incluirTemplate("footer");
?>