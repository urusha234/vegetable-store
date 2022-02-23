

<?php 
session_start();


if(!isset($_SESSION["b_user"])){
    
    header("location:login-b.php");
}

?>

<?php
include 'db_conn.php';

if (isset($_POST['remove'])){
  if ($_GET['action'] == 'remove'){
    $iid = $_GET['id']; 
      foreach ($_SESSION['cart'] as $key => $value){
          if($value["item_id"] == $iid)
          {
              unset($_SESSION['cart'][$key]);
              echo "<script>alert('Product has been Removed...!')</script>";
              echo "<script>window.location = 'buyer-profile.php'</script>";
              $del = "DELETE FROM cart where p_id = $iid";
              $run_del = mysqli_query($conn, $del);
          }
      }
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Buyer-profile</title>
       
    <link rel="stylesheet" type="text/css" href="buys.css">
    <script src="https://kit.fontawesome.com/7dd0b8b9ba.js" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
            </head>
 
<body> 
 <header class="bg">
        
        <div class="rows">

            <div class="logo"> </div>
                
            <div class="menu-icon">
                <ul class="main-nav">
     
                    <li><a href="shop.php"><b>SHOP</b></a></li>
                    <li><a href="logout.php"><b>LOGOUT</b></a></li>

                    <a class= "cart-btn" href="#">
                        
                            <i class="fas fa-shopping-cart"></i> Cart
                        
                        <?php
                        //if (isset($_SESSION['b_user']))
                        //{
                            
                            if (isset($_SESSION['cart']))
                            {
                                $counts = count($_SESSION['cart']);
                                echo "<span id=\"cart_count\" class=\"text-warning bg-light\">$counts</span>";
                            }
                            else
                            {
                                echo "<span id=\"cart_count\" class=\"text-warning bg-light\"> 0</span>";
                            }

                            if (isset($_POST['buy'])) {
                                $counts = count($_SESSION['cart']);
                                echo "<span id=\"cart_count\" class=\"text-warning bg-light\"> 0</span>";
                            }
                        //} 
                            

                        ?>
                       
                    </a>
                    <li><a href="order.php"><b>My ORDER</b></a></li>

                </ul> 
            
            </div>
        </div>
</header>

<div class="container">

    <div class="upfoto">
        <h1><?php echo "Welcome " . $_SESSION['b_user']; ?></h1>
        <h2>Buyer-profile</h2>
        <!--<div class= "bbb">
                        <ul class = "edit/update">
                            <li><a href="edit-acc.php">Edit your account</a></li>
                            
                        </ul>             
           -->         </div>
      </div> 
</div>             
        <div class="container-fluid">
            <div class="row px-5">
                <div class="col-md-7">
                    <div class="shopping-cart">
                        <h6>My Cart</h6>
                        <hr>

<?php
include 'uploaded.php';
include 'db_conn.php';


$total = 0;
$sub_total =0;
if (isset($_SESSION['cart']))
{
    $product_id = array_column($_SESSION['cart'], 'item_id');

    
    $ip_add = getUserIP();
    $select_cart = " SELECT * FROM cart WHERE ip_add = '$ip_add' "; 
    $run_cart =mysqli_query($conn, $select_cart);
    $count = mysqli_num_rows($run_cart);

    while($row = mysqli_fetch_array($run_cart))
    {
        $pro_id =$row['p_id'];
        $quantity =$row['qty'];

   //if (isset($_SESSION['cart']))
 // {
      //  $product_id = array_column($_SESSION['cart'], 'item_id');

        $get_product = "SELECT * FROM images WHERE id = '$pro_id'";
        $run_pro=mysqli_query($conn, $get_product);
        while($red = mysqli_fetch_array($run_pro))
        {
            $p_name = $red['product_name'];
            $p_price = $red['price'];
            $p_weight = $red['weight'];
            $p_image = $red['image_url'];
            $sub_total = $red['price'] * $quantity ;
            //$total =$total+ $sub_total;
           // $total=$total + $red['price'];

            foreach ($product_id as $id)
                {
                    if ($red['id'] == $id)
                    {
                                          
                     ?> 
                        <form action="buyer-profile.php?action=remove&id=<?php echo $red['id']; ?>" method="post" class="cart-items">

                        <div class= "border rounded">
                            <div class="row bg-white" >
                                
                                    <div class="col-md-4 pl-2">
                                        <img src="uploads/<?=  $red['image_url']; ?>" alt="Image" class="img-fluid">
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="pt-2"><?php echo $p_name;?> </h5>
                                
                                        <h5 class="pt-2">Rs.<?php echo $p_price;?></h5>
                                        <h5 class="pt-2"><?php echo $p_weight;?></h5>
                                        <h6 class="pt-1">Quantity: <?php echo $quantity;?></h6> 


                                        <button type="submit" class="btn btn-danger mx-2" name="remove">Remove</button>
                                    </div>
                                
                                
                            </div>
                        </div>
                
                    </form>
                <!--?php
                    $total = $total + (int)$row['price'];
                    }-->
                



<?php
       
        $total = $total + $sub_total;
                }
            }
        }
    }       

}
else
    {
        echo "<h5>Cart is Empty</h5>";
    }
                ?>



            </div>
        </div>
        <div class="col-md-4 offset-md-1 border rounded mt-8 bg-white h-30">

            <div class="pt-4">
                <h6 class="p-3 mb-2 bg-dark text-white">PRICE DETAILS</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <?php

                               if (isset($_SESSION['cart'])){
                                $count  = count($_SESSION['cart']);
                                echo "<h6>Price ($count items)</h6>";
                            }else{
                                echo "<h6>Price (0 items)</h6>";
                            }
                            ?>
                        <h6>Delivery Charges</h6>
                        <hr>
                        <h6>Total Amount </h6>
                    </div>
                    <div class="col-md-6">
                        <h6>Rs.<?php echo ($total); ?></h6>
                        <h6 >Rs.50</h6>
                        <hr>
                        <h6>Rs.<?php
                            
                            echo $total =$total+ 50; ?></h6>


                    </div>
                
                </div>
                <?php
                $session_user=$_SESSION['b_user'];
                $select_buyer = "SELECT * FROM buyer where b_user = '$session_user'";
                $run_query = mysqli_query($conn, $select_buyer);
                $row_buyer = mysqli_fetch_array($run_query);
                $buyerid = $row_buyer['buyer_id'];  



                ?>
                   <form method="post" action="order.php?b_id=<?php echo $buyerid; ?>">
                    <button type= "submit" name="buy" class="btn btn-warning btn-block  my-2  "><a href="order.php"></a> Purchase</a></button>
                    </form>
            </div>

        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
             