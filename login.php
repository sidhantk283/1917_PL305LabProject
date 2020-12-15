<!DOCTYPE html>
<html>
<head>
	<title>Pixel</title>
	<link rel="stylesheet" type="text/css" href="style1.css">
	<script src="js.js"></script>
</head>
<header>
	<div class="tittle">
		fuck PIXEL.com and i hate my life
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
				<li><a href="#" class="Login">Login/Create Account</a></li>
			</ul>
		</nav>
	</header>
	<body>
		<form method="post" action="">
			<div class="container">
				<h1>Log In</h1>
				<p>Please fill in this form to Log In.</p>
				<hr>

				<label for="email"><b>Email</b></label>
				<input type="text" placeholder="Enter Email" name="email" id="email" required>

				<label for="psw"><b>Password</b></label>
				<input type="password" placeholder="Enter Password" name="password" id="password" required>

				<a href="#">Forgot Password</a>
				<?php 
				session_start();
				include("connection.php");
				include("functions.php");

				if ($con) {
					# code...
					echo "done";
					$sql = "SELECT `userid`, `userfirstname`, `userlastname`, `balance`, `password`, `Email` FROM `user` WHERE 1";
					$result = $con->query($sql);

					$id=$_SESSION['userid'];
					echo $id;

					if ($result->num_rows > 0) {
  						// output data of each row
						while($row = $result->fetch_assoc()) {
							echo "id ".$row["userid"]."Name ".$row["userfirstname"]." ".$row["userlastname"]." ".$row["password"]."<br>";
						}
					} else {
						echo "0 results";
					}
				}else echo "not done";


				if($_SERVER['REQUEST_METHOD'] === "POST"){
					$email = $_POST['email'];
					$password = $_POST['password'];
					if (!empty($email) && !empty($password) && !is_numeric($email)) {
						$query="SELECT * FROM `user` where Email = '$email' limit 1";
						$result = $con->query($sql);

						if($result->num_rows > 0){
							while($row = $result->fetch_assoc()) {
								if($row["password"]==$password){
									$_SESSION["Email"]=$row["Email"];
									$_SESSION["password"]=$row["password"];
									header("Location: index.php");
									die;
								}
							}	
						}
					}else echo "Please enter some valid information	!";
				}
				?>
				<button type="submit" name="loginForm" class="registerbtn" value="Submit">Log In</button>
			</div>

			<div class="container signin">
				<p>Create New Account? <a href="signup.php">Sign Up</a>.</p>
			</div>
		</form> 
	</body>
	<?php session_destroy(); ?>
	</html>