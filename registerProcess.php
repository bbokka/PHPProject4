<?php
	session_start();
	require_once('config.php');

	$page="register";
 
	//<!-- retreive the comment on the post and insert it into the post table-->
	$date= date("Y/m/d H:i:s A");
	//checking for user FIRSTNAME
	$fn=mysql_real_escape_string($_POST['firstname']);
	if (empty($fn))
	{
	?>
		<script type="text/javascript">
			alert("Please enter your FIRST NAME ");
			history.back();
		</script>	
	<?php
	}
	else
	{
		//$fn=mysql_real_escape_string($_POST['firstname']);
		$_SESSION['firstname']= $fn;
		//echo "<br>4..".$fn;
	}
	?>
	<!--checking for user lastname-->
	<?php
	$ln=mysql_real_escape_string($_POST['lastname']);
	if (empty($ln))
	{
	?>
		<script type="text/javascript">
			alert("Please enter your LAST NAME ");
			history.back();
		</script>	
	<?php
	}
	else
	{
		//$ln=mysql_real_escape_string($_POST['lastname']);
		$_SESSION['lastname']= $ln;
		//echo "<br>4..".$ln;
	}
	?>
	<!--checking for user forum username-->
	<?php
	$un=mysql_real_escape_string($_POST['username']);
	if (empty($un))
	{
	?>
		<script type="text/javascript">
			alert("Please enter your USER NAME ");
			history.back();
		</script>	
	<?php
	}
	else
	{	
		
		//$un=mysql_real_escape_string($_POST['username']);
		$_SESSION['username']= $un;
		//echo "<br>4..".$un;
	}
	?>
	<!--checking for user forum EMAIL-->
	<?php
	$e1=mysql_real_escape_string($_POST['email']);
	if (empty($e1))
	{
	?>
		<script type="text/javascript">
			alert("Please enter your EMAIL ");
			history.back();
		</script>	
	<?php
	}
	else
	{
		//$e1=mysql_real_escape_string($_POST['email']);
		$_SESSION['email']= $e1;
		//echo "<br>4..".$e1;
	}
	?>
	<!--checking for user PASSWORD-->
		<?php
		$p1=mysql_real_escape_string($_POST['password1']);
	if (empty($p1))
	{
	?>
		<script type="text/javascript">
			alert("Please enter your PASSWORD ");
			history.back();
		</script>	
	<?php
	}
	else
	{
		//$p1=mysql_real_escape_string($_POST['password1']);
		//echo "<br>4..".$p1;
	}
	?>
	<!--checking for RE-ENTER PASSWORD-->
		<?php
		$p2=mysql_real_escape_string($_POST['password2']);
	if (empty($p2))
	{
	?>
		<script type="text/javascript">
			alert("Please RE-ENTER your PASSWORD ");
			history.back();
		</script>	
	<?php
	}
	else
	{
		//$p2=mysql_real_escape_string($_POST['password2']);
		//echo "<br>4..".$p2;
	}
	?>
	<?php
		if ($p1 == $p2)
		{
			$p=$p2;
			$p=MD5($p);
			$_SESSION['password2']= $p;
			
		}
		else
		{
		
	?>
			<script type="text/javascript">
				alert("Your Password doesnot MATCH");
				history.back();
			</script>
	<?php
	
		}
		?>
	<?php
	   //validate the radio button
		if($_POST['choice']==1 || $_POST['choice']==2)
		{
			$c1=$_POST['choice'];
			//echo "<br>7..".$c1;
		}
		else
		{
		?>
			<script type="text/javascript">
				alert("Make a choice of text/html and text/plain");
				history.back();
			</script>
		<?php
		}
		?>
		
		<?php
		//checking the user in database and inserting
		if($fn && $ln && $un && $e1 && $p && $c1 )
		{
			$query = "SELECT 
						*
					FROM 
						P4_users 
					WHERE 
						email='$e1'";
			$result= mysql_query($query) or die ("Unable to verify email because " . mysql_error());
			if(mysql_num_rows($result) == 0)
			{
				$activation =  rand() % 1000000+10000;
				//echo "the 6 digit activation key is".$activation;
				
				$query = "INSERT INTO 
							P4_users
								(id,
								 fname,
								 lname,
								 username,
								 email,
								 password,
								 Is_suspended,
								 Is_verified,
								 email_setting,
								 Is_archived,
								 activationkey,
								 date_registered,
								 role_id) 
							VALUES(' ',
								  '$fn',
								  '$ln',
								  '$un',
								  '$e1',
								  '$p',
								  '0',
								  '0',
								  '$c1',
								  ' ',
								  '$activation',																					
								  '$date',
								  '3')";		
				$result= mysql_query($query) or die ("Unable to execute the insert query " . mysql_error());
				
				if (mysql_affected_rows() == 1) 
				{
					//sending plain mesasge with out html
					if($c1==1)					
					{
						$to=$e1;
						$subject="REGISTRATION CONFIRMATION";
						
						$headers = "MIME-Version: 1.0\r\n";	
						$headers.= "Content-Type: text/plain; charset=UTF-8\r\n";
						$headers.= "Content-Transfer-Encoding: 7bit\r\n";
						$headers.= "From: bbokka@cs.odu.edu\r\n";
						
						$message="Thank you for your Registration.";
						$message.="http://weiglevm.cs.odu.edu/~bbokka/devsandbox/PHPProject4/enterActivationCode.php";
						$message.="\nPlease enter the six digit code at the link provided." .$activation;
						
						mail($to, $subject, $message, $headers);
					}
					//sending html tags message
					else
					{	
						//should update the $e1 value if everything works
						$to=$e1;
						$subject="REGISTRATION CONFIRMATION";
						
						$headers = "MIME-Version: 1.0\r\n";	
						$headers.= "Content-Type: text/html; charset=UTF-8\r\n";
						$headers.= "Content-Transfer-Encoding: 7bit\r\n";
						$headers.= "From: bbokka@cs.odu.edu\r\n";
						
						$message="<h3><em><font face='verdana' color='red'>Thank you for your Registration.</font></em></h3>";
						$message.="<a href=\"http://weiglevm.cs.odu.edu/~bbokka/devsandbox/PHPProject4/enterActivationCode.php\">Click to Activate your account</a><br>";
						$message.="<em><font face='verdana' color='black'>Please enter the six digit code at the link provided.</font></em><br>" .$activation;
						
						mail($to, $subject, $message, $headers);
					}
					header("Location: niceMessages.php?action=$page");
					
				}
				else
				{
				?>
					<script type="text/javascript">
						alert("ERROR in sending the email");
						history.back();
					</script>
				<?php
				}
			}
			else
			{
				//when the email is already registered
				?>
				<script type="text/javascript">
				alert("The email address is already registered");
				history.back();
				</script>
				<?php
			}
		}
		else
		{
		// when the user has NOT provided all the neccessary arguments
	?>
		
		<script type="text/javascript">
			alert("Please TRY again something is WRONG in filling the form");
			history.back();
		</script>
	<?php
		}
	?>