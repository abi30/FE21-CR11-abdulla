
<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-primary">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <a class="navbar-brand" href="index.php"><span style="color: rgb(0, 0, 0);font-size: larger;font-weight: bolder; ">Adopt </span> <span style="color: rgb(255, 255, 254); font-style: italic;font-size: larger;font-weight: bolder; "> a Pet</span>
          <span style="color: rgb(255, 255, 254);font-size: larger;font-weight: bolder; ">ONLINE</span></a>

           <?php 

           if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
           echo' <a class="btn m-2 btn-warning border border-white" id="search" type="button" href="register.php"?register">Register</a>';
        
           
        }elseif(isset($_SESSION['adm'])){
          
         
          $res=mysqli_query($connect, "SELECT * FROM user WHERE id=".$_SESSION['adm']);
          $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
          
          
          echo'
          <p class="">'.$userRow['first_name'].'</p> 
          <p class="">'.$userRow['last_name'].'</p>
          <p class="">'.$userRow['picture'].'</p>
          
          <a href="profile.php?id='.$userRow['id'].'">
          <img class="m-2"src="picture/'.$userRow['picture'].'" style = " width:50px; height:50px; border-radius:50%;"> </a>
          ';
           
        
         
      

        } elseif(isset($_SESSION['user'])){


     
            echo'
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                 <li class="nav-item">
                 <a class="nav-link" id="desc" type="button" href="library.php" >Library</a>
                 </li>
                 <li class="nav-item">
                 <a class="nav-link" id="asc" type="button" href="create.php?page=index.php">Add Items</a>
                 </li>
                 <li class="nav-item">
                 <a class="nav-link"aria-current="page" href="index.php">Database</a>
                 </li>
                 <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                 Media
               </a>
               <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                 <li><a class="dropdown-item" href="type_book.php">BOOKs</a></li>
                 <li><a class="dropdown-item" href="type_cd.php">CDs</a></li>
                 <li><a class="dropdown-item" href="type_dvd.php">DVDs</a></li>
               </ul>
             </li>
                 </ul>
                
                  
                 <p class="">'.$row['first_name'].'</p>
               
             
                  <a href="profile.php">
               <img class="m-2"src="pictures/'.$row['picture'].'" style = " width:50px; height:50px; border-radius:50%;"> </a>';
            
             
                   echo'<a class="btn btn-danger border border-white" id="search" type="button" href="logout.php?logout">Sign Out</a>';


        }
           
           
           
           ?>
          
              
        </div>
    </div>
  </nav>
    <!-- <div  class="hero_img"> -->
   

    
    <!-- <div class ="note">
   <h1>The <span style="color: rgb(245, 237, 6);">BIGLIBRARY</span></h1>
              <h4> <span style="color: rgb(245, 237, 6);">“</span> Books are the quietest and most constant of friends; they are the most accessible and wisest of counselors, and the most patient of teachers.<span style="color: rgb(245, 237, 6);">”</span> <br></h4>
             
     <h1>-Charles W. Eliot</h1>
    </div>    -->



 <!-- </div> -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<link rel="stylesheet" href="style/style.css?ver=<?php echo time(); ?>">

