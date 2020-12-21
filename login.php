<?php 
session_start();
include("connection.php");
if(isset($_POST['Submit'])){
	$email = $_POST['email'];
	$password = $_POST['password'];
	if (!empty($email) && !empty($password) && !is_numeric($email)) {
		$query="SELECT * FROM `user` where `email` = '$email' and password = '$password' limit 1";
		$result = mysqli_query($con, $query);  
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
        if($count == 1){
        	$_SESSION['userid']=$row["userid"];
            echo "<script>alert('Login Successfull');location.href='index.php';</script>";  
        }  
        else{  
            echo "<script>alert('Login Unsuccessfull');</script>";    
        }  
	}else echo "<script>alert('Please enter some valid information!');</script>";
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Pixel</title>
	<link rel="stylesheet" type="text/css" href="style1.css">
	<script src="js.js"></script>
</head>
<header>
	<div class="tittle">
		<img src="logo.png">
	</div>
	<nav role="navigation">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="#">Explore</a>

				<li><a href="#">Catagory</a>
					<ul class="dropdown">
						<li><a href="photography.php">Photography</a></li>
						<li><a href="illustration.php">Illastrations</a></li>
						<li><a href="clipart.php">Clip-Art</a></li>
						<li><a href="other_cat.php">Other Catagories</a></li>
					</ul>
				</li>
				<li><a href="#">About Us</a></li>
				<li class="active">Login/Create Account</li>
			</ul>
		</nav>
	</header>
	<body>
		<form method="POST">
			<div class="container">
				<h1>Log In</h1>
				<p>Please fill in this form to Log In.</p>
				<hr>

				<label for="email"><b>Email</b></label>
				<input type="email" placeholder="Enter Email" name="email" id="email" required>

				<label for="psw"><b>Password</b></label>
				<input type="password" placeholder="Enter Password" name="password" id="password" required>

				<a href="#">Forgot Password</a>
				<button type="submit" name="Submit" class="registerbtn" value="Submit">Log In</button>
			</div>

			<div class="container signin">
				<p>Create New Account? <a href="signup.php">Sign Up</a>.</p>
			</div>
		</form> 
	</body>
	</html>