<?php
session_start();

require_once('config.php');

$susp_user=$_POST['user'];
$suspend_value = $_POST['suspend'];
	
	$query1="UPDATE
				P3_user_login 
			SET
				suspend='$suspend_value' 
			WHERE
				login_id='$susp_user'";
	$result1 = mysql_query($query1) or die ("Unable to verify user because " . mysql_error());
	//echo $susp_user;
	//&nbsp;
	//echo $suspend_value;
	
	$query2="SELECT 
				* 
			 FROM 
				P3_user_login 
			 WHERE 
				login_id='$susp_user'";
    $result2= mysql_query($query2) or die ("Unable to verify user because " . mysql_error());
    $row2 = mysql_fetch_assoc($result2);
	
	$_SESSION['suspend']= $row2['suspend'];
	$e=$_SESSION['suspend'];
	
	
	$_SESSION['email'] = $row2['email'];
	$to=$_SESSION['email'];
	
	
	echo "dfgdgsdfgsdfgsd".$e;
	if($e == 1)
	{
		$subject="Suspending";
		$message = "Hello user, You are temporarily suspended  ";
		mail($to, $subject, $message);
	}
	else
	{
		$subject="Unsuspended";
		$message = "Hello user, You are Unsuspended ";
		mail($to, $subject, $message);
	}

	
	header("Location: showCategory.php"); 
?>
