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









$id = $_SESSION['adm'];
$status = 'adm';
$sqlSelect = "SELECT * FROM user WHERE status != ? ";
$stmt = $connect->prepare($sqlSelect);
$stmt->bind_param("s", $status);
$work = $stmt->execute();
$result = $stmt->get_result();
//this variable will hold the body for the table
$tbody = ''; 
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $tbody .= "<tr>
            <td><img class='img-thumbnail rounded-circle' src='pictures/" . $row['picture'] . "' alt=" . $row['first_name'] . "></td>
            <td>" . $row['first_name'] . " " . $row['last_name'] . "</td>
            <td>" . $row['date_of_birth'] . "</td>
            <td>" . $row['email'] . "</td>
            <td><a href='update.php?id=" . $row['id'] . "'><button class='btn btn-primary btn-sm' type='button'>Edit</button></a>
            <a href='delete.php?id=" . $row['id'] . "'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a></td>
         </tr>";
    }
} else {
    $tbody = "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Adm-DashBoard</title>
        <link rel="stylesheet" href="style/style.css?ver=<?php echo time(); ?>">
        <?php require_once 'components/boot.php'?>
        <style type="text/css">        
            .img-thumbnail{
                width: 70px !important;
                height: 70px !important;
            }
            td{
                text-align: left;
                vertical-align: middle;
            }
            tr{
                text-align: center;
            }
            .userImage{
                width: 100px;
                height: auto;
            }
        </style>
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



        <div class="container">
                    <p class='h2'>Users</p>
            <div class="row">
                <!-- <div class="col-2">
                    <img class="userImage" src="pictures/admavatar.png" alt="Adm avatar">
                    <p class="">Administrator</p>
                    <a href="animals/index.php">animals</a>
                    <a href="logout.php?logout">Sign Out</a>
                </div> -->
                <div class="col-12 mt-2">
                <div class="table-responsive">

                    <table class='table table-striped w-100'>
                        <thead class='table-success'>
                            <tr>
                                <th>Picture</th>
                                <th>Name</th>
                                <th>Date of birth</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?=$tbody?>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </body>
</html>