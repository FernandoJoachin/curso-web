<?php
    require "includes/app.php";
    incluirTemplate("header");
?>
    <main class="contenedor seccion">
        <h1>Conoce sobre Nosotros</h1>
        <div class="contenido-nosotros">
            <div class="img">
                <picture>
                    <source srcset="/build/img/nosotros.webp" type="image/webp">
                    <source srcset="/build/img/nosotros.jpg" type="image/jpg">
                    <img loading="lazy" width="200" height="300" src="build/img/nosotros.jpg" alt="">
                </picture>
            </div>
            <div class="texto-nosotros">
                <blockquote>
                    25 años de experiencia
                </blockquote>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Architecto doloremque perspiciatis sunt velit ab cumque corporis ducimus ex labore reiciendis 
                ad atque quasi dicta harum odit, ut omnis. Tempore, tenetur!</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur laudantium similique aspernatur commodi, illum corporis hic sequi voluptates maiores, autem velit 
                ducimus libero iste nulla ipsa quo assumenda, distinctio porro!</p>
            </div>

        </div>
    </main>

    <section class="contenedor seccion">
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
    </section>
<?php
    incluirTemplate("footer");
?>