<?php
	session_start();
	require_once('config.php');
?>
<?php
	
	if(isset($_REQUEST['category_id']))
	{
		$category=$_REQUEST['category_id'];
		
		if(!is_numeric($category))
		{
			echo "<script>alert('Only numeric values'); location.href='showCategory.php';</script>";
		}
		else 
		{
			$query="select * from P4_threads where category_id = '$category'";
			$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
			$num_rows=mysql_fetch_array($result);
			if($num_rows ==0)
			{
				echo "<script>alert('NO Category are avialable'); location.href='showCategory.php';</script>";
			}
			else if($num_rows>0)
			{
				$category=mysql_real_escape_string($category);
				$_SESSION['category']=$category;
			}
		}
	}
		$query  ="	SELECT 
						thread_id,
						thread_name,
						creation_date,
						fname,
						thread_flag,
						modify_thread
					FROM P4_thread,
						 P4_user_login
					WHERE thread_cat='$category' 
					AND thread_posted_by=login_id";
		
		$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
		echo '<h3 style="color:blue!important">Forum Topics:</h3>';
		while($row = mysql_fetch_assoc($result))
		{		
			if($row['thread_flag']==0)
			{
			?>
				<div id="topic_wrapper" style="width:100%; max-width:1024px; min-height:50px; padding:10px;-webkit-border-radius: 10px;-moz-border-radius: 10px;box-shadow: 10px 10px 5px #888888;	border-radius: 10px; background-color:white; margin-bottom : 5px;">
				<div id="topic_title" style="min-width:300px;width:300px;float:left;">
				<h5><a style="color:green!important" href="extractPost.php?thread_id=<?php print $row['thread_id'];?>".> <?php print $row['thread_name'];?> </a> 
				</div>
				<div id="topic" style="text-align: right; width: 200px;float:right;">
				<?php
					
					echo '<h5><a style="color:blue!important" href="#">Forum Topic edited on &nbsp<br>'.$row['modify_thread'].'&nbsp<br>'.$row['fname'].'<h5>';
					
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
						<input class="btn" type="submit" value="Delete Topic" />
						</form>
					<?php
				}//end if
				?>
				</div>
				<div id="topic_replies" style="text-align: right; width: 200px;float:right;">
				<?php
					$temp = $row['thread_id'];
					$query1="SELECT
								count(post_id)
							 AS
								no_of_replies
							FROM 
								P4_posts 
							WHERE 
								post_topic=$temp";
					$result2 = mysql_query($query1) or die ("Unable to verify user because " . mysql_error());
					$row2 = mysql_fetch_assoc($result2);
					echo '<h5><a style="color:blue!important" href="#"> Replies: '.$row2['no_of_replies'].'<h5>';
				?>
				</div>
				
				<div style="clear: both;">&nbsp;</div>
				</div>
				<?php
			}	
			else
			{
			?>	<div id="topic_wrapper" style="width:100%; max-width:1024px; min-height:50px; padding:10px;-webkit-border-radius: 10px;-moz-border-radius: 10px;box-shadow: 10px 10px 5px #888888;	border-radius: 10px; background-color:white; margin-bottom : 5px;">
				<div id="topic_title" style="min-width:300px;width:300px;float:left;">
				<h5><a style="color:green!important" href="#"> <?php print $row['thread_name'];?> </a> 
				</div>
				<div id="topic_edit" style="text-align: right; width: 200px;float:right;">
				<h5><a style="color:blue!important" href="#"> Topic has been Deleted </a> 
				</div>
				</div>
			<?
			}
	
		}
	
?>
		
		
		
		
		
		
		
		
		
		
		