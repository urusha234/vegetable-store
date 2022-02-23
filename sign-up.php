<!DOCTYPE>
<?php
include 'db_conn.php';


error_reporting(0);

session_start();

if(isset($_SESSION["s_username"])){
    
    header("location:seller-profile.php");
}




if(isset($_POST['register']))
{

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirm-password'];
    $phone = $_POST['phone_no'];
    $location = $_POST['location'];

    if ($password == $cpassword) 
    {        $sql = "SELECT * FROM seller where  email = '$email' ";
        
        $result = mysqli_query($conn, $sql);
       
            if (!$result -> num_rows  > 0 ) 
            {
                $sql = "INSERT INTO sellers(first_name, last_name, user_name, email, password, cpassword, phone_no, location) VALUES('$first_name', '$last_name' ,  '$username', 'email', '$password', '$cpassword', '$phone', '$location')";

                $result = mysqli_query($conn, $sql);
                     
                if($result)
                {
                echo '<script type="text/javascript">alert("Registration Completed Succesfully");window.location=\'seller-profile.php\';</script>';

                    $first_name = "";
                    $last_name = "";
                    $username = "";
                    $email = "";
                    $password = "";
                    $cpassword = "";
                    $phone = "";
                    $location = "";        

                }
                else
                {
                    echo "<script> alert('whoops') </script>";
                }
            }
            else
            {
                echo '<script type="text/javascript">alert("Email or username already exist");</script>';
            }
         
        //}
        //else
        //{
           // echo '<script type="text/javascript">alert("Username already exist");</script>';
        //}
    }
    else
    {
        echo '<script type="text/javascript">alert("Password does not match");</script>';
    }                           
}

?>
<html lang="en">


<head>
    <title>seller-register</title>
   
    <link rel="stylesheet" type="text/css" href="slogin.css">
    <script src="https://kit.fontawesome.com/7dd0b8b9ba.js" crossorigin="anonymous"></script>
</head>
<body>
    <header class="bgg">
        
        <div class="row">
            <div class="logo">
                
            </div>
    
            <div class="menu-icon">
                        <ul class="main-nav">
            <li><a href="index.php"><b>HOME</b></a></li>
            
            <li><a href="login-b.php"><b>BUYER </b><i class="fas fa-sign-in-alt"></i></a></li>
            <li class="active"><a href="active"><b>SELLER </b><i class="fas fa-sign-in-alt"></i></a></li>
            </ul>   
            
            
            </div>
        </div>

 <fieldset class="fill">
                
                 <form action="" method="post" enctype="multipart/form-data">

           
              <h2> Create Seller Account</h2></strong>
               
                  <h3>  <label for="input first_name"><b>Firstname</b></label></h3>
                    
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First_name " value = "<?php echo $first_name; ?>" required>
           
                    <h3><label for="input last_name"><b>Lastname</b></label></h3>
                 
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last_name " value = "<?php echo $last_name; ?>" required>


                    <h3><label for="input username"><b>Username</b></label></h3>
                 
                    <input type="text" class="form-control" id="uername" name="username" placeholder="Enter Username " value = "<?php echo $username; ?>" required>
         
                
              
                    <h3><label for="InputEmail"><b>Email address</b></label></h3>
                    <input type="email" class="form-control" id="InputEmail" name="email" aria-describedby="emailHelp" placeholder="Enter email" value = "<?php echo $email; ?>" required>
               

               <h3>     <label for="input phone_no"><b>Phone No.</b></label></h3>
                    <input type="text"  class="form-control" id="phone_no" name="phone_no" placeholder="Enter Phone No. " value = "<?php echo $phone; ?>" required>
          
                    <h3><label for="input location"><b>Location</b></label></h3>
                    <input type="text" class="form-control" id="location" name="location" placeholder="Enter location " value = "<?php echo $location ;?>" required>
                

                    <input class="field" type="password" name="password" placeholder="Password" id = "password"  required>
                    <input class="field" type="password" name="confirm-password" placeholder="Confirm Password" id = "confirm-password"  required>

                <!--<div>

                        <password-strength data-minimum-character-count="8" data-passphrase-length="15">
                               <h3> <label class="form-label f5" for="farmer_password">Password</label></h3>
                            
                                <input type="password" name="password_one" data-minimum-character-count="8" data-passphrase-length="15" id="farmer_password" class="form-control form-control-lg input-block" placeholder="Create a password" required>

                                <input type="password" name="password_two" data-minimum-character-count="8" data-passphrase-length="15" id="farmer_password1" class="form-control form-control-lg input-block mt-5 mb-5" placeholder="Confirm password" required>
                               
                    </password-strength>
                </div>-->

               
               <table>
                        <tr>        
                            <td><h4><button type="submit" name = "register" class="btn" ><b>Signup as seller</b></button></h4></td>
                           
                            </tr>
                    </table>

</fieldset> 
        
    </header>       


</body>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->


    <script src="dist/js/jquery-3.3.1.min.js"></script>
    <script src="dist/bootstrap/js/bootstrap.min.js"></script>
    <script src="dist/js/all.js"></script>
    <script src="dist/fontawesome/js/all.min.js"></script>
    <script src="dist/js/nicEdit.js"></script>

</html>

