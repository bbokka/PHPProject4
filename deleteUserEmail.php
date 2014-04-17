<?php
	session_start();
	require_once('config.php');
?>
<?php
	
	$del_eval=mysql_real_escape_string( $_POST['user']);
	$message = mysql_real_escape_string( $_POST["message"]);
	
	$query1 ="SELECT 
				* 
			FROM 
				P3_user_login 
			WHERE 
				login_id=$del_eval";
	$result1= mysql_query($query1) or die ("Unable to verify user because " . mysql_error());
	$row1 = mysql_fetch_assoc($result1);
	$_SESSION['email'] = $row1['email'];
	$to=$_SESSION['email'];
	$subject="Deleting Your User Account";
	mail($to, $subject, $message);
	$query2 ="DELETE
					FROM 
						P3_user_login
					WHERE 
						login_id=$del_eval";
	$result2= mysql_query($query2) or die ("Unable to verify user because " . mysql_error());
	header("Location: goToDeleteUser.php");
?>


	
