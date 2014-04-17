<?php
	session_start();
	require_once('config.php');
?>
<?php
	$page="active";
	$ve = "";
	$vc ="";
	$ee=mysql_real_escape_string($_POST['verifyEmail']);
	if (empty($ee))
	{
	?>
		<script type="text/javascript">
			alert("Please enter the email used for the registration ");
			history.back();
		</script>	
	<?php
	}
	else
	{
		$ve=$ee;
		//echo "<br>4..".$ve;
	}
	?>
	<?php
	//checking for passcode
	$ne=mysql_real_escape_string($_POST['verifyActivation']);
	if (empty($ne))
	{
	?>
		<script type="text/javascript">
			alert("Please enter the passcode recieved in the email");
			history.back();
		</script>	
	<?php
	}
	else
	{
		if(is_numeric($ne))
		{
		$vc=$ne;
		
		}
		else
		{
			echo "<script>alert('Only numeric values must be entered'); location.href='enterActivationCode.php';</script>";
		}
		//echo "<br>4..".$vc;
	}
	?>
	<?php
	
		$query = "SELECT 
					username,
					Is_verified
				FROM 
					P4_users
				WHERE 
					activationkey='$vc' 
				AND 
					email= '$ve'";
		$result= mysql_query($query) or die ("Unable to verify email because " . mysql_error());
		$count=mysql_num_rows($result);
		//if the user email and the activation key matched then first check for the flag if it is 1 then the user is alredy registerd and say your
		// already registered  else set the flag and say account has been activated please login
		if( $count== 1)
		{	
			$row = mysql_fetch_assoc($result);
			$user= $row['username'];
			$flag= $row['Is_verified'];
			
			//alter the table by setting the flag
			//echo "the values of user name and flag".$user.$flag;
			if($flag==1)
			{
				
				//avoiding the user to change the database
				//echo "Your account has already been activated Please login into the forum ";
				//header("Location: niceMessagesActivation.php");
				?>
				<script type="text/javascript">
					alert("Your account has already been activated Please login into the forum");
					window.location.href = "login.php";
				</script>	
			<?php	
			}
			else
			{	
				$flag=1;
				$query ="UPDATE P4_users SET Is_verified='$flag' WHERE activationkey='$vc'";
				$result= mysql_query($query) or die ("Unable to verify email because " . mysql_error());
				header("Location: niceMessages.php?action=$page");
			}			
		}
		//if the user email and the activation key doesnt match
		else
		{	
		?>
			<script type="text/javascript">
				alert("SOMETHING WENT WRONG ...Your account has not been activated");
				history.back();
			</script>	
		<?php
		}
		?>