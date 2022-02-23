<?php
	session_start();

if(!isset($_SESSION['s_username'])){
    
    header("location:login-s.php");
}
?>
<?php include 'db_conn.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>seller-profile</title>
       
    <link rel="stylesheet" type="text/css" href="sel.css">
    <script src="https://kit.fontawesome.com/7dd0b8b9ba.js" crossorigin="anonymous"></script>
    
            </head>
 
<body> 
 <header class="bg">
        
        <div class="row">


            <div class="logo">
                
            </div>
    
            <div class="menu-icon">
                        <ul class="main-nav">
            

            <li><a href="shop.php"><b>SHOP</b></a></li>
            <li class="active"><a href="active"><b>ORDERS</b></a></li>
            <li><a href="logout.php"><b>LOGOUT</b></a></li>

          

            </ul>   
         
            </div>
        </div>
</header>




<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-money fa-fw"></i>View Orders
				</h3>	
			</div>

			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-stripped">
						<thead>
							<tr>
								<th>Order no.</th>
								<th>buyer_firstname.</th>
								<th>Buyer_lastname.</th>
								<th>Buyer_email</th>
								<th>Buyer_phoneNo.</th>
								<th>Product</th>
								<th>Quantity</th>
								<th>Order_date</th>
								<th>Total</th>
								<th>Order_status</th>
								<th>Delete order</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							include 'db_conn.php';
							$i=0;

							$get_orders= "SELECT * FROM customer_order";
							$run_orders = mysqli_query($conn , $get_orders);
						
							while ($row_orders = mysqli_fetch_array($run_orders)) 
							{
								$order_id =$row_orders['order_id'];
								$b_id =$row_orders['buyer_id'];
								$pro_id = $row_orders['product_id'];
								$total_amt =$row_orders['due_amt'];
								$qty =$row_orders['qty'];
								$order_date =$row_orders['order_date'];
								$order_status =$row_orders['order_status'];

								$get_products = "SELECT *FROM images WHERE id =  '$pro_id' ";
								$run_product = mysqli_query($conn, $get_products);
								$row_products = mysqli_fetch_array($run_product);
								$pro_name = $row_products['product_name'];
								$i++;
							?>

							<tr>
								<td><?php echo $i; ?></td>
							
							
								<td>
							<?php

							$get_customers = "SELECT * FROM buyer WHERE buyer_id = '$b_id'";
							$run_cust= mysqli_query($conn, $get_customers);
							$row_cust = mysqli_fetch_array($run_cust);
							
							$buyer_fname = $row_cust['first_name'];
							$buyer_lname = $row_cust['last_name'];
							$buyer_email = $row_cust['email'];
							$buyer_phone = $row_cust['phone_no'];

							echo $buyer_fname;
							
							?>

								</td>

								<<td><?php echo $buyer_lname; ?></td>
								<td><?php echo $buyer_email; ?></td>
								<td><?php echo $buyer_phone; ?></td>
								<td><?php echo $pro_name; ?></td>
								<td><?php echo $qty; ?></td>
								<td><?php echo $order_date; ?></td>
								<td>Rs.<?php echo $total_amt; ?></td>
								<td> 
								<?php 
								if ($order_status == 'pending') 
								{
									echo $order_status = 'pending';
								}
								else
								{
								 	echo $order_status = 'Complete';
								}
								?>	
								</td>
								<td>
									<form method="post" action="view_order.php?order_del=<?php echo $order_id; ?>">
                    					<button type= "submit" name="dell" class="btn btn-warning btn-block  my-2  "><i class="fa fa-trash-o"></i>Delete</button>
                   					</form>
									
								</td>
							</tr>

						<?php } ?>
						</tbody>
						
					</table>
					
				</div>
			</div>
		</div>
	</div>	
</div>	

<?php
include 'db_conn.php';
if (isset($_POST['dell'])) 
{
	
		$del_id = $_GET['order_del'];
		$del_order = "DELETE FROM customer_order where order_id ='$del_id'";
		$run_del = mysqli_query($conn, $del_order);
		if ($run_del) {
			echo "<script>alert('Order has been deleted')</script?";
			echo "<script>window.open('view_order.php','_self')</script>";
		}

	
}
?>

</body>
</html>
