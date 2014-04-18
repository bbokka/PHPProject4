<?php
	session_start();
	require_once('config.php');
	
	if(isset($_REQUEST['category_id']))
	{
		$category = $_REQUEST['category_id'];
		
		if(!is_numeric($category))
		{
			echo "	<script> 
						alert('Sorry something went wrong! Please try again'); 
						location.href='showCategory.php';
					</script> ";
		}
		else 
		{
			$query = "select * from P4_threads where category_id = '$category'";
			$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
			$num_rows = mysql_fetch_array($result);
			if($num_rows == 0)
			{
				$have_no_threads = 1;
				echo "	<div class=\"error\"> 
							No topics available for this category.
						</div>";
			}
			else if($num_rows>0)
			{
				$category = mysql_real_escape_string($category);
				$_SESSION['category'] = $category;
			}
		}
	}
	if(!$have_no_threads)
	{
		$query  ="	
				SELECT 
					T.thread_id,
					T.thread_name,
					T.creation_date,
					U.fname,
					T.`is-archived`,
					T.date_last_modified
				FROM 
					P4_threads T,
					P4_users U
				WHERE 
					T.category_id = '$category' 
					AND T.posted_by = U.id 
				ORDER BY 
					T.`is-archived`";
		
		$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
		while($row = mysql_fetch_assoc($result))
		{		
			echo '
				<div class="topicContainer">
					<div class="topicName">
						<a href="extractPost.php?thread_id='.$row['thread_id'].'"> 
							'.$row['thread_name'].' 
						</a>
					</div>
					<div class="topicReplies">
					';
						$thread_id = $row['thread_id'];
						$query1="SELECT
									count(post_id)
								 AS
									no_of_replies
								FROM 
									P4_posts 
								WHERE 
									thread_id = $thread_id";
						$result2 = mysql_query($query1) or die ("Unable to verify user because " . mysql_error());
						$row2 = mysql_fetch_assoc($result2);
						echo $row2['no_of_replies'];
					
			echo '	</div>
					<div class="topicActions">
					';
					if($row['is-archived'] == 0)
					{
						if($_SESSION['rank']!=3)
						{
							// Edit Button
							echo '	<form action="editThread.php" method="post">
										<input type="hidden" name="thread_id" value="'.$row['thread_id'].'"/>
										<input class="btn" type="submit" value="Edit" />
									</form>';
						
							// Delete Button
							echo '	<form action="deleteThread.php" method="post">
										<input type="hidden" name="thread_id" value="'.$row['thread_id'].'"/>
										<input type="hidden" name="category_id" value="'.$category.'"/>
										<input class="btn" type="submit" value="Delete" />
									</form>';
						}
					}
					else
					{
						echo 'Topic has been deleted';
					}
			echo '	</div>
					<div class="topicActionDescription">
						<h5> Created: '.$row['creation_date'].'</h5>
						<h5> Created By: '.$row['fname'].'</h5>
						<h5> Last Modified: '.$row['date_last_modified'].'</h5>
					</div>
				</div>';
		}	
	}
?>
		
		
		
		
		
		
		
		
		
		
		