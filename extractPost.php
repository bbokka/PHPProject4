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
		$thread=$_REQUEST['thread_id'];
		
		if(!is_numeric($thread))
		{
			echo "	<script> 
						alert('Only numeric value '); 
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
				$have_no_threads = 1;
				echo "	<div class=\"error\"> 
							This topic is empty.
						</div>";
			}
			else if($num_rows>0)
			{
				$thread=mysql_real_escape_string($thread);
				$_SESSION['thread']=$thread;
			}
		}
	}
	else
	{
		$thread = $_SESSION['thread'];
	}
	
	$cate=$_SESSION['category'];
	$cate=mysql_real_escape_string($cate);
	
	//query to get the number of posts in that thread	
	$query="SELECT
				count(post_id)
			FROM 
				P3_posts 
			WHERE 
				post_topic='$thread'";
	$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
	$row=mysql_fetch_array($result);
	$rows=$row[0];
	
	 //query to set the page limit value
	$query1="SELECT 
				limit_value 
			FROM 
				P3_limit";
	$result1 = mysql_query($query1) or die ("Unable to verify user because " . mysql_error());
	$row1=mysql_fetch_array($result1);
	$page_rows = $row1['limit_value'];
	
	$last = ceil($rows/$page_rows);
	
	if($last < 1)
	{
		$last = 1;
	}
	
	$pagenum = 1;
	if(isset($_GET['pn'])){
		$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
    }
	
	if ($pagenum < 1) { 
		$pagenum = 1; 
	} else if ($pagenum > $last) { 
		$pagenum = $last; 
	}
	
	$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
	
	//select the data from the data base basing on the limit value
	
	$retreive="SELECT 
					post_id,
					post_content,
					title,
					rank_id,
					post_date,
					fname,
					modify_date,
					del_flag
					
				FROM P3_posts,
					P3_user_level,
					P3_user_login 
				WHERE 
					post_topic='$thread' 
				AND
					rank_id=rank and
					login_id=post_by
				ORDER BY
					post_date ASC $limit";
	$result1 = mysql_query($retreive) or die ("Unable to verify user because " . mysql_error());
	
	$paginationCtrls = '';

	if($last != 1){
	
	if ($pagenum > 1) {
        $previous = $pagenum - 1;
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF']. '?pn='.$previous.'">Previous</a> &nbsp; &nbsp; ';
		
		
		
		
		for($i = $pagenum-4; $i < $pagenum; $i++){
			if($i > 0){
		        $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
			}
	    }
    }
	
	$paginationCtrls .= ''.$pagenum.' &nbsp; ';
	
	for($i = $pagenum+1; $i <= $last; $i++){
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
		if($i >= $pagenum+4){
			break;
		}
	}
	
	
	if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF']. '?pn='.$next.'>Next</a> ';
    }
}
	$list = '';

	echo "<h4>Posts</h4>";
	
	//displaying all the fetched data from the data base
	
	while($row = mysql_fetch_assoc($result1))
	{
		echo '<h5><div style="width:100%; max-width:1024px; min-height:50px; padding:10px;-webkit-border-radius: 10px;
			-moz-border-radius: 10px;box-shadow: 10px 10px 5px #888888;
			border-radius: 10px; background-color:white; margin-bottom : 5px;"><h5>';
			?>
		
		<table>
		<tbody>
		<tr>
			<td width="60%" align="left">
			<?php
				echo '<a style="color:green!important" href="#">' . $row['post_content'];
				
			?>
			</td>
			<td width="15%" align="center">
			<?php
				$_SESSION['del_flag']=$row['del_flag'];
				if($row['del_flag']==0)//check wheather post is being deleted or not if not print else nothing
				{
					echo '<a style="color:blue!important" href="#">'.$row['fname'];
					$sql="SELECT 
							fname, 
							Count(post_id) AS Num_posts 
						FROM   
							P3_posts 
							RIGHT JOIN P3_user_login ON post_by = login_id 
						GROUP  BY username";
					$sqlresult=mysql_query($sql) or die ("Unable to verify user because " . mysql_error());
					while($sqlrow = mysql_fetch_assoc($sqlresult))
					{
						if($row['fname']==$sqlrow['fname'])
						{
							$postCount=$sqlrow['Num_posts'];
							//echo "the count of user post is ". $postCount;
						}
					}
				?>
				</td>
				
				<td width="15%" align="center">
				<?php
					echo '<a style="color:blue!important" href="#">'.$row['title'].'<br>';
						if($postCount==0)
						{
							//no-life
							echo '<a style="color:blue!important" href="#">No-Life';
							
						}
						else if($postCount <=5 && $postCount > 0)
						{
							//newbie
							echo '<a style="color:blue!important" href="#">Newbie';
						}
						else if($postCount<=10 && $postCount>5)
						{
							//active user
							echo '<a style="color:blue!important" href="#">Active';
						}
						else
						{
							//veteran
							echo '<a style="color:blue!important" href="#">Veteran';
						}
				?>
				</td >
				
				<td width="15%" align="center">
				<?php
					echo '<a style="color:blue!important" href="#">'.$row['post_date'];
				?>	
				</td>
				<?
				//dispalying the edit button for the respective logged in user
				if( ($_SESSION['name'] == $row['fname']) || $_SESSION['rank']<3 || $_SESSION['rank']==4)
				{
					?>
					<td width="10%" align="center">
						<form action="editPostUser.php" method="post">
						<input type="hidden" name="post_id" value="<? echo $row['post_id']; ?>"/>
						<input class="btn" type="submit" value="edit" >
						</form>
					</td>
					
					<td width="15%" align="center">
					<?php
						//if condition
						echo '<a style="color:blue!important" href="#">post edited on &nbsp'.$row['modify_date'].'&nbsp'.$row['fname'];
					?>	
					</td>
					<?php
				}//end if
				//displaying the delete button if login as admin or moderator
				if($_SESSION['rank']<3 || $_SESSION['rank']==4)
				{
				?>
					<td width="10%" align="center">
						<form action="deletePostAdmin.php" method="post">
						<input type="hidden" name="post_id" value="<? echo $row['post_id']; ?>" />
						<input class="btn" type="submit" value="delete" />
						</form>
					</td>
					<?php
				}//end if
			}//end if	
			?>
			
		</tr>
		</tbody>
		</table>
		<?php
		echo '</div>';
	}//end while
		?>
		<div>
		   <h4 textcolor='red'><?php echo $paginationCtrls; ?></h4>
		</div>
		<div class="btns" > 
			<form action="insert.php" name="form" method="post">
			<textarea autofocus rows ="6" cols="56" name="comment" ></textarea>
			<input class="btn" align="center" type="submit" value="Comment" >
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