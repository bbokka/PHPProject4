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
	.topicContainer div
	{
		display: inline-block;
	}
	.topicContainer
	{
		background: white;
		width: 100%;
		display: inline-block;
		padding: 10px;
		margin: 2px auto;
		
		-webkit-border-radius: 10px;
		-moz-border-radius: 10px;
		border-radius: 10px;
		
	}
	.topicContainer .topicName
	{
		width: 45%;
		padding-left: 2%;
	}
	.topicContainer .topicReplies
	{
		width: 10%;
	}
	.topicContainer .topicActions
	{
		width: 20%;
	}
	.topicContainer .topicActionDescription
	{
		width: 20%;
	}
	.topicContainer .topicName:hover
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
		<?php
			session_start();
			if(isset($_SESSION['login_id']) && ($_SESSION['login_id'] != 0))
			{
				echo '<h5 style="color: orangered;" align="right"> You are logged in as:'. $_SESSION['name'] .' </h5>';
			}
			else
			{
				header("Location: login.php");
			}
		?>
    </div>
  </div>
</header>
<section id="content">
<div sytle="margin : 0px auto">
	<div class="main">
		<div class="topicContainer" style="background: #123123; color: white">
			<div class="topicName">
				Name
			</div>
			<div class="topicReplies">
				Replies
			</div>
			<div class="topicActions">
				Actions
			</div>
			<div class="topicActionDescription">
				Audits
			</div>
		</div>
		<?php
			include 'retrieveThreads.php'
		?>	
		<form action="createThread.php" name="form" method="GET">
			<input type="hidden" name="category_id" value="<?php echo $_REQUEST['category_id'] ?>" />
			<input class="btn" type="submit" value="Create Topic">	
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