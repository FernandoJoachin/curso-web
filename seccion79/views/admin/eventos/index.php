<h2 class="dashboard__heading"><?php echo $titulo;?></h2>

<div class="dashboard__contenedor-boton">
    <a href="/admin/eventos/crear" class="dashboard__boton">
        <li class="fa-solid fa-circle-plus"></li>
        Agregar Evento
    </a>
</div>

<div class="dashboard__contenedor">
    <?php if(!empty($eventos)){?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table_th">Evento</th>
                    <th scope="col" class="table_th">Categoría</th>
                    <th scope="col" class="table_th">Día y Hora</th>
                    <th scope="col" class="table_th">Ponente</th>
                    <th scope="col" class="table_th"></th>
                </tr>
            </thead>

            <tbody class="table__tbody">
                <?php foreach($eventos as $evento){?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $evento->nombre;?>
                        </td>
                        <td class="table__td">
                            <?php echo $evento->categoria->nombre;?>
                        </td>
                        <td class="table__td">
                            <?php echo $evento->dia->nombre . ", ". $evento->hora->hora;?>
                        </td>
                        <td class="table__td">
                            <?php echo $evento->ponente->nombre . " ". $evento->ponente->apellido;?>
                        </td>
                    </tr>
                <?php }?>    
            </tbody>
        </table>
    <?php } else{?>
        <p class="text-center">No hay eventos aún</p>
    <?php }?>
</div>

<?php
 echo $paginacion;
?>