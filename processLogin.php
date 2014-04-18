<?php
	session_start();
	require_once('config.php');	
?>
<?php
	
	$uname	= mysql_real_escape_string($_POST['emailId']);
	$pwd	= mysql_real_escape_string($_POST['pwd']);
	
	$pwd=MD5($pwd);
	$id=1;
	
	//echo "the pwd is ".$pwd;
	//querying the database
	$query =" 	SELECT id,
					   email,
					   fname,
					   password,
					   role_id
				FROM 
					P4_users 
				WHERE 
					email = '$uname'
					AND	password = '$pwd'
					AND Is_verified = 1
					AND Is_archived = 0";
								
	$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
	$count = mysql_num_rows($result);
	// if there is a match
	if ($count == 1)
	{
		$row = mysql_fetch_assoc($result);
		
		$_SESSION['name'] 		= $row['fname'];
		$_SESSION['login_id'] 	= $row['id'];
		$_SESSION['rank']		= $row['role_id'];
		$_SESSION['admin']	 	= 0;
		$_SESSION['moderator']	= 0;
		$_SESSION['usr']		= 0;
		
		if(($_SESSION['rank']==1) || ($_SESSION['rank']==4))
		{
			$_SESSION['admin']=1;
			$_SESSION['usr']=1;
		}
		 else if($_SESSION['rank']==2)
		{
			$_SESSION['moderator']=1;
			$_SESSION['usr']=1;
		}
		
		else if($_SESSION['rank'] == 3)
		{
			$_SESSION['usr']=1;
		} 
		$hour = time() + 3600;
		if(isset($_POST['remember']) && $_POST['remember'] == "1") 
		{
			setcookie('ID_my_site', $_POST['emailId'], $hour);
			setcookie('Key_my_site', $_POST['pwd'], $hour);
		}
		header("Location: index.php");
	}
	//else redirect to the page
	else
	{
		$_SESSION['login_id'] = 0;
		header("Location: login.php");
	}
	
?>