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
			<li><a href="#" class="Login">Login/Create Account</a></li>
		</ul>
	</nav>
</header>
<body>
	 <form action="action_page.php">
  <div class="container">
    <h1>Log In</h1>
    <p>Please fill in this form to Log In.</p>
    <hr>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

    <a href="#">Forgot Password</a>
    <button type="submit" class="registerbtn">Log In</button>
  </div>

  <div class="container signin">
    <p>Create New Account? <a href="signup.php">Sign Up</a>.</p>
  </div>
</form> 
</body>
</html>