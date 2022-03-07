<?php
require_once("Db.php");

class UsersModel{

/* Agrega usuarios a la base de datos (CREATE) */ 

static public function addUsers($table,$data){

    $stmt= Connect::Connection()->prepare("SELECT * FROM $table WHERE username=:username");

    $username=htmlentities(addslashes($_POST["username"]));

    $stmt->bindValue(":username",$username);

    $stmt->execute();

    $registration_result = $stmt->rowCount();

    if ($registration_result != 0){
      
      return "no";

    }else{
    
    $passw = password_hash($data['password'],PASSWORD_DEFAULT);

    $stmt= Connect::Connection()->prepare("INSERT INTO $table(username,password) VALUES(:username,:password)");

    $stmt->bindParam(":username", $data["username"], PDO::PARAM_STR);
    $stmt->bindparam(":password", $passw, PDO::PARAM_STR);


    if($stmt->execute()){
        return "ok";
    }else{
        print_r(Connect::Connection()->errorInfo());
    }

    $stmt->close();

    $stmt = null;
}
}


/* Muestra usuarios de la base de datos (READ)*/

static public function showUsers($table, $item, $value){

    if($item  == null && $value == null){

        $stmt= Connect::Connection()->prepare("SELECT * FROM $table");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;

    }else{

        $stmt= Connect::Connection()->prepare("SELECT * FROM $table WHERE $item = :$item");

        $stmt->bindParam(":".$item, $value, PDO::PARAM_STR);
        
        $stmt->execute();
        
        return $stmt->fetch();
        
        $stmt->close();
        
        $stmt = null;

    }
}

      /* Actualiza usuarios de la base de datos (UPDATE) */
      
static public function updateUsers($table,$data){

    $passw = password_hash($data['password'],PASSWORD_DEFAULT);

    $stmt= Connect::Connection()->prepare("UPDATE $table SET username=:username, password=:password WHERE id=:id");

    $stmt->bindParam(":username", $data["username"], PDO::PARAM_STR);

    $stmt->bindparam(":password", $passw, PDO::PARAM_STR);

    $stmt->bindparam(":id", $data["id"], PDO::PARAM_INT);

    if($stmt->execute()){
        return "ok";
    }else{
        print_r(Connect::Connection()->errorInfo());
    }

    $stmt->close();

    $stmt = null;
}

/* Borra usuarios de la base de datos (DELETE) */

static public function deleteUsers($table,$data){

    $stmt= Connect::Connection()->prepare("DELETE FROM $table WHERE id=:id");

    $stmt->bindparam(":id", $data, PDO::PARAM_INT);

    if($stmt->execute()){
        return "ok";
    }else{
        print_r(Connect::Connection()->errorInfo());
    }

    $stmt->close();

    $stmt = null;
 }
}

?>