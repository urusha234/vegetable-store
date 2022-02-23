<?php  
session_start();

include 'db_conn.php';


error_reporting(0);
if (isset($_POST['buyer'])) 
{
    $buser= $_POST['buser'];
    //$email = $_POST['email'];
    $password = $_POST['password'];


    $sql=" SELECT * from buyer WHERE  b_user = '$buser' and password = '$password' ";
    $result=mysqli_query($conn,$sql);
    if($result->num_rows > 0)
    {
        $res=mysqli_fetch_array($result);

        //sellers_id is sesssion variable
        $_SESSION['b_id'] = $res['b_id'];
        $_SESSION['b_user'] = $res['b_user'];
        //$_SESSION['s_role'] = $res['role'];
        header('location:buyer-profile.php');

    }   
    else
    {
            
            echo '<script type="text/javascript">alert("Account does not exist or incorrect password");window.location=\'login-s.php\';</script>';
    }
}    

?>


<!-- 
if($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $buyer_password = $_POST['buyer_password'];
// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {

        $sql = "use FreshFarm";
        if ($conn->query($sql) == TRUE) {

            // prepare and bind
            $stmt = $conn->prepare("SELECT * FROM buyer where email=?");

            $user_id = md5($email);
            $stmt->bind_param("s", $email);
            $stmt->execute();


            $stmt->bind_result($ID_no, $first_name,$last_name, $email, $pass_to_store,  $date, $user_id);

            $stmt->fetch();


        

            if($email ==null){
                echo "<script>alert('email doesn't match any account');</script>";
            }
            else {
                if (password_verify($buyer_password, $pass_to_store)){
                        $_SESSION['IDb'] = $ID_no;
                        echo "Login Successfull!";
                        header("Location: shop.php");

                }else{

                    echo "<script>alert('Wrong password');</script>";
                }
            }

            // set parameters and execute
            $stmt->close();
            $conn->close();
        } else {
            echo $conn->error;
        }

    }

}
//?>
-->

<html lang="en">
<head>
	<title>buyer-login</title>
	<link rel="stylesheet" type="text/css" href="slogin.css">
    <script src="https://kit.fontawesome.com/7dd0b8b9ba.js" crossorigin="anonymous"></script>
</head>
<body>
 	<header class="bglo">
 		
 		<div class="row">
            <div class="logo">
                
            </div>
    
            <div class="menu-icon">
                        <ul class="main-nav">
            <li><a href="index.php"><b>HOME</b></a></li>
            <li class="active"><a href="active"><b>BUYER </b><i class="fas fa-sign-in-alt"></i></a></li>
            <li><a href="login-s.php"><b>SELLER </b><i class="fas fa-sign-in-alt"></i></a></li>
            </ul>   
                      
            </div>
        </div>

       
 		     <fieldset>
 			    <div class="nav-login">
 				
 				   <form method="post" action="" enctype="multipart/form-data">
 					 <h2>Buyer Login</h2><br>
                     <!--diaplay validation error here!-->

                     <h3><label for="Username"><b>Username</b></label></h3>
                    <input type="text" placeholder="Enter Username" name="buser" value="<?php echo $buser; ?>" required><br>
                    
				    <!--<h3><label for="email"><b>Email</b></label></h3>
    				    <input type="email" placeholder="Enter Email" name="email" required><br>-->

    			     <h3><label for="psw1"><b>Password</b></label></h3>
                    <input type="password" placeholder="Enter Password" name="password"  required> <br>

    				 <h4><p> <a href="#" >Forgot Password?</a></p></h4>

                     <table>
                        <tr>        
                            <td><h4><button type="submit" name="buyer" class="btn"><b>Login</b></button></h4></td>
                            <td><h4><a href="b-registration.php" target="_self"><b>Register</b></a></h4> </td>    
                            </tr>
                    </table>

                    </form>
                </div>

           </fieldset> 
    	
    </header>		
 		
 <div class="copyrght">
    Copyright &copy; <?php echo date('Y')?>Urusha Bajracharya;
	 
</body>
</html>