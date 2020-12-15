<?php
function check_login($con){;
	if(isset($_SESSION["userid"])){
		$id = $_SESSION["userid"];
		$query = "SELECT * FROM `user` WHERE where `userid` = `$id` limit 1";

		$result = $con->query($sql);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()) {
				echo $row['userid'];
				return $row;
			}
		}
	}else echo "not connected";
	//redirect to login
	//header("Location:login.php");
	//die;
}

function random_num($length){
	 $text = "";
	 if($length<5){
	 	$length=5;
	 }

	 $len = rand(4,$length);

	 for ($i=0; $i < $len; $i++) { 
	 	# code...
	 	$text.=rand(0,9);
	 }
	 return $text;
}
?>