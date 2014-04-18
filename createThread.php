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
      <h1><a href="index.html"><p><b><em><font face="verdana" color="OrangeRed">Art of Cooking</font></em></b></p></a></h1>
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
		<h5><div style="width:100%; max-width:1024px; min-height:50px; padding:10px;-webkit-border-radius: 10px;
				-moz-border-radius: 10px;box-shadow: 10px 10px 5px #888888;
				border-radius: 10px; background-color:white; margin-bottom : 5px;">
				
				<form method='post' action='insertThread.php'>
					<input type="hidden" name="category_id" value="<?php echo $_REQUEST['category_id'] ?>" />
					Create Topic: <textarea name='forum' /></textarea><br>
					<input class="btn" type='submit' value='Add Topic' />
				 </form>
			</div><h5>
			
<section id="content">
	<div sytle="margin : 0px auto">
		<div class="main">
		
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