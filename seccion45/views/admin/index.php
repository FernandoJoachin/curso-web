<h1 class="nombre-pagina">Panel de administración</h1>
<p class="descripcion-pagina">Bienvenido al panel de administración de citas de la barbería</p>

<?php
    include_once __DIR__ . "/../template/barra.php";
?>

<div class="busqueda">
    <h2>Buscar citas</h2>
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input type="date"  name="fecha" id="fecha" value="<?php echo $fecha;?>">
        </div>
    </form>
</div>

<?php
    if(count($citas) === 0){
        echo "<h2 class='citaNoDisponible'>No hay citas disponible en esta fecha</h2>";
    }
?>

<div id="citas-admin">
    <ul class="citas">
        <?php
            $cita_id = 0;
            foreach($citas as $key => $cita){
                if($cita_id !== $cita->id){
                    $totalPagar = 0;
        ?>
        <li>
            <p>ID: <span><?php echo $cita->id;?></span></p>
            <p>Hora: <span><?php echo $cita->hora;?></span></p>
            <p>Cliente: <span><?php echo $cita->cliente;?></span></p>
            <p>Email: <span><?php echo $cita->email;?></span></p>
            <p>Telefono: <span><?php echo $cita->telefono;?></span></p>
            <h3>Servicios</h3>

            <?php $cita_id = $cita->id; };//Fin del if?>
            <p class="servicio"><?php echo $cita->servicio . " $" . $cita->precio;?></p>
            
            <?php
                $totalPagar += $cita->precio;
                $actual_id = $cita->id;
                $proximo_id = $citas[$key + 1]->id ?? 0;
                if(ultimo($actual_id, $proximo_id)){ ;?>
                    <p>Total a pagar: <span>$<?php echo $totalPagar;?></span></p>
                    <form action="/api/eliminar" method="POST">
                        <input type="hidden" name="id" value="<?php echo $cita->id;?>">
                        <input type="submit" class="boton-eliminar" value="Eliminar">

                    </form>
            <?php
                };
            ?>
        <?php };//Fin del foreach?>
    </ul>
</div>

<?php
    $script = "<script src='/build/js/buscador.js'></script>"
?>