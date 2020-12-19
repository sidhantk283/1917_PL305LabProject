<!DOCTYPE html>
<html>
<body>
	<div class="main">
		<h1>Photography</h1>
		<hr>
		<?php
		$sql = "SELECT * FROM `image` WHERE `cid` = '1'";
		$result = $con->query($sql);
		if($result){
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$path=$row['im_path'];
					$title=$row['im_tittle'];
					$desc=$row['im_desc'];
					?>
					<div class='gallery'>
						<a target='#'><img src="<?php echo "$path"; ?>" alt="<?php echo "$path"; ?>" width="500" height="333"></a>
						<div class='title'><?php echo "$title"; ?></div>
						<div class='desc'><?php echo "$desc"; ?></div>
					</div>
					<?php
				}
			}
		}
		?>
	</div>
</body>
</html>