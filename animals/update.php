
<?php
session_start();

if (isset($_SESSION['user']) != "") {
    header("Location: ../home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}

require_once '../components/db_connect.php';

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM animals WHERE id = {$id}";
    $result = $connect->query($sql);
    if ($result->num_rows == 1) {
        $data = $result->fetch_assoc();
        $name = htmlspecialchars($data['name']);
        $picture = $data['picture'];
        $description = htmlspecialchars($data['description']);
        $availability=$data['availability'];
        $origin=htmlspecialchars($data['origin']);
        $location=htmlspecialchars($data['location']);
        $age=$data['age'];
        $size=$data['size'];
        $hobbies=htmlspecialchars($data['hobbies']);
        $supplier = $data['fk_supplierId'];

        $resultSup = mysqli_query($connect, "SELECT * FROM supplier");
        $supList = "";
        if(mysqli_num_rows($resultSup) > 0){
            while ($row = $resultSup->fetch_array(MYSQLI_ASSOC)){
                if($row['supplierId'] == $supplier){
                    $supList .= "<option selected value='{$row['supplierId']}'>{$row['sup_name']}</option>";  
                }else{
                    $supList .= "<option value='{$row['supplierId']}'>{$row['sup_name']}</option>";
                }}                
            }else{
            $supList = "<li>There are no suppliers registered</li>";
        }
    } else {
        header("location: error.php");
    }
    $connect->close();
} else {
    header("location: error.php");
}
?>
<!DOCTYPE html>
<html>
<head>
   <title>Edit Product</title>
   <link rel="stylesheet" href="../style/style.css?ver=<?php echo time(); ?>">
   <?php require_once '../components/boot.php'?>
   <style type= "text/css">
       fieldset {
            margin: auto;
            margin-top: 100px;
            width: 60% ;
        }  
        .img-thumbnail{
            width: 70px !important;
            height: 70px !important;
        }     
   </style>
</head>
<body>
<fieldset>
   <legend class='h2'>Update request <img class='img-thumbnail rounded-circle' src='../pictures/<?php echo $picture ?>' alt="<?php echo $name ?>"></legend>
   <form action="actions/a_update.php"  method="post" enctype="multipart/form-data">
       <table class="table">
           <tr>
               <th>Name</th>
               <td><input class="form-control" type="text"  name="name" placeholder ="Product Name" value="<?php echo $name ?>"  /></td>
           </tr>
           <tr>
               <th>Picture</th>
               <td><input class="form-control" type="file" name= "picture" /></td>
           </tr>
           <tr>
           <th>Description</th>
               <td><input class='form-control' type="text" step="any" name= "description" placeholder="Description" value="<?php echo $description ?>" /></td>
           </tr>










           <tr>
               <th>Availability</th>
               <td><input class='form-control' type="number" step="any" name= "availability" placeholder="Availability" value="<?php echo $availability?>" /></td>
           </tr>
           <tr>
               <th>Origin</th>
               <td><input class='form-control' type="text" step="any" name= "origin" placeholder="Origin"  value="<?php echo $origin?>"/></td>
           </tr>
           <tr>
               <th>Location</th>
               <td><input class='form-control' type="text" step="any" name= "location" placeholder="Location" value="<?php echo $location?>" /></td>
           </tr>
           <tr>
               <th>Age</th>
               <td><input class='form-control' type="number" step="any" name= "age" placeholder="Age" value="<?php echo $age?>"/></td>
           </tr>
           <tr>
               <th>Size</th>
               <td><input class='form-control' type="text" step="any" name="size" placeholder="size" value="<?php echo $size;?>" /></td>
           </tr>
           <tr>
               <th>Hobbies</th>
               <td><input class='form-control' type="text" step="any" name= "hobbies" placeholder="Hobbies" value="<?php echo $hobbies?>" /></td>
           </tr>


htmlcharectes()






           <tr>
               <th>Supplier</th>
               <td>
               <select class="form-select" name="supplier" aria-label="Default select example">
                <?php echo $supList;?>
               </select>
               </td>
           </tr>
           <tr>
               <input type= "hidden" name= "id" value= "<?php echo $data['id'] ?>" />
               <input type= "hidden" name= "picture" value= "<?php echo $data['picture'] ?>" />
               <td><button class="btn btn-success" type= "submit">Save Changes</button></td>
               <td><a href= "index.php"><button class="btn btn-warning" type="button">Back</button></a></td>
           </tr>
       </table>
   </form>
</fieldset>
</body>
</html>

