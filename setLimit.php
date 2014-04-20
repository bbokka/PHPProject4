<?php
	session_start();
	require_once('config.php');
?>
<?php
	$limit_value1 =mysql_real_escape_string( $_REQUEST['limit']);
	
	if(is_numeric($limit_value1))
	{
	$query ="UPDATE
				`P4_setting` 
			SET 
				`value` = $limit_value1";
	
	$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
	if(!$result) die("Error updating the limit value");
	else 
		header("Location: AllFeatures.php");
	}
	else
	{
		echo "<script>alert('Only numeric values must be entered'); location.href='AllFeatures.php';</script>";
		//header("Refresh:3 URL: AllFeatures.php");
	}
?>