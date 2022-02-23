<?php

session_start();

include 'db_conn.php';
include 'uploaded.php';

// create instance of Createdb class
if (isset($_SESSION['b_user'])) 
{
    if (isset($_POST['add']))//add to cart
    {
        $ip_add = getUserIP();
        $p_id = $_GET['add_cart'];
        $product_qty = $_POST['quantity'];
        
        $query = "INSERT INTO cart(p_id, ip_add, qty) VALUES ('$p_id', '$ip_add', '$product_qty')";
                $run_query=mysqli_query($conn, $query);
                
        /// print_r($_POST['product_id']);
        if(isset($_SESSION['cart']))// this check if session cart hav data or not
        {
            $item_array_id = array_column($_SESSION['cart'], "item_id");

            if(in_array($_POST["hidden_id"], $item_array_id))
            {
                echo "<script>alert('Product is already added in the cart..!')</script>";
                echo "<script>window.location = 'shop.php'</script>";
            }
            else
            {   

                $count = count($_SESSION['cart']);
                $item_array = array(
                'item_id'   => $_POST['hidden_id'],
                'item-name' => $_POST['hidden_name'],
                'item-price' => $_POST['hidden_price'],
                'item-weight' => $_POST['hidden_weight'],
                'item-quantity' => $_POST['quantity']
                );

                $_SESSION['cart'][$count] = $item_array;

                
            }

        }else// if session cart hav no data
        {

        $item_array = array(
                'item_id'   => $_POST['hidden_id'],
                'item-name' => $_POST['hidden_name'],
                'item-price' => $_POST['hidden_price'],
                'item-weight' => $_POST['hidden_weight'],
                'item-quantity' => $_POST['quantity']
        );

        // Create new session variable
        $_SESSION['cart'][0] = $item_array; //array ko item session ma store vayo
        //print_r($_SESSION['cart']);
        }
    }
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop</title>

    <link rel="stylesheet" type="text/css" href="buys.css">

    <script src="https://kit.fontawesome.com/7dd0b8b9ba.js" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="bg">
        
        <div class="rows">

            <div class="logo"> </div>
                
            <div class="menu-icon">
                <ul class="main-nav">
     
                    <li ><a href="shop.php"><b>SHOP</b></a></li>
                      
                            <li><a href="seller-profile.php"><b>Seller profile</b></a></li>
            
                            <li><a href="view_order.php"><b>ORDERS</b></a></li>

                 
                    <li><a href="logout.php"><b>LOGOUT</b></a></li>

         
            <?php
           
            if (isset($_SESSION['b_user'])) {
                ?>
          
                    <a href = 'buyer-profile.php' class= "cart-btn" >
                        
                            <i class="fas fa-shopping-cart"></i> Cart
                        <?php

                            if (isset($_SESSION['cart']))
                            {
                                $count = count($_SESSION['cart']);
                                echo "<span>$count</span>";
                            }
                            else
                            {
                                echo "<span>0</span>";
                            }

                        ?>
                       <?php
                   }
                   ?>
                    </a>

                     </ul> 

                   <form method="post" action="search.php">   
                 <div class ="search-box">
                 
                   
                    <input class="search-txt" type="text" name="searches" placeholder="search">
                    <button class = "search-btn" type = "submit" name="search">
                            <i class="fas fa-search"></i>
                    </button>
                       
                </div>  
                </form> 
            
            </div>
        </div>
</header>



<?php
include 'db_conn.php';
	
	if(isset($_POST['search']))
	{
		$search = $_POST['searches'];

	$sql = "SELECT * FROM images WHERE product_name='$search'" ;
	$res = mysqli_query($conn, $sql);
	$count = mysqli_num_rows($res);
	//if(!$res || mysqli_num_rows($res) == 0) 
	if($count >0)
    //$count = mysqli_num_rows($res);
//{
  //  if ($res > 0) 
    	
	{
		while ($row = mysqli_fetch_assoc($res))
		{
			$id = $row['id'];
			$productname = $row['product_name'];
			$price = $row['price'];
			$weight = $row['weight'];
			$image = $row['image_url'];
			$username = $row['user_name'];
		?>

		

		<div class="col-md-3 col-sm-6 my-3 my-md-0"> 

			<form method="post" action="search.php?add_cart=<?php echo $row['id']; ?>">
		<div class="card shadow"> 
                    
                <img src="uploads/<?=$row['image_url'];?>" style='height:200px;' class="img-fluid card-img-top">
                   
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                        <h5 class="text-danger">Rs.<?php echo $row['price']; ?></h5>
                        <h5 class="text-danger"><?php echo $row['weight']; ?></h5>

                        
                        <input type="number" name="quantity" class="form-control" value="1" />
                        <input type="hidden" name="hidden_id" value="<?php echo $row['id']; ?>" >
                        <input type="hidden" name="hidden_name" value="<?php echo $row['product_name']; ?>" />
                        <input type="hidden" name="hidden_price" value="<?php echo $row['price']; ?>" />
                        <input type="hidden" name="hidden_weight" value="<?php echo $row['weight']; ?>" />

                        <button href ="shop.php" type="submit" name="add" class="btn btn-warning my-4" >Add to Cart<i class="fas fa-shopping-cart"></i></button>
                        
                    </div>
                 </div>   

		<?php


		?>
		<?php
		}
	}
	else
	{
		echo "Product not found";
	}
}
?>