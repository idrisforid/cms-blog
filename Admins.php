<?php require_once("Includes/DB.php") ?>
<?php require_once("Includes/Functions.php") ?>
<?php require_once("Includes/Sessions.php") ?>
<?php 
$_SESSION["TrackURL"]=$_SERVER["PHP_SELF"];
Confirm_Login(); ?>
<?php




if (isset($_POST["submit"])) {
   $UserName        = $_POST["Username"];
   $Name            = $_POST["Name"];
   $Password        = $_POST["Password"];
   $ConfirmPassword = $_POST["ConfirmPassword"];
   $Admin           = $_SESSION["UserName"];

   date_default_timezone_set("Asia/Dhaka");
   $CurrentTime=time();
   $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);

   if (empty($UserName)||empty($Password)||empty($ConfirmPassword)) {
     $_SESSION["ErrorMessage"]="All Field Must Be Filled Up!";
     Redirect_to("Admins.php");
   }
    elseif (strlen($Password)<3) {
      $_SESSION["ErrorMessage"]="Password should be greater than 3 character!";
     Redirect_to("Admins.php");
    }
    elseif (($Password)!=($ConfirmPassword)) {
      $_SESSION["ErrorMessage"]="Password and Confirm Password should be matched!";
     Redirect_to("Admins.php");
    }
    elseif (CheckUsernameExistsOrNot($UserName)) {
      $_SESSION["ErrorMessage"]="Username exists! try another one";
     Redirect_to("Admins.php");
    }
    
    else{
      
      //Query to insert DB when everything fine
      global $ConnectingDB;

      $sql  = "INSERT INTO admins (datetime,username,password,aname,addedby)";
      $sql .= "VALUES (:dateTime,:username,:password,:aname,:addedby)";
      $stmt = $ConnectingDB->prepare($sql);

      $stmt-> bindvalue(':dateTime',$DateTime);
      $stmt-> bindvalue(':username',$UserName);
      $stmt-> bindvalue(':password',$Password);
      $stmt-> bindvalue(':aname',$Name);
      $stmt-> bindvalue(':addedby',$Admin);
      

      $Execute=$stmt->execute();
      
    

      if ($Execute) {
         $_SESSION["SuccessMessage"]="Admin Added Successfully";
         Redirect_to("Admins.php");
      }
      else{
         $_SESSION["ErrorMessage"]="Admin Added Failed";
         Redirect_to("Admins.php");
      }

    }

}



?>

<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
       
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
       <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<title>
		Add new admin
	</title>
	<link rel="stylesheet" type="text/css" href="Css/Styles.css">
    </head>
    <body>
    	<!--Navbar Start-->
    	<div style="height: 10px; background-color: #27aae1;"></div>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      	<div class="container" >
      		<a href="" class="navbar-brand">learners flame</a>
      		<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
      			<span class="navbar-toggler-icon"></span>
      		</button>
          <div class="collapse navbar-collapse" id="navbarCollapse">

      	<ul class="navbar-nav ml-auto">
      		<li class="nav-item">
      			<a href="" class="nav-link"><i class="fas fa-user text-success"></i> My Profile</a>
      		</li>
      		<li class="nav-item">
      			<a href="" class="nav-link">Dashboard</a>
      		</li>
      		<li class="nav-item">
      			<a href="" class="nav-link">Post</a>
      		</li>
      		<li class="nav-item">
      			<a href="" class="nav-link">Categories</a>
      		</li>
      		<li class="nav-item">
      			<a href="" class="nav-link">Manage Admins</a>
      		</li>
      		<li class="nav-item">
      			<a href="" class="nav-link">Comments</a>
      		</li>
      		<li class="nav-item">
      			<a href="" class="nav-link">Live Blog</a>
      		</li>
      	</ul>
      	<ul class="navbar-nav ml-auto">
      		<li class="nav-item">
      			<a href="Logout.php" class="nav-link text-danger"> <i class="fas fa-user-times"></i> Logout</a>
      		</li>
      	</ul>
      	</div>
         </div> 
      	

      </nav> 
       <div style="height: 10px; background-color: #27aae1;"></div>
      <!--Navbar Start-->

       

       <!--Header Start-->
          <header class="bg-dark text-white py-3">
          	<div class="container">
          		<div class="row">
          			<div class="col">
          				<h1> <i class="fas fa-user" style="color: #27aae1;"></i> Manage Admins </h1>
          			</div>
          		</div>
          	</div>
          </header>
          <br>
       <!--Header End-->
       
         <!--Main Area Start-->

          <section class="container py-2 mb-4">
          	<div class="row" style="min-height: 350px;">
          		<div class="offset-lg-1 col-lg-10" >
                <?php 
                 echo ErrorMessage();
                 echo SuccessMessage();
 
                 ?>
          			<form class="" action="Admins.php" method="post">
          				<div class="card bg-secondary text-light mb-3">
          					<div class="card-header">
          						<h1>Add New Admin</h1>
          					</div>
          					<div class="card-body bg-dark">
          						<div class="form-group">
          							<label for="Username"> <span class="FieldInfo"> Username </span> </label>
          							<input class="form-control" type="text" name="Username" id="Username"  >
          						</div>
                      <div class="form-group">
                        <label for="name"> <span class="FieldInfo"> Name </span> </label>
                        <input class="form-control" type="text" name="Name" id="name"  >
                        <small class="text-muted">optional</small>
                      </div>
                      <div class="form-group">
                        <label for="Password"> <span class="FieldInfo"> Password </span> </label>
                        <input class="form-control" type="Password" name="Password" id="Username"  >
                      </div>
                      <div class="form-group">
                        <label for="ConfirmPassword"> <span class="FieldInfo"> Confirm Password </span> </label>
                        <input class="form-control" type="password" name="ConfirmPassword" id="ConfirmPassword"  >
                      </div>
                      <div class="row">
                         <div class="col-lg-6 mb-2">
                           <button type="button" name="submit" class="btn btn-warning btn-block"> <i class="fas fa-arrow-left"></i> Back To Dashboard </button>
                         </div>
                         <div class="col-lg-6 mb-2">
                           <button type="submit" name="submit" class="btn btn-success btn-block"> <i class="fas fa-check"></i> Publish </button>
                         </div>
                      </div>
          					</div>
          				</div>
          			</form>

                 <h2>Existing Admins</h2>
              <table class="table table-stripped table hover">
                <thead class="thead-dark">
                  <tr>
                    <th>No.</th>
                    <th>Date&Time</th>
                    <th>Username</th>
                    <th>Admin Name</th>
                    <th>Added By</th>
                    <th>Action</th>
                    
                  </tr>
                </thead>

                 <?php 

                   global $ConnectingDB;
                   $sql="SELECT * FROM admins ORDER BY id desc ";
                   $Execute=$ConnectingDB->query($sql);
                   $SrNo=0;
                   while($DataRows=$Execute->fetch()){
                    $AdminId           = $DataRows["id"];
                    $DateTime          = $DataRows["datetime"];
                    $AdminUsername     = $DataRows["username"];
                    $AdminName         = $DataRows["aname"];
                    $AddedBy           = $DataRows["addedby"];
                    
                    $SrNo++;
                  
                  ?>
                  <tbody>
                    <tr>
                      <td><?php echo $SrNo ; ?></td>
                      <td><?php echo $DateTime; ?></td>
                      <td><?php echo $AdminUsername; ?></td>
                      <td><?php echo $AdminName ; ?></td>
                      <td><?php echo $AddedBy ; ?></td>
                      <td><a href="DeleteAdmins.php?id=<?php echo $AdminId ; ?>" class="btn btn-danger">Delete</a></td>
                      
                      
                    </tr>
                  </tbody>  
                  <?php }  ?>
              </table>

          		</div>
          	</div>
          </section>


         <!--Main Area End-->

      <!--Footer Start-->
          <footer class="bg-dark text-white">
          	<div class="container">
          		<div class="row">
          			<div class="col">
          				<p class="lead text-center"> Theme By | Learners Flame | <span id="demo"></span> | &copy; ----All rights reserved.</p>
          			</div>
          		</div>
          	</div>
          </footer>
          <div style="height: 10px; background-color: #27aae1;"></div>
      <!--Footer End-->
       
    </body>

    <script>
	const d = new Date();
	document.getElementById("demo").innerHTML = d.getFullYear();
	</script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</html>