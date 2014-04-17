<?php
	session_start();
	if($_SESSION['usr']==0)
		{
			header("Location: login.php");
		}
		else if($_SESSION['usr']==1)
		{
		  if($_SESSION['admin']==1 || $_SESSION['moderator']==1)
		  {
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
	.category_div
	{
		style="border:2px solid #a1a1a1; 
		border-radius:12px; 
		padding: 10px;
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
			echo '<h5 style="color: orangered;" align="right"> You are logged in as: '. $_SESSION['name'] .' </h5>';
			
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
		<?php
			require_once("config.php");
			$query = "SELECT
						UL.rank_id ,
						U.username, 
						UL.title, 
						U.login_id 
					FROM 
						P3_user_login U,
						P3_user_level UL 
					WHERE 
						U.rank=UL.rank_id 
					ORDER BY
						UL.rank_id";
			$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
			?>
			<? 
				$_POST['selected'] = 6;
				include "FeaturesBar.php"; 
			?>
			<h5>
				<div class="Form_Box">
					<!--code for setting the limit of the page-->
					<h5 style="color:blue"> Suspend User </h5>
					<form action="freeze.php" name="form" method="post">
						<?php	
					
							$query1 = "SELECT 
											*
										FROM
											P3_thread";
							$result1 = mysql_query($query1) or die ("Unable to verify user because " . mysql_error());
										
							echo '<select name="thread">'; // Open your drop down box

							// Loop through the query results, outputing the options one by one
							while ($row1 = mysql_fetch_array($result1))
							{
							  echo '<option value="'.$row1['thread_id'].'">'.$row1['thread_name'].'</option>';
							}
							echo '</select>';
							
							$freeze_thread=$_POST['thread'];
					
						
							echo'<input type="radio" name="freeze" value="1">Freeze
							<input type="radio" name="freeze" value="0">Unfreeze
							<input class="btn" type="submit" value="Update" >';
						
							$freeze_value = $_POST['freeze'];
						?>
					</form>
				</div>
			</h5>
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
<?php
	} 
	else
	{
		header("Location: login.php");
	}
}
?>	