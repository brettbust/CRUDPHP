<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/css/crud.css">
    <title>Sistema de login</title>
</head>
<body>


<div>
    <nav>
        <ul>
            <li>
                <a id="btn" href="index.php?pagina=Signin">Ingresar al sistema</a>
           
                <a id="btn" href="view/pages/Close-session.php">Salir</a>
            </li>
        </ul>
    </nav>
</div>
    
    <?php

require_once("controller/Users.controller.php");

$get_in = new UsersController();

$get_in -> userLogin();

?> 
<div>
<div>

   <?php 
   
    if(isset($_GET["pagina"])){

    if($_GET['pagina'] == "Crud" || $_GET['pagina'] == "Signin" || $_GET['pagina'] == "Edit"){

    include "pages/".$_GET["pagina"].".php";

    }else{

        include "pages/404.php";
    }
}
 
   ?>
</div>
</div>

</body>
</html>