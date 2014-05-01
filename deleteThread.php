<?php
	session_start();
	require_once('config.php');
?>
<?php
	$date 			= date("Y/m/d H:i:s");
	$threadid		= $_REQUEST['thread_id'];
	$modified_by 	= $_SESSION['login_id'];
	$category_id	= $_REQUEST['category_id'];
	
	$query = "	UPDATE
					P4_threads
				SET 
					`is_archived` = 1,
					`last_modified_by` = $modified_by,
					date_last_modified = '$date'
				WHERE 
					thread_id = $threadid ";
	$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
	header("Location: showThread.php?category_id=$category_id");
?>
	