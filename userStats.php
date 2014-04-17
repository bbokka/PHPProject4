<?php
	session_start();
	if($_SESSION['usr']==0)
		{
			header("Location: login.php");
		}
		else if($_SESSION['usr']==1)
		{
		  if($_SESSION['admin']==1 || $_SESSION['moderator']==1)
		  {
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
	.category_div
	{
		style="border:2px solid #a1a1a1; 
		border-radius:12px; 
		padding: 10px;
	}
</style>
</head>
<body>
<header>
  <div class="line-top"></div>
  <div class="main">
    <div class="row-top">
      <h3><em><font face="verdana" color="red"> Art of Cooking</font></em></h3>
	  <img alt="" src="images\cooking-college.jpg" width="170" height="100" >
      <nav>
       <ul class="sf-menu">
		<?php 
			$_POST['current'] = 4;
			include 'navBar.php'; 
		?>
	   </ul>
      </nav>
      <div class="clear"></div>
    </div>
	<?php
		session_start();
		if(isset($_SESSION['login_id']) && ($_SESSION['login_id'] != 0))
		{
			echo '<h5 style="color: orangered;" align="right"> You are logged in as: '. $_SESSION['name'] .' </h5>';
			
		}
		else
		{
			header("Location: login.php");
		}
	?>
  </div>
</header>

<section id="content">
	<div sytle="margin : 0px auto">
		<div class="main">
		<?php
			$_POST['selected'] = 7;
			include "FeaturesBar.php"; 
		?>
		<?php
			require_once("config.php");
			
			$query = "SELECT UL.rank_id , U.username, UL.title, U.login_id from P3_user_login U,P3_user_level UL where U.rank=UL.rank_id order by UL.rank_id";
			$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
		?>
			
		<?php
			//query to get the number of posts in that thread	
			$query="SELECT
					count(login_id )
				FROM 
					P3_user_login" ;
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
				
			$retreive= "SELECT 
					A.fname,
					A.lname, 
					A.username, 
					A.email, 
					A.Num_posts,
					B.Num_threads,
					IFNULL(C.last_post, 'N/A') Last_Post,
					D.date_registered 
				FROM (SELECT 
						login_id,
						fname, 
						lname, 
						username, 
						email, 
						Count(post_id) AS Num_posts 
					FROM   
						P3_posts 
						RIGHT JOIN P3_user_login ON post_by = login_id 
					GROUP  BY username) A,
					(	
					SELECT 
						login_id,
						Count(thread_id) AS Num_threads 
					FROM   
						P3_thread 
						RIGHT JOIN P3_user_login ON thread_posted_by = login_id 
					GROUP  BY username) B, 
					(SELECT login_id, 
					   A.last_post 
					FROM  (SELECT post_by, 
								  Max(post_date) AS last_Post 
						   FROM   P3_posts 
						   GROUP  BY post_by) A 
						  RIGHT JOIN P3_user_login 
								 ON A.post_by = login_id) C,
					( SELECT P.login_id,
					   R.date_registered 
				FROM   register R 
					   RIGHT JOIN P3_user_login P 
							  ON R.username = P.username ) D
				WHERE 
					A.Login_id = B.Login_id
					AND A.Login_id = C.Login_id
					AND A.Login_id = D.Login_id 
				ORDER BY A.username
					ASC $limit";
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

			?>
			<!--code for setting the limit of the page-->
			<h5 style="color:blue">User Stats</h5>
			<?
	
	while($row = mysql_fetch_assoc($result1)) 
	{
	
		echo '<h5><div style="width:100%; max-width:1024px; min-height:50px; padding:10px;-webkit-border-radius: 10px;
				-moz-border-radius: 10px;box-shadow: 10px 10px 5px #888888;
				border-radius: 10px; background-color:white; margin-bottom : 5px;">';
		?>
		<table>
		<tbody>
		<tr>
			<td width="13%" align="center">
			<?php
				echo '<a style="color:green!important" href="#">' . $row['fname'];
			?>
			</td>
			<td width="13%" align="center">
			<?php
				echo '<a style="color:green!important" href="#">'.$row['lname'];
			?>
			</td>
			<td width="13%" align="center">
			<?php
				echo '<a style="color:blue!important" href="#">'.$row['username'];
			?>
			</td >
			<td width="13%" align="center">
			<?php
				echo '<a style="color:blue!important" href="#">'.$row['email'];
			?>	
			</td>
			<td width="13%" align="center">
			<?php
				echo '<a style="color:blue!important" href="#">'.$row['date_registered'];
			?>	
			</td>
			<td width="13%" align="center">
			<?php
				echo '<a style="color:blue!important" href="#">'.$row['Num_posts'];
			?>	
			</td>
			<td width="13%" align="center">
			<?php
				echo '<a style="color:blue!important" href="#">'.$row['Num_threads'];
			?>	
			</td>
			<td width="13%" align="center">
			<?php
				echo '<a style="color:blue!important" href="#">'.$row['Last_Post'];
			?>	
			</td>
					
		</tr>
		</tbody>
		</table>
		<?php
			echo '</div></h5>';
		
}			
			?>	
		
		<div>
			   <h4 textcolor='red'><?php echo $paginationCtrls; ?></h4>
		</div>
	</div>
</div>
	

</section>
<footer>
  <div class="main">
			<div class="policy"><a style="color:green!important" href="#">Copyright @ 2014 Art of cooking powered by Babitha Bokka & Vaidehi Putta </div>
    <div class="clear"></div>
  </div>
</footer>
</body>
</html>
<?php
	} 
	else
	{
		header("Location: login.php");
	}
}
?>	
