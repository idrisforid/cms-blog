<?php require_once("Includes/DB.php") ?>
<?php require_once("Includes/Functions.php") ?>
<?php require_once("Includes/Sessions.php") ?>
<?php $SearchQueryParameter = $_GET["id"]; ?>


<?php

if (isset($_POST["submit"])) {
   $Name = $_POST["CommenterName"];
   $Email =$_POST["CommenterEmail"];
   $Comment=$_POST["CommenterThoughts"];

   date_default_timezone_set("Asia/Dhaka");
   $CurrentTime=time();
   $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);

   if (empty($Name)||empty($Email)||empty($Comment)) {
     $_SESSION["ErrorMessage"]="All Field Must Be Filled Up!";
     Redirect_to("FullPost.php?id=$SearchQueryParameter");
   }
    elseif (strlen($Comment)>500) {
      $_SESSION["ErrorMessage"]="Comment length should be less than 500 characters!";
     Redirect_to("FullPost.php?id=$SearchQueryParameter");
    }
    
    else{
      
      //Query to insert comment to DB when everything fine
      global $ConnectingDB;

      $sql  = "INSERT INTO comments (datetime,name,email,comment,approvedby,status)";
      $sql .= "VALUES (:datetime,:name,:email,:comment,'Pending','OFF')";
      $stmt = $ConnectingDB->prepare($sql);

      $stmt-> bindvalue(':datetime',$DateTime);
      $stmt-> bindvalue(':name',$Name);
      $stmt-> bindvalue(':email',$Email);
      $stmt-> bindvalue(':comment',$Comment);
      $Execute=$stmt->execute();
       
          
   //   var_dump($Execute);
      

      if ($Execute) {
         $_SESSION["SuccessMessage"]="Comment Added Successfully";
         Redirect_to("FullPost.php?id=$SearchQueryParameter");
      }
      else{
         $_SESSION["ErrorMessage"]="Comment Added Failed";
         Redirect_to("FullPost.php?id=$SearchQueryParameter");
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
        <link rel="stylesheet" type="text/css" href="Css/Styles.css">
         <title>Blog Page</title>
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
          <div class="container">
            <?php 
                 echo ErrorMessage();
                 echo SuccessMessage();
 
                 ?>
            <div class="row mt-4">


              <!--Main area start-->
              <div class="col-sm-8">
                <h1>The Complete responsive blog</h1>
                <h1 class="lead"> the complete blog</h1>

                 <?php
                   global $ConnectingDB;
                   //SQL query when search button is active
                   if (isset($_GET["SearchButton"])) {
                   $Search =$_GET["Search"];
                   $sql = "SELECT * FROM posts
                   Where datetime like :search
                   OR title LIKE :search
                   OR category LIKE :search
                   OR post LIKE :search";

                   $stmt=$ConnectingDB->prepare($sql);
                   $stmt->bindvalue(':search','%'.$Search.'%'); 
                   $stmt->execute();
                   
                 }
                   //default sql query
                  else{
                    $PostIdFromURL= $_GET["id"];
                    if (!isset($PostIdFromURL)) {
                      $_SESSION["ErrorMessage"]="Bad Request Happened!";
                      Redirect_to("Blog.php");
                    }
                   $sql= "SELECT * FROM posts WHERE id='$PostIdFromURL'";
                   $stmt= $ConnectingDB->query($sql);
                   }
                   while ($DataRows = $stmt->fetch()) {
                     $PostId          = $DataRows["id"];
                     $Datetime        =$DataRows["datetime"];
                     $PostTitle       =$DataRows["title"];
                     $Category        =$DataRows["category"];
                     $Admin           = $DataRows["author"];
                     $Image           =$DataRows["image"];
                     $PostDescription =$DataRows["post"];
                   

                  ?>

                  <div class="card">
                    <img src="Uploads/<?php echo($Image) ;?>" style="max-height:350px; class="img-fluid card-img-top"/>
                    <div class="card-body">
                    <h4 class="card-title"><?php echo $PostTitle; ?></h4>
                    <small class="text-muted">Written By <?php echo $Admin; ?> on <?php echo $Datetime; ?></small>
                    <span style="float: right;" class="badge badge-dark text-white">Comments 20</span>
                    <hr>
                    
                    <p class="card-text">
                      <?php 
                         
                         
                         echo $PostDescription;

                       ?>

                    </p>
                     
                     </div>
                  </div>
                  <?php } ?>

               <!--Comment Area start-->
          <div>
            <form class="" action="FullPost.php?id=<?php echo $SearchQueryParameter; ?>" method="post">
              <div class="card mb-3">
                <div class="card-header">
                  <h5 class="FieldInfo">Share Your Thoughts</h5>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                    
                    <input class="form-control" type="text" name="CommenterName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                      </div>                   
                    <input class="form-control" type="email" name="CommenterEmail" placeholder="Email">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <textarea name="CommenterThoughts" class="form-control" rows="6" cols="80">
                      
                    </textarea>
                  </div>

                  <div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  </div>

                </div>
              </div>
            </form>
          </div>



               <!--Comment Area End-->


              </div>
              <!--Main area End-->
               


              <!--Side area start-->
              <div class="col-sm-4" style="min-height: 40px; background: green;">
                
              </div>
              <!--Side area End-->
            </div>
          </div>
       <!--Header End-->
       
         

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