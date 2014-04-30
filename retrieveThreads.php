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
			$query = "	SELECT 
							* 
						FROM
							P4_threads 
						WHERE
							category_id = '$category'";
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
					T.`is_archived` AS T_archived,
					T.date_last_modified
				FROM 
					P4_threads T,
					P4_users U
				WHERE 
					T.category_id = '$category' 
					AND T.posted_by = U.id 
				ORDER BY 
					T.`is_archived`";
		
		$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
		while($row = mysql_fetch_assoc($result))
		{		
			echo '
				<div class="topicContainer">
					<div class="topicName">
					<h5 style="color: green;">';
					if(!$row['T_archived'])
					{
						echo'<a href="extractPost.php?thread_id='.$row['thread_id'].'"> 
							'.$row['thread_name'].' </a>' ;
					}
					else
					{
						echo $row['thread_name'];
					}
					echo '</h5>
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
									thread_id = $thread_id
									AND is_archived=0";
						$result2 = mysql_query($query1) or die ("Unable to verify user because " . mysql_error());
						$row2 = mysql_fetch_assoc($result2);
						echo '<h5 style="color: blue;">';
						echo $row2['no_of_replies'];
						echo '</h5>';
			if($_SESSION['rank']!=3)
			{		
				echo '	</div>
					<div class="topicActions">
					';
					if($row['is_archived'] == 0)
					{
						
							// Edit Button
							echo '	
								<div>
									<form action="editThread.php" method="post">
										<input type="hidden" name="thread_id" value="'.$row['thread_id'].'"/>
										<input class="edit_button" type="submit" value="" />
									</form>
								</div>';
						
							// Delete Button
							echo '	
								<div>
									<form action="deleteThread.php" method="post">
										<input type="hidden" name="thread_id" value="'.$row['thread_id'].'"/>
										<input type="hidden" name="category_id" value="'.$category.'"/>
										<input class="delete_button" type="submit" value="" />
									</form>
								</div>';
						
					}
					else
					{
						echo '<h5 style="color: blue;">';
						echo 'Topic has been deleted';
						echo '</h5>';
					}
			}
			echo '	</div>
					<div class="topicActionDescription">
						<h5 style="color: blue;"> Created By: '.$row['fname'].' <br>
						Created on :'.$row['creation_date'].' <br>
						Last Modified: '.$row['date_last_modified'].'</h5>
					</div>
				</div>';
		}	
	}
?>
		
		