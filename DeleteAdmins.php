<?php require_once("Includes/DB.php") ?>
<?php require_once("Includes/Functions.php") ?>
<?php require_once("Includes/Sessions.php") ?>


<?php 

if (isset($_GET["id"])) {
	$SearchQueryParameter= $_GET["id"];
	global $ConnectingDB;
	$Admin=$_SESSION["AdminName"];
	$sql = "DELETE FROM admins WHERE id='$SearchQueryParameter'";
	$Execute = $ConnectingDB->query($sql);
	if ($Execute) {
		$_SESSION["SuccessMessage"]="Admin Delete Successful";
		Redirect_to("Admins.php");
	}else{
		$_SESSION["ErrorMessage"]="Category Delete Failed";
		Redirect_to("Admins.php");
	}
}


 ?>