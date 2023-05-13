<fieldset>
    <legend>Información General</legend>
    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo de la propiedad" value="<?php echo SanitizarHTML($propiedad->titulo); ?>">

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio de la propiedad" value="<?php echo SanitizarHTML($propiedad->precio); ?>">

    <label for="img">Imagen:</label>
    <input type="file" id="img" name="propiedad[img]" accept="image/jpeg, image/png">

    <?php if($propiedad->imagen){ ?>
        <img class="img-small" src="/imagenes/<?php echo $propiedad->imagen ?>">
    <?php } ?>   

    <label for="descripcion">Descripcion</label>
    <textarea id="descripcion" name="propiedad[descripcion]" cols="30" rows="10"><?php echo SanitizarHTML($propiedad->descripcion); ?></textarea>
</fieldset>

<fieldset>
    <legend>Informacion de la Propiedad</legend>
    <label for="habitaciones">Habitaciones:</label>
    <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ej: 3" min="1" max="9" value="<?php echo SanitizarHTML($propiedad->habitaciones); ?>">

    <label for="wc">Baños:</label>
    <input type="number" id="wc" name="propiedad[wc]" placeholder="Ej: 3" min="1" max="9" value="<?php echo SanitizarHTML($propiedad->wc); ?>">

    <label for="estacionamiento">Estacionamiento:</label>
    <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ej: 3" min="1" max="9" value="<?php echo SanitizarHTML($propiedad->estacionamiento); ?>">

</fieldset>

<fieldset>
    <legend>Vendedores</legend>
    <label for="vendedor"></label>
    <select name="propiedad[vendedores_id]" id="vendedor">
        <option value="" disabled selected>--Seleccione--</option>
        <?php foreach($vendedores as $vendedor){ ?>
            <option <?php echo $propiedad->vendedores_id === $vendedor->id ? "selected" : ""; ?> value="<?php echo SanitizarHTML($vendedor->id); ?>">
                <?php echo SanitizarHTML($vendedor->nombre) . " " . SanitizarHTML($vendedor->apellido); ?>
            </option>
        <?php } ?>    
    </select>

</fieldset>

