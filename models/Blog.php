<?php
namespace Model;
Class Blog extends ActiveRecord{
    protected static $table = 'Blog';
    protected static $columnDB = ['id','title','summary','entryText','image','publicationDate','createdBy'];

    public $id;
    public $title;
    public $summary;
    public $entryText;
    public $image;
    public $publicationDate;
    public $createdBy;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->title = $args['title'] ?? '';
        $this->summary = $args['summary'] ?? '';
        $this->entryText = $args['entryText'] ?? '';
        $this->image = '';
        $this->publicationDate = date('Y/m/d');
        $this->createdBy = $args['createdBy'] ?? '';

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

    public function deleteEntry(){
        $this->deleteImage();
        $consult = $this->delete();
        return $consult;
    }
  
    public function validateEntry(){
        if(!$this->title){
            self::$errors[] = "El título es obligatorio";
        }
        if($this->summary && strlen($this->summary) >= 180){
            self::$errors[] = "El resumen es obligatorio y no debe tener más de 180 caracteres.";
        }
        if(!$this->entryText){
            self::$errors[] = "El texto de la entrada es obligatorio";
        }
        if(!$this->image){
            self::$errors[] = 'La imagen es obligatoria.';
        }
        return self::$errors;
    }
}
?>