<?php require_once("Includes/DB.php") ?>
<?php require_once("Includes/Functions.php") ?>
<?php require_once("Includes/Sessions.php") ?>



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

       <?php 
                 echo ErrorMessage();
                 echo SuccessMessage();
 
       ?>

       <!--Header Start-->
          <div class="container">
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
                 //Query when pagination is Active
                 elseif (isset($_GET["page"])) {
                   $Page=$_GET["page"];
                   if ($Page==0||$Page<0) {
                     $ShowPostFrom=0;
                   }
                   else{
                    $ShowPostFrom=($Page*4)-4;
                   }
                   $sql  = "SELECT * FROM posts ORDER BY id desc LIMIT $ShowPostFrom,4";
                   $stmt = $ConnectingDB->query($sql);
                 }
                   //default sql query
                  else{
                   $sql= "SELECT * FROM posts ORDER BY id desc LIMIT 0,3";
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

                    <small class="text-muted"> 
                      Category:   <span class="text-dark"><?php echo $Category; ?></span>
                      Written By: <span class="text-dark"><?php echo $Admin; ?></span>
                         <span class="text-dark"><?php echo $Datetime; ?></span>
                    </small>

                    <span style="float: right;" class="badge badge-dark text-white">Comments 
                      <?php echo ApprovedCommentsAccordingToPost($PostId); ?>
                        
                      </span>
                    <hr>
                    
                    <p class="card-text">
                      <?php 
                         
                         if (strlen($PostDescription)>150) {
                           $PostDescription = substr($PostDescription, 0,150)."...";
                         }
                         echo $PostDescription;

                       ?>

                    </p>
                     <a href="Fullpost.php?id=<?php echo $PostId; ?> " style="float:right;">
                       <span class="btn btn-info">Read more >></span>
                     </a>
                     </div>
                  </div>
                  <?php } ?>

             <!--Pagination-->
             <br>
             <nav>
               <ul class="pagination pagination-md">

                <!--Creating Backward Button-->
                 <?php 
                  if (isset($Page)) {
                    if ($Page>1) {
                      ?>
                      <li class="page-item">
                   <a href="Blog.php?page=<?php echo $Page-1; ?>" class="page-link">&laquo;</a>
                     </li>
                 <?php 

                    }
                  }

                  ?>

                <?php 

                global $ConnectingDB;
                $sql = "SELECT COUNT(*) FROM posts";
                $stmt= $ConnectingDB->query($sql);
                $RowPagination =$stmt->fetch();
                $TotalPosts= array_shift($RowPagination);
               // echo $TotalPosts."<br>";
                $PostPagination=$TotalPosts/4;
                $PostPagination=ceil($PostPagination);
              //  echo $PostPagination;

                for($i=1;$i<=$PostPagination;$i++){
                  if (isset($Page)) {
                    if ($i==$Page) {
                    ?>  
                      <li class="page-item active">
                   <a href="Blog.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                 </li>
                  <?php    }
                  else{ ?>
                  
                   <li class="page-item">
                   <a href="Blog.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                 </li>
                
                <?php } } }?>

                <!--Creating Forward Button-->
                 <?php 
                  if (isset($Page)&&!empty($Page)) {
                    if ($Page+1<=$PostPagination) {
                      ?>
                      <li class="page-item">
                   <a href="Blog.php?page=<?php echo $Page+1; ?>" class="page-link">&raquo;</a>
                     </li>
                 <?php 

                    }
                  }

                  ?>
               </ul>
             </nav>


              </div>
              <!--Main area End-->
               


              <!--Side area start-->
              <div class="col-sm-4">
               <div class="card mt-4">
                 <div class="card-body">
                   <img src="images/startblog.png" class="d-block img-fluid mb-3">
                   <div class="text-center">
                     Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vel turpis risus. Curabitur laoreet dui et tellus iaculis vulputate. Integer a rhoncus neque, at cursus enim. Aliquam dictum tempus enim, luctus pretium dolor facilisis vel.
                   </div>
                 </div>
               </div>

              <br>

              <div class="card">
                <div class="card-header bg-dark text-light">
                  <h2 class="lead">Sign Up</h2>
                </div>
                <div class="card-body">
                  <button type="button" class="btn btn-success btn-block text-center text-white mb-3" name="button">Join The Forum</button>
                  <button type="button" class="btn btn-danger btn-block text-center text-white mb-3" name="button">Log In</button>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Enter Your Email" name="">
                    <div class="input-group-append">
                      <button type="button" class="btn btn-primary btn-sm text-center text-white" name="button">Subscribe Now</button>
                    </div>
                  </div>
                </div>
              </div>

              <br>

              <div class="card">
                <div class="card-header bg-primary text-light">
                  <h2 class="lead">Categories</h2>
                </div>
                <div class="card-body">
                  <?php 


                   global $ConnectingDB;
                   $sql="SELECT * FROM category ORDER BY id desc";
                   $stmt= $ConnectingDB->query($sql);
                   while($DataRows=$stmt->fetch()){
                         $CategoryId   = $DataRows["id"];
                         $CategoryName =$DataRows["title"];
                   

                   ?>

                <a href="Blog.php?category=<?php echo $CategoryName ;?>"><span class="heading"><?php echo $CategoryName; ?></span></a><br>
                
                <?php } ?>

                </div>

              </div>

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