<?php
namespace Controller;
use MVC\Router;
use Model\Property;
use Model\User;
use Model\Blog;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class pageController{

    public static function index(Router $router){
        $properties = Property::getAllLimited(3);
        $entries = Blog::getAllLimited(2);
        $pageTitle = "Bienes Raices: Inicio";
        $homeText = true;
        $homePage = true;
        $router->render('pages/index', [
            'pageTitle' => $pageTitle,
            'homePage' => $homePage,
            'homeText' => $homeText,
            'properties' => $properties,
            'entries' => $entries
        ]);
    }
    public static function nosotros(Router $router){
        $pageTitle = 'Bienes Raices: Nosotros';
        $router->render('pages/nosotros', [
            'pageTitle' => $pageTitle
        ]);
    }
    public static function propiedades(Router $router){
        $pageTitle = 'Bienes Raices: Propiedades';
        $properties = Property::getAll();
        $router->render('pages/propiedades', [
            'pageTitle' => $pageTitle,
            'properties' => $properties
        ]);
    }
    public static function propiedad(Router $router){
        $id= $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if(!$id){
            header("location: /");
        }

        $property = Property::find($id);
        $pageTitle = 'Bienes Raices: '. $property->title;
        
        $router->render('pages/propiedad', [
            'pageTitle' => $pageTitle,
            'property' => $property
        ]);
    }
    public static function blog(Router $router){
        $entries = Blog::getAllLimited(12);
        $pageTitle = 'Bienes Raices: blog';
        $router->render('pages/blog', [
            'pageTitle' => $pageTitle,
            'entries' => $entries
        ]);
    }
    public static function entrada(Router $router){
        $id= $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if(!$id){
            header("location: /");
        }

        $entry = Blog::find($id);
        $pageTitle = 'Bienes Raices: '. $entry->title;
        $router->render('pages/entrada', [
            'pageTitle' => $pageTitle,
            'entry' => $entry
        ]);
    }
    public static function contacto(Router $router){
        $mjs = null;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $phpmailer = new PHPMailer();
            $phpmailer->isSMTP();
            $phpmailer->Host = 'smtp.mailtrap.io';
            $phpmailer->SMTPAuth = true;
            $phpmailer->Port = 2525;
            $phpmailer->Username = 'f15df1cd5c0631';
            $phpmailer->Password = '450c92b515cf9f';
            $phpmailer->SMTPSecure = 'tls';

            $contact = $_POST['contact'];
            //configure the email
            $phpmailer->setFrom($contact['email']);//admin@bienesraices.com
            $phpmailer->addAddress('admin@bienesraices.com','BienesRaices.com');
            $phpmailer->Subject = 'Tienes un nuevo mensaje';
            //enable html
            $phpmailer->isHTML(true);
            $phpmailer->CharSet = 'UTF-8';

            //content
            $content = '<html>';
            $content .= '<p>Nombre: '. $contact['name']. '</p>';                        
            $content .= '<p>Mensaje: '. $contact['mjs'] . '</p>';
            $content .= '<p>Tipo: '. $contact['options'] . '</p>';
            $content .= '<p>Presupuesto: $'. $contact['price'] . '</p>';
            $content .= '<p>Contactar por: '. $contact['contact_radio'] . '</p>';
            if($contact['contact_radio'] === 'télefono'){
                $content .= '<p>Teléfono: '. $contact['phone'] . '</p>';
                $content .= '<p>fecha para contactar: '. $contact['date'] . '</p>';
                $content .= '<p>hora para contactar: '. $contact['hour'] . '</p>';
            } else {
                $content .= '<p>email: '. $contact['email'] . '</p>';
            }
            $content .= '</html>';
            $phpmailer->Body = $content;
            // sending email.
            if($phpmailer->send()){
                $mjs = 'Mensaje enviado correctamente.';
            } else {
                $mjs = 'El mensaje no pudo ser enviado';
            }

        }

        $pageTitle = 'Bienes Raices: Contacto';
        $router->render('pages/contacto', [
            'pageTitle' => $pageTitle,
            'mjs' => $mjs
        ]);
    }
}
?>