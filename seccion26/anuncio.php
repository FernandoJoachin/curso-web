<?php
    require "includes/funciones.php";
    incluirTemplate("header");
?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en Venta frente al bosque</h1>
        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <img loading="lazy" width="200" height="300" src="build/img/destacada.jpg" alt="Imagen de la propiedad">
        </picture>
        <div class="resumen-propiedad">
            <p class="precio">$3,000,000</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p>3</p>
                </li>
                <li>
                    <img loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p>3</p>
                </li>
                <li>
                    <img loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                    <p>3</p>
                </li>
            </ul>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Totam quam blanditiis ea necessitatibus suscipit officia doloremque fuga dolor commodi aliquid, 
            veritatis error ab dignissimos explicabo officiis ipsam a mollitia aut?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente, et illum vero nihil error tempora reprehenderit, quas est, soluta itaque magni 
            exercitationem obcaecati illo ad voluptatibus natus! Incidunt, quasi quam!</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos soluta earum est tempore quod possimus libero totam hic ipsa voluptates reprehenderit recusandae culpa esse, 
            velit quidem delectus explicabo minus dolorum!</p>
        </div>
    </main>
<?php
    incluirTemplate("footer");
?>