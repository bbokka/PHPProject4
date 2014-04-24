<?php
	session_start();
	require_once('config.php');
?>
<?php
	
	$email=mysql_real_escape_string($_POST['email']);
	$e2="";
	
	if (empty($email))
	{
	?>
		<script type="text/javascript">
			alert("Please enter your EMAIL TO CHANGE YOUR PASSWPORD ");
			history.back();
		</script>	
	<?php
	}
	else
	{
		$e2=mysql_real_escape_string($_POST['email']);
		$_SESSION['email']= $e2;
		//echo "<br>4..".$e2;
	}
	
	$query= "SELECT
				email,
				email_setting 
			FROM
				P4_users
			WHERE
				email='$email'";
	$result = mysql_query($query) or die ("Unable to VERIFY THE EMAIL " . mysql_error());
	$count = mysql_num_rows($result);
	
	if($count ==1)
	{
		$page="emailForgotPassword";
		$row = mysql_fetch_assoc($result);
		$choice=$row['email_setting'];
		if($choice==1)
		{
			$to=$row['email'];
			$subject="PASSWORD RESET CONFIRMATION";
						
			$headers = "MIME-Version: 1.0\r\n";	
			$headers.= "Content-Type: text/plain; charset=UTF-8\r\n";
			$headers.= "Content-Transfer-Encoding: 7bit\r\n";
			$headers.= "From: bbokka@cs.odu.edu\r\n";
								
			$message="click the below link to reset your password.";
			$message.="http://weiglevm.cs.odu.edu/~bbokka/devsandbox/PHPProject4forgot.php";
			$message.="Reset the password Immediately";
		}
		else if($choice ==2)
		{
			$to=$row['email'];
			$subject="PASSWORD RESET CONFIRMATION";
							
			$headers = "MIME-Version: 1.0\r\n";	
			$headers.= "Content-Type: text/html; charset=UTF-8\r\n";
			$headers.= "Content-Transfer-Encoding: 7bit\r\n";
			$headers.= "From: bbokka@cs.odu.edu\r\n";
							
			$message ="<h3><em><font face='verdana' color='red'>Thank you for the Request.</font></em></h3><br>";
			$message.="<a href=\"http://weiglevm.cs.odu.edu/~bbokka/devsandbox/PHPProject4/forgot.php\">Please click this link to reset your password.</a> <br>";
			$message.="<em><font face='verdana' color='black'>And Reset the password Immediately</font></em><br>";
		}
		mail($to,$subject,$message,$headers);
		header("Location: niceMessages.php?action=$page");
	}
	else
	{
		$page="unRegisteredForgot";
		header("Location: niceMessages.php?action=$page");
	}
?>