<?php require_once("Includes/DB.php");?>

 <?php require_once("Includes/Functions.php");?>

 <?php require_once("Includes/Sessions.php");?>
 <?php Confirm_Login(); ?>
<?php

          $SearchQueryParameter = $_GET['id'];
          global $ConnectingDB;
           
           $sql = "SELECT * FROM posts WHERE id='$SearchQueryParameter'";
           $stmt = $ConnectingDB->query($sql);
           while ($DataRows=$stmt->fetch()) {
             $TitleToBeDeleted    = $DataRows['title'];
             $CategoryToBeDeleted = $DataRows['category'];
             $ImageToBeDeleted    = $DataRows['image'];
             $PostToBeDeleted     = $DataRows['post'];
           }
     if (isset($_POST["submit"])) {
  
  
    //Query to Delete post to DB when everything fine

     global $ConnectingDB;

    $sql = "DELETE FROM posts WHERE id='$SearchQueryParameter'";

    $Execute = $ConnectingDB->query($sql);
    
    
    if ($Execute) {
      $Taget_Path_To_Delete_Image = "Uploads/$ImageToBeDeleted";
      unlink($Taget_Path_To_Delete_Image);
      $_SESSION["SuccessMessage"]="Post Deleted Successfully";
      Redirect_to("Posts.php");
    }
    else{
      $_SESSION["ErrorMessage"]="Post Deleted Fail. Try again.";
      Redirect_to("EditPost.php?id=$SearchQueryParameter");
    }
  
}
?>

<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <title>
    Delete Post
  </title>
  <link rel="stylesheet" type="text/css" href="Css/Styles.css">
</head>
<body>

  <!--Navbar Start-->

  <div style="height: 10px; background: #27aae1"></div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
  <a href="#" class="navbar-brand">Forid.com</a>

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
      <h1> <i class="fas fa-edit" style="color: #27aae1;"></i> Delete Post</h1>
    </div>
  </div>
</header>

<!--Header End-->

<!--Main area-->
<section class="container py-2 mb-4">
  <div class="row" style="min-height: 340px;">
    <div class="offset-lg-1 col-lg-10" >

        <?php 
           echo ErrorMessage();
           echo SuccessMessage();
           //Fetching Existing Content according to our
          
         ?>

        <form class="" action="DeletePost.php?id=<?php echo $SearchQueryParameter; ?>" method="post" enctype="multipart/form-data">
           <div class="card bg-secondary text-light mb-3">
             
             <div class="card-body bg-dark">
               <div class="form-group">
                 <label for="title"> <span class="FieldInfo"> Post Title </span> </label>
                 <input disabled class="form-control" type="text" name="PostTitle" id="title" placeholder="Type title here" value="<?php echo $TitleToBeDeleted;?>">
               </div>
               <div class="form-group">
                <span class="FieldInfo">Existing Category</span>
                <?php echo $CategoryToBeDeleted; ?>
                <br>
                 
               </div>
               <div class="form-group">
                <span class="FieldInfo">Existing Image</span>
                <img class="mb-2" src="Uploads/<?php echo $ImageToBeDeleted;?>" width=170px; height=80px; >
                
                 
               </div>
               <div class="mb-3">
                 <label for="Post"> <span class="FieldInfo"> Post </span> </label>
                 <textarea disabled class="form-control" id="Post" name="PostDescription" rows="8" cols="80">
                   <?php echo $PostToBeDeleted; ?>
                 </textarea>
               </div>

               <div class="row">
                 <div class="col-lg-6 mb-2">
                   <a href="Dashboard.php" class="btn btn-warning btn-block"> <i class="fas fa-arrow-left"></i> Back Dashboard</a>
                 </div>

                 <div class="col-lg-6 mb-2">
                   <button type="submit" name="submit" class="btn btn-danger btn-block"> <i class="fas fa-trash"></i> Delete </button>
                 </div>
               </div>
             </div>
           </div>
        </form>
    </div>
  </div>
</section>

<!--Main area end-->

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