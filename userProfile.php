<!DOCTYPE html>
<html lang="en">
	<head>
		<title>User Profile</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
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
			   <h3><em><font face="verdana" color="red"> Art of </font></em></h3>
				<img alt="" src="images\cooking-college.jpg" width="170" height="100" >
			  <nav>
				</nav>
			  <div class="clear"></div>
			</div>
		  </div>
		</header>
		<section id="content">
		  <div class="border-horiz"></div>
		 <div class="box-contact">
		 <br>
			<?php
				//setting the session variable and checking if there is already a value which is set
				session_start();
				if(isset($_SESSION['login_id']) && ($_SESSION['login_id'] == 0))
				{
					//echo '<h5 style="color: red;"> Invalid credentials </h5>';
					unset($_SESSION['login_id']);
				}
			?>
			
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