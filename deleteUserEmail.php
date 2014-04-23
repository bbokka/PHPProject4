<?php
	session_start();
	require_once('config.php');

	$del_eval=mysql_real_escape_string( $_POST['user']);
	$message = mysql_real_escape_string( $_POST["message"]);
	
	$query1 ="
			SELECT 
				email,
				email_settings
			FROM 
				P4_users
			WHERE 
				id=$del_eval";
	$result1= mysql_query($query1) or die ("Unable to verify user because " . mysql_error());
	$row1 = mysql_fetch_assoc($result1);
	$_SESSION['email'] = $row1['email'];
	$choice = $row1['email_settings'];
	if($row1['email_settings']==1)
	{
		//plain email//
	}
	else
	{
		//html email//
	}
	$to=$_SESSION['email'];
	$subject="Deleting Your User Account";
	mail($to, $subject, $message);
	//update the value of is_archived to 1 indicating the user has been deleted//
	$query2 ="
			UPDATE
				P4_users
			SET 
				Is_archived=1
			WHERE 
				id=$del_eval";
	$result2= mysql_query($query2) or die ("Unable to verify user because " . mysql_error());
	header("Location: goToDeleteUser.php");
?>


	
