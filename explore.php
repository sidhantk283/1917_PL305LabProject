<?php 
session_start();
include("connection.php");
if(isset($_SESSION['userid'])){
	$id = $_SESSION['userid'];
	$sql = "SELECT * FROM `user` WHERE `userid` = '$id' limit 1";
	$result = $con->query($sql);
	if($result){
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$username=$row["userfirstname"];
			}
		}
	}
}else unset($_SESSION['userid']);
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
			<li><a href="index.php">Home</li>
			<li class="active">Explore</li>
				<li><a href="#">Catagory</a>
					<ul class="dropdown">
						<li><a href="photography.php">Photography</a></li>
						<li><a href="#">Illastrations</a></li>
						<li><a href="#">Clip-Art</a></li>
						<li><a href="#">Other</a></li>
					</ul>
				</li>
				<li><a href="#">About Us</a></li>
				<li>
					<?php
					if(!isset($_SESSION['userid'])) echo "<a href='signup.php' class='Login'>Sign In/Sign Up</a>";
					else {
						echo "Welcome ".$username;
						echo " <ul class='dropdown'>
						<li><a href='#''>Profile</a></li>
						<li><a href='upload.php'>Upload/Create Post</a></li>
						<li><a href='#'>Add Balance</a></li>
						<li><a href='logout.php'>Log Out</a></li>
						</ul>";
					}
					?>
			</li>
		</ul>
	</nav>
</header>
<body>
	

</body>
</html>