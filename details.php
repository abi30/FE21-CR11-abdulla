






















<?php 
session_start();
require_once 'components/db_connect.php';
require_once 'components/boot.php';

if ($_GET['id']) {
    $id = $_GET['id'];
    // $sql = "SELECT * FROM media   WHERE id = {$id}";
    $sql="SELECT * FROM animals JOIN supplier ON fk_supplierId=supplierID WHERE id = {$id}";

    $result = $connect->query($sql);
  
   

    if ($result->num_rows == 1) {
        $data = $result->fetch_assoc();
        $picture = $data['picture'];
        $name = $data['name'];
        $size = $data['size'];
        $availability = $data['availability'];
        $origin = $data['origin'];
        $description = $data['description'];
        $location = $data['location'];
        $age = $data['age'];
        $sup_email = $data['sup_email'];
        $sup_website = $data['sup_website'];
        $hobbies = $data['hobbies'];
      

        
    } else {
        header("location: error.php");
    }
 
} else {
    header("location: error.php");
}




// if adm will redirect to dashboard

// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
  header("Location: index.php");
  exit;
}

// select logged-in users details - procedural style
$res = mysqli_query($connect, "SELECT * FROM user WHERE id=" . $_SESSION['user']);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);







?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php require_once 'components/boot.php';?>
    <title>View | media</title>
    <link rel="stylesheet" href="style/style.css?ver=<?php echo time(); ?>">
  </head>
   <body>
       
           <div class="container-fluid">


                          <!-- navbar -->

  <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-primary">
    <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" href="index.php"><span style="color: rgb(0, 0, 0);font-size: larger;font-weight: bolder; ">Adopt </span> <span style="color: rgb(255, 255, 254); font-style: italic;font-size: larger;font-weight: bolder; "> a Pet</span>
      <span style="color: rgb(255, 255, 254);font-size: larger;font-weight: bolder; ">ONLINE</span></a>

      <?php 

      if(isset($_SESSION['user'])){


      echo'
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
      <a class="nav-link" id="asc" type="button" href="home.php">Home</a>
      </li>
      <li class="nav-item">
      <a class="nav-link"aria-current="page" href="update.php?id='.$row['id'].'">profile setting</a>
      </li>
      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      Sizes
      </a>
      <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
      <li><a class="dropdown-item" href="senior.php">Senior</a></li>
      <li><a class="dropdown-item" href="s_size.php">S_size</a></li>
      <li><a class="dropdown-item" href="l_size.php">L_size</a></li>
      </ul>
      </li>
      </ul>
      <p class="">Hi '.$row['first_name'].'!</p>
      <a href="home.php">
      <img class="m-2"src="pictures/'.$row['picture'].'" style = " width:50px; height:50px; border-radius:50%;"> </a>';
      echo'<a class="btn btn-danger border border-white" id="search" type="button" href="logout.php?logout">Sign Out</a>';
      }

      $connect->close();
      ?>
      </div>
    </div>

  </nav>


</div>

 <div class="container">
        <div class="hero">
        <img class="userImage" src="pictures/<?php echo $row['picture']; ?>" alt="<?php echo $row['first_name']; ?>" style="width: 100px;">
        </div>
        <h2> Hi <?php echo $row['first_name' ]; ?>, you can see more infromation about this cat!</h2>
    </div>


<div class="container">
       <div class="col text-center d-flex justify-content-center">
       <div class="card text-center rounded-3 m-5 " style="width: 25rem;">
       <img class="card-img-top  m-auto" src="pictures/<?php echo $picture?> ">
           <div class="card-body">
               <h5 class="card-title"> name : <?php echo $name?> </h5>
               <h5 class="card-title"> origin :<?php echo $origin?> </h5>
               <h5 class="card-title"> Location :<?php echo $location?> </h5>
               <h5 class="card-title"> Description :<?php echo $description?> </h5>
               <h5 class="card-title"> Age :<?php echo $age?> </h5>
               <h5 class="card-title"> Size :<?php echo $size ?> </h5>
               <h5 class="card-title"> Availability :<?php echo $availability ?> </h5>
               <p class="card-text">supplier email : <?php echo $sup_email?> </p>
               <p class="card-text">supplier Website : <?php echo $sup_website?> </p>
               </div>
               
               <div class="card-footer">
               
               <a class="btn btn-warning" href ="home.php?id=<?=$id ;?>">home</a>
              
               </div>
           </div>
        </div>
</div>

    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

 
  </body>
</html>


































    </body>
</html>