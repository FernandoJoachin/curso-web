<?php
    foreach($alertas as $key => $mensajes){
        foreach($mensajes as $mensaje){
?>
    <div class="alerta alerta__<?php echo $key;?>">
            <?php echo $mensaje;?>
    </div>
<?php
        }
    }
?>