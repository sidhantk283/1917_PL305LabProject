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
      <li class="active">Explore</li>
      <li><a href="#">Catagory</a>
        <ul class="dropdown">
          <li><a href="photography.php">Photography</a></li>
          <li><a href="illustration.php">Illastrations</a></li>
          <li><a href="clipart.php">Clip-Art</a></li>
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
  <table style="width:100%">
    <tr style="background-color: #ff9966;padding:5px">
      <th>Firstname</th>
      <th>Lastname</th>
      <th>EmailID</th>
      <th>No Of Images Uploaded</th>
      <th>No Of Catagories Created</th>
    </tr>
    <?php 
    $display_user=$con->query("SELECT * FROM `user` WHERE `userid`!=0");
    if ($display_user->num_rows > 0) {
      while($row = $display_user->fetch_assoc()) {
        $uid=$row['userid'];
        $userfname=$row['userfirstname'];
        $userlname=$row['userlastname'];
        $email=$row['email'];
        
        $i=0;
        $display_cat = $con->query("SELECT * FROM `catagory` WHERE `userid`='$uid'");
        if ($display_cat->num_rows > 0) {
          while($cat_row = $display_cat->fetch_assoc()) {
            $i++;
          }
        }

        $j=0;
        $display_im = $con->query("SELECT * FROM `image` WHERE `userid`='$uid'");
        if ($display_im->num_rows > 0) {
          while($im_row = $display_im->fetch_assoc()) {
            $j++;
          }
        }
        echo "
        <tr>
        <th>$userfname</th>
        <th>$userlname</th>
        <th>$email</th>
        <th>$j</th>
        <th>$i</th>
        </tr>";
      }
    }
    ?>
  </table> 
</body>
</html>