<?php require_once("Includes/DB.php");?>

 <?php require_once("Includes/Functions.php");?>

 <?php require_once("Includes/Sessions.php");?>



<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<title>
		Posts
	</title>
	<link rel="stylesheet" type="text/css" href="Css/Styles.css">
</head>
<body>

  <!--Navbar Start-->

  <div style="height: 10px; background: #27aae1"></div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
	<div class="container">
	<a href="" class="navbar-brand">Forid.com</a>

    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarcollapseCMS">

    <ul class="navbar-nav ml-auto">
          <li class="nav-item">
          	<a href="MyProfile.php" class="nav-link"> <i class="fas fa-user text-success"></i> My Profile</a>
          </li> 
          <li class="nav-item">
          	<a href="Dashboard.php" class="nav-link">Dashboard</a>
          </li>
          <li class="nav-item">
          	<a href="post.php" class="nav-link">post</a>
          </li>
          <li class="nav-item">
          	<a href="categories.php" class="nav-link">categories</a>
          </li>
          <li class="nav-item">
          	<a href="Admins.php" class="nav-link">Manage Admins</a>
          </li>
          <li class="nav-item">
          	<a href="Comments.php" class="nav-link">Comments</a>
          </li>
          <li class="nav-item">
          	<a href="Blog.php" class="nav-link">Live Blog</a>
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
  <div style="height: 10px; background: #27aae1"></div>

<!--Navbar End-->

<!--Header-->

<header class="bg-dark text-white py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
      <h1> <i class="fas fa-blog" style="color: #27aae1;"></i> Blog Posts</h1>
      </div>
      <div class="col-lg-3 mb-2">
      <a href="AddNewPost.php" class="btn btn-primary btn-block">
        <i class="fas fa-edit"></i> Add New Post
      </a>
    </div>
    <div class="col-lg-3 mb-2">
      <a href="Categories.php" class="btn btn-info btn-block">
        <i class="fas fa-folder-plus"></i> Add New Category
      </a>
    </div>
    <div class="col-lg-3 mb-2">
      <a href="Admins.php" class="btn btn-warning btn-block">
        <i class="fas fa-user-plus"></i> Add New Category
      </a>
    </div>
    <div class="col-lg-3 mb-2">
      <a href="Comments.php" class="btn btn-success btn-block">
        <i class="fas fa-check"></i> Approve Comments
      </a>
    </div>
    </div>  
  </div>
</header>

<!--Header End-->

<!--Main Area-->


<section class="container py-2 mb-4">
  <div class="row">
     <?php 
           echo ErrorMessage();
           echo SuccessMessage();
         ?>
    <div class="col-lg-12">
      <table class="table table-striped table-hover">
        <thead class="thead-dark">
        <tr>
          <th>#</th>
          <th>Title</th>
          <th>Category</th>
          <th>Date&Time</th>
          <th>Author</th>
          <th>Banner</th>
          <th>Comments</th>
          <th>Action</th>
          <th>Live Preview</th>
        </tr>
        </thead>
        <?php 

          global $ConnectingDB;
          $sql = "SELECT * FROM posts";
          $stmt= $ConnectingDB->query($sql);
          $sr=0;
          while ($Datarows= $stmt->fetch()) {
            $Id        = $Datarows["id"];
            $DateTime  = $Datarows["datetime"];
            $PostTitle = $Datarows["title"];
            $Category  = $Datarows["category"];
            $Admin     = $Datarows["author"];
            $Image     = $Datarows["image"];
            $PostText  = $Datarows["post"];
            $sr++;
          

         ?>
         <tbody>
         <tr>
          <td><?php echo $sr ?></td>
           <td> 
            <?php if (strlen($PostTitle)>=20) {
             $PostTitle= substr($PostTitle, 0,16).'..';
            } 
             echo $PostTitle; 
             ?>
              
            </td>
           <td>

            <?php if (strlen($Category)>=6) {
             $Category= substr($Category, 0,6).'..';
            } 
             echo $Category; 
             ?>
              
            </td>
           <td>

            <?php if (strlen($DateTime)>=10) {
             $DateTime= substr($DateTime, 0,12).'..';
            } 
             echo $DateTime; 
             ?>
              
            </td>
           <td>

            <?php if (strlen($Admin)>=6) {
             $Admin= substr($Admin, 0,6).'..';
            } 
             echo $Admin; 
             ?>
              

            </td>
           <td><img src="Uploads/<?php echo $Image ?>" height="50px;" width="150px; " > </td>
           <td>Comments</td>
           <td>
            <a href="EditPost.php?id=<?php echo $Id;?>"><span class="btn btn-warning">Edit</span></a>
            <a href="DeletePost.php?id=<?php echo $Id;?>"><span class="btn btn-danger">Delete</span></a>
           </td>
           <td><a href="FullPost.php?id=<?php echo $Id;?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
           <?php } ?>
         </tr>
       </tbody>
      </table>
    </div>
  </div>
  
</section>


<!--Main Area end-->

<!--Footer-->
<footer class="bg-dark text-white">
  <div class="container">
    <p class="lead text-center">Theme By | learners flame | <span id="demo"></span> &copy; ----All rights reserved.</p>
  </div>
  <div style="height: 10px; background: #27aae1"></div>
</footer>

<!--Footer End-->


<script>
  const d = new Date();
  document.getElementById("demo").innerHTML = d.getFullYear();
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html> 