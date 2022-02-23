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
     
                    <li class="active"><a href="active"><b>SHOP</b></a></li>
                        <?php
                            if (isset($_SESSION['s_username']))
                            {
                        ?>
                            <li><a href="seller-profile.php"><b>Seller profile</b></a></li>
            
                            <li><a href="view_order.php"><b>ORDERS</b></a></li>

                        <?php   
                            }

                        ?>
                 
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



<div class="container">
    <div class="row text-center py-5">
    <?php
        $query = "SELECT *FROM images";
        $res = mysqli_query($conn, $query);

        if(mysqli_num_rows($res) > 0)
        {
            while ($row = mysqli_fetch_assoc($res))
            {
    ?>   
            <!--//component($row['product_name'], $row['price'], $row['image_url'], $row['weight'], $row['id']);
                    //yo part le chai shop pg ma product dekhayo-->

        <div class="col-md-3 col-sm-6 my-3 my-md-0">      

            <form method="post" action="shop.php?add_cart=<?php echo $row['id']; ?>">
                
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

                        <button type="submit" name="add" class="btn btn-warning my-4" >Add to Cart<i class="fas fa-shopping-cart"></i></button>
                        
                    </div>
                 </div>   

            </form>

        </div>
                <?php 
                }
            }
            ?>
        </div>
</div>





<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

<!--
//yata dekhi aarkai




            <li class="active"><a href="active"><b>SHOP</b></a></li>
            ?php 
            if (isset($_SESSION['b_user'])) 
            {
            ?>
               <li><a href="buyer-profile.php"><b>BUYER profile</b></a></li>
            ?php
            }

             ?>

             ?php
             if (isset($_SESSION['s_username']))
             {
            ?> 

                <li><a href="seller-profile.php"><b>Seller profile</b></a></li>
            ?php
            }
            
            ?>
                
            
            
            <li><a href="logout.php"><b>LOGOUT</b></a></li>


            
            </ul>   
            
            <div class ="search-box" >
                <input class="search-txt" type="text" name="" placeholder="search">
                <a class="search-btn" href="#">
                <i class="fas fa-search"></i>
                </a>
            </div>
            </div>
        </div>

</header>

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="text-center">Shopping cart</h2>
                    <div class="col-md-6">
                        <div class="row">
                            
                     
                ?php

                $query = "SELECT * FROM images";
                $results = mysqli_query($conn, $query);

                while($res = mysqli_fetch_assoc($results))
                ?>
                <div class="col-md-4">
                    
                
                ?php
                {

                } 
                ?>
                        </div
                        
                    </div>

                </div>
                <div class="col-md-6">

                    <h2 class="text-center">Item Selected</h2>

                    ?php 

                    $total = 0;

                    $output ="";

                    $output.="
                    <table class='table table-bordered table-striped'> 
                        <tr>
                            <th>ID</th>
                            <th>PRODUCT NAME</th>
                            <th>PRICE</th>
                            <th>QUANTITY</th>
                            <th>TOTAL PRICE</th>
                            <th>ACTION</th>
                         </tr>
                    ";

                    if (!empty($_SESSION['s_username'])) 
                    {
                        foreach ($_SESSION['s_username'] as $key => $value) {
                           $output.="

                           <tr>
                                <td>."$value['seller_id']".</td>
                                 <td>."$value['product_name']".</td>
                                 <td>."$value['quantity']".</td>
                                 <td>."$value['price']".</td>


                                    <a href = 'shop.php?action=remove&id="value['seller_id']."'>
                                    <button class = 'btn btn-danger btn-block'>Remove</button>
                                    </a>
                                  </td>  
                                    ";

                                     $total = $total + $value['quantity'] * $value['price'];

                        }
                        
                        $output .= "
                        <tr>
                            <td colspan = '3'></td>
                            <td><b>Total Price</b></td>
                            <td>number_format($total,2)
                            <td>
                                <a href= 'shop.php?action=clearall'>
                                    <button class = 'btn btn-warning'>Clear</button>
                                </a>
                            </td>
                        </tr>
                        ";


                    }

                    //var_dump($_SESSION['b_user']);

                    ?>
                </div>
            </div>
        </div>
    </div>

?php
    if (isset($_GET['action'])) {
        if ($_GET['action'] == "clearall") 
        {
            unset($_SESSION['s_username'])
        }
    }
?>
</body>
</html>
-->