<!DOCTYPE html>
<html lang="en">
<head>
<title>The Art of Cooking</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
<!--<link rel="stylesheet" href="css/grid.css" type="text/css" media="screen"> -->
<link rel="icon" href="images/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link href="http://fonts.googleapis.com/css?family=PT+Serif+Caption:400,400italic" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen">
<script src="js/jquery-1.7.1.min.js" ></script>
<script src="js/superfish.js"></script>
<script src="js/jquery.flexslider-min.js"></script>
<script>
jQuery(window).load(function () {
    jQuery('.flexslider').flexslider({
        animation: "fade",
        slideshow: true,
        slideshowSpeed: 7000,
        animationDuration: 600,
        prevText: "",
        nextText: "",
        controlNav: false
    })
});
</script>
</head>
<body>
<header>
  <div class="line-top"></div>
  <div class="main">
    <div class="row-top">
      <h3><em><font face="verdana" color="red"> Art of Cooking</font></em></h3>
	  
      <nav>
        <ul class="sf-menu">
			<?php 
				$_POST['current'] = 1;
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
			echo '<h5 style="color: orangered"; align="right"> You are logged in as: '. $_SESSION['name'] .' </h5>';		
			
		}
	?>
  </div>
  <div class="box-slider">
    <div class="flexslider">
    <ul class="slides">
        <li> <img alt="" src="images/slide-2.jpg"></li>
        <li> <img alt="" src="images/slide-1.jpg"></li>
	</ul>
    </div>
  </div>
  <div class="box-slogan">
    <h3>Welcome to Art of Cooking!</h3>
    <h5> This is one of our several ways of being a blessing to women around us.....Yes! You can cook too.  </h5>
  </div>
</header>
<footer>
  <div class="main">
    <<div class="policy"><a style="color:green!important" href="#">Copyright @ 2014 Art of cooking powered by Babitha Bokka & Vaidehi Putta </div>
    <div class="clear"></div>
  </div>
</footer>
</body>
</html>