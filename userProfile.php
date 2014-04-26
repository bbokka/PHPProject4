<?php
	session_start();
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
			.profile_div
			{
				background: white;
				width: 100%;
				max-width:1024px;
				min-height:1024px;
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
				width:200px; 
				display: inline-block;
				padding: 10px;
				/*border:5px solid red;
				border-color:red;*/
				
			}
			.coll-2
			{
				float:left;
				/*padding: top lef bottom right*/
				padding: 10px;
				
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
			<div class="profile_div">
				<div class="coll-1">
					<?php
						$image_query="
									SELECT 
										user_profile 
									FROM
										P4_users 
									";
						$result = mysql_query($image_query) or die ("Unable to verify user because " . mysql_error());
						$row = mysql_fetch_array($result);
						while($row==1)
						{
							//echo "<img alt="" src='.$row[''].' width='200' height='200' ></img>";
							echo $row['user_profile'];
							//<img alt="" src=".." width="200" height="200" ></img>
						}
					?>
					
				</div>
				<div class="coll-2">
				dfgdfsgsdfgdsfgsd
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