<?php
	$current = $_POST['current'];
	session_start();
	$user = $_SESSION['login_id'] ;
	echo '<li '; if($current == 1) echo 'class="active"'; echo '><a href="index.php">Home</a></li>';
	if(isset($_SESSION['login_id']) && $_SESSION['login_id'] !=0)
	{
		if(isset($_SESSION['rank']))
		{
			if($_SESSION['rank']!=3 )
			{
				echo '<li '; if($current == 4) echo 'class="active"'; echo '><a href="showCategory.php">Forums</a></li>
				<li '; if($current == 5) echo 'class="active"'; echo '><a href="AllFeatures.php"> Control Panel </a> </li>
				<li '; if($current == 6) echo 'class="active"'; echo '><a href="userProfile.php?useraction='.$user.'">My Profile</a> </li>
				<li '; if($current == 7) echo 'class="active"'; echo '><a href="signout.php">Logout</a> </li>'
				;
			}
			else
			{
				echo '<li '; if($current == 4) echo 'class="active"'; echo '><a href="showCategory.php">Forums</a></li>
				<li '; if($current == 6) echo 'class="active"'; echo '><a href="userProfile.php?useraction='.$user.'">My Profile</a> </li>
				<li '; if($current == 7) echo 'class="active"'; echo '><a href="signout.php">Logout</a> </li>';
			}
		}
	}
	else
	{
		echo '<li '; if($current == 2) echo 'class="active"'; echo '><a href="login.php">Login</a> </li>';
		echo '<li '; if($current == 3) echo 'class="active"'; echo '><a href="registerUser.php">Register</a> </li>';
	}
	
	unset($_POST['current']);
?>