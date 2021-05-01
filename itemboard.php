<?php

session_start();
require_once 'components/db_connect.php';
// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
//if session user exist it shouldn't access dashboard.php
if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit;
}

// select logged-in users details

     
$sql = "SELECT * FROM animals order by id desc" ;
$result = mysqli_query($connect ,$sql);
$tbody=''; //this variable will hold the body for the table
if(mysqli_num_rows($result)  > 0) {   
    while ( $row=mysqli_fetch_assoc($result)) {
    // while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){        
       $tbody .= "<tr>
     
            <td>
             <a href='view.php?id=" .$row['id']."'> <img class='img-thumbnail' src='pictures/" .$row['picture']."'/></a>
           </td>
           <td>" .$row['name']."</td>
           <td>" .$row['description']."</td>
           <td>" .$row['availability']."</td>
           <td>" .$row['origin']."</td> 
           <td>" .$row['location']."</td>
           <td>" .$row['age']."</td>
           <td>" .$row['size']."</td>
           <td>" .$row['hobbies']."</td>
           <td>" .$row['fk_supplierId']."</td>
           <td><a href='animals/update.php?id=" .$row['id']."'><button class='btn btn-primary btn-sm' type='button'>Edit</button></a>
           <a href='animals/delete.php?id=" .$row['id']."'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a></td>
           </tr>";
   };
} else {
   $tbody =  "<tr><td colspan='12'><center>No Data Available </center></td></tr>";
}
// echo "<pre>";
// print_r($result);
// echo "</pre>";

// $connect->close();



?>

<!--       <td>" .$row['id']."</td> -->


<!DOCTYPE html>
<html lang="en" >
   <head>
       <meta charset="UTF-8">
       <meta name="viewport"  content="width=device-width, initial-scale=1.0">
       <title>PHP CRUD</title>
       <link rel="stylesheet" href="style/style.css?ver=<?php echo time(); ?>">

       <?php require_once 'components/boot.php' ?>
       <style type= "text/css">
           .manageProduct {          
               margin: auto;
           }
           .img-thumbnail {
               width: 70px !important;
                height: 70px !important;
           }
           td {          
               text-align: left;
               vertical-align: middle;

            }
           tr {
               text-align: center;
           }
       </style>
     <link rel="stylesheet" href="style/style.css?ver=<?php echo time(); ?>">
    </head>
    <body>
   


    


    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-primary">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <a class="navbar-brand" href="index.php"><span style="color: rgb(0, 0, 0);font-size: larger;font-weight: bolder; ">Adopt </span> <span style="color: rgb(255, 255, 254); font-style: italic;font-size: larger;font-weight: bolder; "> a Pet</span>
          <span style="color: rgb(255, 255, 254);font-size: larger;font-weight: bolder; ">ONLINE</span></a>

         
          
        
        
       <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link" id="desc" type="button" href="dashboard.php" >Dashboard</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" id="asc" type="button" href="animals/create.php">Add Animals</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" id="asc" type="button" href="itemboard.php?admin">Itemboard</a>
            </li>
        
            </ul>

            <?php 

if (isset($_SESSION["adm"])) {
    
    $res=mysqli_query($connect, "SELECT * FROM user WHERE id=".$_SESSION['adm']);
    $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
    
    
    echo'
    <p class="">'.$userRow['first_name'].'</p>
    
    <a href="profile.php?id='.$userRow['id'].'">
    <img class="m-2"src="pictures/'.$userRow['picture'].'" style = " width:50px; height:50px; border-radius:50%;"> </a>
    ';
    
}

$connect->close();

        ?> 
  <a class="btn btn-danger border border-white" id="search" type="button" href="logout.php?logout">Sign Out</a>



          
              
       
    </div>
  </nav>



       <div class="container manageProduct w-75 mt-3" >   
     

           <div class='mb-3'>
  
                <!-- <a href= "create.php" ><button class='btn btn-primary'type = "button" >Add product</button></a> -->
            </div>
           <p  class='h2'>All Gallery's Items</p>
           <div class="table-responsive w-100">

            <table class='table table-striped w-auto'>
               <thead class='table-success' >
                   <tr>

                        <!-- <th>ID</th> -->


                        <th>Picture</th>
                       <th>name</th>
                       <th>Description</th>
                       <th>Available</th>
                       <th>origin</th>
                       <th>Location</th>
                       <th>age</th>
                       <th>size</th>
                        <th>hobbies</th>
                        <th>supplier</th>
                        <th>Action</th>

                   </tr>
               </thead>
               <tbody>
              
             
                   <?=$tbody;?>
               </tbody>
            </table>
       </div>
       </div>
    </body>
</html>