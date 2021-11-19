<?php
    namespace Controller;
    use MVC\Router;
    use Model\Agent;

    Class AgentController {

        public static function create(Router $router){
            $errors = Agent::getErrors();
            $agent = new Agent;
            if($_SERVER['REQUEST_METHOD'] === 'POST'){    
                $agent = new Agent($_POST);
                $errors = $agent->validateAgent();
                if(empty($errors)){
                    $consult = $agent->insert();
                    if($consult){
                        //redirect User
                        $URL="location: /admin?result=1";
                        header($URL);                    
                    } 
                }
            }
            $pageTitle = 'Agente: Crear';
            $router->render('agents/create', [
                'pageTitle' => $pageTitle,
                'errors' => $errors,
                'agent' => $agent
            ]);
        }

        public static function update(Router $router){
            $agentId = $_GET['id'];
            $agentId = filter_var($agentId, FILTER_VALIDATE_INT);
            if(!$agentId){
                header('Location: /admin');
            }

            //get agent array
            $agent = Agent::find($agentId);
            $errors = Agent::getErrors();
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                //Asign attributes.
                $args = [];
                $args['aName'] = $_POST['aName'] ?? null;
                $args['lastname'] = $_POST['lastname'] ?? null;
                $args['phone'] = $_POST['phone'] ?? null;        
                $agent->sync($args);// sync the object       
                $errors = $agent->validateAgent();
                if(empty($errors)){
                    $consult = $agent->update();
                    if($consult){
                        //redirect User
                        header("location: /admin?result=2");
                    }
                }
            }
            $pageTitle = 'Agente: Actualizar';
            $router->render('agents/update', [
                'pageTitle' => $pageTitle,
                'errors' => $errors,
                'agent' => $agent
            ]);
        }
        
        public static function delete(Router $router){
            if($_SERVER['REQUEST_METHOD'] === 'POST'){        
                $id = $_POST['id']; 
                $id = filter_var($id, FILTER_VALIDATE_INT);
                if($id){
                    $type = $_POST['type'];
                    if(validateContent($type)){
                        $agent = Agent::find($id);            
                        $deleteConsult = $agent->deleteAgent();
                        if($deleteConsult){
                        $URL="location: /admin?result=3";
                        header($URL);
                        }
                        
                    }
                }
            }
        }
    }
?>