<?php require_once("Includes/DB.php") ?>
<?php require_once("Includes/Functions.php") ?>
<?php require_once("Includes/Sessions.php") ?>

<?php 

   $_SESSION["User_Id"]=null;
   $_SESSION["UserName"]=null;
   $_SESSION["AdminName"]=null;

   session_destroy();

   Redirect_to("Login.php");

 ?>