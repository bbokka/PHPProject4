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
		font-family: Georgia, "Times New Roman", Times, serif;
		font-weight: normal;
		font-style:initial ;
		color:orangeRed;
		
		-webkit-border-radius: 10px;
		-moz-border-radius: 10px;
		border-radius: 10px;
	}
	.category_navigation a:hover
	{
		text-decoration: underline;
	}
	.search_results
	{
		width: 100%;
		padding: 10px;
		background: #FBB917;
		color: white;
		
		-webkit-border-radius: 10px;
		-moz-border-radius: 10px;
		border-radius: 10px;
	}
	.search_Container
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
	.search_path
	{
		color:blue;
		font-family: Georgia, "Times New Roman", Times, serif;
		font-weight: normal;
		font-style: italic;
		text-decoration: underline;
	}
	.search_Content
	{
		width:100%;
		color:green;
		font-family: Georgia, "Times New Roman", Times, serif;
		font-weight: normal;
		font-style:initial ;
	}
	div.search_C
	{
		width: 65%;
		float: left;
	}
	div.search_Co
	{
		width: 5%;
		float: right;
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
	if(!empty($_POST['searchword']))
	{
		echo '	<div class = "category_navigation">
					<h3 style="color:white"><a href="showCategory.php" style="color:white">Forums</a> >>Search</h3>
				</div>';
		echo '	<div class = "search_results">
					<h3 style="color:white"> Single Forum Search Results</h3>
				</div>';
		$search_word=mysql_real_escape_string( $_POST['searchword']);
		$cat_val=mysql_real_escape_string( $_POST['cat_name']);
		$submit_btn= mysql_real_escape_string( $_POST["submit"]);
		
		$query1="SELECT * FROM P4_threads " .
					"WHERE MATCH(thread_name) AGAINST('$search_word' IN BOOLEAN MODE) 
				and category_id=$cat_val
				and is_archived=0
				order by creation_date";
					
		$result1= mysql_query($query1) or die ("Unable to verify user because " . mysql_error());
		
		while($row1 = mysql_fetch_array($result1))
		{
			$th_id= $row1['thread_id'];
			$th_name=$row1['thread_name'];
			$cat_id1=$row1['category_id'];
			
		
			$query3="select * from P4_categories where id=$cat_id1";
				$result3= mysql_query($query3) or die ("Unable to verify user because " . mysql_error());
				while($row3 = mysql_fetch_array($result3))
				{
					$cat_name1= $row3['cat_name'];
					echo '	<div class = "search_Container" >
								<div class = "search_path">
									<a href="showThread.php?category_id='.$cat_id1.'" style="color:blue">'.$cat_name1.'</a> 
								</div>
								<div class = "search_Content">
									<div class = "search_C">
										<a href="extractPost.php?thread_id='.$th_id.'" style="color:red">'.$th_name.'</a>
									</div>
									<div class = "search_Co">
										Topic
									</div>
								</div>				
							</div>';
				}
		}
		
		$query="SELECT thread_id,thread_name
				from P4_threads
				where category_id=$cat_val";
					
		$result= mysql_query($query) or die ("Unable to verify user because " . mysql_error());
		
		while($row = mysql_fetch_array($result))
		{
			$th_id= $row['thread_id'];
			$th_name=$row['thread_name'];
			
			
			$query2="SELECT * FROM P4_posts " .
					"WHERE MATCH(post_content) AGAINST('$search_word' IN BOOLEAN MODE) 
					and Is_archived=0
					and thread_id=$th_id
					order by date_created";
					
			$result2= mysql_query($query2) or die ("Unable to verify user because " . mysql_error());
			
			while($row2 = mysql_fetch_array($result2))
			{  

				$content= $row2['post_content'];
				$thread_id1=$row2['thread_id'];
				
				$query4="select * from P4_threads where thread_id=$thread_id1";
				$result4= mysql_query($query4) or die ("Unable to verify user because " . mysql_error());
				while($row4 = mysql_fetch_array($result4))
				{
					$thread_name1= $row4['thread_name'];
					$cat_id1=$row4['category_id'];
					
					$query5="select * from P4_categories where id=$cat_id1";
					$result5= mysql_query($query5) or die ("Unable to verify user because " . mysql_error());
					while($row5 = mysql_fetch_array($result5))
					{
						$cat_name1= $row5['cat_name'];
						echo '	<div class = "search_Container" >
								<div class = "search_path">
									<a href="showThread.php?category_id='.$cat_id1.'" style="color:blue">'.$cat_name1.'</a> ';
									echo ' >> ';
									echo '<a href="extractPost.php?thread_id='.$thread_id1.'" style="color:red">'.$thread_name1.'</a>
								</div>
								<div class = "search_Content">
									 <div class = "search_C">
										'.$content.'
									</div>
									<div class = "search_Co">
										Post
									</div>
								</div>								
							</div>';
					} 
				}
			}
		}
	}
	else
	{
		echo '	<script type="text/javascript">
					alert("Please enter a search keyword!!");
					history.back();
				</script>';
	}
	
?>
</div>
	</div>
</section>
<footer>
  <div class="main">
    <div class="policy"> <h5 style="color:green!important" >Copyright @ 2014 Art of cooking powered by Babitha Bokka & Vaidehi Putta </h5></div>
    <div class="clear"></div>
  </div>
</footer>
</body>
</html>

