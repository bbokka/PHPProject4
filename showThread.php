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
	.topicContainer .topicActions input[type="submit"]
	{
		width: 36px;
		height: 36px;
		border-radius: 50%;
		background-size:36px 36px;
		border: none;
	}
	.topicContainer .topicActions div
	{
		display: inline-block;
	}
	.topicContainer .topicActions .edit_button
	{
		background: url("images/edit_button.png") no-repeat;
		background-color: #92C7C7;
	}
	.topicContainer .topicActions .delete_button
	{
		background: url("images/delete_button.png") no-repeat;
		background-color: #FBB917;
	}
	.topicContainer .topicActionDescription
	{
		width: 20%;
	}
	/* .topicContainer .topicName:hover
	{
		-webkit-transform: scale(1.1);
		-webkit-transition-timing-function: ease-out;
		-webkit-transition-duration: 250ms;
	} */
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
		<div class="category_navigation">
			<?php
				$category = $_REQUEST['category_id'];
				$retrieveCategoryNameQuery = "
											SELECT
												cat_name,
												id
											FROM
												P4_categories 
											WHERE 
												id = ".$category."
												AND Is_archived=0
											";
				//print $retrieveCategoryNameQuery;
				$CategoryName_res = mysql_query($retrieveCategoryNameQuery) or die(mysql_error());
				while ($CategoryName_row = mysql_fetch_object($CategoryName_res)) 
				{
					echo '<h3><a href="showCategory.php" style="color:white"> Category</a>::';
					echo '<a href="showThread.php?category_id='.$CategoryName_row->id.'"  style="color:white">'.$CategoryName_row->cat_name.'</a></h3>';
				}
			?>
		</div>
		<div class="topicContainer" style="background: #FBB917; color: white">
			<h3 style="color:white!important">
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
			</h3>
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