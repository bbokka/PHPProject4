<?php
	session_start();
	require_once('config.php');
?>
<?php
	
	$categoryNumber=$_SESSION['category'];
	$whoPosted=$_SESSION['login_id'];
	
	$date= date("Y/m/d H:i:s");
	$forumDes=$_POST['forum'];
	
	if (empty($_POST['forum']))
	{
	?>
		<script type="text/javascript">
			alert("Forum Name Cannot Be Empty");
			history.back();
		</script>	
	<?php
	}
	else
	{
		$query = "INSERT INTO
						P3_thread
							(thread_id,
							 thread_name,
							 thread_date,
							 thread_cat,
							 thread_posted_by) 
						VALUES('',
							  '$forumDes',
							  '$date','$categoryNumber',
							  '$whoPosted')";
		$result= mysql_query($query) or die ("Unable to verify user because " . mysql_error());
		header("Location: showCategory.php?category_id=$categoryNumber");
	}
?>