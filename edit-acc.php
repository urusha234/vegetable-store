<?php 

include 'db_conn.php';

session_start();
$username=$_SESSION['s_username'];
?>
<div class="box">
	<center>
		<h1>Edit Yoyr Account</h1>
	</center>
	<div class="form-group">
		<label>First Name:</label>
		<input type="text" name="firstname" class="form-group" required>

		<label>Last Name:</label>
		<input type="text" name="lastname" class="form-group" required>

		<label>Userame:</label>
		<input type="text" name="username" class="form-group" required>

		<label>Email:</label>
		<input type="email" name="email" class="form-group" required>

		<label>Password:</label>
		<input type="password" name="password" class="form-group" required>

		<label>Phone no:</label>
		<input type="number" name="phone" class="form-group" required>

		<label>Location:</label>
		<input type="text" name="location" class="form-group" required>
	
	</div>
	<div class="text-center">
		<button class="btn btn-primary" name="update">
			Update Now
		</button>		
	</div>
</div>	