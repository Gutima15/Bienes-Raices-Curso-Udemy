<?php
    namespace MVC;
    
    class Router{
        public $getRoutes = [];
        public $postRoutes = [];

        public function get($url, $func){
            $this->getRoutes[$url] = $func;
        }
        public function post($url, $func){
            $this->postRoutes[$url] = $func;
        }

        public function routesCheck(){
            session_start();
            $auth = $_SESSION['login'] ?? null;
            //Protectec routes
            $protectedRoutes= ['/admin','properties/create','properties/update','properties/delete','agents/create','agents/update','agents/delete','admin_blog/create','admin_blog/update','admin_blog/delete'];
            $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
            $method = $_SERVER['REQUEST_METHOD'];
            if($method === 'GET'){
                $func = $this->getRoutes[$currentUrl] ?? null;
            } else {
                $func = $this->postRoutes[$currentUrl] ?? null;
            }

            //protect routed
            if(in_array($currentUrl, $protectedRoutes) && !$auth){
                header("location: /");
            }

            if($func){
                call_user_func($func, $this);
            } else {
                echo 'Page not found';
            }
        }
        
        //show view
        public function render($view, $data = []) {
            foreach($data as $key => $value){
                $$key = $value; //show value with key name
            }
            
            ob_start();
            include __DIR__ . "/view/".$view.".php";
            $content = ob_get_clean();
            include __DIR__ . "/view/layout.php";
        }
    }
?>