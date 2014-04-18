<?php
	session_start();
	require_once("config.php");
?>
<?php
	//retrieving the categories from the database
	$query="	SELECT 
					id,
					cat_name,
					cat_description 
				FROM P4_categories";
	$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
	while($row = mysql_fetch_assoc($result))
	{
		echo '
			<div class="category_div">
				<div class="category_name">  
					<a style="color:green!important" href="showThread.php?category_id='.$row['id'].'">'. $row['cat_name'] .'</a>
				</div>
				<div class="category_description"> 
					'.$row['cat_description'].'
				</div>
			</div>';
		
	}
?>