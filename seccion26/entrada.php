<?php
    require "includes/app.php";
    incluirTemplate("header");
?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Guía para la decoración de tu hogar</h1>
        <picture>
            <source srcset="/build/img/blog2.webp" type="image/webp">
            <img loading="lazy" width="200" height="300" src="build/img/blog2.jpg" alt="Imagen de la propiedad">
        </picture>
        <div class="resumen-blog">
            <p class="informacion-meta">
                Escrito el:
                <span>30/04/2021</span>
                por:
                <span>Fernando Joachín Prieto</span>
            </p>
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