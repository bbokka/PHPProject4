<?php

	session_start();
	require_once('config.php');

	$del_value=$_REQUEST['category'];
	$query ="DELETE FROM 
				P4_categories 
			  WHERE 
				id=$del_value";
	$result= mysql_query($query) or die ("Unable to delete the category because " . mysql_error());
	header("Location: showCategory.php");
?>
