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
		   "WHERE MATCH(post_content) AGAINST('$search' IN BOOLEAN MODE) 
		   and is_archived=0
		   order by date_created";
				
    $result= mysql_query($query) or die ("Unable to verify user because " . mysql_error());
    $number = mysql_num_rows($result);
	while($row = mysql_fetch_array($result))
	{
		$content= $row['post_content'];
		$thread_id=$row['thread_id'];

		$query1="select * from P4_threads where thread_id=$thread_id";
		$result1= mysql_query($query1) or die ("Unable to verify user because " . mysql_error());
		while($row1 = mysql_fetch_array($result1))
		{
			$thread_name= $row1['thread_name'];
			$cat_id=$row1['category_id'];
			
			$query2="select * from P4_categories where id=$cat_id";
			$result2= mysql_query($query2) or die ("Unable to verify user because " . mysql_error());
			while($row2 = mysql_fetch_array($result2))
			{
				$cat_name= $row2['cat_name'];
				
				print " <tr>
				<td>$cat_name</td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<td>$thread_name</td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<td>$content</td></tr><br />";	
			}
		}
	}
	$query3="SELECT * FROM P4_threads " .
				"WHERE MATCH(thread_name) AGAINST('$search' IN BOOLEAN MODE) 
			and is_archived=0
			order by creation_date";
				
    $result3= mysql_query($query3) or die ("Unable to verify user because " . mysql_error());
	while($row3 = mysql_fetch_array($result3))
	{
		$th_id= $row3['thread_id'];
		$th_name=$row3['thread_name'];
		$cat_id_main=$row3['category_id'];
		
			$query4="select * from P4_categories where id=$cat_id_main";
			$result4= mysql_query($query4) or die ("Unable to verify user because " . mysql_error());
			while($row4 = mysql_fetch_array($result4))
			{
				$cat_name_main= $row4['cat_name'];

				print " <tr>
				<td>$cat_name_main</td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<td>$th_name</td></tr><br />";
			}
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