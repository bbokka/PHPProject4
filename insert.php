<?php
	session_start();
	require_once('config.php');
?>
<?php
	
	//session values for all the category and thread and user
	$categoryNumber=$_SESSION['category'];
	$threadComment=$_SESSION['thread'];
	$whoPosted=$_SESSION['login_id'];
	
	$sql="select 
			suspend
		 from 
			P3_user_login
		where 
			login_id='$whoPosted'";
	$result = mysql_query($sql) or die ("Unable to verify user because " . mysql_error());
	$row = mysql_fetch_assoc($result);
	$suspend=$row['suspend'];
	
	$sql1="select 
			freeze,
			thread_flag
		 from 
			P3_thread
		where 
			thread_id='$threadComment'";
			
	$result1 = mysql_query($sql1) or die ("Unable to verify user because " . mysql_error());
	$row1 = mysql_fetch_assoc($result1);
	$freeze=$row1['freeze'];
	$thread_flag=$row1['thread_flag'];
	
	$date= date("Y/m/d H:i:s A");
	
	//echo "suspend".$suspend;
	//echo "freeze".$freeze;
	if($thread_flag==0)
	{
		if( $suspend == 0 && $freeze == 0)
		{
			///echo "suspend".$_SESSION['suspend'];
			//echo "".$_SESSION['freeze'];
			$c = mysql_real_escape_string($_POST['comment']);
			if (!empty($c))
			{
			
				
				$query = "INSERT INTO  
							P3_posts(post_id,post_content,post_date,   post_topic,post_by)  
						VALUES      (' '    ,'$c','$date','$threadComment','$whoPosted')";
						
				$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
				header("Location: extractPost.php");
			} 
			else 
			{
			?>
			<script type="text/javascript">
					alert("POST cannot be EMPTY");
					history.back();
			</script>
				
			<?php	
			}
		}
		else
		{
		?>
			<script type="text/javascript">
				alert("YOU CANNOT POST THE POSTS");
				history.back();
			</script>
		<?php
		}
	}
	else
	{
		?>
			<script type="text/javascript">
				alert("YOU CANNOT POST SINCE THREAD HAS BEEN DELETED");
				history.back();
			</script>
		<?php
	}
	?>
 