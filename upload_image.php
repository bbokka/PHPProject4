<?php
	session_start();
	require_once('config.php');
	//creating an array to check for the extension
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	//extracting the extension of the file given by the user explode() function 
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);
	//$date= date("Y/m/d");
	$image_rand =  rand() % 1000000+100000;	
				

	if ((($_FILES["file"]["type"] == "image/gif")
	|| ($_FILES["file"]["type"] == "image/jpeg")
	|| ($_FILES["file"]["type"] == "image/jpg")
	|| ($_FILES["file"]["type"] == "image/pjpeg")
	|| ($_FILES["file"]["type"] == "image/x-png")
	|| ($_FILES["file"]["type"] == "image/png"))
	&& ($_FILES["file"]["size"] < 20000)
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
				echo '
						<script type="text/javascript">
							alert("Image Already exists: '. $_FILES["file"]["name"] .' ");
							history.back();
						</script>';
			} 
			else
			{
				$value =$date.$image_rand .$_FILES["file"]["name"];
				$image_update_query ="
									UPDATE
										P4_users
									SET 
										user_profile='$value'
									WHERE 
										id= ".$_SESSION['login_id'] ."";
				$result2= mysql_query($image_update_query) or die ("Unable to verify user because " . mysql_error());
				move_uploaded_file($_FILES["file"]["tmp_name"],"images/" . $value);
				header("Location: userProfile.php");
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
?>
