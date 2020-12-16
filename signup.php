<?php 
session_start();
include("connection.php");
if(isset($_POST['submit'])){
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$confpassword=$_POST['confpassword'];
	
	if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password) && !empty($confpassword) && !is_numeric($email)) {
		if($password==$confpassword){
			$query=$con->query("INSERT INTO `user`(`userfirstname`, `userlastName`, `email`, `password`) VALUES ('$fname','$lname','$email','$password')");
			if($query){
				echo "<script>alert('Successfully Registered. You can login now');location.href='login.php';</script>";
			}
		}else echo "<script>alert('Password was diffrent. Retry!');</script>";
	}
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
		PIXEL.com
	</div>
	<nav role="navigation">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="#">Explore</a></li>
				<li><a href="#">Catagory</a>
					<ul class="dropdown">
						<li><a href="#">Photography</a></li>
						<li><a href="#">Illastrations</a></li>
						<li><a href="#">Clip-Art</a></li>
						<li><a href="#">Other</a></li>
					</ul>
				</li>
				<li><a href="#">About Us</a></li>
				<li class="active">Login/Create Account</li>
			</ul>
		</nav>
	</header>
	<body>
		<form method="post">
			<div class="container">
				<h1>Register</h1>
				<p>Please fill in this form to create an account.</p>
				<hr>

				<label for="fname"><b>First Name</b></label>
				<input type="text" placeholder="Enter First Name" name="fname" id="fname" required>

				<label for="lname"><b>Last Name</b></label>
				<input type="text" placeholder="Enter Last Name" name="lname" id="lname" required>

				<label for="email"><b>Email</b></label>
				<input type="text" placeholder="Enter Email" name="email" id="email" required>

				<label for="psw"><b>Password</b></label>
				<input type="password" placeholder="Enter Password" name="password" id="password" required>

				<label for="psw-repeat"><b>Repeat Password</b></label>
				<input type="password" placeholder="Repeat Password" name="confpassword" id="confpassword" required>
				<hr>

				<p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
				<button type="submit" name="submit" class="registerbtn">Register</button>
			</div>

			<div class="container signin">
				<p>Already have an account? <a href="login.php">Sign in</a>.</p>
			</div>
		</form> 
	</body>
	</html>