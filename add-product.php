<!--//this condition makes seller see their products only
//$condition = '';
//$condition1 = '';
//if($_SESSION['s_role'] == 1){
    //$condition = " and images.added_by='".$_SESSION['s_id']."'";
    //$condition1 = " and added_by='".$_SESSION['s_id']."'";
//}-->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add product</title>
   
    <link rel="stylesheet" type="text/css" href="s.css">
    <script src="https://kit.fontawesome.com/7dd0b8b9ba.js" crossorigin="anonymous"></script>
</head>
<?php 

include 'db_conn.php';

session_start();
$username=$_SESSION['s_username'];

if(isset($_POST['submitt']))
{
    
    $productname= $_POST['product'];
    $price=$_POST['price'];
    $weight=$_POST['weight'];
              
    $img=$_FILES['my_image']['name'];

    $target_dir = "uploads/";
    $target_file = $target_dir .($_FILES['my_image']['name']);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

          
// Check if file already exists

            if (file_exists($target_file)) 
            {
                echo '<script type="text/javascript">alert("image already exist");window.location=\'add-product.php\';</script>';
                $uploadOk = 0;
            }

// Check file size

            if ($_FILES["my_image"]["size"] > 500000) 
            {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

// Allow certain file formats

            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
            {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

// Check if $uploadOk is set to 0 by an error

            if ($uploadOk == 0) 
            {
                    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
            } 

            else 
            {

                $query = "INSERT INTO images (product_name, price, weight, image_url, user_name) VALUES('$productname', '$price', '$weight','$img', '$username')";//added_by or '".$_Session['s_id']."'
                $query_run = mysqli_query($conn, $query);

                if ($query_run) 
                {   
            
                    move_uploaded_file($_FILES['my_image']['tmp_name'], 'uploads/' .$_FILES['my_image']['name']);
                    echo '<script type="text/javascript">alert("product posted");window.location=\'seller-profile.php\';</script>';
                
                }
                else
                {
                    echo '<script type="text/javascript">alert("Product not posted");window.location=\'add-product.php\';</script>';
                }
         
            }

}
        
?>        


<body>
    <header class="bg">
        
        <div class="row">
            <div class="logo">
                
            </div>
    
            <div class="menu-icon">
                        <ul class="main-nav">
            
            <li><a href="shop.php"><b>SHOP</b></a></li>
            <li><a href="view_order.php"><b>ORDERS</b></a></li>
            <li><a href="logout.php"><b>LOGOUT</b></a></li>
            </ul>   
            
            </div>
        </div>

    </header>

   
 
      <div class="container2">
       <!-- <?php if (isset($_GET['error'])): ?>
        <p><?php echo $_GET['error']; ?></p>

    <?php endif ?>-->

                
                   <form id="add-product" method="post" action="" enctype="multipart/form-data">
                   
                    <h2>Add Products</h2>
                             
                        <input class="field" type="text" name="product" placeholder="product-name" required><br>
                        <input class="field"  type="number" name="price" placeholder="price" required><br>
                        <input class="field"  type="text" name="weight" placeholder="weight(pls enter its unit)" required><br>
                          <input type="hidden" name="id" value="$images[id]">
                            
                                            
                    
                        <label>Picture</label>                               
                            <input type="file" name="my_image">

                             <input class ="btn btn-secondary my-2 my-sm-0" type="submit" p-5 name="submitt" value="upload">
                    </form>
        </div>

   

</body>
</html>

    