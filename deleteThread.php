<?php
	session_start();
	require_once('config.php');
?>
<?php
	$date= date("Y/m/d H:i:s");
	$threadid= $_REQUEST['thread_id'];
	//$thread_flag=1;
	$query  ="UPDATE
					P4_threads
				SET 
					is_archived='1',
					last_modified_by='$date'
				WHERE 
				thread_id='$threadid'";
	$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
	header("Location: showCategory.php");
?>
	