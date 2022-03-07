<?php

class Connect {

public static function Connection(){

try{

    $db = new PDO("mysql:host=localhost; dbname=crud-project" , "root", "1234"); 

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db->exec("set names utf8mb4");;



}catch(Exception $e){

    die("Error:" . $e->getMessage());
    
    echo "error line: " . $e->getLine();

}

return $db;

 }
}

?>