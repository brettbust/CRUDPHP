<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Document</title>
</head>
<body>

<?php

/* Trae id de usuario a Editar */

if(isset($_GET["id"])){

  $item = "id";

  $value = $_GET["id"];

  $data = UsersController::showUsersCtr($item, $value);

}

?>
  
<div id="container">
<form class="add-form" method="post">
<input type="name" value="<?php echo $data["username"];?>" name="updateUsername" required><br><br>
<input type="password" placeholder="Escriba nueva contraseña" name="updatePassword"><br><br>
<input type="hidden" name="currentPassword" value="<?php echo $data["password"]; ?>"><br><br>
<input type="hidden" name="idUsuario" value="<?php echo $data["id"]; ?>"><br><br>

<?php
  $update = UsersController::updateUserCtr();
         
  if($update == "ok"){
    echo '<script>
         if(window.history.replaceState){
         window.history.replaceState(null, null, window.location.href);}
         </script>';
         
    echo '<div>Usuario actualizado correctamente</div>
          
          <script>
          setTimeout(function(){
          window.location = "index.php?pagina=Crud";
          },2000);
          </script>';
}

?>

	<button id="mybutton" type="submit">Actualizar</button>

</form>		
	
</div>

</body>
</html>