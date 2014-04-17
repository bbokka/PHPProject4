<?php
session_start();

	require_once("config.php");
	$uid= $_POST['userid'];
	$role=$_POST['role'];
	
	$query = "update P3_user_login set rank='$role' where  login_id='$uid'";
	$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
	header("Location: AllFeatures.php");

?>