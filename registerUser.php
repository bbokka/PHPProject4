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
					<?php 
						$_POST['current'] = 3;
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
			<h3><em><font face="verdana" color="green"> Registration Page </font></em></h3>
			
			<form action="registerProcess.php" name="form" method="post" enctype="multipart/form-data">
			<fieldset>
				<div class="coll-1">
				  <div>
					<h3>
					<div class="form-txt">First Name:</div>
					<input type ="text" name="firstname" size="25" maxlength="15" placeholder="Firstname">
					<div class="clear"></div>
					</h3>
					&nbsp;
				  </div>
				  <div>
				  <h3>
					<div class="form-txt">Last Name:</div>
					<input type ="text" name="lastname" size="25" maxlength="15" placeholder="Lastname">
					<div class="clear"></div>
					&nbsp;
				  </h3>
				  </div>
				  <div>
				  <h3>
					<div class="form-txt">User name:</div>
					<h5>(First letter of the Firstname and complete Lastname)</h5>
					
					<input type ="text" name="username" size="25" maxlength="15" placeholder="Username">
					<div class="clear"></div>
					&nbsp;
				  </h3>
				  </div>
				  <div>
				  <h3>
					<div class="form-txt">Email:</div>
					<input type ="email" name="email" size="25" maxlength="25" placeholder="Email">
					<div class="clear"></div>
					&nbsp;
				   </h3>
				  </div>
				
				  <div>
				  <h3>
					<div class="form-txt">Password:</div>
					<input type ="password" name="password1" size="25" maxlength="15" placeholder="Password">
					<div class="clear"></div>
					&nbsp;
				  </h3>
				  </div>
				    <h3>
					<div class="form-txt">Re-enter Password:</div>
					<input type ="password" name="password2" size="25" maxlength="15" placeholder="Password">
					<div class="clear"></div>
					&nbsp;
				    </h3>
					<div>
					<h3>
						Please Enter Image Text
						<img src="captcha.php" /><br>
						<input name="captcha" type="text">
						<div class="clear"></div>
						&nbsp;
					</h3>
				  </div>
					<div>
					<h3>
					<div class="form-txt">Type of Email you want to receive:</div>
					<input type="radio" name="choice" value="1">text/plain<br>
					<input type="radio" name="choice" value="2">text/html
					<div class="clear"></div>
					&nbsp;
					<div class="form-txt">Upload your profile picture here:</div>
					<input type="file" name="file" id="file"><br>
					<div class="clear"></div>
					&nbsp;
				  </h3>
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