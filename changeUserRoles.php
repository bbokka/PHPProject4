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
			$_POST['selected'] = 1;
			include "FeaturesBar.php"; 
		?>
		<?php
			require_once("config.php");
			
			
			//query to get the number of posts in that thread	
			$query="SELECT
					count(login_id )
				FROM 
					P4_user_login" ;
			$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
			$row=mysql_fetch_array($result);
			$rows=$row[0];
			
			//query to set the page limit value
			$query1="SELECT 
					limit_value 
				FROM 
					P4_limit";
					
			$result1 = mysql_query($query1) or die ("Unable to verify user because " . mysql_error());
			$row1=mysql_fetch_array($result1);
			$page_rows = $row1['limit_value'];
			
			$last = ceil($rows/$page_rows);
	
			if($last < 1)
			{
				$last = 1;
			}
			
			$pagenum = 1;
			if(isset($_GET['pn'])){
				$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
			}
			
			if ($pagenum < 1) { 
				$pagenum = 1; 
			} else if ($pagenum > $last) { 
				$pagenum = $last; 
			}
			
			$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
			
			$retreive = "SELECT 
							U.fname,
							U.rank,
							UL.rank_id ,
							U.username,
							UL.title,
							U.login_id 
						FROM 
							P4_user_login U,
							P4_user_level UL 
						WHERE 
							U.rank=UL.rank_id 
						ORDER BY
							UL.rank_id ASC $limit";
			$result = mysql_query($retreive) or die ("Unable to verify user because " . mysql_error());
			
			$paginationCtrls = '';

			if($last != 1){
			
			if ($pagenum > 1) {
				$previous = $pagenum - 1;
				$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF']. '?pn='.$previous.'">Previous</a> &nbsp; &nbsp; ';
				
				
				
				
				for($i = $pagenum-4; $i < $pagenum; $i++){
					if($i > 0){
						$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
					}
				}
			}
			
			$paginationCtrls .= ''.$pagenum.' &nbsp; ';
			
			for($i = $pagenum+1; $i <= $last; $i++){
				$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
				if($i >= $pagenum+4){
					break;
				}
			}
			
			
			if ($pagenum != $last) {
				$next = $pagenum + 1;
				$paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF']. '?pn='.$next.'>Next</a> ';
			}
		}
			$list = '';

			?>
			
			<h5 style="color:blue"> Change The Roles </h5>	
			<?php
				while($row = mysql_fetch_assoc($result)) 
				{
					if($row['fname']!=$_SESSION['name'])
					{
						echo '<h5> <div style="width:100%; max-width:1024px; min-height:50px; padding:10px; -webkit-border-radius: 10px; -moz-border-radius: 10px;box-shadow: 10px 10px 5px #888888; border-radius: 10px; background-color:white; margin-bottom : 5px;">';
						echo  $row['username'].'  <-'.$row['title'].'->';
						if($row['rank_id'] != 4)
						echo '<form action="changeRole.php" name="form" method="post">
							  <input type="radio" name="role" value="1">Admin
							  <input type="radio" name="role" value="2">Moderator
							  <input type="radio" name="role" value="3">User<br>
							  <input type="hidden" name="userid" value='.$row['login_id'].'>
							  <input class="btn" type="submit" value="Update" >
							  </form>';
						echo '</div></h5>';
					}
				}
				$role = $_POST['role'];
			?>	
		<div>
		   <h4 textcolor='red'><?php echo $paginationCtrls; ?></h4>
		</div>
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