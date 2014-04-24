<?php
	session_start();
	require_once('config.php');

	//session values for all the category and thread and user
	$categoryNumber = $_SESSION['category'];
	$threadComment = $_REQUEST['thread_id'];
	$whoPosted = $_SESSION['login_id'];
	
	$sql="select 
			is_suspended,
			Is_archived
		 from 
			P4_users
		where 
			id='$whoPosted'";
	$result = mysql_query($sql) or die ("Unable to verify user because " . mysql_error());
	$row = mysql_fetch_assoc($result);
	$suspend = $row['is_suspended'];
	$deleted_user = $row['Is_archived'];
	
	$sql1="select 
			is_freezed,
			`is_archived`
		 from 
			P4_threads
		where 
			thread_id='$threadComment'";
			
	$result1 = mysql_query($sql1) or die ("Unable to verify user because " . mysql_error());
	$row1 = mysql_fetch_assoc($result1);
	$freeze=$row1['is_freezed'];
	$thread_flag=$row1['is_archived'];
	
	$date= date("Y/m/d H:i:s A");
	
	
	if($thread_flag==0)
	{
		if( $suspend == 0 && $deleted_user==0)
		{
			if( $freeze == 0)
			{
				$post_content = mysql_real_escape_string($_POST['comment']);
				if (!empty($post_content))
				{
				
					
					$query = "
							INSERT INTO  
								P4_posts
								(post_content,
								date_created, 
								thread_id, 
								posted_by,
								date_last_modified, 
								last_modified_by, 
								is_archived)  
							VALUES 
								('$post_content',
								'$date',
								$threadComment,
								$whoPosted,
								'$date',
								$whoPosted,
								0)";
					$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
					header("Location: extractPost.php?thread_id=".$threadComment);
				} 
				else 
				{
					echo '
						<script type="text/javascript">
							alert("Post cannot be empty!");
							history.back();
						</script>
					';	
				}
			}
			else
			{
				echo '
					<script type="text/javascript">
						alert("The Thread has freezed!");
						history.back();
					</script>
				';
			}
		}
		else
		{
			echo '
				<script type="text/javascript">
					alert("You are not eligible to post. Please contact the administrator!");
					history.back();
				</script>
			';
		}
	}
	else
	{
		echo '
			<script type="text/javascript">
				alert("YOU CANNOT POST SINCE THREAD HAS BEEN DELETED");
				history.back();
			</script>
		';
	}
?>
 