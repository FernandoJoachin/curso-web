<?php
    if(!isset($_SESSION)){
        session_start();
    }
    $auth = $_SESSION["login"] ?? false;

    if(!isset($inicio)){
        $inicio = false;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preload" href="/build/css/app.css" as="style">
    <link rel="stylesheet" href="/build/css/app.css">
    <title>Bienes raices</title>
</head>
<body>
    <header class="header <?php echo $inicio ? "inicio" : ""; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="Logo">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono de menu responsive">
                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="/build/img/dark-mode.svg" alt="dark mode">
                    <div class="navegacion">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/anuncios">Anuncios</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>
                        <?php if($auth){ ?>
                            <a href="/logout">Cerrar Sesión</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php if($inicio){ ?>
                <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php } ?>    
        </div>
    </header>

    <?php echo $contenido; ?>

    <footer class="footer seccion">
        <div class="contenedor contenido-footer">
            <div class="navegacion">
                <a href="/nosotros">Nostros</a>
                <a href="/anuncios">Anuncios</a>
                <a href="/blog">Blog</a>
                <a href="/contacto">Contacto</a>
            </div>
        </div>
        <p class="copyright">Todos los derechos reservados <?php echo date("Y"); ?> &copy;</p>
    </footer>
    <script src="/build/js/bundle.min.js"></script>
</body>
</html>