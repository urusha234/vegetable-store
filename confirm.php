<?php

session_start();
include 'db_conn.php';
include 'uploaded.php';

if(!isset($_SESSION["b_user"])){
    
    header("location:login-b.php");
}

if (isset($_GET['order_id'])) 
{
	$order_id=$_GET['order_id'];
}

?>

