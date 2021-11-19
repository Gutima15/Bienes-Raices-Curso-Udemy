<?php
    namespace Controller;
    use MVC\Router;
    use Model\Property;
    use Model\Agent;
    use Model\Blog;
    use Intervention\Image\ImageManagerStatic as Image;
    Class PropertyController {

        public static function index(Router $router){            
            $properties = Property::getAll();
            $agents = Agent::getAll();
            $entries = Blog::getAll();
            $result = $_GET['result'] ?? null;
            $pageTitle = 'Inicio: administrador';
            $router->render('properties/admin', [
                'pageTitle' => $pageTitle,
                'properties' => $properties,
                'agents' => $agents,
                'entries' => $entries,
                'result' => $result
            ]);
        }

        public static function create(Router $router){
            $errors = Property::getErrors();
            $agents = Agent::getAll();
            $property = new Property;

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $property = new Property($_POST);
                //unique name to image
                $uImageName = md5(uniqid( rand(), true )) . '.jpg';

                //Resize to the image y la setea
                if($_FILES['image']['tmp_name']){
                    $image = Image::make($_FILES['image']['tmp_name'])->fit(800,600);
                    $property->setImage($uImageName);
                }
                $errors = $property->validateInputs();

                if(empty($errors)){  

                    if(!is_dir(IMAGE_FOLDER)){ //create folder
                        mkdir(IMAGE_FOLDER);
                    }
                    //at the server
                    $image->save(IMAGE_FOLDER . $uImageName);

                    $consult = $property->insert();

                    if($consult){
                        //redirect User
                        $URL="location: /admin?result=1";
                        header($URL);                    
                    } 
                }
            }
            $pageTitle = 'Propiedades: Crear';
            $router->render('properties/create', [
                'pageTitle' => $pageTitle,
                'property' => $property,
                'errors' => $errors,
                'agents' => $agents
            ]);
        }

        public static function update(Router $router){
            $propertyId = $_GET['id'];
            $propertyId = filter_var($propertyId, FILTER_VALIDATE_INT);
            $errors = Property::getErrors();
            $agents = Agent::getAll();
            if(!$propertyId){
                header("location: /admin");
            }
            $property = Property::find($propertyId);
            
            if($_SERVER['REQUEST_METHOD'] === 'POST'){        
                //Asign attributes.
                $args = [];
                $args['title'] = $_POST['title'] ?? null;
                $args['price'] = $_POST['price'] ?? null;
                $args['description'] = $_POST['description'] ?? null;
                $args['rooms'] = $_POST['rooms'] ?? null;
                $args['wc'] = $_POST['wc'] ?? null;
                $args['parking'] = $_POST['parking'] ?? null;
                $args['agentId'] = $_POST['agentId'] ?? null;
                $args['imageProperty'] = $_POST['image'] ?? null;
                $property->sync($args);
                
                $uImageName = md5(uniqid( rand(), true )) . '.jpg';
                //Resize to the image y la setea
                if($_FILES['image']['tmp_name']){
                    $image = Image::make($_FILES['image']['tmp_name'])->fit(800,600);
                    $property->setImage($uImageName);
                }

                //Validating info
                $errors = $property->validateInputs();

                if(empty($errors)){
                    
                    if($_FILES['image']['tmp_name']){
                        //uploading Obj
                        $property->setImage($uImageName);
                        //store image
                        $image->save(IMAGE_FOLDER . $uImageName);
                    }
        
                    $consult = $property->update();
                    if($consult){
                        //redirect User
                        header("location: /admin?result=2");
                    } 
                
                }
            } 
            $pageTitle = 'Propiedades: Actualizar';
            $router->render('/properties/update',[
                'pageTitle' => $pageTitle,
                'property' => $property,
                'errors' => $errors,
                'agents' => $agents
            ]);
        }

        public static function delete(Router $router){
            if($_SERVER['REQUEST_METHOD'] === 'POST'){        
                $id = $_POST['id']; 
                $id = filter_var($id, FILTER_VALIDATE_INT);
                if($id){
                    $type = $_POST['type'];
                    if(validateContent($type)){
                        $property = Property::find($id);            
                        $deleteConsult = $property->deleteProperty();
                        //$deleteConsult = deleteProperty($id);
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