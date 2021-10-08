<?php require_once("Includes/DB.php") ?>

<?php

function Redirect_to($New_Location)
    {   

    	header("Location:".$New_Location);

    	exit();
    }

function CheckUsernameExistsOrNot($UserName)
{
	global $ConnectingDB;
	$sql="SELECT username FROM admins WHERE username=:userName";
	$stmt=$ConnectingDB->prepare($sql);
	$stmt->bindValue(':userName',$UserName);
	$stmt->execute();

	$Result=$stmt->rowcount();
	if ($Result>=1) {
		return true;
	}
	else{
		return false;
	}
}

function Login_attempt($Username,$Password){
	 global $ConnectingDB;
    $sql  = "SELECT * FROM admins WHERE username=:username AND password=:password LIMIT 1";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':username',$Username);
    $stmt->bindValue(':password',$Password);
    $stmt->execute();
    $Result = $stmt->rowcount();
    if ($Result==1) {
       return $Found_Account=$stmt->fetch();
    }else{
      return null;
    }
}

function Confirm_Login(){
    if (isset($_SESSION["User_Id"])) {
        return true;
    }
    else{
        $_SESSION["ErrorMessage"]="Login Required !";
        Redirect_to("Login.php");
    }
}


?>
