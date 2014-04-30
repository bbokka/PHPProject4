<?php
	session_start();
	require_once("config.php");
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
			.search_div
			{
				background: white;
				width: 100%;
				padding: 10px;
				min-height:400px;
				
				-webkit-border-radius: 10px;
				-moz-border-radius: 10px;
				border-radius: 10px;
			}
			.search_inner_div
			{
				background: #FBB917;
				width: 90%;
				padding: 10px;
				min-height:50px;
				margin: 5px auto;
			
				
				-webkit-border-radius: 10px;
				-moz-border-radius: 10px;
				border-radius: 10px;
			}
			.search_innermost_div
			{
				background: #92C7C7;
				width: 90%;
				padding: 10px;
				min-height:300px;
				margin: 2px auto;
			
				
				-webkit-border-radius: 10px;
				-moz-border-radius: 10px;
				border-radius: 10px;
			}
			
			
		</style>
	</head>
	<body>
		<header>
			<div class="line-top"></div>
			<div class="main">
			<div class="row-top">
			  <h3><em><font face="verdana" color="orangered"> Art of Cooking</font></em></h3>
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
					echo '<h5 style="color: green;" align="right"> You are logged in as: '. $_SESSION['name'] .' </h5>';
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
					<div class="search_div">
						<div class="search_inner_div">
							<h3 style="padding: 10px;">Single Forum Search</h3>
						</div>
						<div class="search_innermost_div"><br>
							<h3 style= "color: green"> Keywords:
							<form method="post" action="singleSearchForum.php">
								<input type="text" name="searchword" /> <br><br>Search in Forums:
								<?php
									$query1 = "SELECT * 
												FROM 
													P4_categories
												WHERE
													Is_archived=0";
											$result1 = mysql_query($query1) or die ("Unable to verify user because " . mysql_error());
											echo '<select name="cat_name" display: block;">'; // Open your drop down box
											// Loop through the query results, outputing the options one by one
											while ($row1 = mysql_fetch_array($result1))
											{
												echo '<option value="'.$row1['id'].'">'.$row1['cat_name'].'</option>';
											}
											echo '</select>';
											
								?>
								<input class="btn" type="submit" name="submit" value=" Search">
							</form>
								</h3>
								
						</div>
					</div>
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


							