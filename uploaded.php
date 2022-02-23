<?php 

include "db_conn.php";

/*
add-product but not needed
if(isset($_POST['submitt']) && isset($_FILES['my_image']))
{
	$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "FreshFarm";

	$sesion= $_SESSION['s_username'];
	$productname= $_POST['product'];
	$price=$_POST['price'];
	$weight=$_POST['weight'];
	$img=$_FILES['my_image']['name'];

	if (file_exists("uploads/" .$_FILES['my_image']['name'])) 
	{
		$store = $_FILES['my_image']['name'];
		$_SESSION['status'] = "Image already exists. '.$store.'";
		echo '<script type="text/javascript">alert("image already exist");window.location=\'add-product.php\';</script>';
	}
	else
	{

		$query = "INSERT INTO images (product_name, price, weight, image_url, email) VALUES('$productname', '$price', '$weight','$img', '$sesion')";
		$query_run = mysqli_query($conn, $query);

		if ($query_run) {
			
			move_uploaded_file($_FILES['my_image']['tmp_name'], 'uploads/' .$_FILES['my_image']['name']);
			$_SESSION['success'] = "Prodcut added";
			header('Location:seller-profile.php');
		}
		else
		{
			$_SESSION['success'] = "Prodcut not added";
			header('Location:seller-profile.php');
		}
	}

}
 */

//edit product
if (isset($_POST['product_update_btn'])) {
	$edit_id = $_POST['edit_id'];
	$edit_product = $_POST['edit_product'];
	$edit_price = $_POST['edit_price'];
	$edit_weight = $_POST['edit_weight'];
	$edit_my_image = $_FILES['my_image']['name'];

	$query = "UPDATE images SET product_name='$edit_product', price = '$edit_price', weight = '$edit_weight ', image_url = '$edit_my_image ' WHERE id='$edit_id'";//before $condition1

	if ($query_run) {

		move_uploaded_file($_FILES['my_image']['tmp_name'], 'uploads/' .$_FILES['my_image']['name']);
			$_SESSION['success'] = "Product added";
			header('Location:seller-profile.php');


	}
}

//delete product
if(isset($_POST['del_data_btn']))
{

	$del_id = $_POST['del_id'];
	$query = "DELETE FROM images WHERE id='$del_id'"; //$condition1 this makes the vender del/ update their product only
	$query_run = mysqli_query($conn, $query);

	if ($query_run) {
		echo "<script>alert('Product has been Removed...!')</script>";
		$_SESSION['success'] = "Product deleted";
		header('Location:seller-profile.php');
	

	//$path = "uploads/.$_FILES['my_image']['name']"}
}

}



if (isset($_POST['delete_mulitple_data'])) 
{
	$id = "1";
	$query = "DELETE FROM images WHERE visible = '$id' ";
	$query_run = mysqli_query($conn, $query);

	if ($query_run) 
	{
		$_SESSION['success'] = "Your data is DELETED";
		header('Location: seller-profile.php');
	}
}




// to get user ip address
function getUserIP()
{
	switch (true) {
		case (!empty($_SERVER['HTTP_X_REAL_IP'])): return $_SERVER['HTTP_X_REAL_IP'];

		case (!empty($_SERVER['HTTP_CLIENT_IP'])): return $_SERVER['HTTP_CLIENT_IP'];

		case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])): return $_SERVER['HTTP_X_FORWARDED_FOR'];

		default : return $_SERVER['REMOTE_ADDR'];
			
	}
}

function totalPrice()//seller cannot enter admin pgs
{
	$ip_add =getUserIP();
	$total = 0;
	$select_cat = "SELECT *FROM cart WHERE ip_add = '$ip_add'";
	$run_cart = mysqli_query($conn, $select_cat);
	while ($record = mysqli_fetch_array($run_cart)) 
	{
		$pro_id = $record['p_id'];
		$pro_qty = $record['qty'];
		$get_price = "SELECT * FROM images WHERE id = 'pro_id'";
		$run_price = mysqli_query($conn, $get_price);
		while ($row=mysqli_fetch_array($run_price)) 
		{
			$sub_total = $row['price'] * $pro_qty;
			$total += $sub_total ;
		}
	}
	echo "$total";
}

?>


