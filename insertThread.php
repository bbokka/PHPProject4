<?php
	session_start();
	require_once('config.php');
	
	$categoryId 	= $_REQUEST['category_id'];
	$posted_by 		= $_SESSION['login_id'];
	$date 			= date("Y/m/d H:i:s");
	$thread_name	= $_POST['forum'];
	
	if (empty($_POST['forum']))
	{
		echo ' 	<script type="text/javascript">
					alert("Forum Name Cannot Be Empty");
					history.back();
				</script> ';
	}
	else
	{
		$query = "	INSERT INTO 
						`P4_threads` 
							(`thread_name`, 
							`creation_date`, 
							`posted_by`, 
							`date_last_modified`, 
							`last_modified_by`, 
							`category_id`, 
							`is_freezed`, 
							`is-archived`) 
						VALUES 
							('$thread_name', 
							'$date', 
							$posted_by, 
							'$date', 
							$posted_by, 
							$categoryId, 
							0, 
							0) ";
		$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
		header("Location: showThread.php?category_id=$categoryId");
	}
?>