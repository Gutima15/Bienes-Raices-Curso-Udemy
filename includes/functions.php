<?php
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL',__DIR__. 'funciones.php');
define('IMAGE_FOLDER', $_SERVER['DOCUMENT_ROOT'] . '/images/' );
function addTemplate(string $name, string $pageTitle = "", bool $homePage = false, bool $homeText = false){

    include TEMPLATES_URL . "/${name}.php";
}

function isAuth():bool{
    session_start();
    if (sizeof($_SESSION) != 0);{
        return true;
    }
    return false;
}

function debugItem($var){
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    exit;
}

//Scape/clean html
function scapeHtml($html): string{
    return htmlspecialchars($html); //cleaned
}

//validate type of content
function validateContent($type){
    $types = ['agent','property','blog','entry'];
    return in_array($type, $types);
}

//show alertMessage
function showNotification($code){
    $mjs = '';
    switch($code){
        case 1:
            $mjs = 'Creado correctamente';
            break; 
        case 2:
            $mjs = 'Actualizado correctamente';
            break; 
        case 3:
            $mjs = 'Eliminado correctamente';
            break; 
        default:
            $mjs = false;
            break;
    }
    return $mjs;
}
