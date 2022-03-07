<?php

error_reporting(E_ALL ^ E_WARNING);

require_once("model/Users.model.php");

class UsersController{

  /* Controlador para agregar usuarios */
  

static public function userCtr(){

    if(isset($_POST["username"])){

        $table = "users";

        $data = array("username" => $_POST["username"],
                      "password" => $_POST["password"]);

        $response = UsersModel::addUsers($table,$data);

        return $response;
    }
  }

  /* Controlador para mostrar usuarios */

static public function showUsersCtr($item, $value){

  $table = "users";
  
  $response = UsersModel::showUsers($table, $item, $value);
  
  return $response;
}

  /* Controlador para actualizar usuarios */
  
static public function updateUserCtr(){

  if(isset($_POST["updateUsername"])){

    if($_POST["updatePassword"] != ""){

      $password = $_POST["updatePassword"];
    }else{
      $password = $_POST["currentPassword"];
  }

    $table = "users";

    $data = array("id" => $_POST["idUsuario"],
                  "username" => $_POST["updateUsername"],
                  "password" => $password);

      $response = UsersModel::updateUsers($table,$data);

      return $response;  
    }
  }

  /* Controlador para borrar usuarios */

public function deleteUserCtr(){

    if(isset($_POST["deleteUser"])){

    $table = "users";
    $data = $_POST["deleteUser"];

    $response = UsersModel::deleteUsers($table,$data);

      if($response == "ok"){
          echo '<script>if(window.history.replaceState){
                window.history.replaceState(null, null, window.location.href);}
                window.location = "index.php?pagina=Crud";
                </script>';
            }
      }
 }


   /* Login de usuarios */

public function userLogin(){
    
  if(isset($_POST["username"])){

    $table = "users";
    $item = "username";
    $value = $_POST["username"];
    $pass = $_POST["password"];

    $response = UsersModel::showUsers($table, $item, $value);

     if($_POST["username"] == "" || $_POST["password"] == ""){
      echo '<script>
      if(window.history.replaceState){
      window.history.replaceState(null, null, window.location.href);
       }
       window.location = "index.php?pagina=Signin";
       </script>';
    }

    if($response["username"] == $_POST["username"]){

    if (password_verify($pass, $response["password"])) {

    $_SESSION["validateEntry"] = "ok";

  
    echo '<script>
         if(window.history.replaceState){
         window.history.replaceState(null, null, window.location.href);
          }
          window.location = "index.php?pagina=Crud";
          </script>';
        
        }      
      }
   }
  }
}

?>