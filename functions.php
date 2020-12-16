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
}
?>