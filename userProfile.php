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
			.user_profile_bar
			{
				width: 100%;
				padding: 10px;
				background: #FBB917;
				color: white;
				max-width:1024px;
				margin: 5px auto;
				-webkit-border-radius: 10px;
				-moz-border-radius: 10px;
				border-radius: 10px;
			}
			.profile_div
			{
				background :white;
				width: 100%;
				max-width:1024px;
				min-height:500px;
				display: block;
				padding: 10px;
				margin: 5px auto;/*margin */
			
				-webkit-border-radius: 10px;
				-moz-border-radius: 10px;
				border-radius: 10px;
			}
			
			.coll-1
			{
				background :#92C7C7; 
				float:left;
				width:20%; 
				display: block;
				padding: 10px;
				
				
				-webkit-border-radius: 10px;
				-moz-border-radius: 10px;
				border-radius: 10px;
				
			}
			.user_image
			{
				
			}
			.user_stats
			{
				
			}
			.coll-2
			{
				
				float:left;
				width:70%; 
				/*padding: top lef bottom right*/
				padding: 10px;
				/*border:5px solid red;*/
			}
			.user_name_status
			{
				text-transform:uppercase;
				display:block;
				min-height: 30px;
				border:1px solid red;
				padding: 2px;
				
				
				-webkit-box-shadow: 0 0 5px 2px #fff;
				-moz-box-shadow: 0 0 5px 2px #fff;
				box-shadow: 0 0 5px 2px #fff;
				background:white;
				-moz-border-radius: 5px;
				-webkit-border-radius: 5px;
				-khtml-border-radius: 5px;
				border-radius: 5px;
				
				
			}
			a.feature
			{
				display: inline-block;
				cursor: pointer;
				min-width: 200px; 
				margin-right: 15px;
				margin-top: 15px;
				padding: 5px auto;
				color: blue;
				font-weight: 50;
				text-align: center;
				
				
				-webkit-box-shadow: 0 0 5px 2px #fff;
				-moz-box-shadow: 0 0 5px 2px #fff;
				box-shadow: 0 0 5px 2px #fff;
				background:#92C7C7;
				-moz-border-radius: 5px;
				-webkit-border-radius: 5px;
				-khtml-border-radius: 5px;
				border-radius: 5px;
			}
			
			a.selected
			{
				background: #FBB917;
			}
				
			div.features_div
			{
				
				width:95%; 
				margin-left: auto;
				margin-right: auto;
				text-align: center;
				margin-bottom: 2%;
			}

			
			
			</style>
	</head>
	<body>
		<header>
			<div class="line-top"></div>
			<div class="main">
			<div class="row-top">
			  <h3><em><font face="verdana" color="orangered"> Art of Cooking</font></em></h3>
			  <img alt="" src="images\cooking-college.jpg" width="170" height="100" ></img>
			  <nav>
			   <ul class="sf-menu">
				<?php 
					$_POST['current'] = 6;
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
					echo '<h5 style="color: green;" align="right"> Welcome !!! You are logged in as: '. $_SESSION['name'] .' </h5>';
				}
				else
				{
					header("Location: login.php");
				}
			?>
			</div>
		</header>
		<section id="content">
			<div class="user_profile_bar" >
				<h3 style="color:white">User Profile</h3>
			</div>
			<div class="profile_div">
				<div class="coll-1">
					<div class="user_image">
					
					<?php
						$user_id = $_GET['useraction'];
						$query="
								SELECT 
									user_profile 
								FROM 
									P4_users 
								WHERE 
									id=".$user_id.";
									";
									
						$result = mysql_query($query) or die ("Unable to execute query and reterive user profile " . mysql_error());
						while($row = mysql_fetch_assoc($result))
						{
							echo '<img alt="" src="images/'.$row['user_profile'].'" width="140" height="140" ></img> ';
						}
						if($user_id==$_SESSION['login_id'] )
						{
						echo '
						
							<form action="upload_image.php" method="post" enctype="multipart/form-data">
							<input type="hidden" name="userprofile" value="<?php echo '.$user_id.'?> " />
							<input type="file" name="file" id="file"><br>
							<input type="submit" name="submit" value="Upload">
							</form>';
						}
					?>
					</div>
					<br>
					<div class="user_stats">
						<?php
							$user_stats_query="
											SELECT
												A.date_registered,
												A.date_last_Post,
												A.Num_posts
											FROM(
												SELECT 
													U.fname,								
													U.id,
													U.date_registered,
													Max(date_created) AS date_last_Post ,
													Count(P.post_id) AS Num_posts 
												FROM   
													P4_posts P
													RIGHT JOIN P4_users U ON P.posted_by = U.id 
													GROUP BY username
												)
												A 
											WHERE A.id=".$user_id ."";
							$user_stats_query_result= mysql_query($user_stats_query) or die ("Unable to verify user because " . mysql_error());
							$stats_row = mysql_fetch_assoc($user_stats_query_result);
							
							
							$date_last_posted = explode(" ",$stats_row['date_last_Post']);					
							echo'	<h5 style="color:blue">Last Activity&nbsp&nbsp: '.$date_last_posted[0].'</h5>';
							
							$date_joined = explode(" ",$stats_row['date_registered']);
							echo '	<h5 style="color:blue">Joined&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: '.$date_joined[0].'</h5>';
						
							echo'	<h5 style="color:blue">Posts&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: '.$stats_row['Num_posts'].'</h5>';
						?>
					</div>
									
				</div>
				<div class="coll-2">
					<?php
						echo '	<div class="user_name_status">';
						$user_name_query = "
											SELECT 
											   U.fname,
											   U.lname,
											   UR.Name
											FROM 
												P4_users U,
												P4_roles UR
											WHERE 
												U.id = ".$user_id ."
												AND U.role_id = UR.id";
						$user_name_query_result = mysql_query($user_name_query) or die ("Unable to verify user because " . mysql_error());
						$user_name_row = mysql_fetch_assoc($user_name_query_result);
						echo '	<h3 style="color:orangered">'.$user_name_row['fname']. '&nbsp&nbsp'.$user_name_row['lname'].'</h3>';
						echo'	<h5 style="color:green">'.$user_name_row['Name'].'</h5> 
								</div>';
						$page1="posts";
						$page2="information";
						
						echo '	<div class="features_div">';
									echo '<a class="feature'; 
										if($_POST['selected'] == 1) echo ' selected';
										echo'" href="userActivities.php?action='.$page1.'&user_id='.$user_id.'"> Postings </a>';
									echo '<a class="feature'; 
										if($_POST['selected'] == 2) echo ' selected';
										echo'" href="userActivities.php?action='.$page2.'&user_id='.$user_id.'"> Information</a>';
						echo '	</div>
								';
					?>
				</div>
			</div>
		</section>
		<footer>
		  <div class="main">
			<div class="policy"> <h5 style="color:green!important" >Copyright @ 2014 Art of cooking powered by Babitha Bokka & Vaidehi Putta </h5></div>
			<div class="clear"></div>
		  </div>
		</footer>
		</body>
</html>