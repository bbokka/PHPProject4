<?php
	//<!-- retreive the comment on the post and insert it into the post table-->
	session_start();
	require_once('config.php');
?>
<?php
	
	$threadEdited=$_POST['threadEdited'];
	
	$date= date("Y/m/d H:i:s");
	$threadid= $_SESSION['thread_id'];
	
	//query the database
	
		if (!empty($_POST['threadEdited']))
		{
			$query  ="UPDATE
						P3_thread
					SET 
						thread_name='$threadEdited',
						modify_thread='$date'
					WHERE 
					thread_id='$threadid'";
			$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
			header("Location: showCategory.php");
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
	
	/*else
	{
		?>
			<script type="text/javascript">
				alert("Post has been deleted you cannot edit the post");
				history.back();
			</script>
		<?php
	}*/
	
 ?>
 
