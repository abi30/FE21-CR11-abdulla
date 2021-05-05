
<?php
session_start();

if (isset($_SESSION['user']) != "") {
    header("Location: ../../home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../../index.php");
    exit;
}

require_once '../../components/db_connect.php';
require_once '../../components/file_upload.php';

if ($_POST) {   
    $name = $_POST['name'];
    $picture = file_upload($_FILES['picture'], 'product');  
    $description = $_POST['description'];
    $availability = $_POST['availability'];
    $origin = $_POST['origin'];
    $location = $_POST['location'];
    $age = $_POST['age'];
    $size = $_POST['size'];
    $hobbies = $_POST['hobbies'];
    // $fk_supplierId = $_POST['fk_supplierId'];







    $supplier = $_POST['supplier'];    
    $uploadError = '';
    //this function exists in the service file upload.
   
    if($supplier == 'none'){
   //checks if the supplier is undefined and insert null in the DB
    $sql = "INSERT INTO animals 
    (
    picture,
    name,
    description,
    availability,
    origin,
    location,
    age,
    size,
    hobbies,
     fk_supplierId
     ) VALUES (
          '$picture->fileName',
          '$name', 
          '$description', 
          '$availability', 
          '$origin', 
          '$location', 
          '$age', 
          '$size', 
          '$hobbies', 
           null)";
   }else{


    $sql = "INSERT INTO animals 
    (
    picture,
    name,
    description,
    availability,
    origin,
    location,
    age,
    size,
    hobbies,
     fk_supplierId
     ) VALUES (
          '$picture->fileName',
          '$name', 
          '$description', 
          '$availability', 
          '$origin', 
          '$location', 
          '$age', 
          '$size', 
          '$hobbies', 
          '$supplier')";







   





   }
    if ($connect->query($sql) === true) {

        $class = "success";
        $message = "The entry below was successfully created <br>
                <table class='table w-50'><tr>
                <td>Name: $name </td>
                <td>Orizin $origin </td>
                <td>Location: $location </td>
                <td>Size: $size </td>
                <td>Available: $availability </td>
                <td>Age: $age Y </td>
                </tr></table><hr>
                ";
        $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
    } else {
        $class = "danger";
        $message = "Error while creating record. Try again: <br>" . $connect->error;
        $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
    }
    $connect->close();
} else {
    header("location: ../error.php");
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update</title>
    <link rel="stylesheet" href="../../style/style.css?ver=<?php echo time(); ?>">
    <?php require_once '../../components/boot.php'?>
</head>
<body>
   
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Create request response</h1>
        </div>
        <div class="alert alert-<?=$class;?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../index.php'><button class="btn btn-primary" type='button'>Home</button></a>
        </div>
    </div>
</body>
</html>

