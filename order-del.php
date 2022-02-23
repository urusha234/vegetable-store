<?php

if (!isset($_SESSION['s_username'])) 
{
	header("location:login-s.php");
}
?>

<?php
include 'db_conn.php';
if (isset($_POST['dell'])) 
{
	

	if(isset($_GET['order_del']))
	{
		$del_id = $_GET['order_del'];
		$del_order = "DELETE FROM customer_order where order_id ='$del_id'";
		$run_del = mysqli_query($conn, $del_order);
		if ($run_del) {
			echo "<script>alert('Order has been deleted')</script?";
			echo "<script>window.open('view_order.php','_self')</script>";
		}

	}
}
?>