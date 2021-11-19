<?php
    require_once __DIR__ . "/../includes/app.php";
    use MVC\Router;
    use Controller\PropertyController;
    use Controller\AgentController;
    use Controller\BlogController;
    use Controller\pageController;
    use Controller\LoginController;


    $router = new Router();

    $router->get('/admin', [PropertyController::class, 'index']);

    $router->get('/properties/create', [PropertyController::class, 'create']);
    $router->post('/properties/create', [PropertyController::class, 'create']);
    $router->get('/properties/update', [PropertyController::class, 'update']);
    $router->post('/properties/update', [PropertyController::class, 'update']);
    $router->post('/properties/delete', [PropertyController::class, 'delete']);
    
    $router->get('/agents/create', [AgentController::class, 'create']);
    $router->post('/agents/create', [AgentController::class, 'create']);
    $router->get('/agents/update', [AgentController::class, 'update']);
    $router->post('/agents/update', [AgentController::class, 'update']);
    $router->post('/agents/delete', [AgentController::class, 'delete']);
    
    $router->get('/admin_blog/create', [BlogController::class, 'create']);
    $router->post('/admin_blog/create', [BlogController::class, 'create']);
    $router->get('/admin_blog/update', [BlogController::class, 'update']);
    $router->post('/admin_blog/update', [BlogController::class, 'update']);
    $router->post('/admin_blog/delete', [BlogController::class, 'delete']);
    
    //general access
    $router->get('/',[pageController::class, 'index']);
    $router->get('/nosotros',[pageController::class, 'nosotros']);
    $router->get('/propiedades',[pageController::class, 'propiedades']);
    $router->get('/propiedad',[pageController::class, 'propiedad']);
    $router->get('/blog',[pageController::class, 'blog']);
    $router->get('/entrada',[pageController::class, 'entrada']);
    $router->get('/contacto',[pageController::class, 'contacto']);
    $router->post('/contacto',[pageController::class, 'contacto']);

    //authentication
    $router->get('/login',[LoginController::class, 'login']);
    $router->post('/login',[LoginController::class, 'login']);
    $router->get('/sesionClose',[LoginController::class, 'sesionClose']);
    $router->routesCheck();
?>