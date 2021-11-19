<?php 
    if(!isset($_SESSION)){
        session_start();
    }
    $auth = $_SESSION['login'] ?? false; 

    if(!isset($homePage)){
        $homePage = false;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle?></title>
    <link rel="stylesheet" href="../build/css/app.css">
</head>
<body>
    <header class="header <?php echo $homePage ? 'inicio' : '' ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <!-- <a href="/" aria-label=""> -->
                <input alt="Bienes Raices Inicio" type="image" src="../build/img/logo.svg" height="50" onclick="location.href= '/'">
                <!-- </a> -->

                <div class="mobile-menu">
                    <input type="image" src="/build/img/barras.svg" height="50" id="optionsMenu" alt="Option Menu">
                </div>
                
                <div class="derecha">
                    <input class="dark-mode-button" type="image" src="../build/img/dark-mode-white.svg" height="30" name="DarkMode" id="DarkMode" alt="Dark mode option">
                    <nav class="navegacion" data-cy="header-navigation">
                        <?php if($auth){ ?>
                            <input class='auth' type="button" value="Inicio" onclick = "location.href='/admin'">
                        <?php }else {?>
                            <input class='no_auth' type="button" value="Inicio" onclick = "location.href='/'">
                        <?php } ?>                        
                        <input type="button" value="Nosotros" onclick = "location.href='/nosotros'">
                        <input type="button" value="Propiedades" onclick = "location.href='/propiedades'">
                        <input type="button" value="Blog" onclick = "location.href='/blog'">
                        <input type="button" value="Contactos" onclick = "location.href='/contacto'">
                        <?php if($auth){ ?>
                            <input type="button" value="Cerrar sesión" onclick = "location.href='/sesionClose'">
                        <?php }else {?>
                            <input type="button" value="¿Eres administrador?" onclick = "location.href='/login'">
                        <?php } ?>
                    </nav>
                </div>
            </div>
            <?php echo $homeText ? "<h1 data-cy='home_text'>Venta de casas y departamentos exclusivos de lujo</h1>" : '' ?>
        </div>
    </header>

    <?php echo $content;?>
    
    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion" data-cy="footer-navigation">
                <input type="button" value="Nosotros" onclick = "location.href='/nosotros'">
                <input type="button" value="Propiedades" onclick = "location.href='/propiedades'">
                <input type="button" value="Blog" onclick = "location.href='/blog'">
                <input type="button" value="Contactos" onclick = "location.href='/contacto'">
            </nav>
        </div>    
        
        <p class="copyright">Todos los derechos reservados <?php echo date('Y'); ?> &copy;</p>
        <script src="../build/js/bundle.min.js"></script>
    </footer>
</body>
</html>