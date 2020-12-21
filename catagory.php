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
	
	if(isset($_POST['catagory_select'])){
		$ctitle = $_POST['catagory'];
		$cat_data = $con->query("SELECT * FROM `catagory` WHERE `ctitle` = '$ctitle' limit 1");
		if($cat_data){
			if ($cat_data->num_rows > 0) {
				while($cat_row = $cat_data->fetch_assoc()) {
					$cid=$cat_row["cid"];
					$cnum=$cat_row['no_of_images'];
				}
			}
		}else echo "<script>alert('Catagory Not Available')</script>";

		if(!empty($ctitle)){
			if(isset($_SESSION['im_id'])){
				$im_id = $_SESSION['im_id'];
				$result_catagory_select = $con->query("UPDATE `image` SET `cid`=$cid WHERE `im_id`= $im_id");
				if ($result_catagory_select){
					unset($_SESSION['im_id']);
					$cnum++;
					$con->query("UPDATE `catagory` SET `no_of_images`='$cnum' WHERE `cid`='$cid'");
					echo "<script>alert('Catagory Applied');location.href='index.php';</script>";
				}else echo "<script>alert('Catagory Not Applied')</script>";
			}
		}
	}
	if(isset($_POST['catagory_create'])){
		$cctitle = $_POST['cctitle'];
		$ccdesc = $_POST['ccdesc'];
		if(!empty($cctitle)){
			$result_catagory_insert = $con->query("INSERT INTO `catagory`(`ctitle`, `cdesc`, `userid`) VALUES ('$cctitle','$ccdesc','$id')");
			if ($result_catagory_insert) echo "<script>alert('Catagory Inserted')</script>";
			else echo "<script>alert('Catagory Not Inserted')</script>";
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
		<img src="logo.png">
	</div>
	<nav role="navigation">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="explore.php">Explore</a></li>
			<li><a href="#">Catagory</a>
				<ul class="dropdown">
					<li><a href="photography.php">Photography</a></li>
					<li><a href="illustration.php">Illastrations</a></li>
					<li><a href="clipart.php">Clip-Art</a></li>
					<li><a href="other_cat.php">Other Catagories</a></li>
				</ul>
			</li>
			<li><a href="statistics.php">Users Data</a></li>
			<li class="last">
				<?php
				if(!isset($_SESSION['userid']))echo "<a href='signup.php' class='Login'>Sign In/Sign Up</a>";
				else {
					echo "Welcome ".$username;
					echo " <ul class='dropdown'>
					<li><a href='profile.php'>Profile</a></li>
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
				<button type="submit" class="registerbtn" name="catagory_select">Submit</button>
			</form>
			<br>
			<hr>
			<form method="Post">
				<h1>Create a new Catagory</h1>
				<br>
				<br>
				<label for="fname">Catagory Title</label>
				<input type="text" placeholder="Enter Catagory Title" name="cctitle" id="ctitle" required>

				<label for="lname">Catagory Description</label>
				<input type="text" placeholder="Enter Catagory Description" name="ccdesc" id="cdesc">
				<button type="submit" name="catagory_create" class="registerbtn">Add Catagory</button>
			</form>
		</div>
	</div>
</body>
</html>