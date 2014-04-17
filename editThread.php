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
				
				<h3>Edit your comment here</h3>
				<?php
				
					require_once("config.php");
					$thread_id=$_POST['thread_id'];
					$_SESSION['thread_id']=$thread_id;
					
					$retreive="SELECT 
									thread_name 
							   FROM
									P3_thread 
							   WHERE
									thread_id ='$thread_id'";
					$result = mysql_query($retreive) or die ("Unable to verify user because " . mysql_error());
					
					$count = mysql_num_rows($result);
					if($count==1)
					{
						$row = mysql_fetch_assoc($result);
					?>
					<div class="btns" > 
						<form action="insertEditedThread.php"  method="post">
						<textarea autofocus rows ="6" cols="56" name="threadEdited" ><? echo $row['thread_name']; ?></textarea><br>
						<input class="btn" align="center" type="submit" value="editThread">
						</form>
					</div>
					<?php
					}
					?>
				</br>
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
