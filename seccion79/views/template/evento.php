<div class="evento swiper-slide">
    <p class="evento__hora"><?php echo $evento->hora->hora;?></p>
    
    <div class="evento__informacion">
        <h4 class="evento__nombre"><?php echo $evento->nombre;?></h4>
        <p class="evento__introduccion"><?php echo $evento->descripcion;?></p>

        <div class="evento__autor-info">
            <picture>
                <source srcset="/img/speakers/<?php echo $evento->ponente->imagen;?>.webp">
                <source srcset="/img/speakers/<?php echo $evento->ponente->imagen;?>.png">
                <img class="evento__imagen-autor" loading="lazy" width="200" height="300" src="/img/speakers/<?php echo $evento->ponente->imagen;?>.png" alt="Imagen Ponente">
            </picture>
            <p class="evento__autor-nombre"></p>
        </div>
    </div>
</div>