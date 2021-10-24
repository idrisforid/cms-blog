<?php require_once("Includes/DB.php") ?>
<?php require_once("Includes/Functions.php") ?>
<?php require_once("Includes/Sessions.php") ?>

<!--Fetching Existing Data-->

<?php 

 $SearchQueryParameter= $_GET["username"];
 global $ConnectingDB;
 $sql= "SELECT aname, aheadline, abio, aimage FROM admins WHERE username=:userName";
 $stmt=$ConnectingDB->prepare($sql);
 $stmt->bindvalue(':userName',$SearchQueryParameter);
 $stmt->execute();

 $Result = $stmt->rowcount();

 if ($Result==1) {
     while($DataRows         = $stmt->fetch()){
           $ExistingName     = $DataRows["aname"];
           $ExistingBio      = $DataRows["abio"];
           $ExistingImage    =$DataRows["aimage"];
           $ExistingHeadline =$DataRows["aheadline"];
     }
 }
 else{
    $_SESSION["ErrorMessage"]="Bad Request";
    Redirect_to("Blog.php?page=1");
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
        <link rel="stylesheet" type="text/css" href="Css/Styles.css">
         <title>Profile</title>
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
            <a href="Blog.php" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">About Us</a>
          </li>
          <li class="nav-item">
            <a href="Blog.php" class="nav-link">Blog</a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">Contact Us</a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">Features</a>
          </li>
          
        </ul>
        <ul class="navbar-nav ml-auto">
          <form class="form-inline d-none d-sm-block" action="Blog.php">
            <div class="form-group">
              <input class="form-control mr-2" type="text" name="Search" placeholder="Search here">
              <button  class="btn btn-primary" name="SearchButton">Go</button>
               
                 
               
            </div>
          </form>
        </ul>
        </div>
         </div> 
        

      </nav> 
       <div style="height: 10px; background-color: #27aae1;"></div>
      <!--Navbar End-->

       

       <!--Header Start-->
          <header class="bg-dark text-white py-3">
          	<div class="container">
          		<div class="row">
          			<div class="col-md-6">
          				<h1> <i class="fas fa-user text-success"></i> <?php echo $ExistingName; ?></h1>
                  <h3><?php echo $ExistingHeadline; ?></h3>
          			</div>
          		</div>
          	</div>
          </header>
          <br>
       <!--Header End-->
         
         <section class="container py-2 mb-4">
           <div class="row">
             <div class="col-md-3">
               <img src="Images/<?php echo $ExistingImage; ?>" class="d-block img-fluid mb-3 rounded-circle">
             </div>
             <div class="col-md-9" style="min-height: 320px;">
               <div class="card">
               <div class="card-body">
                 <p class="lead"><?php echo $ExistingBio; ?></p>
               </div>
             </div>
             </div>
           </div>
         </section>
         

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