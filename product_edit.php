<?php include('db_conn.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>update product</title>
   
    <link rel="stylesheet" type="text/css" href="s.css">
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
            <li><a href="shop.php"><b>SHOP</b></a></li>
            <li><a href="logout.php"><b>LOGOUT</b></a></li>
            </ul>   
            
            </div>
        </div>

    </header>

   
 <div class="container2">



<form action="uploaded.php" method="post" enctype="multipart/form-data">

 <?php

 if (isset($_POST['edit_data_btn'])) 
 {
    $id=$_POST['edit_id'];

    $query = "SELECT * FROM images WHERE id='$id' ";
    $query_run = mysqli_query($conn, $query);

    foreach ($query_run as $row ) {
    


 ?>
 
	<h2>Edit</h2>

	<input type="hidden" name="edit_id" value="<?php echo $row['id']?>" >

	<input class="field" type="text" name="edit_product" value="<?php echo $row['product_name']?>" required><br>
                      
   	<input class="field"  type="number" name="edit_price"value="<?php echo $row['price']?>" required><br>

    <input class="field"  type="text" name="edit_weight" value="<?php echo $row['weight']?>" required><br>
                                
                                     
    <label>Picture </label>                               
    <input type="file" name="my_image" value="<?php echo $row['image_url']?>">

    <input class ="btn btn-secondary my-2 my-sm-0" type="submit" name="product_update_btn" value="edit">
</form>



 <?php	
 	}
 }
 ?>


