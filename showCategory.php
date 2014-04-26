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
			.category_navigation
			{
				background: #92C7C7;
				width: 100%;
				padding: 10px;
				
				-webkit-border-radius: 10px;
				-moz-border-radius: 10px;
				border-radius: 10px;
			}
			.category_div
			{
				background: white;
				width: 100%;
				display: block;
				padding: 10px;
				margin: 5px auto;
				-webkit-border-radius: 10px;
				-moz-border-radius: 10px;
				border-radius: 10px;
			}
			.category_div .category_name
			{
				width: 35%;
				display: inline-block;
				margin-left: 2%;
			}
			.category_div .category_description
			{
				width: 60%;
				display: inline-block;
			}
			.category_div .category_name:hover
			{
				-webkit-transform: scale(1.1);
				-webkit-transition-timing-function: ease-out;
				-webkit-transition-duration: 250ms;
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
				<div class="category_navigation">
					<h3 style= "color: white"> Category: </h3>
				</div>
				<div class="category_div" style="background: #FBB917; color: white">
					<div class="category_name">  
						<h3 style= "color: white">Category Name</h3>
					</div>
					<div class="category_description">
						<h3 style= "color: white">Description </h3>
					</div>
				</div>
				<?php
					include 'retrieveCategories.php';
				?>
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