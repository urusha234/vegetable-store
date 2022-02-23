<!DOCTYPE>
<?php
include 'db_conn.php';


error_reporting(0);

session_start();

if(isset($_SESSION["b_user"])){
    
    header("location:buyer-profile.php");
}


if(isset($_POST['register']))
{

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $buser = $_POST['buser'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirm-password'];
    $phone = $_POST['phone_no'];
    $location = $_POST['location'];

    if ($password == $cpassword) 
    {        $sql = "SELECT * FROM buyer where  email = '$email' ";
        
        $result = mysqli_query($conn, $sql);
       
            if (!$result -> num_rows  > 0 ) 
            {
                $sql = "INSERT INTO buyer (first_name, last_name, b_user, email, password, cpassword, phone_no, location) VALUES('$first_name', '$last_name' ,  '$buser', '$email', '$password', '$cpassword', '$phone', '$location')";

                $result = mysqli_query($conn, $sql);
                     
                if($result)
                {
                echo '<script type="text/javascript">alert("Registration Completed Succesfully");window.location=\'buyer-profile.php\';</script>';

                    $first_name = "";
                    $last_name = "";
                    $buser = "";
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
    <title>buyer-registration</title>
    <link rel="stylesheet" type="text/css" href="slogin.css">
    <script src="https://kit.fontawesome.com/7dd0b8b9ba.js" crossorigin="anonymous"></script>
    
</head>
<body>
    <header class="bibi">
        
        <div class="row">
            <div class="logo">
                
            </div>
    
                <div class="menu-icon">
                    <ul class="main-nav">
                        <li><a href="index.php"><b>HOME</b></a></li>
                        <li ><a href="login-b.php"><b>BUYER </b><i class="fas fa-sign-in-alt"></i></a></li>
                        <li><a href="login-s.php"><b>SELLER </b><i class="fas fa-sign-in-alt"></i></a></li>
                    </ul>   
           
                </div>
        </div>

         
 <fieldset class="filll">
                
                
                   <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                     <h2>Create buyer account</h2><br>
                     <!--diaplay validation error here!-->
                    
                    <h3><label for="input username"><b>Firstname</b> </label></h3>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First_name " required>
                    
                   
                    <h3><label for="input username"><b>Lastname</b></label></h3>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last_name " required>
                  
                   <h3><label for="input username"><b>Username</b></label></h3>
                    <input type="text" class="form-control" id="buser" name="buser" placeholder="Enter Username " value = "<?php echo $buser; ?>" required>

                   <h3><label for="InputEmail"><b>Email address</b></label></h3>
                    <input type="email" class="form-control" id="InputEmail" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
         


        
                   <h3>     <label for="input phone_no"><b>Phone No.</b></label></h3>
                    <input type="text"  class="form-control" id="phone_no" name="phone_no" placeholder="Enter Phone No. " value = "<?php echo $phone; ?>" required>
          
                    <h3><label for="input location"><b>Location</b></label></h3>
                    <input type="text" class="form-control" id="location" name="location" placeholder="Enter location " value = "<?php echo $location ;?>" required>
                

                    <input class="field" type="password" name="password" placeholder="Password" id = "password"  required>
                    <input class="field" type="password" name="confirm-password" placeholder="Confirm Password" id = "confirm-password"  required>
         
               <table>
                        <tr>        
                            <td><h4><button type="submit" name="register" class="btn"><b>Signup as Buyer</b></button></h4></td>
                           
                            </tr>
                    </table>

                              
            </form>
</fieldset> 
        
    </header>       

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="dist/js/jquery-3.3.1.min.js"></script>
<script src="dist/bootstrap/js/bootstrap.min.js"></script>
<script src="dist/js/all.js"></script>
<script src="dist/fontawesome/js/all.min.js"></script>
<script src="dist/js/nicEdit.js"></script>
</body>

</html>

    