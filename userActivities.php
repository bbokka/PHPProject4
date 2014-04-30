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
		<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen">
		<!--<link rel="stylesheet" href="css/grid.css" type="text/css" media="screen"> -->
		<link rel="icon" href="images/favicon.ico" type="image/x-icon">
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
		<link href="http://fonts.googleapis.com/css?family=PT+Serif+Caption:400,400italic" rel="stylesheet" type="text/css">
		<script src="js/jquery-1.7.1.min.js" ></script>
		<script src="js/superfish.js"></script>
		<script src="js/forms.js"></script>
		<script src="js/lightbox.js"></script>
		<style>
			.user_profile_bar
			{
				width: 100%;
				padding: 10px;
				background: #92C7C7;
				color: white;
				max-width:1024px;
				margin: 5px auto;
				-webkit-border-radius: 10px;
				-moz-border-radius: 10px;
				border-radius: 10px;
			}
			.profile_div
			{
				background: white;
				width: 100%;
				max-width:1024px;
				min-height:500px;
				overflow: auto;
				display: block;
				padding: 10px;
				margin: 5px auto;/*margin */
			
				-webkit-border-radius: 10px;
				-moz-border-radius: 10px;
				border-radius: 10px;
			}
			
			.coll-1
			{
				float:left;
				width:20%; 
				display: block;
				padding: 10px;
				background: #92C7C7;
				
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
				border:1px solid blue;
				padding: 2px;
				background:white;
				
				-webkit-border-radius: 10px;
				-moz-border-radius: 10px;
				border-radius: 10px;
			}
			a.feature
			{
				display: inline-block;
				cursor: pointer;
				min-width: 200px; 
				margin-right: 15px;
				margin-top: 15px;
				padding: 5px auto;
				color: white;
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
				background: black;
			}
			
			.Form_Box
			{
				background: white;
				width: 100%;
				display: inline-block;				
				margin-left: auto;
				margin-right: auto;
				margin-bottom: 10px;
				border:1px solid white;
				
				max-width:1024px; 
				min-height:50px; 
				padding:3px;
				-webkit-border-radius: 10px;
				-moz-border-radius: 10px;
				
				-webkit-box-shadow: 0 0 5px 2px #888;
				-moz-box-shadow: 0 0 5px 2px #888;
				box-shadow: 0 0 5px 2px #888;
				
				border-radius: 10px;
			}
			.image_part
			{
				width: 15%;
				display: inline-block;
				
			}
			
			.post_details
			{
				display: inline-block;
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
				overflow: auto;
				/*border-top: 1px solid red; */ 
				
				border-radius: 10px;
				padding: 1px;
			}
	
			.features_div
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
						$action = $_REQUEST['action'];
						$user_id = $_REQUEST['user_id'];
						$user_id= mysql_real_escape_string($user_id);
						if(!is_numeric($user_id))
						{
							echo "	<script> 
										alert('Sorry something went wrong!'); 
										history.back(); 
									</script> ";
						}
						else
						{
							$sql_query="
									SELECT 
										user_profile 
									FROM 
										P4_users 
									WHERE 
										id=".$user_id.";
										";
							$sql_query_result = mysql_query($sql_query) or die ("Unable to execute query and reterive user profile " . mysql_error());
							$count = mysql_num_rows($sql_query_result);
							if($count==0)
							{
								echo'
									<script> 
										alert("User does not exists.!"); 
										history.back(); 
									</script> ';
							}
							else
							{
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
									echo ' <a href ="images/'.$row['user_profile'].'" rel="lightbox"><img alt="" src="images/'.$row['user_profile'].'" width="140" height="140" ></img></a> ';
								}
								if($user_id==$_SESSION['login_id'] )
								{
									echo '
										<form action="upload_image.php" method="post" enctype="multipart/form-data">
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
														WHERE
															P.Is_archived=0
														GROUP BY username
															
														)
														A 
													WHERE A.id=".$user_id ."";
									$user_stats_query_result= mysql_query($user_stats_query) or die ("Unable to verify user because " . mysql_error());
									$stats_row = mysql_fetch_assoc($user_stats_query_result);
									
									
									$date_last_posted = explode(" ",$stats_row['date_last_Post']);					
									echo'	<h5 style="color:white">Last Activity&nbsp&nbsp: '.$date_last_posted[0].'</h5>';
									
									$date_joined = explode(" ",$stats_row['date_registered']);
									echo '	<h5 style="color:white">Joined&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: '.$date_joined[0].'</h5>';
								
									echo'	<h5 style="color:white">Posts&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: '.$stats_row['Num_posts'].'</h5>';
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
								
								
								if($action=="posts")
								{
									$_POST['selected'] = 1;
								}
								else if($action=="information")
								{
									$_POST['selected'] = 2;
								}		
								echo '	<div class="features_div">';
											echo '<a class="feature'; 
												if($_POST['selected'] == 1) echo ' selected';
												echo'" href="userActivities.php?action=posts&user_id='.$user_id.'"> Postings </a>';
											
											echo '<a class="feature'; 
												if($_POST['selected'] == 2) echo ' selected';
												echo'" href="userActivities.php?action=information&user_id='.$user_id.'"> Information</a>';
								echo '	</div>
										';
								
								if($action=="posts")
								{
									//code for retreiving the recent posts
									$user_posts_query="
													SELECT
														C.cat_name,
														C.id AS category,
														T.thread_name,
														P.post_content, 
														P.date_created, 
														U.fname, 
														U.user_profile,
														T.thread_id
													FROM  	
														P4_users U,
														P4_posts P, 
														P4_threads T, 
														P4_categories C 
												WHERE 	
														P.thread_id = T.thread_id 
														AND T.category_id = C.id 
														AND C.Is_archived=0
														AND P.Is_archived=0
														AND U.id = P.posted_by 
														AND U.id = ".$user_id."";
									//print $user_posts_query;
									$user_posts_query_result = mysql_query($user_posts_query) or die ("Unable to verify user because " . mysql_error());
									while($user_posts_row = mysql_fetch_assoc($user_posts_query_result))
									{
										echo '<h5 style="color:blue"><div class="Form_Box">';
										echo '	<div class ="image_part">
													<img alt="" src="images/'.$user_posts_row['user_profile'].'" width="60" height="60" ></img> 
												</div>';
										
										echo '	<div class="post_details">
													<div class="post_Audits">
														<a href="extractPost.php?thread_id='.$user_posts_row['thread_id'].' " style="color:blue">'.$user_posts_row['thread_name'].'</a>
													</div>
													<div class ="post_content">
														 <a href="extractPost.php?thread_id='.$user_posts_row['thread_id'].' " style="color:green">'.$user_posts_row['post_content'].'</a>
													</div>';
													$date_posted = explode(" ",$user_posts_row['date_created']);
												echo '	<div class="post_Audits">';
												echo 'Posted by :<a href="userProfile.php?useraction='.$user_id.' " style="color:orangered">'.$user_posts_row['fname'].'</a>' ;
												
												echo '&nbsp at '.$date_posted[0];
												
												echo '&nbsp in <a href="showThread.php?category_id='.$user_posts_row['category'].' " style="color:orangered">' .$user_posts_row['cat_name'].'</a>';
											echo '</div>';
											
										echo '	</div>';
										echo '</div></h5>';
									}
								}
								
								else if($action=="information")
								{
									echo '<div class="Form_box" align="center">';
									//code for pulling out the inforamtion of user
									$user_info_query="
													SELECT 
														UL.Name as role,
														U.fname,
														U.lname,
														U.email,
														U.username 
													FROM
														P4_users U,
														P4_roles UL 
													WHERE
														U.role_id=UL.id
														AND U.id=".$user_id ."";
									$user_info_query_result = mysql_query($user_info_query) or die ("Unable to verify user because " . mysql_error());
									$user_info_row = mysql_fetch_assoc($user_info_query_result);
									echo '	<h3 style="color:orangered">First Name :'.$user_info_row['fname']. '&nbsp&nbsp<br>Last Name:'.$user_info_row['lname'].'</h3>';
									echo '	<h5 style="color:green">User Name :'.$user_info_row['username'].'</h5> ';
									echo '	<h5 style="color:green">User Name :'.$user_info_row['email'].'</h5>';
									echo '	<h5 style="color:green">User Name :'.$user_info_row['role'].'</h5>';
									echo "</div>";
															
								}
							}						
						}
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