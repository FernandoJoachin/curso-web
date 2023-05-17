<?php
    require "includes/app.php";
    incluirTemplate("header", true);
?>
    <main class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="/build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Accusamus blanditiis officia reiciendis quos, dolores nostrum perspiciatis vitae! Incidunt iste iure nihil. 
                Distinctio repellat eos officia esse totam mollitia inventore quibusdam.</p>
            </div>
            <div class="icono">
                <img src="/build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Accusamus blanditiis officia reiciendis quos, dolores nostrum perspiciatis vitae! Incidunt iste iure nihil. 
                Distinctio repellat eos officia esse totam mollitia inventore quibusdam.</p>
            </div>
            <div class="icono">
                <img src="/build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>A Tiempo</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Accusamus blanditiis officia reiciendis quos, dolores nostrum perspiciatis vitae! Incidunt iste iure nihil. 
                Distinctio repellat eos officia esse totam mollitia inventore quibusdam.</p>
            </div>
        </div>
    </main>

    <section class="seccion contenedor">
        <h1>Casas y Departamentos en Venta</h1>
        
        <?php
            include "includes/template/anuncio.php";
        ?>
        
        <div class="ver-todas alinear-derecha">
            <a class="boton-verde" href="anuncions.html">Ver todas</a>
        </div>
    </section>

    <section class="img-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad</p>
        <a class="boton-amarillo" href="contacto.html">Contáctanos</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro blog</h3>
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
                        <img loading="lazy" src="build/img/blog2.jpg" alt="Imagen Entrada de Blog">
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
        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote>
                    El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas.
                </blockquote>
                <p>- Fernando Joachín Prieto</p>
            </div>

        </section>
    </div>
<?php
    incluirTemplate("footer");
?>