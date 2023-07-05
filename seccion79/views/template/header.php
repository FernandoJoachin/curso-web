<header class="header">
    <div class="header__contenedor">
        <nav class="header__nav">
            <?php if(esta_Autenticado()){?>
                <a href="<?php echo esAdmin() ? "/admin/dashboard" : "/finalizar-registro"; ?>" class="header__enlace">Administrar</a>
                <form class="header__form" action="/logout" method="POST">
                    <input type="submit" class="header__submit" value="Cerrar Sesion">
                </form>
            <?php } else{ ?>
                <a href="/registro" class="header__enlace">Registro</a>
                <a href="/login" class="header__enlace">Iniciar Sesión</a>
            <?php }?>
        </nav>

        <div class="header__contenido">
            <a href="/"><h1 class="header__logo">&#60;DevWebCamp/></h1></a>
            <p class="header__texto">Octubre 5-6 - 2023</p>
            <p class="header__texto header__texto--modalidad">En linea - Presencial</p>
            <a href="/registro" class="header__btn">Comprar Pase</a>
        </div>
    </div>
</header>

<div class="barra">
    <div class="barra__contenido">
        <a href="/"><h2 class="barra__logo">&#60;DevWebCamp/></h2></a>
        <nav class="nav">
            <a href="/devwebcamp" class="nav__enlace <?php echo pagina_actual("/devwebcamp") ? "nav__enlace--actual" : "";?>">Eventos</a>
            <a href="/paquetes" class="nav__enlace <?php echo pagina_actual("/paquetes") ? "nav__enlace--actual" : "";?>">Paquetes</a>
            <a href="/workshops-conferencia" class="nav__enlace <?php echo pagina_actual("/workshops-conferencia") ? "nav__enlace--actual" : "";?>">Workshops / Conferencias</a>
            <?php if(!esta_Autenticado()){ ?>
                <a href="/registro" class="nav__enlace <?php echo pagina_actual("/registro") ? "nav__enlace--actual" : "";?>">Comprar pase</a>
            <?php }?>
        </nav>
    </div>
</div>