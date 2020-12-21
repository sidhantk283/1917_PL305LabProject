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
				$userlastname=$row['userlastname'];
				$email=$row['email'];
				$bal=$row['balance'];
			}
		}
	}
}else unset($_SESSION['userid']);
?>

<!DOCTYPE html>
<head>
	<title>Pixel</title>
	<link rel="stylesheet" type="text/css" href="style1.css">
	<script src="js.js"></script>
	<style>
		div.main{
			width: 80%;
			margin: 30px auto;
			display: grid;
			background-color: #ffe6e6;
		}

		h1.title{
			text-align: left;
			padding: 10px;
			font-size: 50px;
		}

		p.desc{
			padding: 10px;
			text-align: left;
		}

		div.download-box{
			width: 100%;
			margin: auto;
			padding: 10px;
			display: grid;
			border: none;
			background-color: #ff3399;
		}

		div.download-box{
			width: 100%;
			margin: auto;
			padding: 10px;
			display: grid;
			border: none;
			background-color: #ff3399;
		}

		a.download{
			color: white;
			text-align: center;
			padding: 0px;
			opacity: 0.9;
		}

		a.download{
			text-align: center;
			padding: 0px;
			opacity: 0.9;
		}

		div.download-box:hover {
			opacity:1;
			background: #990033;
		}

		div.below-main{
			width: 80%;
			margin: 20px auto;
			display: grid;
			background-color: #ffe6e6;
		}

		div.display_cat{
			padding: 10px;
			width: 100%;
			background-color: #ffb3b3;
		}

		div.below-main-text{
			width: 80%;
			margin: 20px auto;
			text-align: center;
			padding-top: : 5px;
			padding-bottom: : 50px; 
		}

		div.gallery-display{
			display: grid;
			grid-template-columns: auto auto auto auto;
			grid-gap: 10px;
		}

		div.gallery {
			margin-left: auto;
			margin-right: auto;
			margin-top: 10px;
			border: 1px solid #ccc;
			float: left;
			width: 30%;
			padding: 2px;
			display: grid;
			background-color: #ff9966;
		}
		div.gallery:hover {
			border: 5px solid #777;
		}

		div.gallery img {
			display: block;
			margin-left: auto;
			margin-right: auto;
			width: 50%;
		}
		div.gallery img:hover {
			box-shadow: 10px 10px;
		}

		div.desc{
			padding-top: 5px;
			padding-bottom: 10px;
			text-align: center;
		}

		div.by {
			padding-top: 5px;
			padding-bottom: 10px;
			text-align: center;
		}

		div.title {
			padding-top: 10px;
			text-align: center;
			color: dodgerblue;
		}
	</style>
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
					<li><a>Clip-Art</a></li>
					<li><a href="other_cat.php">Other Catagories</a></li>
				</ul>
			</li>
			<li><a href="statistics.php">Users Data</a></li>
			<li>
				<?php
				if(!isset($_SESSION['userid'])) echo "<a href='signup.php' class='Login'>Sign In/Sign Up</a>";
				else {
					echo "Welcome ".$username;
					echo " <ul class='dropdown'>
					<li><a href='profile.php'>Profile</a></li>
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
<html>
<body>
	<?php		
	echo "	<div class='main'>
	<h1 class='title'>$username $userlastname</h1>
	<br>";
	echo "<hr>";
	echo "<br>
	<div class='display_cat'>Catagory Created By $username</div>
	<hr>
	";

	$display_cat = $con->query("SELECT * FROM `catagory` WHERE `userid`='$id'");
	if ($display_cat->num_rows > 0) {
		while($cat_row = $display_cat->fetch_assoc()) {
			$display_cat_title=$cat_row['ctitle'];
			if(!empty($display_cat_title)){
				echo "
				<div class='display_cat'>$display_cat_title <a href='other_cat.php'>View</a></div>
				";
			}
		}
	}else echo "No Catagories Created";

	echo "<br><hr>";
	echo "<br>
	<div class='display_cat'>Images Uploaded By $username</div>
	<hr>";

	$display_cat = $con->query("SELECT * FROM `image` WHERE `userid`='$id'");
	if ($display_cat->num_rows > 0) {
		while($cat_row = $display_cat->fetch_assoc()) {
			$display_cat_title=$cat_row['im_tittle'];
			$path_im=$cat_row['im_path'];
			$im_file_name_download = basename($path_im);
			if(!empty($display_cat_title)){	
				echo "<br>
				<div class='display_cat'>$display_cat_title <a class='download2' href=$path_im download=$im_file_name_download>Download</a></div>
				";
			}
		}
	}else echo "No Images Uploaded";


	$i=0;
	$sql = "SELECT * FROM `image` WHERE `userid` = '$id'";
	$result_grid = $con->query($sql);

	if($result_grid){
		if ($result_grid->num_rows > 0) {
			while($row_grid = $result_grid->fetch_assoc()) {
				$path=$row_grid['im_path'];
				$title=$row_grid['im_tittle'];
				$desc=$row_grid['im_desc'];
				$im_u_id=$row_grid['userid'];
				$time=$row_grid['im_uploaddatetime'];

				$i++;

				$im_file_name = basename($path);
				echo "
				<div class='gallery'>
				<a><img src='$path' alt='$path'></a>
				<div class='title'>$title</div>
				<div class='desc'>$desc</div>
				<div class='by'>-$username $userlastname<br>$time</div>

				<div class='download-box'>
				<a class='download' href=$path download=$im_file_name>Download</a>
				</div>
				</div>";
			}
		}
	}
	echo "</div>
	</div>";
	echo "
	<div class='below-main'>
	<div class='below-main-text'>$username has uploaded $i images.<a href='upload.php'>Upload More</a></div>
	</div>";		
	?>
	<script src="js.js"></script>
</body>
</html>