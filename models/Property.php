<?php
namespace Model;
//require "../includes/config/database.php";
//active record...
class Property extends ActiveRecord{
    protected static $table = 'Property';
    protected static $columnDB = ['id','title','price','image','description','rooms','wc','parking','creationDate','agentId'];

    public $id;
    public $title;
    public $price;
    public $image;
    public $description;
    public $rooms;
    public $wc;
    public $parking;
    public $creationDate;
    public $agentId;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->title = $args['title'] ?? '';
        $this->price = $args['price'] ?? '';
        $this->image = '';
        $this->description = $args['description'] ?? '';
        $this->rooms = $args['rooms'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->parking = $args['parking'] ?? '';
        $this->creationDate = date('Y/m/d');
        $this->agentId = $args['agentId'] ?? '';
    }

    public function setImage($image){
        //Delete previous image
        $this->deleteImage();
        $this->image = $image;
    }

    function deleteImage(){
        if(!is_null($this->id) && file_exists(IMAGE_FOLDER . $this->image)){
            unlink(IMAGE_FOLDER . $this->image);
        }
    }

    public function deleteProperty(){
        $this->deleteImage();
        $consult = $this->delete();
        return $consult;
    }

    //Fill a list of error messages that will be appear in the form
    public function validateInputs(){
        //error messages
        if(!$this->title){
            self::$errors[] = "La propiedad debe tener un nombre.";
        }
        if(!$this->price){
            self::$errors[] = "La propiedad debe tener un precio.";
        }
        if(!$this->description or strlen($this->description) <= 50){
            self::$errors[] = "La descripción es obligatoria y debe tener al menos 50 caracteres.";
        }
        if(!$this->rooms){
            self::$errors[] = "La propiedad debe tener habitaciones.";
        }
        if(!$this->wc){
            self::$errors[] = "La propiedad debe tener baños.";
        }
        if(!$this->parking){
            self::$errors[] = "La propiedad debe tener parqueo.";
        }
        if(!$this->agentId){
            self::$errors[] = "Debe seleccionar un vendedor.";
        }
        if(!$this->image){
            self::$errors[] = 'La imagen es obligatoria.';
        }
        return self::$errors;
    }

}