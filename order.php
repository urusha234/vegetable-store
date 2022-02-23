<?php

session_start();
include 'db_conn.php';
include 'uploaded.php';

if(!isset($_SESSION['b_user'])){
    
    header("location:login-b.php");
}
if (isset($_GET['b_id'])) 
{
	$buyerid= $_GET['b_id'];
	

$ip_add = getUserIP();
$status = "pending";

$select_cart = "SELECT * FROM cart where ip_add = '$ip_add'";
$run_cart = mysqli_query($conn, $select_cart);

while ($row_cart=mysqli_fetch_array($run_cart)) 
{
	$pro_id=$row_cart['p_id'];
	


	$qty=$row_cart['qty'];

	$get_product = "SELECT * FROM images WHERE id = '$pro_id'";
	$run_pro = mysqli_query($conn, $get_product);
	
	while ($row_pro = mysqli_fetch_array($run_pro)) 
	{
		$sub_total = $row_pro['price'] * $qty;
		$p_id = $row_pro['id'];

		$insert = "INSERT INTO customer_order(buyer_id, product_id,due_amt, qty, order_date, order_status) VALUES('$buyerid', '$p_id', '$sub_total', '$qty', NOW(), '$status')";

		$run_cus_order = mysqli_query($conn, $insert);
		
		
		$insert_pending_order =  "INSERT INTO pending_order(buyer_id, id, qty,order_status) VALUES('$buyerid', '$pro_id', '$qty', '$status' )";
		$run_pending_order = mysqli_query($conn, $insert_pending_order);

		$delete_cart = "DELETE FROM cart WHERE ip_add = '$ip_add'";
		$run_del = mysqli_query($conn, $delete_cart);


		

	}
	
}
echo "<script>alert('Your order has been submitted, Thanks')</script>";
		echo "<script>window.open('order.php')</script>";
		unset($_SESSION['cart']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>My order</title>
       
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


            <div class="logo">
                
            </div>
    
            <div class="menu-icon">
                <ul class="main-nav">
            
		            <li><a href="shop.php"><b>SHOP</b></a></li>
		            <li><a href="logout.php"><b>LOGOUT</b></a></li>

		            <a class= "cart-btn" href="buyer-profile.php">
                    <i class="fas fa-shopping-cart"></i> Cart
                        
                        <?php
                        //if (isset($_SESSION['b_user']))
                        //{
                            
                            if (isset($_SESSION['cart']))
                            {
                                $counts = count($_SESSION['cart']);
                                echo "<span id=\"cart_count\" class=\"text-warning bg-light\">$counts</span>";
                            
                               // if (isset($_POST['buy'])) 
                               // {
                               // unset($_SESSION['cart']);
                               // echo "<span id=\"cart_count\" class=\"text-warning bg-light\"> 0</span>";
                            
                            }                            
                       // }
                            else
                            {
                                echo "<span id=\"cart_count\" class=\"text-warning bg-light\"> 0</span>";
                            }
                            //if (isset($_POST['clear'])) 
                           // {
                            	//unset($_SESSION['cart']);
                            	// echo "<span id=\"cart_count\" class=\"text-warning bg-light\"> 0</span>";
                            //}/
                            //if (isset($_POST['buy'])) {
                             //   unset($_SESSION['cart']);
                             //   echo "<span id=\"cart_count\" class=\"text-warning bg-light\"> 0</span>";
                            
                           // }
                        //}

                        ?>
                       
                    </a>
				<li class="active"><a href="active"><b>My order</b></a></li>
            </ul>   
            
           </div>
        </div>
</header>

<div class="container">
    <center>
        <h1>MY ORDER</h1>
        <br>
    </center>
  
   
    
  
	<div class="table-responsive-xl">
        <table class="table">

	        <thead>
	            <tr>
	                	<th>SN</th>
	                    <th>DUE AMOUNT</th>
	                    <th>QUANTITY</th>
	                    <th >ORDER DATE</th>
	                    <!--<th >PAID/UNPAID</th>
	                    <th>STATUS</th>-->
	                </tr>
	        </thead>
	        <tbody>

	            	<?php  
		                $buyer_session = $_SESSION['b_user'];
		                $get_buyer = "SELECT * FROM buyer WHERE b_user = '$buyer_session'";
		                $run = mysqli_query($conn, $get_buyer);
		                $row = mysqli_fetch_array($run);
		                $cus_id=$row['buyer_id'];

		                $get_order = "SELECT * FROM customer_order WHERE buyer_id='$cus_id'";
		                $run_order = mysqli_query($conn, $get_order);
		                $sn=0;
		                while ($row_order=mysqli_fetch_array($run_order))
		                {
		                    $order_id = $row_order['order_id'];
		                    $due_amt = $row_order['due_amt'];
		                    $qty = $row_order['qty'];
		                    $order_date = substr($row_order['order_date'],0,11);
		                    //$order_status = $row_order['order_status'];
		                    $sn++;
		                   // if ($order_status == 'pending') 
		                    //{
		                       // $order_status = "Unpaid";
		                  //  }
		                   // else
		                   // {
		                   //     $order_status = "Paid";
		                  //  }    
		  
	            	?>
	    
                	<tr>
	                    <td><?php echo $sn;?></td>
	                    <td><?php echo $due_amt; ?></td>
	                    <td><?php echo $qty;?></td>
	                    <td><?php echo $order_date;?></td>
	                    <!--<td><?php echo $order_status;?></td>
	                    <td><a href="confirm.php?order_id=<?php echo $order_id; ?>" target = "_self" class = "btn btn-info btn-sm">Comfirm if paid</a></td>-->
                	</tr>

           
				    <?php
				               
				        } 
				        ?>
        	</tbody>

   		</table>
   		<!--form method="post" action="order.php">
   			<button class="btn btn-success btn-block" name="clear">Clear My order</button>
   		</form-->
	</div>   
	

</div>


<!--?php 
if (isset($_GET['b_id'])) 
{
	$buyerid= $_GET['b_id'];
	
}
if (isset($_POST['clear'])) 
{
	$sql = "DELETE FROM customer_order";
	$run = mysqli_query($conn, $sql);

	if ($run) {
		echo "<script>alert('Your order has been cleared')</script>";
		echo "<script>window.open('order.php')</script>";
		//unset($_SESSION['cart']);
	}
}
?-->
</body>
</html>

