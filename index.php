<?php
session_start();
require_once 'components/db_connect.php';

// it will never let you open index(login) page if session is set
if (isset($_SESSION['user']) != "") {
    header("Location: home.php");
    exit;
}
if (isset($_SESSION['adm']) != "") {
    header("Location: dashboard.php"); // redirects to home.php
}

$error = false;
$email = $password = $emailError = $passError = '';

if (isset($_POST['btn-login'])) {

    // prevent sql injections/ clear user invalid inputs
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);
    // prevent sql injections / clear user invalid inputs

    if (empty($email)) {
        $error = true;
        $emailError = "Please enter your email address.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    }

    if (empty($pass)) {
        $error = true;
        $passError = "Please enter your password.";
    }

    // if there's no error, continue to login
    if (!$error) {

        $password = hash('sha256', $pass); // password hashing

        $sqlSelect = "SELECT id, first_name, password, status FROM user WHERE email = ? limit 1";
        $stmt = $connect->prepare($sqlSelect);
        $stmt->bind_param("s", $email);
        $work = $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $count = $result->num_rows;
        if ($count == 1 && $row['password'] == $password) {
            if($row['status'] == 'adm'){
                $_SESSION['adm'] = $row['id'];        
                header( "Location: dashboard.php");}
            else{
                $_SESSION['user'] = $row['id']; 
               header( "Location: home.php");
            }          
        } else {
            $errMSG = "Incorrect Credentials, Try again...";
        }
    }
}
$connect->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login & Registration System</title>
        <link rel="stylesheet" href="style/style.css?ver=<?php echo time(); ?>">

        <?php require_once 'components/boot.php'?>
    </head>
    <body>
    <?php require_once 'nav.php';  ?>
        <div class="container">
      




      

<div class="col text-center d-flex justify-content-center m-4">



        <div class="box">
  <h2>Login</h2>
  <form class="w-100 form-box" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
            
              
            <hr/>
            <span class="text-danger"> <?php
            if (isset($errMSG)) {
                echo $errMSG; 
            }
            ?></span> 
           
    <div class="inputBox">
        <input type="email" autocomplete="off"  name="email"value="<?php echo  $email; ?>">
        <span class="text-danger"><?php echo $emailError; ?></span> 
        <label>Username</label>
    </div>
    <div class="inputBox">
        <input type="password" name="pass" value=""/>
        <span class="text-danger"><?php echo $passError; ?></span>
        <label>Password</label>
    </div>
        <input type="submit" name="btn-login" value="Sign In">
        <a  class="link-light" href="register.php">Not registered yet? Click here</a>
	


            </form> 
            </div>
           
     </div>



          
        </div>
    </body>
</html>