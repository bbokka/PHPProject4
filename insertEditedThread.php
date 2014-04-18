<?php
	//<!-- retreive the comment on the post and insert it into the post table-->
	session_start();
	require_once('config.php');
?>
<?php
	
	$threadEdited 	= $_POST['threadEdited'];	
	$date 			= date("Y/m/d H:i:s");
	$threadid 		= $_SESSION['thread_id'];
	$modified_by 	= $_SESSION['login_id'];
	$category_id	= $_REQUEST['category_id'];
	
		if (!empty($_POST['threadEdited']))
		{
			$query  ="UPDATE
						P4_threads
					SET 
						thread_name = '$threadEdited',
						date_last_modified = '$date',
						last_modified_by = $modified_by
					WHERE 
						thread_id = '$threadid'";
			$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
			header("Location: showThread.php?category_id=$category_id");
		} 
		else 
		{
		?>
			<script type="text/javascript">
				alert("Thread cannot be empty");
				history.back();
			</script>
		<?php
		}
 ?>
 
