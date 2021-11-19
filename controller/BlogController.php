<?php
    namespace Controller;
    use MVC\Router;
    use Intervention\Image\ImageManagerStatic as Image;
    use Model\Blog;
    use Model\User;

    Class BlogController {

        public static function create(Router $router){    
            $errors = Blog::getErrors();            
            $entry = new Blog();
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $entry = new Blog($_POST);
                //unique name to image
                $uImageName = md5(uniqid( rand(), true )) . '.jpg';

                //Resize to the image y la setea
                if($_FILES['image']['tmp_name']){
                    $image = Image::make($_FILES['image']['tmp_name'])->fit(800,600);
                    $entry->setImage($uImageName);
                }
                $errors = $entry->validateEntry();

                if(empty($errors)){  

                    if(!is_dir(IMAGE_FOLDER)){ //create folder
                        mkdir(IMAGE_FOLDER);
                    }
                    //at the server
                    $image->save(IMAGE_FOLDER . $uImageName);

                    //Adding the user...
                    session_start();  
                    $entry->createdBy = $_SESSION['user'];
                    //inserting
                    $consult = $entry->insert();
                    if($consult){
                        //redirect User
                        $URL="location: /admin?result=1";
                        header($URL);                   
                    } 
                }
            }
            $pageTitle = 'Blog: Crear entrada';
            $router->render('admin_blog/create', [
                'pageTitle' => $pageTitle,
                'errors' => $errors,
                'entry' => $entry
            ]);
        }

        public static function update(Router $router){
            $entryId = $_GET['id'];
            $entryId = filter_var($entryId, FILTER_VALIDATE_INT);
            $errors = Blog::getErrors();
            if(!$entryId){
                header("location: /admin");
            }
            $entry = Blog::find($entryId);
            
            if($_SERVER['REQUEST_METHOD'] === 'POST'){        
                //Asign attributes.
                $args = [];
                $args['title'] = $_POST['title'] ?? null;
                $args['summary'] = $_POST['summary'] ?? null;
                $args['entryText'] = $_POST['entryText'] ?? null;
                $args['image'] =  $_POST['image'] ?? null;
                $entry->sync($args);
                
                $uImageName = md5(uniqid( rand(), true )) . '.jpg';
                //Resize to the image y la setea
                if($_FILES['image']['tmp_name']){
                    $image = Image::make($_FILES['image']['tmp_name'])->fit(800,600);
                    $entry->setImage($uImageName);
                }

                //Validating info
                $errors = $entry->validateEntry();
                if(empty($errors)){
                    
                    if($_FILES['image']['tmp_name']){
                        //uploading Obj
                        $entry->setImage($uImageName);
                        //store image
                        $image->save(IMAGE_FOLDER . $uImageName);
                    }
                    session_start();  
                    $entry->createdBy = $_SESSION['user'];
                    //updating modifications
                    $consult = $entry->update();// cambiar por $property->agentId                    
                    if($consult){
                        //redirect User
                        header("location: /admin?result=2");
                    } 
                
                }
            } 
            $pageTitle = 'Blog: Actualizar entrada';
            $router->render('/admin_blog/update',[
                'pageTitle'=> $pageTitle,
                'errors' => $errors,
                'entry' => $entry
            ]);
        }

        public static function delete(Router $router){
            if($_SERVER['REQUEST_METHOD'] === 'POST'){        
                $id = $_POST['id']; 
                $id = filter_var($id, FILTER_VALIDATE_INT);
                if($id){
                    $type = $_POST['type'];
                    if(validateContent($type)){
                        $entry = Blog::find($id);            
                        $deleteConsult = $entry->deleteEntry();
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