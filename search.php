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
		margin: 2px auto;
		
		-webkit-border-radius: 10px;
		-moz-border-radius: 10px;
		border-radius: 10px;
	}
	.recent_post
	{
		background: #92C7C7;
		width: 100%;
		padding: 10px;
		background: #FBB917;
		color: white;
		
		-webkit-border-radius: 10px;
		-moz-border-radius: 10px;
		border-radius: 10px;
	}
	.post_container
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
	.non_actions_part
	{
		width: 95%;
		display: inline-block;
	}
	.post_Actions
	{
		width: 4%;
		display: inline-block;
	}
	.non_actions_part div
	{
		display: inline-block;
	}
	.post_owner_details
	{
		width: 20%;
		min-height: 100px;
	}
	.post_owner_details span , .post_Audits span
	{
		display: block;
	}
	.post_details
	{
		width: 78%;
		margin-left: auto;
		margin-right: auto;
	}
	.post_content, .post_Audits
	{
		width: 100%;
	}
	.post_content
	{
		min-height: 100px;
		/*border-top: 1px solid red;  */
		background: #92C7C7;
		border-radius: 10px;
		padding: 2px;
	}
	.post_Actions input[type="submit"]
	{
		width: 36px;
		height: 36px;
		border-radius: 50%;
		background-size:36px 36px;
		border: none;
	}
	.post_Actions div
	{
		display: inline-block;
	}
	.post_Actions .edit_button
	{
		background: url("images/edit_button.png") no-repeat;
		background-color: #7F8778;
	}
	.post_Actions .delete_button
	{
		background: url("images/delete_button.png") no-repeat;
		background-color: #db3222;
	}
</style>
</head>
<body>
<header>
  <div class="line-top"></div>
  <div class="main">
    <div class="row-top">
      <h1><a href="index.html"><p><b><em><font face="verdana" color="OrangeRed">Art of Cooking</font></em></b></p></a></h1>
      <nav>
       <ul class="sf-menu">
			<?php 
				$_POST['current'] = 4;
				include 'navBar.php'; 
			?>
        </ul>
      </nav>
      <div class="clear"></div>
		<?php
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
  </div>
</header>
	
<section id="content">
<div sytle="margin : 0px auto">
<div class="main">
	<?php 
	$search=$_POST[search];
	$query="SELECT * FROM P4_posts " .
		   "WHERE MATCH(post_content) AGAINST('$search' IN BOOLEAN MODE) order by date_created";
				
    $result= mysql_query($query) or die ("Unable to verify user because " . mysql_error());
    $number = mysql_num_rows($result);
	while($row = mysql_fetch_array($result))
	{
	$content= $row['post_content'];
	$date=$row['date_created'];

	//echo $date;
	print " <tr>
	<td>$date</td>
	<td>$content</td></tr><br />";	
	}
?>
		
		
	</div>
	</div>
</section>
<footer>
  <div class="main">
    <div class="policy">Copyright @ 2014 Art of cooking powered by Babitha Bokka & Vaidehi Putta </div>
    <div class="clear"></div>
  </div>
</footer>
</body>
</html>