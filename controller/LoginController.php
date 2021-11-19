<?php
namespace Controller;
use MVC\Router;
use Model\User;
class LoginController{

    public static function login(Router $router){
        $errors = User::getErrors();
        $user = new User();
        if($_SERVER['REQUEST_METHOD'] ==='POST'){
            $user = new User($_POST);
            $errors = $user->validateUser();
            if(empty($errors)){
                session_start();
                $_SESSION['user'] = $user->email;
                $_SESSION['login'] = true;
                header("location: /admin");    
            }
        }
        $pageTitle = 'Bienes raices: inicio de sesión';
        $router->render('log_in/login', [
            'errors' => $errors,
            'pageTitle' => $pageTitle
        ]);
    }

    public static function sesionClose(Router $router){
        session_start();
        session_unset();
        header('location: /');
    }
}
?>
