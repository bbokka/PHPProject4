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
			//to get the images to post value for no-life
			$sql1 = "SELECT 
						value 
					FROM 
						P4_setting
					WHERE
						setting_id=2";
			$result1 = mysql_query($sql1);
			$row1=mysql_fetch_array($result1);
			//to get the images to post value for newbie
			$sql2 = "SELECT 
						value 
					FROM 
						P4_setting
					WHERE
						setting_id=3";
			$result2 = mysql_query($sql2);
			$row2=mysql_fetch_array($result2);
			//to get the images to post value for active
			$sql3 = "SELECT 
						value 
					FROM 
						P4_setting
					WHERE
						setting_id=4";
			$result3 = mysql_query($sql3);
			$row3=mysql_fetch_array($result3);
			//to get the images to post value for veteran
			$sql4 = "SELECT 
						value 
					FROM 
						P4_setting
					WHERE
						setting_id=5";
			$result4 = mysql_query($sql4);
			$row4=mysql_fetch_array($result4);
			?>
			<?php 
				$_POST['selected'] = 8;
				include "FeaturesBar.php"; 
			?>
			<h5>
				<div class="Form_Box">
					<!--code for setting the limit of the page-->
					<h5 style="color:blue">Set the limit for the Post Image :</h5>	
					<form action='setImageLimit.php' method='post'>
						<label>No-Life &nbsp&nbsp&nbsp:</label>
						<input type="text" name="noLifeLimit" value="<?php echo $row1['value'];?>"><br>
						<label>Newbie &nbsp&nbsp:</label>
						<input type="text" name="NewbieLimit" value="<?php echo $row2['value'];?>"><br>
						<label>Active &nbsp&nbsp&nbsp :</label>
						<input type="text" name="ActiveLimit" value="<?php echo $row3['value'];?>"><br>
						<label>Veteran :</label>
						<input type="text" name="VeteranLimit" value="<?php echo $row4['value'];?>"><br>
						<input class="btn"type="submit" value="Set Limit">
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