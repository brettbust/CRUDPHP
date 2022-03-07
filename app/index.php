<?php
require_once("controller/Template.controller.php");
$template = new TemplateController();
$template -> ctrShowTemplateView();



/* Al requerir el controlador desde el index cualquier vista puede
usar los métodos que se encuentre en el. */

 require_once("controller/Users.controller.php");
           
/* Al requerir un modelo desde el index cualquier controlador puede
usar los métodos que se encuentre en el. */

require_once('model/Users.model.php');



?>