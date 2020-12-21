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
	if(isset($_POST['Upload_file'])){
		$image_tittle = $_POST['image_tittle'];
		$image_desc = $_POST['image_desc'];
		$image_file = $_FILES['image_file'];

		$imageName=$_FILES['image_file']['name'];
		$imageTmpName=$_FILES['image_file']['tmp_name'];
		$imageSize=$_FILES['image_file']['size'];
		$imageType=$_FILES['image_file']['type'];
		$imageExt=explode('.',$image_tittle);

		$imageActualExt=strtolower(end($imageExt));
		$newImageName=$imageName.".".$imageActualExt;
		$target= "Images/".$imageName;
		    //$tags = $_POST['tags'];

		    //check if image is uploaded before

		$target_exists = $con->query("SELECT * FROM `image` WHERE `im_path` = '$target' limit 1");
		if($target_exists){
			if($imageType=="image/jpeg" || $imageType=="image/png" || $imageType=="image/JPEG" || $imageType=="image/PNG"){
				if(!empty($image_tittle) && !empty($image_file)){
					$result_image_insert = $con->query("INSERT INTO `image`(`im_tittle`, `im_desc`, `im_path`,`userid`, `cid`) VALUES ('$image_tittle','$image_desc','$target',$id,0)");

					if ($result_image_insert){
						$im_data = $con->query("SELECT * FROM `image` WHERE `im_path` = '$target' limit 1");
						if($im_data){
							if ($im_data->num_rows > 0) {
								while($im_row = $im_data->fetch_assoc()) {
									$_SESSION['im_id']=$im_row['im_id'];
								}
							}else unset($_SESSION['im_id']);
						}else echo "<script>alert('Catagory Not Available')</script>";

						move_uploaded_file($imageTmpName,$target);
						echo "<script>alert('$imageName Uploaded Sucessfully.Now select the catagory.');location.href='catagory.php';</script>";
					}
					else echo "<script>alert('$imageName Uploaded Unsucessfully')</script>";
				}else echo "<script>alert('Fields empty')</script>";
			}else echo "<script>alert('Not Image File')</script>";
		}else echo "<script>alert('Already exists $target')</script>";
	}
}else{
	unset($_SESSION['userid']);
	echo"<script>alert('Login First');location.href='index.php';</script>";
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
				if(!isset($_SESSION['userid'])){echo "<a href='signup.php' class='Login'>Sign In/Sign Up</a>";echo "<script>alert('You haven't logged in')</script>";}
				else {
					echo "Welcome ".$username;
					echo " <ul class='dropdown'>
					<li><a href='profile.php''>Profile</a></li>
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
			<h1>Upload Image</h1>
			<p>Enter the details for yor new post!</p>
			<hr>
			<form method="POST" enctype="multipart/form-data"> 
				<label for="tittle">Image Tittle :</label>
				<input type="text" id="text" placeholder="Enter Image Tittle" name="image_tittle" required>

				<label for="desc">Image Descriptio :</label>
				<input type="text" id="text" placeholder="Enter Image Description" name="image_desc">
				
				<label for="file">Select file :</label>
				<input type="file" id="image_file" placeholder="select file" name="image_file" required>

				<button type="submit" class="registerbtn" name="Upload_file">Submit</button>
				<button type="reset" class="resetbtn" name="reset"  href="#"> Reset</button>
			</form>
		</div>
	</div>
</body>
</html>