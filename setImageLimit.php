<?php
	session_start();
	require_once('config.php');
?>
<?php
	$limit_value1 = mysql_real_escape_string( $_REQUEST['noLifeLimit']);
	$limit_value2 = mysql_real_escape_string( $_REQUEST['NewbieLimit']);
	$limit_value3 = mysql_real_escape_string( $_REQUEST['ActiveLimit']);
	$limit_value4 = mysql_real_escape_string( $_REQUEST['VeteranLimit']);
	///updating nolife
	if(is_numeric($limit_value1))
	{
		$query1 ="UPDATE
					`P4_setting` 
				SET 
					`value` = $limit_value1
				WHERE 
					setting_id=2";
		$result1 = mysql_query($query1) or die ("Unable to update nolife  user because " . mysql_error());
		if(!$result1) die("Error updating the limit value");
		else 
			header("Location: AllFeatures.php");
	}
	else
	{
		echo "<script>alert('Something went wrong !!!'); location.href='AllFeatures.php';</script>";
	}
	///updating newbie
	if(is_numeric($limit_value2))
	{
		$query2 ="UPDATE
					`P4_setting` 
				SET 
					`value` = $limit_value2
				WHERE 
					setting_id=3";
		$result2 = mysql_query($query2) or die ("Unable to update newbie user because " . mysql_error());
		if(!$result2) die("Error updating the limit value");
		else 
			header("Location: AllFeatures.php");
	}
	else
	{
		echo "<script>alert('Something went wrong !!!'); location.href='AllFeatures.php';</script>";
	}
	///updating active
	if(is_numeric($limit_value3))
	{
		$query3 ="UPDATE
					`P4_setting` 
				SET 
					`value` = $limit_value3
				WHERE 
					setting_id=4";
		$result3 = mysql_query($query3) or die ("Unable to update active because " . mysql_error());
		if(!$result3) die("Error updating the limit value");
		else 
			header("Location: AllFeatures.php");
	}
	else
	{
		echo "<script>alert('Something went wrong !!!'); location.href='AllFeatures.php';</script>";
	}
	///updating veteran
	if(is_numeric($limit_value4))
	{
		$query4 ="UPDATE
					`P4_setting` 
				SET 
					`value` = $limit_value4
				WHERE 
					setting_id=5";
		$result4 = mysql_query($query4) or die ("Unable to update veteran because " . mysql_error());
		if(!$result4) die("Error updating the limit value");
		else 
			header("Location: AllFeatures.php");
	}
	else
	{
		echo "<script>alert('Something went wrong !!!'); location.href='AllFeatures.php';</script>";
	}
	
?>