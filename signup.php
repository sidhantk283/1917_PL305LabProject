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
				<li><a href="signup.php" class="login_button">Login/Create Account</a></li>
			</ul>
		</nav>
	</header>
	<body>
		<form method="post" action="">
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
				<input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>
				<hr>

				<?php 
				session_start();
				include("connection.php");
				include("functions.php");

				if ($con) {
					# code...
					echo "done";
					$sql = "SELECT `userid`, `userfirstname`, `userlastname`, `balance`, `password`, `Email` FROM `user` WHERE 1";
					$result = $con->query($sql);

					if ($result->num_rows > 0) {
  						// output data of each row
						while($row = $result->fetch_assoc()) {
							echo "id ".$row["userid"]."Name ".$row["userfirstname"]." ".$row["userlastname"]." ".$row["password"]."<br>";
						}
					} else {
						echo "0 results";
					}
				}else echo "not done";

				if($_SERVER['REQUEST_METHOD'] == "POST"){
					$fname = $_POST['fname'];
					$lname = $_POST['lname'];
					$email = $_POST['email'];
					$password = $_POST['password'];
					if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password) && !is_numeric($email)) {
						$userid=random_num(20);
						$_SESSION["userid"]=$userid;
						$query="INSERT INTO `user`(`userid`,`userfirstname`, `userlastname`, `balance`, `password`, `Email`) VALUES ($userid,$fname,$lname,0,$password,$email)";
						$result = $con->query($sql);
						if($result){
							header("Location: login.php");
							die;
						}
					}else echo "Please enter some valid information	!";
				}else echo "no post";
				?>

				<p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
				<button type="submit" class="registerbtn">Register</button>
			</div>

			<div class="container signin">
				<p>Already have an account? <a href="login.php">Sign in</a>.</p>
			</div>
		</form> 
	</body>
	<?php session_destroy(); ?>
	</html>