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
	.user_details_container div
	{
		display: inline-block;
	}
	.user_details_container
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
	.user_details_container .fname_details
	{
		width: 10%;
		padding-left: 2%;
	}
	.user_details_container .lname_details
	{
		width: 10%;
		padding-left: 2%;
	}
	.user_details_container .username_details
	{
		width: 10%;
		padding-left: 2%;
	}
	.user_details_container .email_details
	{
		width: 15%;
		padding-left: 2%;
	}
	.user_details_container .date_registered
	{
		width: 10%;
		padding-left: 2%;
	}
	.user_details_container .number_of_post
	{
		width: 5%;
		padding-left: 2%;
	}
	.user_details_container .number_of_threads
	{
		width: 5%;
		padding-left: 2%;
	}
	.user_details_container .date_last_posted
	{
		width: 10%;
		padding-left: 2%;
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
			
			$query = "SELECT 
							UL.id ,
							UL.Name, 
							U.username,
							U.id 
						FROM 
							P4_users U,
							P4_roles UL 
						WHERE 
							U.role_id=UL.id 
						ORDER BY
							UL.id";
			$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
		
			//query to get the number of users
			$query="SELECT
					count(id )
				FROM 
					P4_users" ;
			$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
			$row=mysql_fetch_array($result);
			$rows=$row[0];
			
			//query to set the page limit value
			$query1="SELECT 
						value 
					FROM 
						P4_setting";
					
			$result1 = mysql_query($query1) or die ("Unable to verify user because " . mysql_error());
			$row1=mysql_fetch_array($result1);
			$page_rows = $row1['value'];
			
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
							A.date_registered, 
							A.Num_posts,
							B.Num_threads,
							IFNULL(C.date_last_post, 'N/A') Date_Last_Post
							
						FROM (SELECT 
								id,
								fname, 
								lname, 
								username, 
								email,
								date_registered,                                                                                              
								Count(post_id) AS Num_posts 
							FROM   
								P4_posts 
							RIGHT JOIN P4_users
								ON posted_by = id 
							GROUP  BY username) A,
							
							
							(SELECT  id,
									Count(thread_id) AS Num_threads 
							FROM   
								P4_threads 
							RIGHT JOIN P4_users
							ON 
								posted_by = id 
							GROUP  BY 
								username) B, 
							(SELECT id, 
									X.date_last_post 
							FROM  
								(SELECT posted_by,
										Max(date_created) AS date_last_Post 
								FROM   
									P4_posts 
								GROUP  BY 
									posted_by) X 
								RIGHT JOIN P4_users 
								ON X.posted_by = id) C
						WHERE 
							A.id = B.id
							AND A.id = C.id
						ORDER BY 
							A.username
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

		
			//<!--code for setting the limit of the page-->
	echo '<h3 style="color:blue">User Stats :</h3>';
	echo '
			<h3>
			<div class = "user_details_container">
				<div class="fname_details" style="color:green">';
					echo 'FirstName'; 
				echo '</div>
				`
				<div class="lname_details" style="color:green">';
					echo 'LastName';
				echo '</div>
				
				<div class="username_details" style="color:green">';
					echo 'UserName';
				echo '</div>
				
				<div class="email_details" style="color:green">';
					echo 'UserEmail';
				echo '</div>
				
				<div class="date_registered" style="color:green">';
					echo 'Date Registered';
				echo '</div>
				
				<div class="number_of_post" style="color:green">';
					echo 'Number Of Posts';
				echo '</div>
				
				<div class="number_of_threads" style="color:green">';
					echo 'Number Of Topics';
				echo '</div>
				
				<div class="date_last_posted" style="color:green">';
					echo 'Date Last Posted';
				echo '</div>
				
			</div>
			</h3>
			';
			
	
	while($row = mysql_fetch_assoc($result1)) 
	{
	
		echo '
			<h5>
			<div class = "user_details_container">
				<div class="fname_details">';
					echo $row['fname'];
				echo '</div>
				`
				<div class="lname_details">';
					echo $row['lname'];
				echo '</div>
				
				<div class="username_details">';
					echo $row['username'];
				echo '</div>
				
				<div class="email_details">';
					echo $row['email'];
				echo '</div>
				
				<div class="date_registered">';
					echo $row['date_registered'];
				echo '</div>
				
				<div class="number_of_post">';
					echo $row['Num_posts'];
				echo '</div>
				
				<div class="number_of_threads">';
					echo $row['Num_threads'];
				echo '</div>
				
				<div class="date_last_posted">';
					echo $row['Date_Last_Post'];
				echo '</div>
				
				
			</div>
			</h5>
			';
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
