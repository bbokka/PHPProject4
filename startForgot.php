<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>The Art of Cooking</title>
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
			   <h3><em><font face="verdana" color="red"> Art of Cooking</font></em></h3>
				<img alt="" src="images\cooking-college.jpg" width="170" height="100" >
			  <nav>
				<ul class="sf-menu">
				
				</ul>
			  </nav>
			  <div class="clear"></div>
			</div>
		  </div>
		</header>
		<section id="content">
		  <div class="border-horiz"></div>
		 <div class="box-contact">
		 <br>
			<h3><em><font face="verdana" color="green"> Welcome To The Password Reset Page </font></em></h3>
			
			<form action="forgotPassword.php" name="form" method="post">
			<fieldset>
				<div class="coll-1">
				  <div>
				  <h4>
				  <div>
				  <h3>
					<div class="form-txt">Enter The Email:</div>
					<input type ="email" name="email" size="25" maxlength="25" placeholder="Email">
					<div class="clear"></div>
					&nbsp;
				   </h4>
				  </div> 
				</div>
				<div class="clear"></div>
				&nbsp;
				<div class="btns"> 
				<input class="btn" type="submit" value="Submit">
				</div>
			  </fieldset>
			</form>
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