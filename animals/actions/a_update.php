
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
    $id = $_POST['id'];
    $name = $_POST['name'];


    $picture = $_POST['picture'];
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $availability=htmlspecialchars($_POST['availability']);
    $origin=htmlspecialchars($_POST['origin']);
    $location=htmlspecialchars($_POST['location']);
    $age=$_POST['age'];
    $size=htmlspecialchars($_POST['size']);
    $hobbies=htmlspecialchars($_POST['hobbies']);
  


   
    $supplier = $_POST['supplier'];
    //variable for upload pictures errors is initialized
    $uploadError = '';

    $picture = file_upload($_FILES['picture'], 'product');//file_upload() called  
        if($picture->error===0){
            ($_POST["picture"]=="product.png")?: unlink("../../pictures/$_POST[picture]");           
            $sql = "UPDATE animals SET 
            name = '$name',
            picture = '$picture->fileName',
            availability='$availability',
            description='$description',
            origin='$origin',
            location='$location',
            age='$age',
            size='$size',
            hobbies='$hobbies',
             fk_supplierId = $supplier WHERE id = {$id}";
        }else{
            $sql = "UPDATE animals SET 
            name = '$name',
            -- picture = '$picture->fileName',
            description='$description',
            availability='$availability',
            origin='$origin',
            location='$location',
            age='$age',
            size='$size',
            hobbies='$hobbies',
             fk_supplierId = $supplier WHERE id = {$id}";
        }    
        if ($connect->query($sql) === TRUE) {
            $class = "success";
            $message = "The record was successfully updated";
            $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
} else {
            $class = "danger";
            $message = "Error while updating record : <br>" . $connect->error;
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
            <h1>Update request response</h1>
        </div>
        <div class="alert alert-<?php echo $class;?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../update.php?id=<?=$id;?>'><button class="btn btn-warning" type='button'>Back</button></a>
            <a href='../index.php'><button class="btn btn-success" type='button'>Home</button></a>
        </div>
    </div>
</body>
</html>

