	<!--<?php
		$sql = "SELECT * FROM `catagory` WHERE `cid` = '$cid'";
		$result = $con->query($sql);
		if($result){
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$ctitle=$row['ctitle'];
					$cdesc=$row['cdesc'];
		?>-->
				<h1 class="title"><?php echo "$ctitle"; ?></h1>
				<p class="desc"><?php echo "$cdesc"; ?></p>
				<hr>
		<!--<?php 
				}
			}	
		}
		?>-->		
	<div class="gallery-grid">
		<?php
		$sql = "SELECT * FROM `image` WHERE `cid` = '$cid'";
		$result_grid = $con->query($sql);

		if($result_grid){
			if ($result_grid->num_rows > 0) {
				while($row_grid = $result_grid->fetch_assoc()) {
					$path=$row_grid['im_path'];
					$title=$row_grid['im_tittle'];
					$desc=$row_grid['im_desc'];
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