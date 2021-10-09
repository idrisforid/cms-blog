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
         <title>Manage Comments</title>
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
      			<a href="" class="nav-link text-danger"> <i class="fas fa-user-times"></i> Logout</a>
      		</li>
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
          			<div class="col">
          				<h1> <i class="fas fa-comments" style="color: #27aae1;"></i> Manage Comments </h1>
          			</div>
          		</div>
          	</div>
          </header>
          <br>
       <!--Header End-->
       
       <!--Main area start-->

        <section class="container py-2 mb-4">
          <div class="row" style="min-height: 30px;">
            <div class="col-lg-12" style="min-height: 400px;">
              <?php 
                 echo ErrorMessage();
                 echo SuccessMessage();
 
                 ?>
              <h2>Un-approved Comments</h2>
              <table class="table table-stripped table hover">
                <thead class="thead-dark">
                  <tr>
                    <th>No.</th>
                    <th>Date&Time</th>
                    <th>Name</th>
                    <th>Comment</th>
                    <th>Approve</th>
                    <th>Delete</th>
                    <th>Details</th>
                  </tr>
                </thead>

                 <?php 

                   global $ConnectingDB;
                   $sql="SELECT * FROM comments WHERE status='OFF' ORDER BY id desc ";
                   $Execute=$ConnectingDB->query($sql);
                   $SrNo=0;
                   while($DataRows=$Execute->fetch()){
                    $CommentId         = $DataRows["id"];
                    $CommenterName     = $DataRows["name"];
                    $DateTimeOfComment = $DataRows["datetime"];
                    $CommentContent    = $DataRows["comment"];
                    $CommentPostId     = $DataRows["post_id"];
                    $SrNo++;
                  
                  ?>
                  <tbody>
                    <tr>
                      <td><?php echo $SrNo ; ?></td>
                      <td><?php echo $DateTimeOfComment; ?></td>
                      <td><?php echo $CommenterName; ?></td>
                      <td><?php echo $CommentContent; ?></td>
                      <td><a href="ApproveComments.php?id=<?php echo $CommentId; ?>" class="btn btn-success">Approve</a></td>
                      <td><a href="DeleteComments.php?id=<?php echo $CommentId; ?>" class="btn btn-danger">Delete</a></td>
                      <td style="min-width: 140px;"><a href="FullPost.php?id=<?php echo $CommentId; ?>" class="btn btn-primary">Live Preview</a></td>
                      
                    </tr>
                  </tbody>  
                  <?php }  ?>
              </table>

             <h2>Approved Comments</h2>
              <table class="table table-stripped table hover">
                <thead class="thead-dark">
                  <tr>
                    <th>No.</th>
                    <th>Date&Time</th>
                    <th>Name</th>
                    <th>Comment</th>
                    <th>Revert</th>
                    <th>Delete</th>
                    <th>Details</th>
                  </tr>
                </thead>

                 <?php 

                   global $ConnectingDB;
                   $sql="SELECT * FROM comments WHERE status='ON' ORDER BY id desc ";
                   $Execute=$ConnectingDB->query($sql);
                   $SrNo=0;
                   while($DataRows=$Execute->fetch()){
                    $CommentId         = $DataRows["id"];
                    $CommenterName     = $DataRows["name"];
                    $DateTimeOfComment = $DataRows["datetime"];
                    $CommentContent    = $DataRows["comment"];
                    $CommentPostId     = $DataRows["post_id"];
                    $SrNo++;
                  
                  ?>
                  <tbody>
                    <tr>
                      <td><?php echo $SrNo ; ?></td>
                      <td><?php echo $DateTimeOfComment; ?></td>
                      <td><?php echo $CommenterName; ?></td>
                      <td><?php echo $CommentContent; ?></td>
                      <td><a href="DisapproveComments.php?id=<?php echo $CommentId; ?>" class="btn btn-warning">DisApprove</a></td>
                      <td><a href="DeleteComments.php?id=<?php echo $CommentId; ?>" class="btn btn-danger">Delete</a></td>
                      <td style="min-width: 140px;"><a href="FullPost.php?id=<?php echo $CommentPostId; ?>" class="btn btn-primary">Live Preview</a></td>
                      
                    </tr>
                  </tbody>  
                  <?php }  ?>
              </table>

            </div>
          </div>
        </section>

       <!--Main area End-->
         

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