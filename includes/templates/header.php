<?php 
    if(!isset($_SESSION)){
        session_start();
    }
    $auth = $_SESSION['login'] ?? false; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle?></title>
<link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
<header class="header <?php echo $homePage ? 'inicio' : '' ?>">
    <div class="contenedor contenido-header">
        <div class="barra">
            <!-- <a href="/" aria-label=""> -->
            <input alt="Bienes Raices Inicio" type="image" src="/build/img/logo.svg" height="50" onclick="location.href= '/'">
            <!-- </a> -->

            <div class="mobile-menu">
                <input type="image" src="/build/img/barras.svg" height="50" id="optionsMenu" alt="Option Menu">
            </div>
            
            <div class="derecha">
                <input class="dark-mode-button" type="image" src="/build/img/dark-mode-white.svg" height="30" name="DarkMode" id="DarkMode" alt="Dark mode option">
                <nav class="navegacion">
                    <input type="button" value="Nosotros" onclick = "location.href='/nosotros.php'">
                    <input type="button" value="Anuncios" onclick = "location.href='/anuncios.php'">
                    <input type="button" value="Blog" onclick = "location.href='/blog.php'">
                    <input type="button" value="Contactos" onclick = "location.href='/contacto.php'">
                    <?php if($auth){ ?>
                        <input type="button" value="Cerrar sesión" onclick = "location.href='/sesionClose.php'">
                    <?php } ?>
                </nav>
            </div>
        </div>
        <?php echo $homeText ? '<h1>Venta de casas y departamentos exclusivos de lujo</h1>' : '' ?>
        
    </div>
</header>