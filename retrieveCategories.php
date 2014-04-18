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
				FROM P4_categories 
				where Is_archived = 0 ";
	$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
	
	echo '<h3  style="color:blue!important"> Forum Category:</h3>';
	
	while($row = mysql_fetch_assoc($result))
	{
		echo '<div style="width:100%; max-width:1024px; min-height:50px; padding:10px;-webkit-border-radius: 10px;
				-moz-border-radius: 10px;box-shadow: 10px 10px 5px #888888;
				border-radius: 10px; background-color:white; margin-bottom : 5px;">';
		
		echo '<h3><a style="color:green!important" href="showThread.php?category_id='.$row['id'].'">'. $row['cat_name'] .'</h3>';
		echo '<h5><a style="color:blue!important">'.$row['cat_description'].'</h5>';
		echo '</div>';
		
	}
?>