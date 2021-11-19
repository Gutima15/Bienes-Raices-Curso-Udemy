<?php
namespace Model;
Class ActiveRecord {
    
    protected static $columnDB = [];
    protected static $table = '';

    protected static $errors = [];

    public function __construct($args = []){
        
    }
    public function insert() {
        //connect to DB
        $db = connectingDB();
        //cleaning data
        $attributes = $this->filterData($db);
        //Preparing data for store procedure
        $attributes = join("', '" , array_values($attributes));
        $sp = "CALL ". static::$table ."_insert('". $attributes ."' )";
        $consult = $db->query($sp);
        mysqli_close($db); 
        return $consult;
    }

    //List all properties
    public static function getAll(){     
        $sp = "CALL ". static::$table . "_getAll()";
        $objectList = self::addObjToList($sp);
        return $objectList;
    }

    public static function getAllLimited($limit) {        
        $sp = $sp = "CALL ". static::$table . "_getAllLimited(". $limit .")";
        $objectList = self::addObjToList($sp);
        return $objectList;
    }

    //Update a property according to the class actual information
    public function update(){
        $db = connectingDB();
        $attributes = $this->filterData($db);        
        $attributes = join("', '" , array_values($attributes));        
        $sp = "CALL ". static::$table ."_update('". $db->escape_string($this->id) ."', '" . $attributes ."' )";
        $consult = $db->query($sp);
        mysqli_close($db);
        return $consult;
    }

    //Get the info for the update window by id
    public static function find($attribute){
        $sp = "CALL " . static::$table . "_find('$attribute')";
        $propertyList = self::addObjToList($sp);
        return array_shift($propertyList); //return $propertyList[0] //https://www.php.net/manual/es/function.array-shift.php
    }

    public function delete(){
        $db = connectingDB();    
        $sp = "CALL " . static::$table . "_delete(".$db->escape_string($this->id).")";
        $consult =$db->query($sp);       
        mysqli_close($db);
        return $consult;
    }

    //clean the class attributes stores in an array
    public function filterData($db) {
        $attributes = $this->matchAttributes();
        $cleanAttr = [];
        foreach($attributes as $key => $value) {
            $cleanAttr[$key] = $db->escape_string($value);
        }
        return $cleanAttr;
    }

    //Store the atributes in one array (obj like)
    //Requieres column[0] as id
    public function matchAttributes(){
        $attributes = []; //works like a js object
        foreach(static::$columnDB as $column){
            if ($column === static::$columnDB[0]) continue; //self::$columnDB[0] always add the id at first
            $attributes[$column] = $this->$column;//ex: when $column = price then $this->price
        }
        return $attributes;
    }

    public static function addObjToList($sp){ //General
        $db = connectingDB();
        $consult = $db->query($sp);
        $array = [];
        while( $register = $consult->fetch_assoc()) {
            $array[] = static::createObj($register); //to avoid this register
        }
        mysqli_close($db);
        return $array;
    }

    public static function createObj($dbRegister){ //General
        $obj = new static;  
        foreach($dbRegister as $key => $value){
            if(property_exists( $obj, $key )){
                $obj->$key = $value;
            }
        }
        return $obj;
    }

    public static function getErrors(){
        return static::$errors;
    }

    //Syncronize the memory object with user changes.
    public function sync($args = []){
        foreach($args as $key => $value){
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }
}
?>