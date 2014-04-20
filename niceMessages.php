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
			<div>
			</div>
			<div>
			<br>
			<?php
				session_start();
				if(isset($_REQUEST['action']))
				{
					$page=$_REQUEST['action'];			
				}
				else
				{
				}
			?>
			<?php
			if($page=="register")
			{
		 	echo "<h3>Thank You for registration.<br> A confirmation email has been sent you email please click on the link and enter the PASSCODE to activate your account</h3>";
			}
			else if($page=="active")
			{
				echo "<h3>Your account has been activated succesfully </h3>";
				?>
			<div class="form-txt">
				<a href="http://weiglevm.cs.odu.edu/~bbokka/devsandbox/PHPProject4/login.php">Click to LOGIN an enjoy COMMENTING on POSTS
			</div>
			<?php
			}
			else if($page=="forgot")
			{
				echo "<h3>Thank You !!! Your Password has been reset....!!!</h3>";
				?>
				<div class="form-txt">
				<a href="http://weiglevm.cs.odu.edu/~bbokka/devsandbox/PHPProject4/login.php">Click to LOGIN with your new password
			</div>
				<?php
			}
			
			else if($page=="emailForgotPassword")
			{
				echo "<h3>Thank You !!! A link to reset your Password has been sent to your email  ....!!!</h3>";
				?>
				<div class="form-txt">
				<a href="http://weiglevm.cs.odu.edu//~bbokka/devsandbox/PHPProject4/index.php">click to go back to the HOME page
			</div>
				<?php
			}
			
			else if($page=="unRegisteredForgot")
			{
				echo "<h3>Your email is not registered in this forum ....!!!</h3>";
				?>
				<div class="form-txt">
				<a href="http://weiglevm.cs.odu.edu/~bbokka/devsandbox/PHPProject4/registerUser.php">click to REGISTER IN THE FORUM
			</div>
				<?php
			}
			?>
			</div>
			<div class="clear"></div>
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