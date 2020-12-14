<?php 
session_start();
include("connection.php");
include("functions.php");
$user_data=check_login($con);
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
			<li class="active"><a href="index.php">Home</a></li>
			<li><a href="#">Explore</a>
			<li><a href="#">Catagory</a>
				<ul class="dropdown">
					<li><a href="#">Photography</a></li>
					<li><a href="#">Illastrations</a></li>
					<li><a href="#">Clip-Art</a></li>
					<li><a href="#">Other</a></li>
				</ul>
			</li>
			<li><a href="#">About Us</a></li>
			<li><a href="signup.php" class="Login">Login/Create Account</a></li>
		</ul>
	</nav>
</header>
<body>
</body>
</html>