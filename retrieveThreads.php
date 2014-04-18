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
				$no_categories = 1;
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
	if(!$no_categories)
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
					AND T.posted_by = U.id";
		
		$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
		while($row = mysql_fetch_assoc($result))
		{		
			if($row['is-archived'] == 0)
			{
			?>
				<div id="topic_wrapper" style="width:100%; max-width:1024px; min-height:50px; padding:10px;-webkit-border-radius: 10px;-moz-border-radius: 10px;box-shadow: 10px 10px 5px #888888;	border-radius: 10px; background-color:white; margin-bottom : 5px;">
					<div id="topic_title" style="min-width:300px;width:300px;float:left;">
						<h5> 
							<a style="color:green!important" href="extractPost.php?thread_id=<?php print $row['thread_id'];?>".> 
								<?php print $row['thread_name'];?> 
							</a>
						</h5> 
					</div>	
				</div>
				<div id="topic" style="text-align: right; width: 200px;float:right;">
				<?php
					echo "<h5> Created: ".$row['creation_date']."</h5>";
					echo "<h5> Created By: ".$row['fname']."</h5>";
					echo "<h5> Last Modified: ".$row['date_last_modified']."</h5>";
				?>
				</div>
				<div id="topic_edit" style="text-align: right; width: 200px;float:right;">
				<?php
				if($_SESSION['rank']<3 || $_SESSION['rank']==4)
				{
					?>
						<form action="editThread.php" method="post">
						<input type="hidden" name="thread_id" value="<? echo $row['thread_id']; ?>" />
						<input class="btn" type="submit" value="Edit Topic" />
						</form>
					<?php
				}//end if
				?>
				</div>
				
				<div id="topic_delete" style="text-align: right; width: 200px;float:right;">
				<?php
				if($_SESSION['rank']<3 || $_SESSION['rank']==4)
				{
					?>
						<form action="deleteThread.php" method="post">
						<input type="hidden" name="thread_id" value="<? echo $row['thread_id']; ?>" />
						<input type="hidden" name="category_id" value="<? echo $category; ?>" />
						<input class="btn" type="submit" value="Delete Topic" />
						</form>
					<?php
				}//end if
				?>
				</div>
				<div id="topic_replies" style="text-align: right; width: 200px;float:right;">
				<?php
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
					echo '<h5> Replies: '.$row2['no_of_replies'].'</h5>';
				?>
				</div>
				
				<div style="clear: both;">&nbsp;</div>
				</div>
				<?php
			}	
			else
			{
			?>	
				<div id="topic_wrapper" style="width:100%; max-width:1024px; min-height:50px; padding:10px;-webkit-border-radius: 10px;-moz-border-radius: 10px;box-shadow: 10px 10px 5px #888888;	border-radius: 10px; background-color:white; margin-bottom : 5px;">
					<div id="topic_title" style="min-width:300px;width:300px;float:left;">
						<h5> <?php print $row['thread_name'];?> </h5>
					</div>
					<div id="topic_edit" style="text-align: right; width: 200px;float:right;">
						<h5> Topic has been Deleted </h5> 
					</div>
				</div>
			<?
			}
	
		}
	}
?>
		
		
		
		
		
		
		
		
		
		
		