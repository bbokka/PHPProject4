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
				//$post_content = mysql_real_escape_string($_POST['comment']);
				$post_content = $_POST['comment'];
				$post_content = nl2br($post_content);
				$post_content = mysql_real_escape_string($post_content);
				
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
					////for pagination
	
					//query to get the number of posts in that thread	
					$query="SELECT
								count(post_id)
							FROM 
								P4_posts 
							WHERE 
								thread_id='$threadComment'";
					$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
					$row=mysql_fetch_array($result);
					$rows=$row[0];
					
					 //query to set the page limit value
					$query1="SELECT 
								value AS limit_value
							FROM 
								P4_setting
							WHERE
								Type_unique = 'Pagination_limit'";
					$result1 = mysql_query($query1) or die ("Unable to verify user because " . mysql_error());
					$row1=mysql_fetch_array($result1);
					$page_rows = $row1['limit_value'];
					
					$last = ceil($rows/$page_rows);

					////
					header("Location: extractPost.php?thread_id=".$threadComment. "&pn=".$last);//addpage
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
 