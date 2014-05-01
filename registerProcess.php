<?php
	session_start();
	require_once('config.php');

	$page="register";
 
	$date= date("Y/m/d H:i:s A");
	//checking for user FIRSTNAME
	$fn=mysql_real_escape_string($_POST['firstname']);
	if (empty($fn))
	{
		echo '<script type="text/javascript">
				alert("Please enter your FIRST NAME ");
				history.back();
			</script>	';
	}
	else
	{
		$_SESSION['firstname']= $fn;
	}
	
	//<!--checking for user lastname-->
	$ln=mysql_real_escape_string($_POST['lastname']);
	if (empty($ln))
	{
		echo '	<script type="text/javascript">
					alert("Please enter your LAST NAME ");
					history.back();
				</script>';
	}
	else
	{
		$_SESSION['lastname']= $ln;
	}
	
	//<!--checking for user forum username-->
	$un=mysql_real_escape_string($_POST['username']);
	if (empty($un))
	{
		echo'	<script type="text/javascript">
					alert("Please enter your USER NAME ");
					history.back();
				</script>';
	}
	else
	{	
		$_SESSION['username']= $un;
	}
	
	//<!--checking for user forum EMAIL-->
	$e1=mysql_real_escape_string($_POST['email']);
	if (empty($e1))
	{
		echo '	<script type="text/javascript">
					alert("Please enter your EMAIL ");
					history.back();
				</script>';
	}
	else
	{
		$_SESSION['email']= $e1;
	}
	
	//<!--checking for user PASSWORD-->
	$p1=mysql_real_escape_string($_POST['password1']);
	if (empty($p1))
	{
		echo '	<script type="text/javascript">
					alert("Please enter your PASSWORD ");
					history.back();
				</script>';
	}
	//<!--checking for RE-ENTER PASSWORD-->
	$p2=mysql_real_escape_string($_POST['password2']);
	if (empty($p2))
	{
		echo '
			<script type="text/javascript">
				alert("Please RE-ENTER your PASSWORD ");
				history.back();
			</script>';	
	}
	if ($p1 == $p2)
	{
		$p=$p2;
		$p=MD5($p);
		$_SESSION['password2']= $p;
	}
	else
	{
		echo '<script type="text/javascript">
				alert("Your Passwords doesnot MATCH");
				history.back();
			</script>';
	}
   //validate the radio button
	if($_POST['choice']==1 || $_POST['choice']==2)
	{
		$c1=$_POST['choice'];
	}
	else
	{
		echo '
			<script type="text/javascript">
				alert("Make a choice of text/html and text/plain");
				history.back();
			</script>';	
	}
	
	$cp= $_POST["captcha"];
	if(isset($cp) && !empty($cp) && $_SESSION["code"] == $cp)	
	{
		
		//checking for the image	
		//creating an array to check for the extension
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		//extracting the extension of the file given by the user explode() function 
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);
		//checking for the image file
		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/pjpeg")
		|| ($_FILES["file"]["type"] == "image/x-png")
		|| ($_FILES["file"]["type"] == "image/png"))
		&& ($_FILES["file"]["size"] <  100000)
		&& in_array($extension, $allowedExts)) 
		{
			if ($_FILES["file"]["error"] > 0) 
			{
				echo '
					<script type="text/javascript">
						alert("Return Code: '. $_FILES["file"]["error"] .' ");
						history.back();
					</script>';	 
			}
			else
			{
				if (file_exists("images/" . $_FILES["file"]["name"])) 
				{
					//javascript for this error
					echo '
						<script type="text/javascript">
							alert("Image Already exists: '. $_FILES["file"]["name"] .' ");
							history.back();
						</script>';
				} 
				else
				{
					//$image_date= date("Y/m/d");
					$image_rand =  rand() % 1000000+100000;	
					$image_value = $image_date.$image_rand .$_FILES["file"]["name"];
					move_uploaded_file($_FILES["file"]["tmp_name"],"images/" . $image_value);
				}
		  }
		} 
		else 
		{
			echo '	<script type="text/javascript">
						alert("Invalid Image !! Choose another image");
						history.back();
					</script>';	
		}
		
		//checking the user in database and inserting
		if($fn && $ln && $un && $e1 && $p && $c1 && $image_value)
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
								 role_id,
								 user_profile) 
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
								  '3',
								  '$image_value')";		
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
						$message.="http://weiglevm.cs.odu.edu/~bbokka/proj4/enterActivationCode.php";
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
						$message.="<a href=\"http://weiglevm.cs.odu.edu/~bbokka/proj4/enterActivationCode.php\">Click to Activate your account</a><br>";
						$message.="<em><font face='verdana' color='black'>Please enter the six digit code at the link provided.</font></em><br>" .$activation;
						
						mail($to, $subject, $message, $headers);
					}
					header("Location: niceMessages.php?action=$page");
					
				}
				else
				{
					echo'
						<script type="text/javascript">
							alert("ERROR in sending the email");
							history.back();
						</script>';
				}
			}
			else
			{
				//when the email is already registered
				echo'
					<script type="text/javascript">
						alert("The email address is already registered");
						history.back();
					</script>';
			}
		}
		else
		{
		// when the user has NOT provided all the neccessary arguments
			echo '
				<script type="text/javascript">
					alert("Please TRY again something is WRONG in filling the form");
					history.back();
				</script>';
		}
	}
	else
	{
		echo '
			<script type="text/javascript">
				alert("The CAPTCHA you entered is Incorrect!!");
				history.back();
			</script>';	
	}
	
?>
