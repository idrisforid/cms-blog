<?php require_once("Includes/DB.php") ?>
<?php require_once("Includes/Functions.php") ?>
<?php require_once("Includes/Sessions.php") ?>
<?php 

$_SESSION["TrackURL"]=$_SERVER["PHP_SELF"];


Confirm_Login(); ?>

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
         <title>Posts</title>
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
                
          			<div class="col-md-12">
          				<h1> <i class="fas fa-blog" style="color: #27aae1;"></i> Blog Posts </h1>
          			</div>
                <div class="col-lg-3 mb-2">
                  <a href="AddNewPost.php" class="btn btn-primary btn-block">
                    <i class="fas fa-folder-plus"> Add New Post</i>
                  </a>
                </div>
                <div class="col-lg-3 mb-2">
                  <a href="Categories.php" class="btn btn-info btn-block">
                    <i class="fas fa-edit"> Add New Category</i>
                  </a>
                </div>
                <div class="col-lg-3 mb-2">
                  <a href="" class="btn btn-warning btn-block">
                    <i class="fas fa-user-plus"> Add New Admin</i>
                  </a>
                </div>
                <div class="col-lg-3 mb-2">
                  <a href="" class="btn btn-success btn-block">
                    <i class="fas fa-check">Approve Comments</i>
                  </a>
                </div>
          		</div>
          	</div>
          </header>
       <!--Header Start-->
       
         <!--Main Area Start -->

          <section class="container py-2 mb-4" >
            <div class="row" style="min-height: 370px;">
              <?php 
           echo ErrorMessage();
           echo SuccessMessage();
           
                ?>
               <!--Side Area Start--> 
               <div class="col-lg-2">
                 <div class="card text-center bg-dark text-white mb-3">
                   <div class="card-body">
                     <h1 class="lead">Posts</h1>
                     <h4 class="display-5">
                       <i class="fab fa-readme"></i>
                       <?php 

                        echo TotalPosts();

                        ?>
                     </h4>
                   </div>
                 </div>


                <div class="card text-center bg-dark text-white mb-3">
                   <div class="card-body">
                     <h1 class="lead">Categories</h1>
                     <h4 class="display-5">
                       <i class="fas fa-folder"></i>
                       <?php 

                        echo TotalCategories();

                        ?>
                     </h4>
                   </div>
                 </div>


                 <div class="card text-center bg-dark text-white mb-3">
                   <div class="card-body">
                     <h1 class="lead">Admins</h1>
                     <h4 class="display-5">
                       <i class="fas fa-users"></i>
                       <?php 

                        echo TotalAdmins() ;
                        ?>
                     </h4>
                   </div>
                 </div>

                 <div class="card text-center bg-dark text-white mb-3">
                   <div class="card-body">
                     <h1 class="lead">Comments</h1>
                     <h4 class="display-5">
                       <i class="fas fa-comments"></i>
                       <?php 

                        echo TotalComments();

                        ?>
                     </h4>
                   </div>
                 </div>

               </div>




               <!--Side Area End--> 
            </div>
          </section>


         <!--Main Area End -->

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