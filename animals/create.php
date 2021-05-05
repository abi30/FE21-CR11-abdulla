
<?php
session_start();
require_once '../components/db_connect.php';

if (isset($_SESSION['user']) != "") {
    header("Location: ../home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}

$suppliers = "";
$result = mysqli_query($connect, "SELECT * FROM supplier");

while ($row = $result->fetch_array(MYSQLI_ASSOC)){
       $suppliers .= 
"<option value='{$row['supplierId']}'>{$row['sup_name']}</option>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css?ver=<?php echo time(); ?>">
    <?php require_once '../components/boot.php'?>
    <title>PHP CRUD  |  Add Product</title>
    <style>
        fieldset {
            margin: auto;
            margin-top: 100px;
            width: 60% ;
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
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <a class="nav-link" id="desc" type="button" href="../dashboard.php" >Dashboard</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" id="asc" type="button" href="create.php">
        Add Animals</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" id="asc" type="button" href="../itemboard.php?admin">Itemboard</a>
        </li>
        </ul>
        
        <?php 

        if (isset($_SESSION["adm"])) {

        $res=mysqli_query($connect, "SELECT * FROM user WHERE id=".$_SESSION['adm']);
        $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);


        echo'
        <p class="">'.$userRow['first_name'].'</p>

        <a href="../dashboard.php?id='.$userRow['id'].'">
        <img class="m-2"src="../pictures/'.$userRow['picture'].'" style = " width:50px; height:50px; border-radius:50%;"> </a>
        ';

        }

        $connect->close();

        ?> 
        <a class="btn btn-danger border border-white" id="search" type="button" href="../logout.php?logout">Sign Out</a>



        </div>
      </div>
    </nav>







<fieldset>
   <legend class='h2'>Add Product</legend>
   <form action="actions/a_create.php" method= "post" enctype="multipart/form-data">
   <table class='table'>
           <tr>
               <th>Name</th>
               <td><input class='form-control' type="text" name="name"  placeholder="Cat Name" /></td>
           </tr>    
           <tr>
               <th>Picture</th>
               <td><input class='form-control' type="file" name="picture" /></td>
           </tr>
           <tr>
               <th>Descripition</th>
               <td><input class='form-control' type="text" step="any" name= "description" placeholder="Descripiton" /></td>
           </tr>
           <tr>
               <th>Availability</th>
               <td><input class='form-control' type="number" step="any" name= "availability" placeholder="Availability" /></td>
           </tr>
           <tr>
               <th>Origin</th>
               <td><input class='form-control' type="text" step="any" name= "origin" placeholder="Origin" /></td>
           </tr>
           <tr>
               <th>Location</th>
               <td><input class='form-control' type="text" step="any" name= "location" placeholder="Location" /></td>
           </tr>
           <tr>
               <th>Age</th>
               <td><input class='form-control' type="number" step="any" name= "age" placeholder="Age" /></td>
           </tr>
           <tr>
               <th>Size</th>
               <td><input class='form-control' type="text" step="any" name="size" placeholder="size" /></td>
           </tr>
           <tr>
               <th>Hobbies</th>
               <td><input class='form-control' type="text" step="any" name= "hobbies" placeholder="Hobbies" /></td>
           </tr>
           <tr>
               <th>Supplier</th>
               <td>
               <select class="form-select" name="supplier" aria-label="Default select example">
                <?php echo $suppliers;?>
                <option selected value='none'>Undefined</option>
               </select>
               </td>
           </tr>
           <tr>
               <td><button class='btn btn-success' type="submit">Insert Data</button></td>
               <td><a href="index.php"><button class='btn btn-warning' type="button">Home</button></a></td>
           </tr>
       </table>
   </form>
</fieldset>
</body>
</html>

