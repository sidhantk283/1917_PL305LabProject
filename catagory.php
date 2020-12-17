<?php 
session_start();
include("connection.php");
if(isset($_SESSION['userid'])){
	$id = $_SESSION['userid'];
	$sql = "SELECT * FROM `user` WHERE `userid` = '$id' limit 1";
	$result = $con->query($sql);
		//$count=;
		//$count=mysqli_num_rows($result);
	if($result){
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$username=$row["userfirstname"];
			}
		}
	}
}else unset($_SESSION['userid']);

if(isset($_POST['catagory_create'])){
	$ctitle = $_POST['ctitle'];
	$cdesc = $_POST['cdesc'];
	$userid = $_SESSION['userid'];
	if(!empty(ctitle)){
		$result_catagory_insert = $con->query("INSERT INTO `catagory`(`ctitle`, `cdesc`, `userid`) VALUES ('$ctitle','$cdesc','$userid')");
		if ($result_catagory_insert) echo "<script>alert('Catagory Inserted')</script>";
		else echo "<script>alert('Catagory Not Inserted')</script>";
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
			<li><a href="explore.php">Explore</a></li>
			<li><a href="#">Catagory</a>
				<ul class="dropdown">
					<li><a href="#">Photography</a></li>
					<li><a href="#">Illastrations</a></li>
					<li><a href="#">Clip-Art</a></li>
					<li><a href="#">Other</a></li>
				</ul>
			</li>
			<li><a href="#">About Us</a></li>
			<li class="last">
				<?php
				if(!isset($_SESSION['userid']))echo "<a href='signup.php' class='Login'>Sign In/Sign Up</a>";
				else {
					echo "Welcome ".$username;
					echo " <ul class='dropdown'>
					<li><a href='#''>Profile</a></li>
					<li>Upload/Create Post</li>
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
	<div class="container">
		<div>
			<h1>Select Catagory</h1>
			<p>What catagory would you like you'r image to be in...</p>
			<form method="POST">
				<label for="catagory">Choose a Catagory :</label>

				<select name="catagory" class="option">
					<?php
					$sql_catagory = "SELECT * FROM `catagory` WHERE 1";
					$result_catagory = $con->query($sql_catagory);
					if($result_catagory){
						$i=0;
						if ($result_catagory->num_rows > 0) {
							while($row_catagory = $result_catagory->fetch_assoc()) {
								$catagory[$i]=$row_catagory['ctitle'];
								echo "<option value='$catagory[$i]'>$catagory[$i]</option>";
								$i++;
							}
						}
					}
					?>
				</select>
				<button type="submit" class="registerbtn" name="submit">Submit</button>
			</form>
			<br>
			<hr>
			<form method="Post">
				<h1>Create a new Catagory</h1>
				<br>
				<br>
				<label for="fname">Catagory Title</label>
				<input type="text" placeholder="Enter Catagory Title" name="ctitle" id="ctitle" required>

				<label for="lname">Catagory Description</label>
				<input type="text" placeholder="Enter Catagory Description" name="cdesc" id="cdesc">
				<button type="submit" name="catagory_create" class="registerbtn">Add Catagory</button>
			</form>
		</div>
	</div>
</body>
</html>