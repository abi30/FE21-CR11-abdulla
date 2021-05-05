<?php
session_start();
require_once 'components/db_connect.php';

// if adm will redirect to dashboard
if (isset($_SESSION['adm'])) {
    header("Location: dashboard.php");
    exit;
}
// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

// select logged-in users details - procedural style
$res = mysqli_query($connect, "SELECT * FROM user WHERE id=" . $_SESSION['user']);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome - <?php echo $row['first_name']; ?></title>
        <link rel="stylesheet" href="style/style.css?ver=<?php echo time(); ?>">

        <?php require_once 'components/boot.php'?>
        <style>
            .userImage{
                width: 200px;
                height: 200px;
            }
            .hero {
                background: rgb(2,0,36);
                background: linear-gradient(24deg, rgba(2,0,36,1) 0%, rgba(0,212,255,1) 100%);   
            }
        </style>
    </head>
    <body>

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
           ?>
        </div>
    </div>
  </nav>







    <div class="container">
        <div class="hero">
        <img class="userImage" src="pictures/<?php echo $row['picture']; ?>" alt="<?php echo $row['first_name']; ?>">
        </div>
        <h2> Hi <?php echo $row['first_name' ]; ?> ! Here you can find all large animals.</h2>
    </div>


  
   
      <?php
              $sql = "SELECT * FROM animals WHERE  size ='large'";
              $result = $connect->query($sql);
              $tbody="";
              if($result->num_rows > 0) {
       
                  while($row2 = $result->fetch_assoc()) {
              



      $tbody .= '
      <div class="col own_col text-center p-2">
      <div class="card text-left w-100 h-100 rounded-3 " style="width: 18rem;">
      <img class="img-thumbnail own_pic" src="pictures/' .$row2["picture"].'"/>
          <div class="card-body">


          <hr>
          <h6 class="card-text">Name :<small>' .$row2['name'].'</small></h6>
          <h6 class="card-text">Description :<small>' .$row2['description'].'</small></h6>
          <h6 class="card-text">Availability :<small>' .$row2['availability'].'</small></h6>
          <h6 class="card-text">Location :<small>' .$row2['location'].'</small></h6>
          <h6 class="card-text">Origin :<small>' .$row2['origin'].'</small></h6>
          <h6 class="card-text">Age :<small>' .$row2['age'].'</small></h6>
          <h6 class="card-text">Hobbies :<small>' .$row2['hobbies'].'</small></h6>
          <h6 class="card-text">Size :<small>' .$row2["size"].'</small></h6> 
          <hr>

              </div>

              <div class="card-footer">
                <h6>Klick More to show detailed information of this animal.</h6>
              <a href="details.php?id='.$row2['id'].'"><button class="btn btn-warning border border-dark" type="button">More</button></a><hr>

              </div>
          </div>
          </div>
      
              ';

          };
      } else {
         $tbody =  "<tr><td colspan='12'><center>No Data Available </center></td></tr>";
      }
      $connect->close();
?>;


<div class="container w-100 mt-3" >   


<div class='mb-3'>

<p  class='h2'>All Gallery's Items</p>
<div class="row row-cols-1 row-cols-md-2  row-cols-lg-3 g-3">

 
       <?=$tbody;?>
  
    </div>
    </div>
    </div>

    </body>
</html>