<?php
    require "includes/app.php";
    incluirTemplate("header");
?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Nuestro blog</h1>
        <article class="entrada-blog">
            <div class="img">
                <picture>
                    <source srcset="/build/img/blog1.webp" type="image/webp">
                    <img loading="lazy" src="/build/img/blog1.jpg" alt="Imagen Entrada de Blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Terraza en el techo de tu casa</h4>
                    <p class="informacion-meta">
                        Escrito el:
                        <span>30/04/2021</span>
                        por:
                        <span>Fernando Joachín Prieto</span>
                    </p>
                    <p>Consejos para construir una terraza en el techo de tu casa con
                    los mejores materiales y ahorrando dinero.</p>
                </a>
            </div>
        </article>
        <article class="entrada-blog">
            <div class="img">
                <picture>
                    <source srcset="/build/img/blog2.webp" type="image/webp">
                    <img loading="lazy" src="/build/img/blog2.jpg" alt="Imagen Entrada de Blog">
                </picture>
            </div>
            <div class="texto-entrada">
               <a href="entrada.php">
                    <h4>Guía para la decoración de tu hogar</h4>
                    <p class="informacion-meta">
                        Escrito el:
                        <span>30/04/2021</span>
                        por:
                        <span>Fernando Joachín Prieto</span>
                    </p>
                    <p>Maximiza el espacio en tu hogar con esta guia, 
                    aprende a combinar muebles y colores para darle vida a tu espacio.</p>
               </a>
            </div>
        </article>

        <article class="entrada-blog">
            <div class="img">
                <picture>
                    <source srcset="/build/img/blog3.webp" type="image/webp">
                    <img loading="lazy" src="/build/img/blog3.jpg" alt="Imagen Entrada de Blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Terraza en el techo de tu casa</h4>
                    <p class="informacion-meta">
                        Escrito el:
                        <span>30/04/2021</span>
                        por:
                        <span>Fernando Joachín Prieto</span>
                    </p>
                    <p>Consejos para construir una terraza en el techo de tu casa con
                    los mejores materiales y ahorrando dinero.</p>
                </a>
            </div>
        </article>
        <article class="entrada-blog">
            <div class="img">
                <picture>
                    <source srcset="/build/img/blog4.webp" type="image/webp">
                    <img loading="lazy" src="/build/img/blog4.jpg" alt="Imagen Entrada de Blog">
                </picture>
            </div>
            <div class="texto-entrada">
               <a href="entrada.php">
                    <h4>Guía para la decoración de tu hogar</h4>
                    <p class="informacion-meta">
                        Escrito el:
                        <span>30/04/2021</span>
                        por:
                        <span>Fernando Joachín Prieto</span>
                    </p>
                    <p>Maximiza el espacio en tu hogar con esta guia, 
                    aprende a combinar muebles y colores para darle vida a tu espacio.</p>
               </a>
            </div>
        </article>
    </main>
<?php
    incluirTemplate("footer");
?>