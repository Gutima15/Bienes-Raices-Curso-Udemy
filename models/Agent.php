<?php
namespace Model;
Class Agent extends ActiveRecord{
    protected static $table = 'Agent';
    protected static $columnDB = ['id','aName','lastname','phone'];

    public $id;
    public $aName;
    public $lastname;
    public $phone;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->aName = $args['aName'] ?? '';
        $this->lastname = $args['lastname'] ?? '';
        $this->phone = $args['phone'] ?? '';;
    }

    public function deleteAgent(){
        $consult = $this->delete();
        return $consult;
    }

    public function validateAgent(){
        if(!$this->aName){
            self::$errors[] = "El nombre es obligatorio";
        }
        if(!$this->lastname){
            self::$errors[] = "El apellido es obligatorio";
        }
        if(!$this->phone){
            self::$errors[] = "El teléfono es obligatorio";
        }
        if(!preg_match("/(^[5-9])\d{3}[\s| |-]*\d{4}/", $this->phone)){ //Para expresiones regulares
            self::$errors[] = "El formato no es válido dentro de Costa Rica";
        }
        return self::$errors;
    }

}
?>