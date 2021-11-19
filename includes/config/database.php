<?php

function connectingDB(): mysqli {
    $db= new mysqli('127.0.0.1','root','','bienesRaices_crud');

    if(!$db) {
    echo "Error: It was a problem connecting to the database";
    exit;
    }

    return $db;
} 

//done at property class
function insertProperty($title, $price, $image ,$desc, $rooms, $wc, $parking, $date ,$agent) {
    $db = connectingDB();
    //Insert in DB https://www.mysqltutorial.org/stored-procedures-parameters.aspx
    $sp = "CALL Property_insert('$title' , $price , '$image' , '$desc' , $rooms, $wc , $parking , '$date' ,$agent)";
    $consult = mysqli_query($db,$sp);
    mysqli_close($db); //https://www.geeksforgeeks.org/php-mysqli_close-function/#:~:text=To%20close%20the%20connection%20in,mysqli_close(conn)%3B
    return $consult;
}

function getAgents() {
    $db = connectingDB();
    $sp = "CALL Agent_getAll()";
    $consult = mysqli_query($db,$sp);
    mysqli_close($db);
    return $consult;
}

function getAllProperties() {
    $db = connectingDB();
    $sp = "CALL Property_getAll()";
    $consult = mysqli_query($db,$sp);
    mysqli_close($db);
    return $consult;
}

function getUpdatableInfo($id){
    $db = connectingDB();
    $sp = "CALL getUpdateInfo('$id')";
    $consult = mysqli_query($db,$sp);
    mysqli_close($db);
    return $consult;
}

function updateProperty($id, $title, $price, $image ,$desc, $rooms, $wc, $parking, $date ,$agent){
    $db = connectingDB();
    $sp = "CALL Property_update($id, '$title' , $price , '$image' , '$desc' , $rooms, $wc , $parking , '$date' , $agent)";
    $consult = mysqli_query($db,$sp);
    mysqli_close($db);
    return $consult;
}

function deleteImage($id){
    $db = connectingDB();   
    $spi = "CALL getImage($id)"; 
    $consult = mysqli_query($db,$spi);
    $property = mysqli_fetch_assoc($consult);
    unlink("../images/" . $property['image']);
    mysqli_close($db);
}
function deleteProperty($id){
    deleteImage($id);
    $db = connectingDB();
    $sp = "CALL Property_delete('$id')";
    $consult = mysqli_query($db,$sp);
    mysqli_close($db);
    return $consult;
}

function getAllAddsData($limit) {
    $db = connectingDB();
    $sp = "CALL getAllAddsData($limit)";
    $consult = mysqli_query($db,$sp);
    mysqli_close($db);
    return $consult;
}

function getAddDataById($id) {
    $db = connectingDB();
    $sp = "CALL getAddDatabyId($id)";
    $consult = mysqli_query($db,$sp);
    mysqli_close($db);
    return $consult;
}

function insertUser($email, $password) {
    $db = connectingDB();
    $sp = "CALL insertUser('$email', '$password')";
    $consult = mysqli_query($db,$sp);
    mysqli_close($db);
    return $consult;
}

function getUserByEmail($email) {
    $db = connectingDB();
    $sp = "CALL getUserByEmail('$email')";
    $consult =$db->query($sp);  
    mysqli_close($db);
    return $consult;
}

?>
