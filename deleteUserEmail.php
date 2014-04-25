<?php
	session_start();
	require_once('config.php');

	$del_eval=mysql_real_escape_string( $_POST['user']);
	$message_from_UI = mysql_real_escape_string( $_POST["message"]);
	
	$query1 ="
			SELECT 
				email,
				email_setting
			FROM 
				P4_users
			WHERE 
				id=$del_eval";
	$result1= mysql_query($query1) or die ("Unable to verify user because " . mysql_error());
	$row1 = mysql_fetch_assoc($result1);
	$_SESSION['email'] = $row1['email'];
	
	//$to=$_SESSION['email'];
	if($row1['email_setting']==1)
	{
		//plain email//
		$to=$_SESSION['email'];
		$subject="Deleting Your User Account";
					
		$headers = "MIME-Version: 1.0\r\n";	
		$headers.= "Content-Type: text/plain; charset=UTF-8\r\n";
		$headers.= "Content-Transfer-Encoding: 7bit\r\n";
		$headers.= "From: bbokka@cs.odu.edu\r\n";
		
		$message=$message_from_UI;
		//$message.="http://weiglevm.cs.odu.edu/~bbokka/devsandbox/PHPProject4/contact.php";
	}
	else if($row1['email_setting']==2)
	{
		//html email//
		$to=$_SESSION['email'];
		$subject="Deleting Your User Account";
						
		$headers = "MIME-Version: 1.0\r\n";	
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
		$headers .= "Content-Transfer-Encoding: 7bit\r\n";
		$headers .= "From: bbokka@cs.odu.edu\r\n";
		
		$message .= "<h3><em><font face='verdana' color='red'>".$message_from_UI."</font></em></h3><br>";
		//$message .= "<a href=\"http://weiglevm.cs.odu.edu/~bbokka/devsandbox/PHPProject4/contact.php\">Please Visit the Web page.</a> <br>";
	}
	mail($to, $subject, $message,$headers);
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


	
