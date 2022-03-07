<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/css/cru.css">
    <title>Document</title>
</head>
<body>

<!-- Verificación de sesion de usuario -->

<?php

 if(!isset($_SESSION["validateEntry"])){

      echo '<script>window.location = "index.php";</script>';
  
      return; 
  }else{
  
    if($_SESSION["validateEntry"] != "ok"){

    echo '<script>window.location = "index.php";</script>';
 
    return;
  }
} 

?>

<!-- Muestra de usuarios registrados en el sistema -->

<?php
$list = UsersController::showUsersCtr(null,null);
?>

<table id="mytable" class="tbl" style="width:300px;">

<thead>
<tr>
<th>Usuario</th>
<th>Contraseña</th>
</tr>
<thead>

<?php foreach($list as $key => $value): ?>

  <tbody>
        <tr>
            <td><?php echo $value["username"];?></td>
            <td><?php echo $value["password"];?></td>
            <td><a id="add-btn" href="index.php?pagina=Edit&id=<?php echo $value["id"]?>">Editar</a></td>
            <td><form method="post">
            <input type="hidden" value="<?php echo $value["id"]; ?>" name="deleteUser">
            <button id="delete-btn" type="submit">Eliminar</button>
            <?php
                $delete = new UsersController();
                $delete -> deleteUserCtr();
            ?>
            </form></td>
        </tr>

<?php endforeach ?>
</tbody>
  </table>

<!-- Formulario para agregar usuarios al sistema -->

  <form class="add-form" method="post">
        <label for="username">Usuario:</label>
        <input type="text" name="username" id="username">
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password">
       
        <button id="mybutton">Agregar Usuario</button>
    </form>


  <?php

   $registration = UsersController::userCtr();

   if($registration == "no"){
    echo '<div style="color:white; position:absolute; top:450px; left:960px;">El usario ya se encuentra registrado</div>';
   }

   if($registration == "ok"){
       echo '<script>
       if(window.history.replaceState){
         window.history.replaceState(null, null, window.location.href);
       }
       </script>';

       echo '<div style="color:white; position:absolute; top:450px; left:960px;">Usuario agregado correctamente</div>';

       echo '<script>
          setTimeout(function(){
          window.location = "index.php?pagina=Crud";
          },2000);
          </script>';

   }
?>

</body>
</html>