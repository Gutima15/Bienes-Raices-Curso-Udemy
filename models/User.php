<?php
namespace Model;
Class User extends ActiveRecord{
    protected static $table = 'User';
    protected static $columnDB = ['id','email','password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? null;
        $this->password = $args['passWord'] ?? null;
    }

    public function deleteUser(){
        $consult = $this->delete();
        return $consult;
    }

    public function validateUser(){
        $userDB = $this->find($this->email);
        if(strlen($this->email) === 0){
            self::$errors[] = 'El email es obligatorio';
        }
        if(strlen($this->password) === 0){
            self::$errors[] = 'El password es obligatorio';
        } elseif($userDB == false || !password_verify($this->password, $userDB->password)){
            self::$errors[] = 'El usuario o contraseña es incorrecto';
        } 
        return self::$errors;
    }

}
?>