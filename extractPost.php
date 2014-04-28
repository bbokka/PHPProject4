<?php
	session_start();
	require_once('config.php');
?>

<!DOCTYPE html>
<html>
<head>
<title>The Art of Cooking</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
<!--<link rel="stylesheet" href="css/grid.css" type="text/css" media="screen"> -->
<link rel="icon" href="images/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link href="http://fonts.googleapis.com/css?family=PT+Serif+Caption:400,400italic" rel="stylesheet" type="text/css">
<script src="js/jquery-1.7.1.min.js" ></script>
<script src="js/superfish.js"></script>
<script src="js/forms.js"></script>
<style>
	.category_navigation
	{
		background: #92C7C7;
		width: 100%;
		padding: 10px;
		margin: 2px auto;
		
		-webkit-border-radius: 10px;
		-moz-border-radius: 10px;
		border-radius: 10px;
	}
	.category_navigation a:hover
	{
		text-decoration: underline;
	}
	.recent_post_bar
	{
		width: 100%;
		padding: 10px;
		background: #FBB917;
		color: white;
		
		-webkit-border-radius: 10px;
		-moz-border-radius: 10px;
		border-radius: 10px;
	}
	.post_container
	{
		background: white;
		width: 100%;
		display: inline-block;
		padding: 10px;
		margin: 2px auto;
		
		-webkit-border-radius: 10px;
		-moz-border-radius: 10px;
		border-radius: 10px;
		
	}
	.non_actions_part
	{
		width: 95%;
		display: inline-block;
	}
	.post_Actions
	{
		width: 4%;
		display: inline-block;
	}
	.non_actions_part div
	{
		display: inline-block;
	}
	.post_owner_details
	{
		width: 20%;
		min-height: 100px;
	}
	.post_owner_details span , .post_Audits span
	{
		display: block;
	}
	.post_details
	{
		width: 78%;
		margin-left: auto;
		margin-right: auto;
	}
	.post_content, .post_Audits
	{
		width: 100%;
	}
	.post_content
	{
		min-height: 100px;
		/*border-top: 1px solid red;  */
		background: #92C7C7;
		border-radius: 10px;
		padding: 2px;
	}
	.post_Actions input[type="submit"]
	{
		width: 36px;
		height: 36px;
		border-radius: 50%;
		background-size:36px 36px;
		border: none;
	}
	.post_Actions div
	{
		display: inline-block;
	}
	.post_Actions .edit_button
	{
		background: url("images/edit_button.png") no-repeat;
		background-color: #92C7C7;
	}
	.post_Actions .delete_button
	{
		background: url("images/delete_button.png") no-repeat;
		background-color: #FBB917;
	}
</style>
</head>
<body>
<header>
  <div class="line-top"></div>
  <div class="main">
    <div class="row-top">
      <h1><a href="index.html"><p><b><em><font face="verdana" color="OrangeRed">Art of Cooking</font></em></b></p></a></h1>
      <nav>
       <ul class="sf-menu">
			<?php 
				$_POST['current'] = 4;
				include 'navBar.php'; 
			?>
        </ul>
      </nav>
      <div class="clear"></div>
		<?php
			if(isset($_SESSION['login_id']) && ($_SESSION['login_id'] != 0))
			{
				echo '<h5 style="color: green;" align="right"> You are logged in as: '. $_SESSION['name'] .' </h5>';
			}
			else
			{
				header("Location: login.php");
			}
		?>
    </div>
  </div>
</header>
	
<section id="content">
<div sytle="margin : 0px auto">
<div class="main">
	<?php 
	//getting on the session cat and thread values
	if(isset($_REQUEST['thread_id']))
	{
		$thread = $_REQUEST['thread_id'];
	}
	else
	{
		$thread = $_SESSION['thread'];
	}
	
	if(!is_numeric($thread))
	{
		echo "	<script> 
					alert('Sorry something went wrong!'); 
					location.href='showCategory.php'; 
				</script> ";
	}
	else 
	{
		$query="select * from P4_posts where thread_id = '$thread'";
		$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
		$num_rows = mysql_fetch_array($result);
		if($num_rows ==0)
		{
			$have_no_posts = 1;
			echo "	<div class=\"error\"> 
						This topic has no posts.
					</div>";
		}
		else if($num_rows>0)
		{
			$thread = mysql_real_escape_string($thread);
			$_SESSION['thread'] = $thread;
		}
	}
	
	if(!$have_no_posts)
	{
		$cate = $_SESSION['category'];
		$cate = mysql_real_escape_string($cate);
		
		//query to get the number of posts in that thread	
		$query="SELECT
					count(post_id)
				FROM 
					P4_posts 
				WHERE 
					thread_id='$thread'";
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
		
		if($last < 1)
		{
			$last = 1;
		}
		
		$pagenum = 1;
		if(isset($_GET['pn']))
		{
			$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
		}
		
		if ($pagenum < 1) 
		{ 
			$pagenum = 1; 
		} 
		else if ($pagenum > $last) 
		{ 
			$pagenum = $last; 
		}
		$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
		
		//select the data from the data base basing on the limit value
		$retreive="
					SELECT 
						A.post_content, 
						A.role_name, 
						A.role_id, 
						A.date_created, 
						A.is_archived, 
						A.fname, 
						A.user_id, 
						A.date_last_modified, 
						A.modified_by, 
						A.post_id,
						B.fname AS Modified_post_by,
						B.user_profile
					FROM   
						(SELECT P.post_id, 
								P.post_content, 
								UR.name aS role_name, 
								U.role_id, 
								P.date_created, 
								U.fname, 
								U.username, 
								P.date_last_modified, 
								P.is_archived, 
								U.id AS user_id, 
								P.last_modified_by AS modified_by 
						FROM   
							P4_posts P, 
							P4_users U, 
							P4_roles UR 
						WHERE  
								P.thread_id = $thread 
								AND U.role_id = UR.id 
								AND U.id = P.posted_by) 
						A, 
						P4_users B 
					WHERE  
						A.modified_by = B.id
					ORDER BY
						A.is_archived, 
						A.date_created 
					ASC $limit";
		$result1 = mysql_query($retreive) or die ("Unable to verify user because " . mysql_error());
		$paginationCtrls = '';
		if($last != 1) 
		{
			if ($pagenum > 1) 
			{
				$previous = $pagenum - 1;
				$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF']. '?pn='.$previous.'">Previous</a> &nbsp; &nbsp; ';
				
				for($i = $pagenum-4; $i < $pagenum; $i++) 
				{
					if($i > 0) 
					{
						$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
					}
				}
			}
			
			$paginationCtrls .= ''.$pagenum.' &nbsp; ';
			
			for($i = $pagenum+1; $i <= $last; $i++) 
			{
				$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
				if($i >= $pagenum+4)
				{
					break;
				}
			}
			
			
			if ($pagenum != $last) 
			{
				$next = $pagenum + 1;
				$paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF']. '?pn='.$next.'>Next</a> ';
			}
		}
		$list = '';
		
		$retrieveCategoryNameQuery = "SELECT
										cat_name, 
										id
									FROM
										P4_categories 
									WHERE 
										id = $cate 
										AND Is_archived=0";
		$CategoryName_res = mysql_query($retrieveCategoryNameQuery) or die(mysql_error());
		while ($CategoryName_row = mysql_fetch_object($CategoryName_res)) 
		{
			$CategoryName=$CategoryName_row->cat_name;
			$CategoryID=$CategoryName_row->id;
		}

		$retrieveThreadNameQuery = "SELECT
										thread_name,
										thread_id
									FROM
										P4_threads 
									WHERE 
										thread_id = $thread";
		$ThreadName_res = mysql_query($retrieveThreadNameQuery) or die(mysql_error());
		while ($ThreadName_row = mysql_fetch_object($ThreadName_res)) 
		{
			echo '<div class="category_navigation" >';
			echo '<h3><a href="showCategory.php" style="color:white">Category</a>::';
			
			echo '<a href="showThread.php?category_id='.$CategoryID.'" style="color:white">'.$CategoryName.'</a>::';
			
			echo '<a href="extractPost.php?thread_id='.$ThreadName_row->thread_id.'" style="color:white">'.$ThreadName_row->thread_name.' </a>';
			echo '</h3>
				 </div>';
			
		}
		echo '<div class="recent_post_bar" >';
		echo '<h3 style="color:white">Recent Posts</h3>';
		echo '</div>';
		
		//displaying all the fetched data from the data base
		while($row = mysql_fetch_assoc($result1))
		{
			echo '
			<div class="post_container">
			<div class="non_actions_part">
				<div class="post_owner_details">
					<span> <img alt="" src="images/'.$row['user_profile'].'" width="140" height="140" ></img> </span>
					<span><a href="userProfile.php?useraction='.$row['user_id'].'" style="color:green"> '.$row['fname'].' </a> </span>
					<span> '.$row['role_name'].'</span>
					';
			if($row['role_id'] == 3)
			{
				echo '
					<span> User Level:';
						$sql = "
							SELECT 
								U.id, 
								Count(P.post_id) AS Num_posts 
							FROM   
								P4_posts P
								RIGHT JOIN P4_users U ON P.posted_by = U.id 
							GROUP BY username
							";
						$sqlresult = mysql_query($sql) or die ("Unable to verify user because " . mysql_error());
						while($sqlrow = mysql_fetch_assoc($sqlresult))
						{
							if($row['user_id'] == $sqlrow['id'])
							{
								$postCount = $sqlrow['Num_posts'];
								if($postCount==0)
									echo 'No-Life';
								else if($postCount <=5 && $postCount > 0)
									echo 'Newbie';
								else if($postCount<=10 && $postCount>5)
									echo 'Active';
								else
									echo 'Veteran';
							}
						}
				echo ' </span>';
			}
			echo '
					</div>
					<div class="post_details">
						<div class="post_content">
							'.$row['post_content'].'
						</div>
						<div class="post_Audits">
							<span> Created: '.$row['date_created'].'</span>
							<span> Last Modified: '.$row['date_last_modified'].'<br> by '.$row['Modified_post_by'].'</span>
						</div>
					</div>
				</div>
				<div class="post_Actions">
					';
					if($row['is_archived'])
					{
						echo 'This post has been deleted';
					}
					else
					{
						$show_edit_button = 0;
						$show_delete_button = 0;
						if($_SESSION['login_id'] == $row['user_id'])
						{
							$show_edit_button = 1;
						}
						
						if($_SESSION['rank']!=3)
						{
							$show_edit_button = 1;
							$show_delete_button = 1;
						}
						
						/*if(!$show_edit_button && !$show_edit_button)
						{
							echo 'No actions available';
						}*/
						
						//dispalying the edit button for the respective logged in user
						if($show_edit_button)
						{
							echo '
								<div>
									<form action="editPostUser.php" method="post">
										<input type="hidden" name="post_id" value="'.$row['post_id'].'"/>
										<input class="edit_button" type="submit" value="" >
									</form>
								</div>
								';
						}
						//displaying the delete button if login as admin or moderator
						if($show_delete_button)
						{
							echo '
								<div>
									<form action="deletePostAdmin.php" method="post">
										<input type="hidden" name="post_id" value="'.$row['post_id'].'" />
										<input class="delete_button" type="submit" value="" />
									</form>
								</div>
							';
						}
					}
			echo '</div>
			</div>
			
		';
			$_SESSION['del_flag'] = $row['is_archived'];
		}//end while
		
		echo '
		<div>
		   <h4 textcolor="red">'.$paginationCtrls.'</h4>
		</div>
		';
	}
?>
		
		<div class="btns"> 
			<style>
				.post_textarea
				{
					-webkit-border-radius: 10px;
					-moz-border-radius: 10px;
					border-radius: 10px;
					padding: 10px;
					outline: 0;
					width: 60%;
					height: 50px;
				}
			</style>
			<form action="insert.php" name="form" method="post">
				<h5> Please post you comment below </h4>
				<input type="hidden" name="thread_id" value="<?php echo $thread; ?>">
				<textarea class="post_textarea" style="resize: none;" autofocus name="comment" ></textarea>
				</br>
				<input class="btn" type="submit" value="Comment" >
			</form>
		</div>
	</div>
	</div>
</section>
<footer>
  <div class="main">
    <div class="policy">Copyright @ 2014 Art of cooking powered by Babitha Bokka & Vaidehi Putta </div>
    <div class="clear"></div>
  </div>
</footer>
</body>
</html>