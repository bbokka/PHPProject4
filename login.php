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
					<?php 
						$_POST['current'] = 2;
						include 'navBar.php'; 
					?>
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
			<h4>Please login to view the forum</h4>
			<h3>Login</h3>
			
			<?php
				//setting the session variable and checking if there is already a value which is set
				session_start();
				if(isset($_SESSION['login_id']) && ($_SESSION['login_id'] == 0))
				{
					echo '<h5 style="color: red;"> Invalid credentials </h5>';
					unset($_SESSION['login_id']);
				}
			?>
			<form action="processLogin.php" name="form" method="post">
			<fieldset>
				<div class="coll-1">
				  <div>
					<div class="form-txt">Email:</div>
					<?php
					$uname = "";
					if(isset($_COOKIE['ID_my_site']))
						$uname = $_COOKIE['ID_my_site'];
					?>
					<input type ="email" name="emailId" size="30" maxlength="25" placeholder="Email" value="<?php echo $uname; ?>">
					<div class="clear"></div>
					&nbsp;
				  </div>
				  <div>
					<div class="form-txt">PASSWORD:</div>
					<input type ="password" name="pwd" size="30" maxlength="25" placeholder="Password"><br>
					<div class="clear"></div>
					&nbsp;
				  </div>
				  <div>
					<?php 
					if(isset($_COOKIE['ID_my_site'])) 
					{
					?>
					<input type="checkbox" name="remember" value="1" checked>Remember Me
					<?php
					}
					else
					{
					?>
					<input type="checkbox" name="remember" value="1">Remember Me
					<?php
					}
					?>
					<div>
					<a href="startForgot.php">Forgot Password?</a>
					</div>
					<div class="clear"></div>
				  </div>
				</div>
				<div class="clear"></div>
				&nbsp;
				<div class="btns"> 
				<input class="btn" type="submit" value="Sign In">
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