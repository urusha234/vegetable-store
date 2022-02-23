<?php  
session_start();

include 'db_conn.php';


error_reporting(0);
if (isset($_POST['seller'])) 
{
    $username = $_POST['username'];
    //$email = $_POST['email'];
    $password = $_POST['password'];


    $sql=" SELECT * from sellers WHERE  user_name = '$username' and password = '$password' ";
    $result=mysqli_query($conn,$sql);
    if($result->num_rows > 0)
    {
        $res=mysqli_fetch_array($result);

        //sellers_id is sesssion variable
        $_SESSION['s_id'] = $res['seller_id'];
        $_SESSION['s_username'] = $res['user_name'];
        $_SESSION['s_role'] = $res['role'];
        header('location:seller-profile.php');

    }   
    else
    {
            
            echo '<script type="text/javascript">alert("Account does not exist or incorrect password");window.location=\'login-s.php\';</script>';
    }
}    

?>

<!DOCTYPE html>
<html>
<head>
	<title>sellers-login</title>
   
	<link rel="stylesheet" type="text/css" href="slogin.css">
    <script src="https://kit.fontawesome.com/7dd0b8b9ba.js" crossorigin="anonymous"></script>
</head>
<body>
 	<header class="bg">
 		
 		<div class="row">
            <div class="logo">
                
            </div>
    
            <div class="menu-icon">
                        <ul class="main-nav">
            <li><a href="index.php"><b>HOME</b></a></li>
            <li><a href="login-b.php"><b>BUYER </b><i class="fas fa-sign-in-alt"></i></a></li>
            <li class="active"><a href="active"><b>sellers </b><i class="fas fa-sign-in-alt"></i></a></li>
            </ul>   
            
            
            </div>
        </div>

       
 		     <fieldset>
 			<div class="nav-login">
 				
 				<form method="post" action="" enctype="multipart/form-data">
 					 <h2>sellers-Login</h2><br>
                                    				
                     <h3><label for="Username"><b>Username</b></label></h3>
                    <input type="text" placeholder="Enter Username" name="username" value="<?php echo $username; ?>" required><br>


                 <!--<h3><label for="email1"><b>Email</b></label></h3>
    				<input type="email" placeholder="Enter Email" name="email" value="<?php echo $email; ?>" required><br>-->

    			<h3><label for="psw1"><b>Password</b></label></h3>
    				<input type="password" placeholder="Enter Password" name="password"  required> <br>
                
                <h4><p> <a href="#" >Forgot Password?</a></p></h4>

                <table>
                <tr>        
                    <td><h4><button type="submit" class="btn" name="seller"><b>Login</b></button></h4></td>
                    <td><h4><a href="sign-up.php" target="_self" name="slogin"><b>Register</b></a></h4>
                       
                    </td>    
                </tr>
                </table>

                   
    		</form>	
    		</div>

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