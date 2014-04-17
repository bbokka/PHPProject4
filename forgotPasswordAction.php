<?php 
	session_start();
	require_once('config.php');
?>

<?php
	$e2="";
	$p11="";
	$p12="";
	$page="forgot";
	
	$e1=mysql_real_escape_string($_POST['email']);
	if (empty($e1))
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
		$e2=$e1;
		//$_SESSION['firstname']= $e2;
		//echo "<br>4..".$e2;
	}
	?>
	<?php
	//checking the password1
	$eee=mysql_real_escape_string($_POST['verifyPass1']);
	if (empty($eee))
	{
	?>
		<script type="text/javascript">
			alert("Please enter the password");
			history.back();
		</script>	
	<?php
	}
	else
	{
		$p11=$eee;
		//$_SESSION['firstname']= $p11;
		//echo "<br>4..".$p11;
	}
	?>
	<?php
	//checking the password2
	$rrr=mysql_real_escape_string($_POST['verifyPass2']);
	if (empty($rrr))
	{
	?>
		<script type="text/javascript">
			alert("Please Re-enter the password");
			history.back();
		</script>	
	<?php
	}
	else
	{
		$p12=$rrr;
		//$_SESSION['firstname']= $p12;
		//echo "<br>4..".$p12;
	}
	?>
	<?php
		if ($p11== $p12)
		{
			$p=$p12;
			$_SESSION['verifyPass2']= $p;
			$p=MD5($p);
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
		$query= "UPDATE 
					P4_users 
				SET 
					password='$p' 
				WHERE 
					email='$e2'";
		$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
		header("Location: niceMessages.php?action=$page");
	
?>
