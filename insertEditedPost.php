<?php
	//<!-- retreive the comment on the post and insert it into the post table-->
	session_start();
	require_once('config.php');

	$postEdited=$_POST['commentEdited'];
	
	$date  = date("Y/m/d H:i:s");
	$postid= $_SESSION['post_id'];
	
	//echo "".$_SESSION['$del_flag'];
	//just to make sure that the user has been deleted by the admin and the same time the user is trying to post the comment.
	if($_SESSION['$del_flag']==0)
	{
		if (!empty($_POST['commentEdited']))
		{
				$query  ="UPDATE
							P4_posts
						SET 
							post_content='$postEdited',
							date_last_modified='$date'
						WHERE 
						post_id='$postid'";
				$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
				header("Location: extractPost.php");
		} 
		else 
		{
		?>
			<script type="text/javascript">
				alert("post cannot be empty");
				history.back();
			</script>
		<?php
		}

	}
	else
	{
		?>
			<script type="text/javascript">
				alert("something went wrong you cannot edit the post");
				history.back();
			</script>
		<?php
		
	}
	
 ?>
 
